<?php
namespace App\Http\Controllers;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller {
    public function edit() {
        $setting = Setting::first() ?? Setting::create(['site_name' => 'LuxeEstate Living']);
        return view('admin.settings', compact('setting'));
    }
    public function update(Request $request, $id) {
        $setting = Setting::findOrFail($id);
        $setting->update($request->all());
        return redirect()->back()->with('status', 'Website settings updated successfully!');
    }
}