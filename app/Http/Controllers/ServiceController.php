<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function show()
    {
        $services = Service::all()->sortByDesc("id");
        return view('pages.services.services', compact('services'));
    }
    public function edit($id)
    {
        $services = Service::find($id);
        return view('pages.services.edit',compact('services'));
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'service_name' => 'required',
            'description' => 'required',
            'cost' => 'required',
        ]);
        $service = Service::find($request->id);
        $service->service_name=$request->service_name;
        $service->description=$request->description;
        $service->cost=$request->cost;
        $service->save();
        return redirect('services')->withStatus(__('Service successfully updated.')); 
    }
    public function delete($id)
    {
        $data = Service::find($id);
        $data->delete();
        return back()->withStatus(__('Service successfully deleted.')); 
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'service_name' => 'required',
            'description' => 'required',
            'cost' => 'required',
        ]);
        $service = new Service;
        $service->service_name=$request->service_name;
        $service->description=$request->description;
        $service->cost=$request->cost;
        $service->save();
        return redirect('services')->withStatus(__('Service successfully Added.')); 
    }
}
