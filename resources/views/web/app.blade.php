@extends('layouts.base')

@section('content')
    <div class="conteiner d-flex flex-row justify-content-evenly align-items-center" style="height: 100vh;">

        <div class="category mb-5">
            <a href="{{ route('web.transaction') }}" title="внесення доходів / видатків">
                <img src="{{ asset('/pictures/icons/categories.png') }}" class="img-fluid">
            </a>
        </div>

        <div class="category mb-5">
            <a href="{{ route('web.report') }}" title="звіти">
                <img src="{{ asset('/pictures/icons/chart.png') }}" class="img-fluid">
            </a>
        </div>

        <div class="category mb-5">
            <a href="{{ route('web.category') }}" title="налаштування">
                <img src="{{ asset('/pictures/icons/settings.png') }}" class="img-fluid">
            </a>
        </div>

    </div>
@endsection

@section('footer')
@include('includes.footer')
@endsection