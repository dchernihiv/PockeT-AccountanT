<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\Currency;
use Illuminate\Http\Request;

class FinanceDataController extends Controller {

    /**
     * Отображение таблицы транзакций за выбраный период с возможностью дальнейшего редактирования записей
     */
    public function index(Request $request) {
     
        $startPeriod = $request->input('date')[0];
        $endPeriod = $request->input('date')[1];

        $data = Transaction::select('id', 'date', 'transaction', 'category_id', 'sum', 'currency_id')
            ->where('user_id', $request->user()->id)
            ->whereBetween('date', [$startPeriod, $endPeriod])
            ->get()
            ->toArray();
    
        for ($i = 0; $i < count($data); $i++) {

            $currency = Transaction::find($data[$i]['id'])
                ->currency
                ->currency;
        
            $categoryInstance = Transaction::find($data[$i]['id'])
                ->category;

            $category = $categoryInstance->category;

            $subcategory = ($categoryInstance->subcategory)
                ? $categoryInstance->subcategory
                : null;

            $data[$i]['subcategory'] = $subcategory;
            
            foreach ($data[$i] as $key => $value) {

                if ($key == 'category_id') {
                    $data[$i]['category'] = $category;
                    unset($data[$i][$key]);
                }
                if ($key == 'currency_id') {
                    $data[$i]['currency'] = $currency;
                    unset($data[$i][$key]);
                }
            }
        }

        return response()->json([
            'conteiner' => 'table',
            'html' => view('web.category.result-table', compact('data'))->render(),
        ]);
    
    }

    /**
     * Добавление новых транзакций в БД 
     */

    public function create(Request $request) {
    
        $data = $request->validate([
            'transaction' => 'required',
            'date' => 'date',
            'category' => 'required|doesnt_start_with:виберіть категорію...',
            'subcategory' => 'nullable',
            'sum' => 'required',
            'currency' => 'required'
        ]);

        $data['user_id'] = $request->user()->id;

        $data['category_id'] = Category::when($request->has('subcategory'),
            function($builder) {
                return $builder->where([
                    ['transaction', request('transaction')],
                    ['category', request('category')],
                    ['subcategory', request('subcategory')],
                ]);
            }, function($builder) {
                    return $builder->where([
                        ['transaction', request('transaction')],
                        ['category', request('category')]
                    ]);
        })->first()->id;

        $data['currency_id'] = Currency::where('currency', request('currency'))->first()->id;

        $array = collect($data)->except(['category', 'subcategory', 'currency'])->toArray();
        Transaction::create($array);
        
        return back();

    }

    /**
     * Изменение транзакций в БД
     */

    public function update(Request $request) {

        $category_id = Category::where([
                ['transaction', '=',  $request->input('transaction')],
                ['category', '=', $request->input('newItem')],
                ['subcategory', '=', $request->input('subNewItem')]
            ])
            ->first()
            ->id;

        $currency_id = Currency::where('currency', $request->input('currency'))
            ->first()
            ->id;

        Transaction::find($request->input('id'))
            ->update([
                'user_id' => $request->user()->id,
                'date' => $request->input('date'),
                'transaction' => $request->input('transaction'),
                'category_id' => $category_id,
                'sum' => $request->input('sum'),
                'currency_id' => $currency_id
            ]);

        return  $this->index($request);
    }

    /**
     * Удаление транзакций из БД 
     */

    public function destroy(Request $request) {

        Transaction::find($request->input('id'))
            ->delete();

        return  $this->index($request);
     
    }
}
