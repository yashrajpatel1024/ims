<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpanceManager;

class ExpanceManagerController extends Controller
{
    public function show(ExpanceManager $model)
    {
        $expancemanagers = ExpanceManager::all()->sortByDesc("id");
        return view('pages.expancemanager.expancemanager_list', compact('expancemanagers'));
    }
    public function edit($id)
    {
        $expancemanagers = ExpanceManager::find($id);
        return view('pages.expancemanager.edit_expancemanager',compact('expancemanagers'));
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required',
            'catagories' => 'required',
            'current_balance' => 'required',

        ]);
        $expancemanager = ExpanceManager::find($request->id);
        $expancemanager->amount=$request->amount;
        $expancemanager->catagories=$request->catagories;
        $expancemanager->current_balance=$request->current_balance;
        $expancemanager->save();
        return redirect('expance_list')->withStatus(__('Successfully updated.')); 
    }
    public function delete($id)
    {
        $data = ExpanceManager::find($id);
        $data->delete();
        return back()->withStatus(__('Successfully deleted.')); 
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required',
            'catagories' => 'required',
            'current_balance' => 'required',

        ]);
        $expancemanager = new ExpanceManager;
        $expancemanager->amount=$request->amount;
        $expancemanager->catagories=$request->catagories;
        $expancemanager->current_balance=$request->current_balance;
        $expancemanager->save();
        return redirect('expance_list')->withStatus(__('Successfully Added.')); 
    }
}
