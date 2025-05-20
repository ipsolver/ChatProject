<ul class="navbar-nav">
    <li class="nav-item {{request()->route() && request()->route()->getName() === 'register' ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('register') }}">Зареєструватися <i class="fas fa-user-plus"></i></a>
    </li>
    <li class="nav-item {{request()->route() && request()->route()->getName() === 'login' ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('login') }}">Увійти <i class="fas fa-sign-in-alt"></i></a>
    </li>
</ul>
