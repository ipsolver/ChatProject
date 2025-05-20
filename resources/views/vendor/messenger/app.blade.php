<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="application-name" content="FS">
    <meta name="theme-color" content="#343a40">
    <meta name="msapplication-navbutton-color" content="#343a40">
    <meta name="msapplication-starturl" content="/">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('vendor/messenger/images/favicon-16x16.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="title" content="@yield('title', config('messenger-ui.site_name'))">
    <title>@yield('title', config('messenger-ui.site_name'))</title>
    @auth
        <link id="main_css" href="{{ asset(mix(messenger()->getProviderMessenger()->dark_mode ? 'app.css' : 'app.css', 'vendor/messenger')) }}" rel="stylesheet">
    @else
        <link id="main_css" href="{{ asset(mix('app.css', 'vendor/messenger')) }}" rel="stylesheet">
    @endauth
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    @stack('css')
</head>
<style>

.landing {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 80vh;
    text-align: center;
    background-color: #f4f9ff;
    padding: 2rem;
    border-radius: 12px;
}
.landing-title span {
    background: linear-gradient(to right, #0d6efd, #6f9eff);
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
    -webkit-text-fill-color: transparent;
    display: inline-block;
}
.landing-title span {
    background: linear-gradient(to right, #0d6efd, #6f9eff);
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
    -webkit-text-fill-color: transparent;
}

.landing-subtitle {
    font-size: 1.2rem;
    color: #555;
    max-width: 600px;
    margin-bottom: 2rem;
}

.hero {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 90vh;
    background: linear-gradient(135deg, #0d6efd, #6f9eff, #a8c2ff);
    color: #fff;
    text-align: center;
    padding: 0 20px;
    border-radius: 12px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    font-family: 'Lato', sans-serif;
    position: relative;
    overflow: hidden;
}

.typing-text {
    font-size: 2.5rem;
    font-weight: bold;
    border-right: 3px solid rgba(255,255,255,0.75);
    white-space: nowrap;
    overflow: hidden;
    width: 0;
    animation: typing 2.0s steps(18, end) forwards, blink .75s step-end infinite;
}

@keyframes typing {
    from { width: 0; }
    to { width: 38%; }
}

@keyframes blink {
    50% { border-color: transparent; }
}

.hero-subtitle {
    margin-top: 20px;
    font-size: 1.5rem;
    background: linear-gradient(45deg, #ffffff, #d6e6ff);
    background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: fadeInUp 2s ease forwards;
    opacity: 0;
    transform: translateY(20px);
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

    </style>
<body>
<wrapper class="d-flex flex-column">
    <nav id="FS_navbar" class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark {{request()->is('messenger/*') && app('agent')->isMobile() ? 'NS' : ''}}">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{ asset('vendor/messenger/images/messenger.png') }}" width="30" height="30" class="d-inline-block align-top" alt="Messanger">
            Chatter
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="badge badge-pill badge-danger mr-n2" id="nav_mobile_total_count"></span>
        </button>
        <div id="navbarNavDropdown" class="navbar-collapse collapse">
            @auth
                @include('messenger::nav')
            @else
                @include('layouts.guest')
            @endauth
        </div>
    </nav>
    @if(app('agent')->isMobile() && request()->is('messenger/*'))
        <main id="FS_main_section" class="pt-0 mt-3 flex-fill">
            @else
                <main id="FS_main_section" class="{{request()->is('messenger*') ? 'pt-5' : 'py-5'}} mt-4 flex-fill">
                    @endif
                    <div id="app">
                        @yield('content')
                    </div>
                </main>
</wrapper>
@include('messenger::scripts')
</body>
</html>
