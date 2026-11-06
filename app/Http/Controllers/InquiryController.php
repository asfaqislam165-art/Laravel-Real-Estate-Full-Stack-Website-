<?php
namespace App\Http\Controllers;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller {
    public function index() {
        $inquiries = Inquiry::with('property')->latest()->get();
        return view('admin.inquiries', compact('inquiries'));
    }
    public function updateStatus(Request $request, $id) {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->status = $request->status;
        $inquiry->save();
        return redirect()->back()->with('status', 'Inquiry status updated successfully.');
    }
    public function destroy($id) {
        Inquiry::findOrFail($id)->delete();
        return redirect()->back()->with('status', 'Inquiry deleted successfully.');
    }
}