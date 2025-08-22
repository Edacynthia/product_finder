<?php

namespace App\Http\Controllers;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    public function store(Request $request, $marketerId)
    {
        $data = $request->validate(['message' => 'required|string']);

        Inquiry::create([
            'user_id' => Auth::id(),
            'marketer_id' => $marketerId,
            'message' => $data['message'],
        ]);

        return back()->with('success', 'Inquiry sent');
    }

    public function marketerInquiries()
    {
        $inquiries = Auth::user()->marketerProfile->inquiries()->with('user')->get();
        return view('marketer.inquiries', compact('inquiries'));
    }
}
