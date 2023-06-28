@extends('layouts.base')

@section('content')

    <div class="mt-4 me-4" style="float: right;">
        <button class="btn"><a class="text-decoration-none text-reset" href="{{ route('logout') }}">logout</a></button>
    </div>

    <div class="conteiner d-flex flex-row justify-content-evenly align-items-center" style="height: 100vh;">

        <div class="category mb-5">
            <a href="{{ route('web.transaction') }}" title="внесення доходів / видатків">
                <img src="{{ asset('/pictures/icons/categories.png') }}" class="img-fluid">
            </a>
        </div>

        <div class="category mb-5">
            <a href="{{ route('web.form-report') }}" title="звіти">
                <img src="{{ asset('/pictures/icons/chart.png') }}" class="img-fluid">
            </a>
        </div>

    </div>
@endsection

@section('footer')
@include('includes.footer')
@endsection