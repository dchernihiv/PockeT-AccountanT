<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;


class WebController extends Controller {

    /**
     *  Начальное заполнение списков категорий и подкатегорий данными из БД
     *  */
    
    public function showItems(Request $request) {

        $items = Category::select('category', 'subcategory')
            ->where('transaction', $request->input('transaction'))
            ->get()
            ->mapToGroups(function ($element) {
                return [$element['category'] => $element['subcategory']];
            });

        $currency = Currency::pluck('currency');

        return response()->json([$items, $currency]);
        

    }

    /** 
     * Добовление в БД новых значений категорий/подкатегорий/валюты
     *  */

    public function createNewTitles(Request $request) {

        $validator = Validator::make($request->all(), [
            'newItem' => [
                'exclude_unless:targetButton,add-category',
                'required',
                'unique:categories,category'
            ],
            'currency' => [
                'exclude_unless:targetButton,add-currency',
                'required',
                'unique:currencies,currency'
            ],
            'subNewItem' => [
                'exclude_unless:targetButton,add-subcategory',
                'required',
                'unique:categories,subcategory'
            ]
        ]);
       
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $transaction = $request->input('transaction');
        $newItem = $request->input('newItem');
        $subNewItem = $request->input('subNewItem');
        $currency = $request->input('currency');
        $targetButton = $request->input('targetButton');

        if ($targetButton == 'add-category') {
            
            Category::create([
                'transaction' => $transaction,
                'category' => $newItem
            ]);

            $categories = Category::where('transaction', $transaction)->pluck('category');
            
            return response()->json($categories);

        }
         else if ($targetButton == 'add-subcategory') {
           
            $countInstance = Category::where([
                    ['transaction', '=', $transaction],
                    ['category', '=', $newItem]
                ])
                ->get();
              
            Category::when($countInstance->count() == 1 && $countInstance->first()->subcategory == null,
                function () use ($countInstance, $subNewItem) {
                    return $countInstance->first()->update(['subcategory' => $subNewItem]);
                },
                function () use ($transaction, $newItem, $subNewItem) {
                    Category::create([
                                'transaction' => $transaction,
                                'category' => $newItem,
                                'subcategory' => $subNewItem
                            ]);
                }
            );  
            
            $subcategories =  Category::where([
                    ['transaction', '=', $transaction],
                    ['category', '=', $newItem]
                ])
                ->pluck('subcategory');

            return response()->json($subcategories);

        }
        else {
            
            Currency::create([
                'currency' => $currency
            ]);

            return response()->json(null);
        }

    }

    /** 
     * Построение графиков
     *  */

    public function sendDataForChart (Request $request) {

        $validator = Validator::make($request->all(), [
                'type' => 'required',
                'date' => 'array',
                'date.*' => 'required',
                'transaction' => 'required',
                'newItem' => 'nullable',
                'subNewItem' => 'nullable'
            ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $startPeriod = $request->input('date')[0];
        $endPeriod = $request->input('date')[1];

        $data= Transaction::where([
                ['user_id', $request->user()->id],
                ['transaction', $request->input('transaction')],
            ])
            ->whereBetween('date', [$startPeriod, $endPeriod])
            ->get()
            ->map(fn ($item) => $item->setVisible(['type', 'date', 'sum']));

        $wrongValue = 'виберіть категорію...';

        if ( request('newItem') != $wrongValue && request('subNewItem') != $wrongValue ) {
           
            $category_id = Category::where([
                    ['transaction', $request->input('transaction')],
                    ['category', $request->input('newItem')],
                    ['subcategory', $request->input('subNewItem')]
                ])
                ->first()
                ->id;
         
            $data = $data->filter(function($item) use($category_id) {
                    return $item->category_id == $category_id;
                });
        }
        if ($request->input('newItem') != $wrongValue && $request->input('subNewItem') == $wrongValue) {
            
            $category_id = Category::where([
                ['transaction', $request->input('transaction')],
                ['category', $request->input('newItem')],
            ])
            ->first()
            ->id;
            $data = $data->filter(function($item) use($category_id) {
                    return $item->category_id == $category_id;
                });
        }

        return response()->json($data);
    }

}
