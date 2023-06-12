@extends('layouts.base')

@section('content')

<div class="conteiner d-flex flex-row justify-content-end mt-4 me-4">
    <button type="button" class="btn">
        <a href="{{ route('web.category') }}">В головне меню</a>
    </button>
</div>

@if ($errors->any())
    <div class="validationErrors mx-auto">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="conteiner">

    <div class="validationErrors mx-auto mt-2">
        <ul>
            <li style="display: none;"></li>
        </ul>
    </div>

    <div class="col-md-5 mx-auto mt-2 mb-4 form-box">
    
        <form method="post">
            @csrf

            <div class="frame ms-2 me-2 mt-2 mb-2">
                <div class="radio">
                    <div class="form-check mt-4 ms-2 me-2">
                        <label for="income" class="form-check-label">доходи</label>
                        <input type="radio" class="form-check-input" id="income" name="transaction" value="income">
                    </div>

                    <div class="form-check ms-2 me-2">
                        <label for="expenses" class="form-check-label">видатки</label>
                        <input type="radio" class="form-check-input" id="expenses" name="transaction" value="expenses">
                    </div>
                </div>

                <div class="col-4 mt-2 mb-4 ms-2">
                    <label for="date" class="form-label">дата</label>
                    <input type="date" id="date" name="date" class="form-control">
                </div>
            </div>

            <div class="frame ms-2 me-2 mt-4 mb-2">

                <div class="d-flex flex-row mt-4 ms-2 me-2">
                    <label for="category" class="form-label">категорії</label>
                    <select name="category" class="form-select ms-4" id="category"></select>

                    <button type="button" class="btn ms-4 add" value="add-category">+</button>
                </div>

                <div class="d-flex flex-row mt-4 ms-2 me-2">
                    <label for="subcategory">підкатегорії</label>
                    <select name="subcategory" class="form-select ms-4" id="subcategory"></select>

                    <button type="button" class="btn ms-4 add" value="add-subcategory">+</button>
                </div>

                <div class="d-flex flex-row mt-4 mb-4 ms-2 me-2">

                    <label for="sum" class="form-label me-4">сума</label>
                    <input type="number" id="sum" name="sum" class="form-control">
            
                    <label for="currency" class="form-label ms-4 me-4">валюта</label>
                    <select name="currency" class="form-select" id="currency"></select>
            
                    <button type="button" class="btn add ms-4" value="add-currency">+</button>
                
                </div>
            </div>

            <div class="d-flex flex-row justify-content-between mt-4 mb-4 ms-2 me-2">
                <input type="submit" class="btn" name="btn" value="Додати">

                <div class="d-flex flex-row">
                    <p>змінити/видалити записи?</p>
                    <button type="button" class="btn ms-3" >
                        <a href="http://buh.ua/table/modify">Так</a>
                    </button>
                </div>
            </div>

        </form>
        
    </div>

    <div class="window col-3">
        <form method="post">
            @csrf

            <div class="mt-2 mb-3 ms-2 me-2">
                <label for="new-category" class="form-label title"></label>
                <input type="text" id="new-category" class="form-control" name="new-item">
            </div>

            <div class="d-flex flex-row">
                <button type="button" class="btn ms-2 mb-2" name="add-item" value="add">Додати
                <button type="button" class="btn ms-2 mb-2" name="cancel">Вийти
            </div>
        </form>
    </div>
</div>

@endsection

@section('footer')
@include('includes.footer')
@endsection