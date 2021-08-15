@extends('layout.default')
@section('content')
    <div class="container-xl">
        <nav class="navbar navbar-expand-xl bg-dark navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="{{ asset($restaurant->logo) }}" height="30" alt="">
            </a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item text-white">
                        Správa menu - {{ $restaurant->name }}
                    </li>
                </ul>
        </nav>
        <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item text-white">
                    Správa menu - {{ $restaurant->name }}
                </li>
            </ul>
        </nav>
        <div class="row">
            <div class="col-3 ">
                <div class="list-group">
                    <button class="list-group-item">16. 8. - 22. 8. 2021<span class="float-right">&gt</span></button>
                    <button class="list-group-item active">16. 8. - 22. 8. 2021<span class="float-right">&gt</span></button>
                </div>
            </div>

        </div>


    </div>
@endsection
