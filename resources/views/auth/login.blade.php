@extends('layouts.base');

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

    <div class="conteiner">
        <div class="d-flex flex-row justify-content-end me-2">
            <button class="btn"><a class="text-decoration-none text-reset" href="{{ route('logout') }}">Вихід</a></button>
        </div>

        <div class="form-box col-4 mx-auto">
            <div class="text-center fs-3 name">Аутентифікація</div>
            
            <form method="post">
                @csrf

                <div class="ms-2 me-2">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" class="form-control" name="email">
                </div>

                <div class="mt-3 ms-2 me-2">
                    <label for="password" class="form-label">Пароль:</label>
                    <input type="password" id="password" class="form-control" name="password">
                </div>

                <div class="mt-3 ms-2 me-2">
                    <label for="confirm" class="form-label">Підтвердити пароль:</label>
                    <input type="password" id="confirm" class="form-control" name="password_confirmation">
                </div>    

                <div class="row mx-auto mt-3 ms-2">
                    <div class="col-6 form-check">
                        <label for="remember" class="form-check-label">Запам'ятати мене</label>
                        <input type="checkbox" class="form-check-input" id="remember" name="remember" checked>
                    </div>

                    <a href="" class="col-6 d-flex justify-content-end"><span>Забули пароль?</span></a>
                </div>

                <input type="submit" class="btn my-3 ms-2" value="Увійти">
            </form>

            <div class="d-flex flex-row ms-2">
                <p>Не зареєстровані?</p>
                <a href="{{ route('registr') }}" class="ms-3 justify-content-end"><span>Зареєструватися</span></a>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    @include('includes.footer')
@endsection