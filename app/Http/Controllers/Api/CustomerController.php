<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Customer;
use Image;
use DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $customer = Customer::orderBy('id','DESC')->get();
       // $customer=DB::table('customers')->get();
       return response()->json($customer);
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
            'email' => 'required|unique:customers|max:255',
            'name' => 'required',
            'phone' => 'required|unique:customers',
            'address' => 'required',
           ]);
       

        $photos = $request->photo;
        if($photos){
            $position = strpos($photos,';');
            $sub = substr($photos, 0, $position);
            $ext = explode('/',$sub)[1];
            $name= time().".".$ext;
            $img=Image::make($photos)->resize(200,240);
            $upload_path='backend/images/customers/';
            $image_url=$upload_path.$name;
            $img->save($image_url);

            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->photo =  $image_url;
            $customer->save();
        }else{
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->save();
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
        $customer = DB::table('customers')->where('id',$id)->first();
        return response()->json($customer);
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
        $newphoto = $request->newphoto;

    if($newphoto){
        $position = strpos($newphoto,';');
        $sub = substr($newphoto, 0, $position);
        $ext = explode('/',$sub)[1];
        $name= time().".".$ext;
        $img=Image::make($newphoto)->resize(200,240);
        $upload_path='backend/images/customers/';
        $image_url=$upload_path.$name;
        $success = $img->save($image_url);

        if($success){
            $data['photo']=$image_url;
            $img= DB::table('customers')->where('id',$id)->first();
            $img_path =$img->photo;
            $done = unlink($img_path); 
            $user = DB::table('customers')->where('id',$id)->update($data);
        }
        
    }else{
        $oldphoto = $request->photo;
        $data['photo'] = $oldphoto;
        DB::table('customers')->where('id',$id)->update($data);
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
        DB::table('customers')->where('id',$id)->delete();

    }
}
