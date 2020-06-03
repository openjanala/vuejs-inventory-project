<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Supplier;
use DB;
use Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return response()->json($supplier);
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
            'email' => 'required',
            'name' => 'required',
            'phone' => 'required|unique:suppliers',
           ]);

           $photos = $request->photo;
            if($photos){
                $position = strpos($photos,';');
                $sub = substr($photos, 0, $position);
                $ext = explode('/',$sub)[1];
                $name= time().".".$ext;
                $img=Image::make($photos)->resize(200,240);
                $upload_path='backend/images/suppliers/';
                $image_url=$upload_path.$name;
                $img->save($image_url);

                $supplier = new Supplier;
                $supplier->name = $request->name;
                $supplier->email = $request->email;
                $supplier->phone = $request->phone;
                $supplier->address = $request->address;
                $supplier->shopname = $request->shopname;
                $supplier->photo =  $image_url;
                $supplier->save();
            }else{
                $supplier = new Supplier;
                $supplier->name = $request->name;
                $supplier->email = $request->email;
                $supplier->phone = $request->phone;
                $supplier->address = $request->address;
                $supplier->shopname = $request->shopname;
                $supplier->save();
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
     
        $supplier = DB::table('suppliers')->where('id',$id)->first();
        return response()->json($supplier);
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
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['shopname']=$request->shopname;
        $newphoto = $request->newphoto;

    if($newphoto){
        $position = strpos($newphoto,';');
        $sub = substr($newphoto, 0, $position);
        $ext = explode('/',$sub)[1];
        $name= time().".".$ext;
        $img=Image::make($newphoto)->resize(200,240);
        $upload_path='backend/images/suppliers/';
        $image_url=$upload_path.$name;
        $success = $img->save($image_url);

        if($success){
            $data['photo']=$image_url;
            $img= DB::table('suppliers')->where('id',$id)->first();
            $img_path =$img->photo;
            $done = unlink($img_path); 
            DB::table('suppliers')->where('id',$id)->update($data);
        }
        
        }else{
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            DB::table('suppliers')->where('id',$id)->update($data);
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
        $supplier =DB::table('suppliers')->where('id', $id)->first();
        $photo = $supplier->photo;
        if($photo){
            unlink($photo);
            DB::table('suppliers')->where('id', $id)->delete();
           
        }else{
            DB::table('suppliers')->where('id', $id)->delete(); 
         
        }
       
    }
   
}
