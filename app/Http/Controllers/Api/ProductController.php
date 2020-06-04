<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use Image;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = DB::table('products')
        ->join('categories','products.category_id','categories.id')
        ->join('suppliers','products.supplier_id','suppliers.id')
        ->select('categories.category_name','suppliers.name','products.*')
        ->orderBy('products.id','DESC')
        ->get();
        return response()->json($product);

        // Product::all();
        // return response()->json($product);
    }
       

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|unique:products|max:255',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'root' => 'required',
            'selling_price' => 'required',
            'selling_price' => 'required',
           ]);

           $photos = $request->image;
            if($photos){
                $position = strpos($photos,';');
                $sub = substr($photos, 0, $position);
                $ext = explode('/',$sub)[1];
                $name= time().".".$ext;
                $img=Image::make($photos)->resize(200,240);
                $upload_path='backend/images/products/';
                $image_url=$upload_path.$name;
                $img->save($image_url);

                $product = new Product;
                $product->product_name = $request->product_name;
                $product->product_code = $request->product_code;
                $product->category_id = $request->category_id;
                $product->supplier_id = $request->supplier_id;
                $product->buying_price = $request->buying_price;
                $product->selling_price = $request->selling_price;
                $product->root = $request->root;
                $product->buying_date = $request->buying_date;
                $product->product_quantity = $request->product_quantity;
                $product->image =  $image_url;
                $product->save();
            }else{
                $product = new Product;
                $product->product_name = $request->product_name;
                $product->product_code = $request->product_code;
                $product->category_id = $request->category_id;
                $product->supplier_id = $request->supplier_id;
                $product->buying_price = $request->buying_price;
                $product->selling_price = $request->selling_price;
                $product->root = $request->root;
                $product->buying_date = $request->buying_date;
                $product->product_quantity = $request->product_quantity;
                $product->save();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=DB::table('products')->where('id',$id)->first();
        return response()->json($product);
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
        $validatedData = $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'root' => 'required',
            'selling_price' => 'required',
            'selling_price' => 'required',
           ]);

            $data=array();
            $data['product_name']=$request->product_name;
            $data['product_code']=$request->product_code;
            $data['category_id']=$request->category_id;
            $data['supplier_id']=$request->supplier_id;
            $data['root']=$request->root;
            $data['buying_price']=$request->buying_price;
            $data['selling_price']=$request->selling_price;
            $data['buying_date']=$request->buying_date;
            $data['product_quantity']=$request->product_quantity;
           $newphoto = $request->newphoto;

       if($newphoto){
           $position = strpos($newphoto,';');
           $sub = substr($newphoto, 0, $position);
           $ext = explode('/',$sub)[1];
           $name= time().".".$ext;
           $img=Image::make($newphoto)->resize(200,240);
           $upload_path='backend/images/products/';
           $image_url=$upload_path.$name;
           $success = $img->save($image_url);

           if($success){
               $data['image']=$image_url;
               $img= DB::table('products')->where('id',$id)->first();
               $img_path =$img->image;
               $done = unlink($img_path); 
               $user = DB::table('products')->where('id',$id)->update($data);
           }
           
       }else{
           $oldphoto = $request->image;
           $data['image'] = $oldphoto;
           DB::table('products')->where('id',$id)->update($data);
       }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $product =DB::table('products')->where('id', $id)->first();
        $photo = $product->image;
        if($photo){
            unlink($photo);
            DB::table('products')->where('id',$id)->delete(); 
        
        }else{
            DB::table('products')->where('id',$id)->delete(); 
        
        }
      
    }
}



