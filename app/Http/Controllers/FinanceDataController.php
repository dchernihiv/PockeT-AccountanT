<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\Currency;
use Illuminate\Http\Request;

class FinanceDataController extends Controller {

    
    public function index(Request $request) {

        $startPeriod = $request->input('transaction')[0];
        $endPeriod = $request->input('transaction')[1];

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
            'html' => view('web.category.result-table', compact('data'))->render()
        ]);
        
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {
    
        $data = $request->validate([
            'transaction' => 'required|in:income,expenses',
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
