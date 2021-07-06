<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Notifications\ProductAddToFavourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::with(['categories'])->get();
        return view('products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products|max:255',
            'price' => 'required',
            'image'=> 'required'
        ]);

        $product=new Product($request->all());
        $user=Auth::user();
        $product->user_id=$user->id;


        if ($request->hasFile('image')) {
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('uploads/product', $filename);
            $product->image=$filename;
        }


        $product->save();
        $product->categories()->attach($request->category);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::findOrFail($id);
        return view('edit',compact('product'));
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
        $product=Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $product->delete();
    }

    public function category($id){
        $category=Category::findOrFail($id);
        return view('category',compact('category'));
    }

    public function addtofavourite(Product $product)
    {
        $user=Auth::user();
        if ($user->product()->detach($product)==true){
            $user->product()->detach($product);
        }else{
            $user->product()->attach($product->id);
            $data=[
                "text"=>'პროდუქტი სათაურით'.'  '.$product->name.'  '.'დაემატა ფავორიტებში'
            ];
            $user->notify(new ProductAddToFavourite($data));
        }

        return redirect()->back();
    }

    public function favourited(){
        $user=Auth::user();
        return view('favourite', compact('user'));
    }
}
