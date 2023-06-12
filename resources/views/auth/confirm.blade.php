@extends('layouts.base')

@section('content')
    <div class="conteiner mx-auto mt-5 col-4 ps-2 pf-2 form-box" @style([
        'color: white',
        'min-height: 10vw',
        'display: flex',
        'align-items: center'
    ])>
        <p>На ваш email був відправлений лист. Будь ласка перейдіть за посиланням для підтвердження email</p>
    </div>
@endsection

@section('footer')
    @include('includes.footer')
@endsection