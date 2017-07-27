<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;

class StockController extends Controller
{
    public function add(Request $request, $id = null) {
    	
    	$stock = null;

    	if($id == null)
    		$stock = new Stock();
    	else
    		$stock = Stock::find($id);

    	$stock->product_code = $request->product_code;
    	$stock->product_name = $request->product_name;
    	$stock->price = $request->price;
    	$stock->is_available = $request->is_available;

    	try {
    		$stock->save();
    	} catch(\Exception $e) {
    		return response()->json( ['status' => 'error', 'info' => $e ] , 406);
    	}

    	return response()->json( ['status' => 'success'] , 200);
    }

    public function show($id) {
    	$stock = Stock::find($id);
    	return response()->json( $stock, 200);
    }

    public function all() {
    	return response()->json( Stock::all(), 200);
    }

    public function update(Request $request, $id) {
    	$stock = Stock::find($id);
    	return $this->add($request, $id);
    }

    public function delete(Request $request) {
    	$stock = Stock::find($request->id);
    	$stock->delete();
    	return response()->json( ['status' => 'success'] , 200);
    }
}
