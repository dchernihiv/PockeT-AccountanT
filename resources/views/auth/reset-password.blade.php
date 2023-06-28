@extends('layouts.base')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger mx-auto col-4 mt-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="conteiner form-box mx-auto col-4 mt-4">
        <form method="post" action="{{ url('/reset-password') }}" autocomplete="off">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mt-4 mb-4 ms-2 me-2">
                <label for="email" class="form-label">введіть email</label>
                <input type="email" id="email" class="form-control" name="email">
            </div>

            <div class="mb-4 ms-2 me-2">
                <label for="password" class="form-label">введіть пароль</label>
                <input type="password" id="password" class="form-control" name="password">
            </div>

            <div class="mb-4 ms-2 me-2">
                <label for="confirm-password" class="form-label">підтвердіть пароль</label>
                <input type="password" id="confirm-password" class="form-control" name="password_confirmation">
            </div>

            <input type="submit" class="btn ms-2 mb-4" value="застосувати зміни">

        </form>
    </div>

@endsection

@section('footer')
    @include('includes.footer')
@endsection