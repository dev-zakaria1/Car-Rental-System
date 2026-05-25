<form method="POST" action="{{ route('logout') }}">
    @csrf

    <a class="nav-link d-flex align-items-center justify-content-center py-3 px-4 shadow-sm w-75 mx-auto mb-4"
        style="background-color: transparent; color: #eb1010; border: 2px solid #b91d1d; border-radius: 12px; transition: all 0.3s ease-in-out; margin-top: 20px; font-weight: bold; cursor: pointer;"
        onmouseover="this.style.backgroundColor='#fef2f2'; this.style.transform='translateY(-2px)';"
        onmousedown="this.style.backgroundColor='#b91d1d'; this.style.color='#eb1010'; this.style.transform='scale(0.95)';"
        onmouseup="this.style.backgroundColor='transparent'; this.style.color='#b91d1d'; this.style.transform='scale(1)';"
        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#eb1010'; this.style.transform='translateY(0)';"
        :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">

        <i class="fas fa-sign-out-alt me-2"></i> {{ __('Log Out') }}
    </a>
</form>
#b91d1d