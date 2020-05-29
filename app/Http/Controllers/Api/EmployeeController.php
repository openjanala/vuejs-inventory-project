<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employee;
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
        $validateData =$request->validation([
            'email'=> 'required|unique:employees|max:25',
            'name'=>'required',
            'phone'=>'required|unique:employees',
        ]);
        
        // $data =array();
        // $data['name'] =$request->name;
        // $data['email'] =$request->email;
        // $data['phone'] =$request->phone;
        // $data['address'] =$request->address;
        // $data['nid'] =$request->nid;
        // $data['salary'] =$request->salary;
        // $data['photo'] =$request->photo;
        // $data['joining_date'] =$request->joining_date;
        // DB::table('employees')->insert($data);
        // return response('successfully Inserted Data');
       

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
