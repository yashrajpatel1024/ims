<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceData;


class InvoiceDataController extends Controller
{
    public function updateInvoice(Request $request) 
    {
    	$input = $request->except('id', '_token');
    	$invoice_data = InvoiceData::find($request->id);
    	$invoice_data->update($input);
    	return ($invoice_data);
    }

    public function delete($id) 
    {
    	$invoice_data = InvoiceData::find($id);
    	$invoice_data->delete();
    	return ($invoice_data);
    }
}
