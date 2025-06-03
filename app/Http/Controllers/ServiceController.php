<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serviceweb;

class ServiceController extends Controller
{

    public function index()
    {
        $services = ServiceWeb::all();
        return view('admin.service.index', compact('services'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $imageName = time().'.'.$request->picture->extension();
        $request->picture->move(public_path('img'), $imageName);
    
        ServiceWeb::create([
            'service_name' => $request->service_name,
            'picture' => $imageName,
        ]);
    
        return redirect()->back()->with('success', 'Service added successfully!');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
        ]);
    
        $service = ServiceWeb::findOrFail($id);
        $service->update([
            'service_name' => $request->service_name,
        ]);
    
        return redirect()->back()->with('success', 'Service updated successfully!');
    }
    
    public function destroy($id)
    {
        $service = ServiceWeb::findOrFail($id);
        $service->delete();
    
        return redirect()->back()->with('success', 'Service deleted!');
    }
    
}
