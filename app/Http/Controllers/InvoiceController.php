<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;

class InvoiceController extends Controller
{
    public function save(Request $request) {
    	$id = Invoice::find($request->bid);

    	$invoice = empty($id) ? new Invoice() : $id;

    	$invoice->id = $request->bid;
    	$invoice->sale = $request->total;
    	$invoice->total_gst = $request->total_gst;
    	$invoice->total = $request->total_roff;

    	try {
    		$invoice->save();
    	} catch(\Exception $e) {
    		return response()->json( ['status' => 'error', 'info' => $e ] , 406);
    	}

    	return response()->json( ['status' => 'success'] , 200);

    }
}
