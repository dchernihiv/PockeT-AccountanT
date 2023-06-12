<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Currency;
use Illuminate\Support\Facades\Validator;


class WebController extends Controller {

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

}
