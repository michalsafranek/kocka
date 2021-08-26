@extends('layout.default')

@section('content')
    <div class="container-xl">
        <nav class="navbar navbar-expand-xl bg-dark navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/menu">
                <img src="{{ asset($restaurant->logo) }}" height="30" alt="">
            </a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item text-white">
                    Správa e-mailů - {{ $restaurant->name }}
                </li>
            </ul>
        </nav>

        <div id="app">
            <menu-emails-component :restaurant="{{ $restaurant }}"></menu-emails-component>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/menu.js') }}"></script>
@endsection
