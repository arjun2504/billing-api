<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Option;

class OptionController extends Controller
{
    public function all() {
    	$options = Option::select('key','value')->get();
    	$option_arr = [];
    	foreach($options as $o) {
    		$options_arr[$o->key] = $o->value;
    	}
    	return response()->json( $options_arr, 200);
    }

    public function save(Request $request) {
    	try {
	    	$this->pushToDb('cgst_lt_1000', $request->cgst_lt_1000);
	    	$this->pushToDb('sgst_lt_1000', $request->sgst_lt_1000);
	    	$this->pushToDb('cgst_ge_1000', $request->cgst_ge_1000);
	    	$this->pushToDb('sgst_ge_1000', $request->sgst_ge_1000);
	    	$this->pushToDb('company_name', $request->company_name);
	    	$this->pushToDb('address', $request->address);
	    	$this->pushToDb('tin', $request->tin);
	    	$this->pushToDb('gstin', $request->gstin);
    	} catch(\Exception $e) {
    		return response()->json( ['status' => 'error', 'info' => $e ] , 406);
    	}

    	return response()->json( [ 'status' => 'success' ], 200);
    }

    public function pushToDb($key, $val) {
		Option::where('key', '=', $key)->update(['value' => $val]);    	
    }
}
