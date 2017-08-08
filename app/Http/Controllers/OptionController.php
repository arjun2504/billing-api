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

    public function template() {
      $options = Option::select('key','value')->whereIn('key', ['company_name', 'address', 'tin', 'gstin'])->orWhere('key','like','custom_text_%')->get();
      $option_arr = [];
    	foreach($options as $o) {
    		$options_arr[$o->key] = $o->value;
    	}
    	return response()->json( $options_arr, 200);
    }

    public function getHF() {
      $header = Option::select('value')->where('key','=','header')->first();
      $footer = Option::select('value')->where('key','=','footer')->first();
      return response()->json( ['header' => $header->value, 'footer' => $footer->value ], 200);
    }

    public function saveHF(Request $request) {
      $header = Option::where('key','=','header')->get();
      if(count($header) == 0) {
        $option = new Option();
        $option->key = 'header';
        $option->value = json_encode($request->header);
        $option->save();
      } else if (count($header) != 0){
        Option::where('key','=','header')->update(['value' => json_encode($request->header) ]);
      }

      $footer = Option::where('key','=','footer')->get();
      if(count($footer) == 0) {
        $option = new Option();
        $option->key = 'footer';
        $option->value = json_encode($request->footer);
        try {
          $option->save();
        } catch(\Exception $e) {
          return response()->json(['err' => $e],500);
        }

      } else if (count($footer) != 0){
        Option::where('key','=','footer')->update(['value' => json_encode($request->footer) ]);
      }

      return response()->json(['status' => 'success']);
    }

    public function saveCustom(Request $request) {
      Option::where('key','like','custom_text_%')->delete();
      for($i=0; $i<count($request->custom_text); $i++) {
        $option = new Option();
        $option->key = 'custom_text_'.($i+1);
        $option->value = $request->custom_text[$i];
        try {
          $option->save();
        } catch(\Exception $e) {
          return response()->json( ['status' => 'error', 'info' => $e ] , 406);
        }
      }

      return response()->json( ['status' => 'success' ] , 200);
    }

    public function getCustom() {
      $options = Option::select('key','value')->where('key','like','custom_text_%')->orderBy('key')->get();
      $option_arr = [];
    	foreach($options as $o) {
    		$options_arr[] = $o->value;
    	}
    	return response()->json( ['custom_text' => $options_arr ], 200);
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
