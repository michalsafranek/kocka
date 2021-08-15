@extends('layout.default')

@section('content')
    <div class="container-xl">
        <nav class="navbar navbar-expand-xl bg-dark navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item text-white">
                        Správa menu
                    </li>
                </ul>
            </div>
        </nav>


        <h3 class="my-4">
            Vyberte restauraci
        </h3>
        <div class="row justify-content-md-center">
            <div class="col-md-3">
                <a href="/menu/zamek" class="btn btn-block  bg-dark btn-outline-secondary d-flex flex-wrap align-items-center" style="min-height: 120px;">
                    <img src="{{ asset('images/logo_zamek.png') }}" class="w-100"/>
                </a>
            </div>
            <div class="col-1">&nbsp;</div>
            <div class="col-md-3">
                <a href="/menu/kocka" class="btn btn-block  bg-dark btn-outline-secondary d-flex flex-wrap align-items-center" style="min-height: 120px;">
                    <img src="{{ asset('images/logo.png') }}" class="w-100"/>
                </a>
            </div>
        </div>
    </div>

    @endsection
</div>
