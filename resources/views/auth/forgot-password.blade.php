@extends('layouts.base')

@section('content')

        <div class="mx-auto col-4 mt-5">
            @if(session('status'))
                <div class="alert alert-success">
                    <ul>
                        <li>{{ session('status') }}</li>
                    </ul>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="conteiner form-box mx-auto col-4 mt-4">
            <form method="post" autocomplete="off">
                @csrf

                <div class="mt-4 mb-4 ms-2 me-2">
                    <label for="forgot" class="form-label">введіть ваш email, на який буде відправлено посилання для зміни паролю</label>
                    <input type="email" id="forgot" class="form-control" name="email">
                </div>

                <input type="submit" class="btn ms-2 mb-4" value="надіслати">

            </form>
    </div>

@endsection

@section('footer')
    @include('includes.footer')
@endsection