<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
use DB;
use Image;


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
                $upload_path='backend/images/employee/';
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
