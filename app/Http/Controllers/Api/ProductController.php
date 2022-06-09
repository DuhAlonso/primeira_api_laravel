<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $product;

    public function __contruct(Product $product)
    {
        $this->product = $product;
    }

    public function index(Request $request)
    {
        //$products = $this->product->all();
//        $products = Product::paginate(10);
//        return response()->json($products);
//        return new ProductCollection($products);
        $products = new Product();
        if($request->has('fields')){
            $fields = $request->get('fields');
            $products = $products->selectRaw($fields);
        }

        if($request->has('conditions')){
            $expressions = explode(';', $request->get('conditions'));
            foreach ($expressions as $e){
                $exp = explode('=', $e);
                $products = $products->where($exp[0], $exp[1]);
            }
        }
        return new ProductCollection($products->paginate(10));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $product = Product::create($data);
        //$newProduct->create($data);
        return response()->json($product);
    }

    public function show($id)
    {
       $product = Product::find($id);
//        return response()->json($product);
        return new ProductResource($product);


    }

    public function update(Request $request)
    {
        $data = $request->all();
        $product = Product::find($data['id']);
        $product->update($data);
        return response()->json($product);
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        Product::destroy($data['id']);
        return response()->json(["message" => "Product excluido com sucesso!"]);
    }
}
