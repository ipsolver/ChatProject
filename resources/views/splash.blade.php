@extends('layouts.app')
@section('content')
    <div class="pt-5">
        <div class="container">
            <noscript>
                <div class="alert alert-danger shadow h4"><span class="float-right"><i class="fab fa-js-square fa-2x"></i></span> Здається, у вашому браузері вимкнено JavaScript. Щоб продовжувати користуватися моїм веб-сайтом, ви повинні спочатку
                    <a class="alert-link" rel="nofollow" target="_blank" href="https://www.enable-javascript.com/"> увімкнути javascript</a></div>
            </noscript>
            <div class="hero">
    <div class="typing-text">Welcome to Chatter!</div>
    <div class="hero-subtitle">A real-time chat experience like never before</div>
</div>


<div class="landing">
  <h1 class="landing-title">Вітаємо в <span>Chatter</span></h1>
  <p class="landing-subtitle">Твоє затишне місце для реального спілкування</p>
        </div>
    </div>
    @include('demo')
@endsection
