<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Customer;
use App\Exports\PaymentExport;
use Excel;
use Input;
use PDF;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function show(Payment $model)
    {
        $payments = Payment::all()->sortByDesc("id");
        return view('pages.payments.payment_list', compact('payments'));
    }
    public function showPaymentReport()
    {
        $customers = Customer::pluck('first_name','id')->all();
        $payments = [];
        $total = 0;
        $paid_total = 0;
        $due_total = 0;
        if(Input::get('customer_id'))
        {
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');
            $customer = Customer::find(Input::get('customer_id'));
            // dd( $customer->invoices()->get());
            $customer_invoices = $customer->invoices()->get()->map(function($data) use($start_date,$end_date,&$payments,&$total,&$paid_total,&$due_total)
                                {
                                    $customerPayments = Payment::where('invoice_id',$data->id)->whereBetween('date', [$start_date, $end_date])->get();
                                    foreach ($customerPayments as $key => $payment) 
                                    {
                                        $payments[] = $payment;
                                    }
                                    $total = Payment::where('invoice_id',$data->id)->whereBetween('date', [$start_date, $end_date])->sum('amount');
                                    $paid_total = Payment::where('invoice_id',$data->id)->whereBetween('date', [$start_date, $end_date])->sum('paying_amount');
                                    $due_total = Payment::where('invoice_id',$data->id)->whereBetween('date', [$start_date, $end_date])->sum('due_amount');
                                });
            // dd($total);
        }
        return view('pages.reports.payments_report', compact('customers','payments','total','paid_total','due_total'));
    }
    public function edit(Request $request)
    {
        $payments = Payment::find($request->id);
        $invoices = Invoice::all();
        return view('pages.payments.edit_payment',compact('payments','invoices'));
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'paying_amount' => 'required',
            'mode' => 'required',
            'date' => 'required',
        ]);
        $invoiceTotal =  $request->amount;
        $paid = $request->paying_amount;
        $id = $request->invoice_id;
        if($invoiceTotal == $paid)
        {
            $payment = Payment::find($request->id);
            $payment->invoice_id=$request->invoice_id;
            $payment->amount=$request->amount;
            $payment->paying_amount=$request->paying_amount;
            $payment->due_amount=$request->due_amount;
            $payment->mode=$request->mode;
            $payment->date=$request->date;
            $payment->save();
            $id = $request->invoice_id;
            $status = Invoice::where('id',$id)->update(['status'=>'paid']);
            return redirect('payments_list')->withStatus(__('Payment successfully updated.')); 
        }
        else if($invoiceTotal > $paid)
        {
            $payment = Payment::find($request->id);
            $payment->invoice_id=$request->invoice_id;
            $payment->amount=$request->amount;
            $payment->paying_amount=$request->paying_amount;
            $payment->due_amount=$request->due_amount;
            $payment->mode=$request->mode;
            $payment->date=$request->date;
            $payment->save();
            return redirect('payments_list')->withStatus(__('Payment successfully updated.')); 
        }
        else if($invoiceTotal < $paid)
        {
            return redirect('edit_payments/'.$id)->withStatus(__('Your Paying Amount is Large.')); 
        }
    }
    public function delete($id)
    {
        $data = Payment::find($id);
        $data->delete();
        return back()->withStatus(__('Payment successfully deleted.')); 
    }
    public function addcreate()
    {
        $invoices = Invoice::all();
        return view('pages.payments.add_payment',compact('invoices'));
    }
    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'paying_amount' => 'required',
            'mode' => 'required',
            'date' => 'required',

        ]);
        $invoiceTotal =  $request->amount;
        $paid = $request->paying_amount;
        $id = $request->invoice_id;
        if($invoiceTotal == $paid)
        {
            $payment = new Payment;
            $payment->invoice_id=$request->invoice_id;
            $payment->amount=$request->amount;
            $payment->paying_amount=$request->paying_amount;
            $payment->due_amount=$request->due_amount;
            $payment->mode=$request->mode;
            $payment->date=$request->date;
            $payment->save();
            $id = $request->invoice_id;
            $status = Invoice::where('id',$id)->update(['status'=>'paid']);
            return redirect('payments_list')->withStatus(__('Payment successfully Added.')); 
        }
        else if($invoiceTotal > $paid)
        {
            $payment = Payment::find($request->id);
            $payment->invoice_id=$request->invoice_id;
            $payment->amount=$request->amount;
            $payment->paying_amount=$request->paying_amount;
            $payment->due_amount=$request->due_amount;
            $payment->mode=$request->mode;
            $payment->date=$request->date;
            $payment->save();
            return redirect('payments_list')->withStatus(__('Payment successfully updated.')); 
        }
        else if($invoiceTotal < $paid)
        {
            return redirect('payment/'.$id)->withStatus(__('Your Paying Amount is Large.')); 
        }
    }
    public function payment($id)
    {
        $invoices = Invoice::find($id);
        return view('pages.payments.payment',compact('invoices'));
    }

    public function exportPaymentExcel()
    {
        if(Input::get('customer_id'))
        {
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');
            $customer = Customer::find(Input::get('customer_id'));
            // dd( $customer->invoices()->get());
            $customer_invoices = $customer->invoices()->get()->map(function($data) use($start_date,$end_date,&$payments,&$total,&$paid_total,&$due_total)
            {
                $customerPayments = Payment::where('invoice_id',$data->id)->whereBetween('date', [$start_date, $end_date])->select('invoice_id','date','mode','amount','paying_amount','due_amount')->get();
                foreach ($customerPayments as $key => $payment) 
                {
                    $payments[] = $payment;
                }
            });
            // dd($payments);
            return Excel::download(new PaymentExport($payments),'payment_list.xlsx');
        }
    }

    public function PaymentReportDownload()
    {
        if(Input::get('customer_id'))
        {
            $start_date = Input::get('start_date');
            $end_date = Input::get('end_date');
            $customer = Customer::find(Input::get('customer_id'));
            // dd( $customer->invoices()->get());
            $customer_invoices = $customer->invoices()->get()->map(function($data) use($start_date,$end_date,&$payments,&$total,&$paid_total,&$due_total)
            {
                $customerPayments = Payment::where('invoice_id',$data->id)->whereBetween('date', [$start_date, $end_date])->select('invoice_id','date','mode','amount','paying_amount','due_amount')->get();
                foreach ($customerPayments as $key => $payment) 
                {
                    $payments[] = $payment;
                }
                $total = Payment::where('invoice_id',$data->id)->whereBetween('date', [$start_date, $end_date])->sum('amount');
                $paid_total = Payment::where('invoice_id',$data->id)->whereBetween('date', [$start_date, $end_date])->sum('paying_amount');
                $due_total = Payment::where('invoice_id',$data->id)->whereBetween('date', [$start_date, $end_date])->sum('due_amount');
            });
            // dd($payments);
            $pdf = PDF::loadView('pages.reports.payments_report_pdf',compact('payments','total','paid_total','due_total'))->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('payments_report.pdf');
        }
    }

    public function showPayment($id)
    {
        $payments = Payment::find($id);
        return view('pages.payments.show_payments',compact('payments'));
    }
}
