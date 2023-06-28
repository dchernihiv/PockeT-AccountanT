@extends('layouts.base')

@section('content')
    <div class="conteiner">

        <div class="d-flex flex-row justify-content-end mt-4 me-4">
            <button type="button" class="btn">
            <a href="{{ route('web.transaction') }}">В попереднє меню</a>
            </button>
        </div>

        <div class="form-box col-8 mx-auto">

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

            <div class="frame mt-4 mb-4 ms-2 me-2">
                <div class="d-flex flex-row ms-2 mt-4 mb-4">
                    <button type="button" class="btn me-3" name="send-period">Ok</button>
                    <p style="color:white;">відобразити транзакції за вказаний період</p>
                </div>

                <div id="table" class="mb-4 mt-4 ms-2 me-2">
                    @include('web.category.result-table')
                </div>

                <div class="d-flex flex-row mt-4 ms-2 mb-4 button-block">
                    <button type="button" class="btn me-4" name="change">змінити</button>
                    <button type="button" class="btn" name="remove">видалити</button>
                </div>

            </div>

            <div class="modify frame ms-2 me-2 mb-4">
                <form method="post" class="d-flex flex-row">
                    @csrf

                    <div class="title"></div>
                    <input type="text" hidden>

                    <div class="mt-2 mb-3 ms-2 me-2 col-2">
                        <label for="date" class="form-label">дата</label>
                        <input type="date" id="date" class="form-control" name="update-date">
                    </div>

                    <div class="mt-2 mb-3 me-2" style="width: 7vw;">
                        <label for="transaction" class="form-label">транзакція</label>
                        <input type="text" id="transaction" class="form-control" name="update-transaction">
                    </div>

                    <div class="mt-2 mb-3 me-2 col-3">
                        <label for="category" class="form-label">категорія</label>
                        <input type="text" id="category" class="form-control" name="update-category">
                    </div>

                    <div class="mt-2 mb-3 me-2 col-3">
                        <label for="subcategory" class="form-label">підкатегорія</label>
                        <input type="text" id="subcategory" class="form-control" name="update-subcategory">
                    </div>

                    <div class="mt-2 mb-3 me-2 col-1">
                        <label for="sum" class="form-label">сума</label>
                        <input type="text" id="sum" class="form-control" name="update-sum">
                    </div>

                    <div class="mt-2 mb-3 me-2 col-1">
                        <label for="currency" class="form-label">валюта</label>
                        <input type="text" id="currency" class="form-control" name="update-currency">
                    </div>

                </form>

                <div class="d-flex flex-row justify-content-between mt-2">
                    <button type="button" class="btn ms-2 mb-2" name="apply-modify">застосувати зміни</button>
                    <div class="d-flex flex-row">
                        <p style="color: white;">вийти з режиму редагування записів</p>
                        <button type="button" class="btn ms-2 me-2 mb-2" name="cancel">
                            <a href="{{ route('web.modify') }}">вийти</a>
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('footer')
@include('includes.footer')
@endsection