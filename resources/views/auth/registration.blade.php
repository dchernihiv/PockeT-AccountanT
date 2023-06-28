@extends('layouts.base')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger col-4 mx-auto">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="conteiner d-flex flex-row justify-content-end mt-4 me-4">
        <button type="button" class="btn">
            <a href="{{ route('login') }}">В попереднє меню</a>
        </button>
    </div>

    <div class="conteiner form-box col-4 mx-auto my-5">
        <div class="text-center fs-3 name">Реєстрація</div>
        <form method="post" autocomplete="off">
            @csrf

            <div class="mt-3 ms-2 me-2">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" class="form-control my-2" name="email">
            </div>

            <div class="mt-3 ms-2 me-2">
                <label for="password" class="form-label">Пароль:</label>
                <input type="password" id="password" class="form-control my-2" name="password">  
            </div>

            <input type="submit" class="btn my-4 ms-2" value="Регистрация">
        </form>
    </div>

@endsection

@section('footer')
    @include('includes.footer')
@endsection