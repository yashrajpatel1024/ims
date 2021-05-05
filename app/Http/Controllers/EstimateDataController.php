<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstimateData;


class EstimateDataController extends Controller
{


    public function updateEstimate(Request $request) 
    {
    	$input = $request->except('id', '_token');
    	$estimate_data = EstimateData::find($request->id);
    	$estimate_data->update($input);
    	return ($estimate_data);
    }
    public function delete($id) 
    {
    	$estimate_data = EstimateData::find($id);
    	$estimate_data->delete();
    	return ($estimate_data);
    }
}
