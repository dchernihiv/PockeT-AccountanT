@extends('layouts.base')

@section('content')
    <div>
        <canvas id="report" width="50%" height="auto"></canvas>
    </div>

    <script src="{{ asset('resources/assets/js/chart.js')  }}"></script>
@endsection

@section('footer')
@include('includes.footer')
@endsection