<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;


class TableController extends Controller
{
    public function index()
    {
        Config::set('title', 'Product Tables');

        $tables = ProductTable::all();

        return view('admin.tables.index', compact('tables'));
    }

    public function create()
    {
        Config::set('title', 'Create Table');

        return view('admin.tables.create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'attr' => json_encode($request->get('attr'))
        ]);

        ProductTable::create($request->except('_token'));

        return redirect(route('admin.tables.index'));
    }

    public function edit(ProductTable $productTable)
    {
        Config::set('title', 'Update Table');

        $productTable->attr = json_decode($productTable->attr);

        return view('admin.tables.update', compact('productTable'));
    }

    public function update(ProductTable $productTable, Request $request)
    {
        $request->merge([
            'attr' => json_encode($request->get('attr'))
        ]);

         $productTable->update($request->except('_token'));

        return redirect(route('admin.tables.index'));
    }

    public function delete(ProductTable $productTable)
    {
        $productTable->delete();
        return redirect(route('admin.tables.index'));
    }

    public function get(Request $request)
    {
        $table = ProductTable::find($request->get('key'));

        return response([
            'table' => $table
        ]);
    }
}
