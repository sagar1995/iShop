<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product; 
use File; 

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'product_name'=>'required',
            'product_description'=>'required',
            'product_category'=>'required',
            'price'=>'required',
        ]);
        // $this->validateProduct();
        $image = $request->image;   
        $new_name = rand() . '.' . $image-> getClientOriginalExtension();
        $image->move(public_path('/uploads'),$new_name);
        Product::create(array_merge(['image'=>$new_name,'image_url'=>'http://127.0.0.1:8888/laravel/ishop/public/uploads/'.$new_name,'user_id'=>auth()->user()->id],$request->except(['image'])));
        
        return redirect(route('admin.product'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('admin.show_product',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.edit_product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product=Product::where('id',$id);
        $array=[
            'product_name'=>$request->product_name,
            'product_description'=>$request->product_description,
            'product_category'=>$request->product_category,
            'price'=>$request->price
        ];
        if ($request->image != null){
            $url=__DIR__.'../../../../../public/uploads/'.$product->first()->image;
            File::delete($url);
            $image = $request->image;
            $new_name = rand() . '.' . $image-> getClientOriginalExtension();
            $image->move(public_path('/uploads'),$new_name);
            $array=array_merge($array,['image'=>$new_name,'image_url'=>'http://127.0.0.1:8888/laravel/ishop/public/uploads/'.$new_name]);
        }
        $product->update($array);   
        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $url=__DIR__.'../../../../../public/uploads/'.$product->image;
        File::delete($url);
        $product->delete();
        return redirect('admin/products');
    }
}
