@extends('layouts.base')

@section('content')

    <div class="conteiner d-flex flex-row justify-content-end mt-4 me-4">
        <button type="button" class="btn">
        <a href="{{ route('web.transaction') }}">В попереднє меню</a>
        </button>
    </div>

    <div class="conteiner form-box col-8 mx-auto">
        <div class="frame mt-4 ms-2 me-2">
            <div class="d-flex flex-row ms-2 me-2 mt-4 mb-4">
                <p>вибрати період:</p>

                <div class="d-flex flex-row ms-5">
                    <label for="period-start" class="form-label me-3">з</label>
                    <input type="date" id="period-start" name="period-start" class="form-control">
                </div>

                <div class="d-flex flex-row">
                    <label for="period-end" class="form-label ms-5 me-3">по</label>
                    <input type="date" id="period-end" name="period-end" class="form-control">
                </div>
            </div>
        </div>

        <div class="frame mt-4 ms-2 me-2">
            <div class="d-flex flex-row ms-2 mt-4 mb-4">
                <button type="button" class="btn me-3" name="send-period">Ok</button>
                <p style="color:white;">відобразити транзакції за вказаний період</p>
            </div>

            <div id="table" class="mb-4 mt-4 ms-2 me-2">
                @include('web.category.result-table')
            </div>
        </div>

        <div class="d-flex flex-row mt-4 ms-2 mb-4">
            <button type="button" class="btn me-4">змінити</button>
            <button type="button" class="btn">видалити</button>
        </div>
    </div>

@endsection

@section('footer')
@include('includes.footer')
@endsection