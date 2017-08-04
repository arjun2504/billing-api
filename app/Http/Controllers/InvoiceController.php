<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Product;

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

      if(!empty($id)) {
        Product::where('invoice_id', '=', $request->bid)->delete();
      }

      for($i=0;$i<count($request->products);$i++) {
          $product = new Product();
          $product->product_code = $request->products[$i]['product_code'];
          $product->product_name = $request->products[$i]['product_name'];
          $product->meter = $request->products[$i]['meters'];
          $product->quantity = $request->products[$i]['quantity'];
          $product->rate = $request->products[$i]['rate'];
          $product->amount = $request->products[$i]['amount'];
          $product->amount_gst = $request->products[$i]['amount_gst'];
          $product->invoice_id = $request->bid;
          try {
            $product->save();
          } catch(\Exception $e) {
            return response()->json( ['status' => 'error', 'info' => $e ] , 406);
          }
      }

    	return response()->json( ['status' => 'success'] , 200);

    }

    public function next() {
      $last_row = Invoice::select('id')->orderBy('created_at','desc')->first();
      $id = empty($last_row) ? 1 : $last_row->id + 1;
      return response()->json(['next' => $id], 200);
    }
}
