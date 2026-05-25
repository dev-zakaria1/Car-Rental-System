<x-guest-layout>
    <div class="text-center mt-4">
        <h1 class="h2">Get started</h1>
        <p class="lead">
            Start creating the best possible user experience for you customers.
        </p>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="m-sm-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input class="form-control form-control-lg" type="text" name="name"
                            placeholder="Enter your name" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control form-control-lg" type="email" name="email"
                            placeholder="Enter your email" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">phone</label>
                        <input class="form-control form-control-lg" type="phone" name="phone"
                            placeholder="Enter your phone" required />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control form-control-lg" type="password" name="password"
                            placeholder="Enter password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="form-control form-control-lg" type="password"
                            name="password_confirmation" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-lg btn-primary">Sign up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-guest-layout>
