<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WaterSupportRequest;
use App\Models\ReplyForm;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;
use Carbon\Carbon;

class AdminRequestController extends Controller
{
    //
    public function showRequests()
    {
        // ดึงข้อมูลคำร้องทั้งหมดพร้อมกับข้อมูลผู้ใช้และการตอบกลับ
        $requests = WaterSupportRequest::with(['user', 'replyforms'])
            // ->orderBy('created_at', 'desc') // เรียงตามวันที่สร้างใหม่ที่สุด
            ->get();

        return view('admin_show_request.admin_show_request', compact('requests'));
    }

    public function reply(Request $request, $id)
    {
        $validatedData = $request->validate([
            'message' => 'required|string',
        ]);

        // สร้างการตอบกลับใหม่
        ReplyForm::create([
            'water_support_requests_id' => $id,
            'message' => $validatedData['message'],
        ]);

        // อัพเดทสถานะหรือชื่อผู้ตอบกลับถ้าจำเป็น
        $waterSupportRequest = WaterSupportRequest::findOrFail($id);
        $waterSupportRequest->user_name_verifier = Auth::user()->fullname; // สมมติว่ามีชื่อผู้ตอบ
        $waterSupportRequest->status = 'ตอบกลับแล้ว'; // ปรับสถานะตามที่ต้องการ
        $waterSupportRequest->save();

        return redirect()->back()->with('success', 'ส่งข้อความตอบกลับเรียบร้อยแล้ว');
    }

    public function ShowFormEdit($id)
    {
        // ดึงข้อมูลคำร้องที่ต้องการแก้ไข
        $request = WaterSupportRequest::findOrFail($id);

        // ส่งข้อมูลไปยังหน้า Blade
        return view('admin_show_request.admin_show_request_edit', compact('request'));
    }


    public function FormUpdate(Request $request, $id)
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

        // ดึงข้อมูลคำร้องโดย ID
        $waterSupportRequest = WaterSupportRequest::findOrFail($id);

        // อัปเดตข้อมูลคำร้อง
        $waterSupportRequest->update([
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

        // Redirect back with a success message
        return redirect()->back()->with('success', 'คำร้องได้รับการอัปเดตเรียบร้อยแล้ว');
    }

    public function updateStatus(Request $request, $id)
    {
        // ค้นหาคำร้องที่ต้องการอัปเดต
        $requestToUpdate = WaterSupportRequest::findOrFail($id);

        // กำหนดสถานะเป็น 2
        $requestToUpdate->status = 2;

        // ส่งชื่อผู้ที่กด update ลงใน user_name_verifier
        $requestToUpdate->user_name_verifier = Auth::user()->first_name . ' ' . Auth::user()->last_name; // หรือใช้ข้อมูลที่คุณต้องการ

        // บันทึกการเปลี่ยนแปลง
        $requestToUpdate->save();

        // ส่งกลับไปยังหน้าก่อนหน้านี้พร้อมข้อความยืนยัน
        return redirect()->back()->with('success', 'สถานะได้รับการอัปเดตเรียบร้อยแล้ว');
    }

    public function exportPDF($id)
    {
        // ค้นหาข้อมูล WaterSupportRequest โดย ID
        $request = WaterSupportRequest::find($id);
        if (!$request) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลคำร้อง');
        }

        // แยกข้อมูลวันที่
        $requestDate = Carbon::parse($request->request_date);
        $day = $requestDate->day;   // วันที่
        $month = $requestDate->translatedFormat('F'); // แสดงเดือนเป็นชื่อ
        $year = $requestDate->year + 543; // แสดงปีพุทธศักราช

        // เปลี่ยนชื่อเดือนเป็นภาษาไทย
        $monthNames = [
            1 => 'มกราคม',
            2 => 'กุมภาพันธ์',
            3 => 'มีนาคม',
            4 => 'เมษายน',
            5 => 'พฤษภาคม',
            6 => 'มิถุนายน',
            7 => 'กรกฎาคม',
            8 => 'สิงหาคม',
            9 => 'กันยายน',
            10 => 'ตุลาคม',
            11 => 'พฤศจิกายน',
            12 => 'ธันวาคม',
        ];

        // ดึงชื่อเดือนตามตัวเลข
        $month = $monthNames[$requestDate->month];

        // กำหนด Options สำหรับ Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // สร้าง instance ของ Dompdf
        $dompdf = new Dompdf($options);

        // โหลด view ที่ต้องการสร้าง PDF
        $html = view('admin_show_request.admin_show_request_pdf', compact('request', 'day', 'month', 'year'))->render();

        // โหลด HTML ลงใน Dompdf
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // ส่งไฟล์ PDF ไปยังเบราว์เซอร์
        return $dompdf->stream('คำร้องน้ำอุปโภค-บริโภค_' . $request->id . '.pdf');
    }
}
