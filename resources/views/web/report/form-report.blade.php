@extends('layouts.base')

@section('content')
    <div class="page">

        <div class="validationErrors mx-auto mt-4">
            <ul>
                <li style="display: none;"></li>
            </ul>
        </div>

        <div class="conteiner chart mb-4" style="display: none;">

            <div class="conteiner d-flex flex-row justify-content-end mt-4 me-4">
                <button type="button" class="btn">
                    <a href="{{ route('web.form-report') }}">В попереднє меню</a>
                </button>
            </div>

            <div class="report-conteiner mx-auto" style="width: 60vw; height: 70vh;">
                <canvas id="report"></canvas>
            </div>

        </div>

        <div class="conteiner report">

            <div class="conteiner d-flex flex-row justify-content-end me-4">
                <button type="button" class="btn">
                    <a href="{{ route('web.category') }}">В головне меню</a>
                </button>
            </div>

            <div class="form-box col-5 mx-auto mb-5"> 

                <form method="POST">
                    @csrf

                    <div class="frame d-flex flex-row ms-2 me-2 mt-4 mb-4">

                        <div class="form-check ms-2 mt-3 mb-3">
                            <label for="linear" class="form-check-label">лінійний графік</label>
                            <input type="radio" id="linear" class="form-check-input" name="type-report" value="line">
                        </div>

                        <div class="form-check ms-5 mt-3 mb-3">
                            <label for="gistogram" class="form-check-label">гістограма</label>
                            <input type="radio" id="gistogram" class="form-check-input" name="type-report" value="bar">
                        </div>

                    </div>

                    <div class="frame ms-2 me-2 mb-4">
                        <p class="ms-2 mt-3">звітний період:</p>
                        <div class="ms-2 me-2 mt-2 d-flex flex-row">

                            <label for="period-start" class="form-label me-3">з</label>
                            <input type="date" id="period-start" name="period" class="form-control">

                            <label for="period-end" class="form-label ms-5 me-3">по</label>
                            <input type="date" id="period-end" name="period" class="form-control">

                        </div>

                        <div class="radio d-flex flex-row">

                            <div class="form-check mt-4 ms-2 me-4">
                                <label for="income" class="form-check-label">доходи</label>
                                <input type="radio" class="form-check-input" id="income" name="transaction" value="income">
                            </div>

                            <div class="form-check mt-4">
                                <label for="expenses" class="form-check-label">видатки</label>
                                <input type="radio" class="form-check-input" id="expenses" name="transaction" value="expenses">
                            </div>
                            
                        </div>

                        <div class="ms-2 me-2 mt-3 col-8">
                            <label for="category" class="form-label">категорії</label>
                            <select name="category" id="category" class="form-select"></select>
                        </div>

                        <div class="ms-2 me-2 mt-3 col-8">
                            <label for="subcategory" class="form-label">підкатегорії</label>
                            <select name="subcategory" id="subcategory" class="form-select"></select>
                        </div>

                        <div class="ms-2 mt-4 mb-4">
                            <label for="generate">згенерувати звіт</label>
                            <input type="button" id="generate" class="btn mt-2" value="go" name="generate">
                        </div>
    
                    </div>

                </form>

            </div> 

        </div>
        
    </div>

@endsection

@section('footer')
@include('includes.footer')
@endsection