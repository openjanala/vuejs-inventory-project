<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class StockController extends Controller
{
    public function StockUpdate(Request $request,$id){

        $data =  array();
        $data['product_quantity'] = $request->product_quantity;
        $data = DB::table('products')->where('id',$id)->update($data);

    }
}
