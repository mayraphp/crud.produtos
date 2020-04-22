<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{

    public function import(Request $request)
    {
        $file = file($request->file('import_file')->getRealPath());
        $data = array_slice($file, 1);

        $parts = (array_chunk($data, 50000));

        foreach($parts as $index=>$part){
            $fileName = resource_path('pending-products/'.date('Y-m-d').$index.'.csv');

            file_put_contents($fileName, $part);
        }

        (new Product())->importProduct();

        return response()->json([
            'msg' => 'Produtos adicionados para fila de importação',
        ]);
    }

    public function show(Request $request)
    {
        $data = $request->all();

        $product = Product::find($data['id']);

        return response()->json([
            'id' => $product->id,
            'name' =>$product->name,
            'quantity' =>$product->quantity,
            'description' => $product->description,
            'price' => $product->price,
        ]);
    }

    public function destroy($product)
    {
        $product = Product::find($product);

        $product->delete();

        return redirect()->route('dashboard');
    }
}

