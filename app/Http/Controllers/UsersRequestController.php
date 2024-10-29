<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WaterSupportRequest;
use Illuminate\Support\Facades\Auth;

class UsersRequestController extends Controller
{
    //
    public function UserIndex()
    {
        return view('users_forms.users_forms');
    }

    public function userAccount()
    {
        $user = Auth::user(); // รับข้อมูลผู้ใช้ที่ล็อกอิน
        return view('users_account.users_account_form', compact('user'));
    }

    public function showUserRequest()
    {
        $requests = WaterSupportRequest::with(['user', 'replyforms'])
            ->where('user_id', Auth::id()) // กรองคำร้องตาม user_id ที่ล็อกอิน
            ->orderBy('created_at', 'desc') // เรียงตามวันที่สร้างใหม่ที่สุด
            ->get();

        return view('users_account.users_account_follow_request', compact('requests'));
    }

    public function FormCreate(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'request_date' => 'required|date',
            'salutation' => 'nullable|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'house_number' => 'nullable|string|max:255',
            'village' => 'nullable|string|max:255',
            'subdistrict' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'subject' => 'nullable|string|max:255',
            'reason' => 'nullable|string',
            'support_address' => 'required|string',
            'quantity' => 'required|integer',
            'capacity' => 'required|numeric',
        ]);

        // Create a new request in the database
        WaterSupportRequest::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'request_date' => $validatedData['request_date'],
            'salutation' => $validatedData['salutation'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'occupation' => $validatedData['occupation'],
            'house_number' => $validatedData['house_number'],
            'village' => $validatedData['village'],
            'subdistrict' => $validatedData['subdistrict'],
            'district' => $validatedData['district'],
            'province' => $validatedData['province'],
            'phone_number' => $validatedData['phone_number'],
            'subject' => $validatedData['subject'],
            'reason' => $validatedData['reason'],
            'support_address' => $validatedData['support_address'],
            'quantity' => $validatedData['quantity'],
            'capacity' => $validatedData['capacity'],
        ]);

        return redirect()->back()->with('success', 'คำร้องขอความอนุเคราะห์น้ำอุปโภค-บริโภคได้ถูกส่งเรียบร้อยแล้ว');
    }
}
