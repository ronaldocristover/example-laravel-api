<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
  public function __construct()
  {
            $this->middleware('auth');
  }
  
   public function index()
   {
       $data = Product::get();
       if($data->count() > 0){
           return $this->wrapper('OK', $data);
       }
       return $this->wrapper('NOT OK', [], 400);
   }

   public function store(Request $request)
   {
        $name = $request->get('name', '');
        $price = $request->get('price', '');
        $imageurl = $request->get('imageurl', '');

        $data = Product::create([
            'name' => $name, 
            'price' => $price, 
            'imageurl' => $imageurl
        ]);

        if($data){
            return $this->wrapper('OK', $data, 201);
        }
        return $this->wrapper('NOT OK', [], 400, 'Error');
   }

   public function update(Request $request, $id)
   {
       $data = Product::where('id', $id)->first();
       if(!$data){
        return $this->wrapper('NOT OK', [], 400, 'Product Not Found');
       }

       $updateProduct = Product::find($id);
       if ($request->has('name')) {
         $updateProduct->name = $request->get('name');
       }

       if ($request->has('price')) {
         $updateProduct->name = $request->get('price');
       }

       if ($request->has('imageurl')) {
         $updateProduct->name = $request->get('imageurl');
       }

       $updateProduct->save();

       $updatedProduct = Product::where('id', $id)->first();
        if($updateProduct){
            return $this->wrapper('OK', $updatedProduct, 201);
        }
        return $this->wrapper('NOT OK', [], 400, 'Error');
   }

   public function remove($id)
   {
       $data = Product::where('id', $id)->first();
       if(!$data){
        return $this->wrapper('NOT OK', [], 400, 'Product Not Found');
       }

       $updateProduct = Product::destroy($id);
        if($updateProduct){
            return $this->wrapper('OK', [
              'message' => $id.' deleted'
            ], 201);
        }
        return $this->wrapper('NOT OK', [], 400, 'Error'); 
   }

   public function show($id)
   {
       $data = Product::where('id', $id)->first();
       if(!$data){
        return $this->wrapper('NOT OK', [], 400);
       }
       return $this->wrapper('OK', $data);
   }

}
