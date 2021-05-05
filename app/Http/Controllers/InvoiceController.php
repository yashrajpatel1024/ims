<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\Customer;
use App\Models\InvoiceData;
use App\Models\Payment;
use App\Exports\InvoiceExport;
use Illuminate\Support\Facades\Mail;
use App\Mail\Testmail;
use Excel;
use Input;
use DB;
use PDF;

class InvoiceController extends Controller
{
    public function show()
    {
        $invoices = Invoice::all()->sortByDesc("id");
        return view('pages.invoices.invoice_list',compact('invoices'));
    }
    public function showInvoiceReport()
    {
        $customers = Customer::pluck('first_name','id')->all();
        $invoicesReports = [];
        $sum = 0;
        $quantity_sum = 0;
        if(Input::get('customer_id')>0)
        {
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');
            $invoicesReports = Invoice::where('customer_id',Input::get('customer_id'))->whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'DESC')->get();
            $sum = Invoice::where('customer_id',Input::get('customer_id'))->whereBetween('created_at', [$start_date, $end_date])->sum('total');
            $quantity_sum = Invoice::where('customer_id',Input::get('customer_id'))->whereBetween('created_at', [$start_date, $end_date])->sum('quantity');
        }
        else if(Input::get('customer_id')==0)
        {
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');
            $invoicesReports = Invoice::whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'DESC')->get();
            $sum = Invoice::whereBetween('created_at', [$start_date, $end_date])->sum('total');
            $quantity_sum = Invoice::whereBetween('created_at', [$start_date, $end_date])->sum('quantity');
        }
        return view('pages.reports.invoices_report', compact('customers','invoicesReports','sum','quantity_sum'));
    }
    public function edit($id)
    {
        $invoices = Invoice::find($id);
        $services = Service::all();
        $invoice_data = InvoiceData::where('invoice_id','=',$id)->get();
        $customers = Customer::all();
        return view('pages.invoices.edit_invoice',compact('invoices','services','invoice_data','customers'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $invoice = Invoice::find($request->id);
        $invoice->customer_id=$request->customer_id;
        $invoice->status=$request->status;
        $invoice->issue_date=$request->issue_date;
        $invoice->due_date=$request->due_date;
        $invoice->cost=$request->cost;
        $invoice->quantity=$request->quantity;
        $invoice->subtotal=$request->subtotal;
        $invoice->discount=$request->discount;
        $invoice->tax=$request->tax;
        $invoice->total=$request->total;
        $invoice->save();
        return redirect('invoices_list')->withStatus(__('Invoice successfully updated.'));
    }
    public function delete($id)
    {
        $data = Invoice::find($id);
        $data->delete();
        return back()->withStatus(__('Invoice successfully deleted.')); 
    }
    public function addcreate()
    {
        $services = Service::all();
        $customers = Customer::all();
        return view('pages.invoices.add_invoice',compact('services','customers'));
    }
    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'issue_date' => 'required',
            'due_date' => 'required',
            'status' => 'required',
        ]);
        $invoice = new Invoice;
        $invoice->customer_id=$request->customer_id;
        $invoice->status=$request->status;
        $invoice->issue_date=$request->issue_date;
        $invoice->due_date=$request->due_date;
        $invoice->cost=$request->cost;
        $invoice->quantity=$request->quantity;
        $invoice->subtotal=$request->subtotal;
        $invoice->discount=$request->discount;
        $invoice->tax=$request->tax;
        $invoice->total=$request->total;
        if($invoice->save()){

        $id = $invoice->id;
                
        foreach($request->service_id as $key => $invoice_id)
                {
                    $values[] = [
                        'invoice_id' => $id,
                        'service_id' => $request->service_id[$key],
                        'invoice_cost' => $request->invoice_cost[$key],
                        'invoice_quantity' => $request->invoice_quantity[$key],
                        'invoice_subtotal' => $request->invoice_subtotal[$key],
                    ];
                }
            }
        DB::table('invoice_data')->insert($values);
        return redirect('invoices_list')->withStatus(__('Invoice successfully Added.')); 
    }

    public function exportInvoiceExcel()
    {
        if(Input::get('customer_id')>0)
        {
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');
            $invoicesReports = Invoice::where('customer_id',Input::get('customer_id'))->whereBetween('created_at', [$start_date, $end_date])->select('id','customer_id','status','issue_date','due_date','quantity','total')->orderBy('id', 'DESC')->get();
            $sum = Invoice::where('customer_id',Input::get('customer_id'))->whereBetween('created_at', [$start_date, $end_date])->sum('total');
            $quantity_sum = Invoice::where('customer_id',Input::get('customer_id'))->whereBetween('created_at', [$start_date, $end_date])->sum('quantity');
        return Excel::download(new InvoiceExport($invoicesReports),'invoice_list.xlsx');
        }
        else if(Input::get('customer_id')==0)
        {
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');
            $invoicesReports = Invoice::whereBetween('created_at', [$start_date, $end_date])->select('id','customer_id','status','issue_date','due_date','quantity','total')->orderBy('id', 'DESC')->get();
            $sum = Invoice::whereBetween('created_at', [$start_date, $end_date])->sum('total');
            $quantity_sum = Invoice::whereBetween('created_at', [$start_date, $end_date])->sum('quantity');
            return Excel::download(new InvoiceExport($invoicesReports),'invoice_list.xlsx');
        }
    }
    public function showInvoice($id)
    {
        $invoices = Invoice::find($id);
        $services = Service::all();
        $invoice_data = InvoiceData::where('invoice_id','=',$id)->get();
        $customers = Customer::all();
        return view('pages.invoices.show_invoice',compact('invoices','services','invoice_data','customers'));
    }

    public function downloadInvoiceReportPDF()
    {
        if(Input::get('customer_id')>0)
        {
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');
            $invoicesReports = Invoice::where('customer_id',Input::get('customer_id'))->whereBetween('created_at', [$start_date, $end_date])->select('id','customer_id','status','issue_date','due_date','quantity','total')->orderBy('id', 'DESC')->get();
            $sum = Invoice::where('customer_id',Input::get('customer_id'))->whereBetween('created_at', [$start_date, $end_date])->sum('total');
            $quantity_sum = Invoice::where('customer_id',Input::get('customer_id'))->whereBetween('created_at', [$start_date, $end_date])->sum('quantity');
            $pdf = PDF::loadView('pages.reports.invoices_report_pdf',compact('invoicesReports','quantity_sum','sum'))->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('invoices_report.pdf');
        }
        else if(Input::get('customer_id')==0)
        {
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');
            $invoicesReports = Invoice::whereBetween('created_at', [$start_date, $end_date])->select('id','customer_id','status','issue_date','due_date','quantity','total')->orderBy('id', 'DESC')->get();
            $sum = Invoice::whereBetween('created_at', [$start_date, $end_date])->sum('total');
            $quantity_sum = Invoice::whereBetween('created_at', [$start_date, $end_date])->sum('quantity');
            $pdf = PDF::loadView('pages.reports.invoices_report_pdf',compact('invoicesReports','quantity_sum','sum'))->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('invoices_report.pdf');
        }
    }

    public function downloadInvoice($id)
    {
        $invoices = Invoice::find($id);
        $invoice_data = InvoiceData::where('invoice_id','=',$id)->get();
        $pdf = PDF::loadView('pages.invoices.invoice_pdf',compact('invoices','invoice_data'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('invoice_'.$invoices->customer->first_name.'_'.$invoices->customer->last_name.'.pdf');
        // return view('pages.invoices.invoice_pdf',compact('invoices','invoice_data'));
    }

    public function sendMail($id)
    {
        $invoices = Invoice::find($id);
        $invoice_data = InvoiceData::where('invoice_id','=',$id)->get();
        $email = $invoices->customer->email;
        $pdf = PDF::loadView('pages.invoices.invoice_pdf',compact('invoices','invoice_data'))->setOptions(['defaultFont' => 'sans-serif']);

        Mail::send([],[], function($message)use($pdf, $email, $invoices){
            $message->to($email)
                    ->subject('Invoice')
                    ->attachData($pdf->output(),'Invoice_'.$invoices->customer->first_name.'_'.$invoices->customer->last_name.'.pdf');
        });
        return redirect('invoices_list')->withStatus(__('Mail has been sent'));
    }

    public function printInvoice($id)
    {
        $invoices = Invoice::find($id);
        $invoice_data = InvoiceData::where('invoice_id','=',$id)->get();
        $pdf = PDF::loadView('pages.invoices.invoice_pdf',compact('invoices','invoice_data'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
        // return view('pages.invoices.invoice_pdf',compact('invoices','invoice_data'));
    }
}
