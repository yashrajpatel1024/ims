<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\User;
use App\Models\Payment;
use App\Models\ExpanceManager;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $invoice = Invoice::all()->count();
        $customer = Customer::all()->count();
        $service = Service::all()->count();
        $user = User::all()->count();
        $due_payment = Payment::all()->sum('due_payment');
        $amount = Payment::all()->sum('amount');
        $expance = ExpanceManager::all()->sum('amount');
        $expance_currentBalance = ExpanceManager::all()->sum('current_balance');
        $invoicesReports = Invoice::orderBy('id', 'DESC')->get();
        $sum = Invoice::all()->sum('total');
        $quantity_sum = Invoice::all()->sum('quantity');
        $payments = Payment::orderBy('id', 'DESC')->get();
        $total = Payment::all()->sum('amount');
        $paid_total = Payment::all()->sum('paying_amount');
        $due_total = Payment::all()->sum('due_amount');

        return view('dashboard', compact(['customer','invoice','service','user','due_payment','amount', 'expance','expance_currentBalance','invoicesReports','sum','quantity_sum','payments','total','paid_total','due_total']));
    }
}
