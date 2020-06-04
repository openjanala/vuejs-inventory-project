<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use Image;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return response()->json($employee);
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
            'email' => 'required|unique:employees|max:255',
            'name' => 'required',
            'phone' => 'required|unique:employees',
           ]);

           $photos = $request->photo;
            if($photos){
                $position = strpos($photos,';');
                $sub = substr($photos, 0, $position);
                $ext = explode('/',$sub)[1];
                $name= time().".".$ext;
                $img=Image::make($photos)->resize(200,240);
                $upload_path='backend/images/employees/';
                $image_url=$upload_path.$name;
                $img->save($image_url);

                $employee = new Employee;
                $employee->name = $request->name;
                $employee->email = $request->email;
                $employee->phone = $request->phone;
                $employee->address = $request->address;
                $employee->salary = $request->salary;
                $employee->nid = $request->nid;
                $employee->joining_date = $request->joining_date;
                $employee->photo =  $image_url;
                $employee->save();
            }else{
                $employee = new Employee;
                $employee->name = $request->name;
                $employee->email = $request->email;
                $employee->phone = $request->phone;
                $employee->address = $request->address;
                $employee->salary = $request->salary;
                $employee->nid = $request->nid;
                $employee->joining_date = $request->joining_date;
                $employee->save();
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
        $employee = DB::table('employees')->where('id',$id)->first();
        return response()->json($employee);
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
                $data['salary']=$request->salary;
                $data['nid']=$request->nid;
                $data['joining_date']=$request->joining_date;
                $newphoto = $request->newphoto;

            if($newphoto){
                $position = strpos($newphoto,';');
                $sub = substr($newphoto, 0, $position);
                $ext = explode('/',$sub)[1];
                $name= time().".".$ext;
                $img=Image::make($newphoto)->resize(200,240);
                $upload_path='backend/images/employees/';
                $image_url=$upload_path.$name;
                $success = $img->save($image_url);

                if($success){
                    $data['photo']=$image_url;
                    $img= DB::table('employees')->where('id',$id)->first();
                    $img_path =$img->photo;
                    $done = unlink($img_path); 
                    $user = DB::table('employees')->where('id',$id)->update($data);
                }
                
            }else{
                $oldphoto = $request->photo;
                $data['photo'] = $oldphoto;
                DB::table('employees')->where('id',$id)->update($data);
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
        $employee =DB::table('employees')->where('id', $id)->first();
        $photo = $employee->photo;
        if($photo){
            unlink($photo);
            DB::table('employees')->where('id', $id)->delete();
           
        }else{
            DB::table('employees')->where('id', $id)->delete(); 
         
        }
       
    }
}
