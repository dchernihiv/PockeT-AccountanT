@extends('layouts.base')

@section('content')

    @if(session('message'))
        <div class="alert alert-success mx-auto col-4 mt-4">{{ session('message') }}</div>
    @endif

    <div class="d-flex flex-column mx-auto col-4 mt-5 pt-2 pb-2 ps-2 pf-2 form-box" style="color: white; line-height: 1em;">

        <p>На ваш email був відправлений лист з посиланням.</br>
        Будь ласка перейдіть за посиланням для підтвердження адреси.</p>

        <div class="d-flex flex-row mt-2">
            <button type="button" class="btn me-4"><a href="{{ route('verification.send') }}">Надіслати</a></button>
            <p>Не надійшов лист? Повторно надіслати лист з посиланням.</p>
        </div>
    </div>
    
@endsection

@section('footer')
    @include('includes.footer')
@endsection