<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .payment-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            background: #ffffff;
        }

        .stripe-input-container {
            border: 1px solid #ced4da;
            padding: 12px;
            border-radius: 8px;
            background-color: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .stripe-input-container--focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        .btn-pay {
            background-color: #5469d4;
            border: none;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-pay:hover {
            background-color: #243d8c;
            transform: translateY(-1px);
        }

        .btn-pay:disabled {
            background-color: #aab7c4;
        }

        .header-icon {
            font-size: 2.5rem;
            color: #5469d4;
        }

        .amount-badge {
            font-size: 1.2rem;
            background: #eef2ff;
            color: #3730a3;
            border: 1px solid #c7d2fe;
        }

        /* ستايل العداد */
        .timer-box {
            border-radius: 10px;
            border: 1px dashed #ffc107;
            background-color: #fffdf5;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card payment-card p-4 mx-auto" style="max-width: 480px;">
            <div class="text-center mb-4">
                <div class="header-icon mb-2">💳</div>
                <h3 class="fw-bold">Secure Checkout</h3>
                <p class="text-muted small">Your payment information is encrypted and secure.</p>
            </div>

            <div id="timer-container" class="alert timer-box text-center mb-4 p-2">
                <div class="text-muted small fw-bold text-uppercase">Hold expires in:</div>
                <div id="countdown" class="h4 fw-bold text-warning mb-0">30:00</div>
            </div>

            <div class="alert amount-badge d-flex justify-content-between align-items-center mb-4">
                <span>Total Amount:</span>
                <span class="fw-bold text-dark">{{ number_format($booking->total_price, 2) }} €</span>
            </div>

            <form id="payment-form">
                <label class="form-label text-muted small fw-bold">CARD DETAILS</label>
                <div id="card-element" class="stripe-input-container mb-2"></div>
                <div id="card-errors" role="alert" class="text-danger mb-3 small" style="min-height: 20px;"></div>

                <button id="submit-button" class="btn btn-pay btn-lg w-100 py-3 text-white">
                    <span id="button-text">Pay {{ number_format($booking->total_price, 2) }} €</span>
                    <div class="spinner-border spinner-border-sm d-none" id="spinner" role="status"></div>
                </button>
            </form>

            <div class="text-center mt-4">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/ba/Stripe_Logo%2C_revised_2016.svg"
                    width="60" alt="Stripe">
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripeKey = "{{ config('services.stripe.key') }}";
        const clientSecret = "{{ $clientSecret }}";
        const bookingId = "{{ $bookingId }}";
        const expiresAt = {{ session('expiresAt', time() + 1800) }} * 1000;
        const stripe = Stripe(stripeKey);
        const elements = stripe.elements();
        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-button');
        const spinner = document.getElementById('spinner');
        const buttonText = document.getElementById('button-text');
        const countdownElement = document.getElementById("countdown");
        const containerElement = document.getElementById("timer-container");

        const style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSize: '16px'
            }
        };
        const cardElement = elements.create('card', {
            style,
            hidePostalCode: true
        });
        cardElement.mount('#card-element');

        // 3. منطق الدفع
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            setLoading(true);

            const {
                paymentIntent,
                error
            } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: "{{ Auth::user()->name }}"
                    },
                },
            });

            if (error) {
                document.getElementById('card-errors').textContent = error.message;
                setLoading(false);
            } else if (paymentIntent.status === 'succeeded') {
                window.location.href = "/payment-success";
            }
        });

        function setLoading(isLoading) {
            submitButton.disabled = isLoading;
            if (isLoading) {
                spinner.classList.remove('d-none');
                buttonText.classList.add('d-none');
            } else {
                spinner.classList.add('d-none');
                buttonText.classList.remove('d-none');
            }
        }


        async function cancelBookingOnServer() {
            try {
                const response = await fetch("{{ route('booking.cancel', $bookingId) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });
                if (response.ok) {
                    alert("Time is up! Booking cancelled.");
                    window.location.href = "{{ route('listing.index') }}";
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }

        function updateTimer() {
            const now = new Date().getTime();
            const distance = expiresAt - now;

            if (distance < 0) {
                clearInterval(timerInterval);
                countdownElement.innerHTML = "EXPIRED";
                countdownElement.classList.replace('text-warning', 'text-danger');
                containerElement.style.borderColor = "red";
                submitButton.disabled = true;
                buttonText.textContent = "Booking Expired";
                cancelBookingOnServer();
                return;
            }

            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownElement.innerHTML =
                (minutes < 10 ? "0" + minutes : minutes) + ":" +
                (seconds < 10 ? "0" + seconds : seconds);
        }

        updateTimer();
        const timerInterval = setInterval(updateTimer, 1000);
    </script>
</body>

</html>
