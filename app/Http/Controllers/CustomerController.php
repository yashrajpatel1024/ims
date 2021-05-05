<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Exports\CustomerExport;
use Excel;
use Input;
use PDF;

class CustomerController extends Controller
{
    public function show(Customer $model)
    {
        $customers = Customer::all()->sortByDesc("id");
        return view('pages.customers.customer_list', compact('customers'));
    }
    public function showCustomerReport()
    {
        $customers = Customer::pluck('first_name','id')->all();
        $customersReports = [];
        if(Input::get('id')>0)
        {
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');
            $customersReports = Customer::where('id',Input::get('id'))->whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'DESC')->get();
        }
        else if(Input::get('id')==0)
        {
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');
            $customersReports = Customer::whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'DESC')->get();
        }
        return view('pages.reports.customers_report', compact('customers','customersReports'));
    }
    public function edit($id)
    {
        $customers = Customer::find($id);
        return view('pages.customers.edit_customer',compact('customers'));
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'mobile_no' => 'required|size:10',
            'add' => 'required',
            'pincode' => 'required|size:6',
            'city' => 'required',
            'state' => 'required',
        ]);
            $customer = Customer::find($request->id);
            $customer->first_name=$request->first_name;
            $customer->last_name=$request->last_name;
            $customer->email=$request->email;
            $customer->mobile_no=$request->mobile_no;
            $customer->add=$request->add;
            $customer->pincode=$request->pincode;
            $customer->city=$request->city;
            $customer->state=$request->state;
            $customer->save();
            return redirect('customers_list')->withStatus(__('Customer successfully updated.')); 
    }
    public function delete($id)
    {
        $data = Customer::find($id);
        $data->delete();
        return back()->withStatus(__('Customer successfully deleted.'));
    }
    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:customers',
            'mobile_no' => 'required|size:10',
            'add' => 'required',
            'pincode' => 'required|size:6',
            'city' => 'required',
            'state' => 'required',

        ]);
        $customer = new Customer;
        $customer->first_name=$request->first_name;
        $customer->last_name=$request->last_name;
        $customer->email=$request->email;
        $customer->mobile_no=$request->mobile_no;
        $customer->add=$request->add;
        $customer->pincode=$request->pincode;
        $customer->city=$request->city;
        $customer->state=$request->state;
        $customer->save();
        return redirect('customers_list')->withStatus(__('Customer successfully added.'));
    }

    public function exportCustomerExcel()
    {
        if(Input::get('id')>0)
        {
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');
            $customersReports = Customer::where('id',Input::get('id'))->whereBetween('created_at', [$start_date, $end_date])->select('id','first_name','last_name','email','mobile_no','add','pincode','city','state')->orderBy('id', 'DESC')->get();
            return Excel::download(new CustomerExport($customersReports),'customer_list.xlsx');
        }
        else if(Input::get('id')==0)
        {
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');
            $customersReports = Customer::whereBetween('created_at', [$start_date, $end_date])->select('id','first_name','last_name','email','mobile_no','add','pincode','city','state')->orderBy('id', 'DESC')->get();
            return Excel::download(new CustomerExport($customersReports),'customer_list.xlsx');
        }
    }

    public function CustomerReportDownload()
    {
        if(Input::get('id')>0)
        {
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');
            $customersReports = Customer::where('id',Input::get('id'))->whereBetween('created_at', [$start_date, $end_date])->select('id','first_name','last_name','email','mobile_no','add','pincode','city','state')->orderBy('id', 'DESC')->get();
            $pdf = PDF::loadView('pages.reports.customers_report_pdf',compact('customersReports'))->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('customers_report.pdf');
        }
        else if(Input::get('id')==0)
        {
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');
            $customersReports = Customer::whereBetween('created_at', [$start_date, $end_date])->select('id','first_name','last_name','email','mobile_no','add','pincode','city','state')->orderBy('id', 'DESC')->get();
            $pdf = PDF::loadView('pages.reports.customers_report_pdf',compact('customersReports'))->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('customers_report.pdf');
        }
    }
}
