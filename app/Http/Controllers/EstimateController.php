<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estimate;
use App\Models\Service;
use App\Models\Customer;
use App\Models\EstimateData;
use DB;

class EstimateController extends Controller
{
    public function show()
    {
        $estimates = Estimate::all()->sortByDesc("id");
        return view('pages.estimates.estimate_list', compact('estimates'));
    }
    public function edit($id)
    {
        $estimates = Estimate::find($id);
        $services = Service::all();
        $estimate_data = EstimateData::where('estimate_id','=',$id)->get();
        $customers = Customer::all();
        return view('pages.estimates.edit_estimate',compact('estimates','services','estimate_data','customers'));
    }
    public function update(Request $request)
    {
        $estimate = Estimate::find($request->id);
        $estimate->customer_id=$request->customer_id;
        $estimate->issue_date=$request->issue_date;
        $estimate->due_date=$request->due_date;
        $estimate->cost=$request->cost;
        $estimate->quantity=$request->quantity;
        $estimate->subtotal=$request->subtotal;
        $estimate->discount=$request->discount;
        $estimate->tax=$request->tax;
        $estimate->total=$request->total;
        $estimate->save();
        return redirect('estimates_list')->withStatus(__('Estimate successfully updated.')); 
    }
    public function delete($id)
    {
        $data = Estimate::find($id);
        $data->delete();
        return back()->withStatus(__('Estimate successfully deleted.')); 
    }
    public function addcreate()
    {
        $services = Service::all();
        $customers = Customer::all();
        return view('pages.estimates.add_estimate',compact('services','customers'));
    }
    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'issue_date' => 'required|date',
            'due_date' => 'required|date',
        ]);
        $estimate = new Estimate;
        $estimate->customer_id=$request->customer_id;
        $estimate->issue_date=$request->issue_date;
        $estimate->due_date=$request->due_date;
        $estimate->cost=$request->cost;
        $estimate->quantity=$request->quantity;
        $estimate->subtotal=$request->subtotal;
        $estimate->discount=$request->discount;
        $estimate->tax=$request->tax;
        $estimate->total=$request->total;
        if($estimate->save())
        {
            $id = $estimate->id;
            foreach($request->service_id as $key => $estimate_id)
            {
                $values[] = [
                    'estimate_id' => $id,
                    'service_id' => $request->service_id[$key],
                    'estimate_cost' => $request->estimate_cost[$key],
                    'estimate_quantity' => $request->estimate_quantity[$key],
                    'estimate_subtotal' => $request->estimate_subtotal[$key],
                ];
            }
        }
        DB::table('estimate_data')->insert($values);
        return redirect('estimates_list')->withStatus(__('Estimate successfully Added.')); 
    }
}
