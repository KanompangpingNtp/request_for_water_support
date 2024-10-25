@extends('layout.users_account_layout')
@section('account_layout')
<div class="container">
    <h3 class="text-center">ประวัติการยื่นคำร้อง</h3><br>
    <table class="table table-bordered table-striped">
        <thead style="text-align: center;">
            <tr>
                <th>ลำดับ</th>
                <th>วันที่ส่งแบบฟอร์ม</th>
                <th>ผู้ส่งแบบฟอร์ม</th>
                <th>ผู้ส่งตอบรับฟอร์ม</th>
                <th>การกระทำ</th>
                <th>สถานะ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $index => $request)
            <tr class="text-center">
                <td>{{ $index + 1 }}</td>
                <td>{{ $request->request_date }}</td>
                <td>
                    @if(is_null($request->user_id))
                        <p>ผู้ใช้งานทั่วไป</p>
                    @else
                        {{ $request->salutation ? $request->salutation . ' ' : '' }}{{ $request->first_name }} {{ $request->last_name }}
                    @endif
                </td>
                <td>{{ $request->user_name_verifier ? $request->user_name_verifier : ' ' }}</td>
                <td>
                    @if(!is_null($request->user_id))
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#replyModal-{{ $request->id }}">
                        <i class="bi bi-reply"></i>
                    </button>
                    @endif
                </td>
                <td>
                    @if($request->status == 1)
                    <p> - </p>
                    @elseif($request->status == 2)
                    <p style="font-size: 20px; color:blue;"><i class="bi bi-check-circle"></i></p>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @foreach ($requests as $index => $request)
    <div class="modal fade" id="replyModal-{{ $request->id }}" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">ตอบกลับฟอร์ม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><span style="color: black;">ชื่อผู้ส่งฟอร์ม : </span>{{ $request->user_name_verifier ? $request->user_name_verifier : 'ยังไม่มีผู้ตอบกลับ' }}</p>
                    <p>ข้อความตอบกลับก่อนหน้า</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>วันที่ตอบกลับ</th>
                                <th>ข้อความที่ตอบกลับ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($request->replyforms as $reply)
                            <tr class="text-center">
                                <td>
                                    {{ $reply->created_at->timezone('Asia/Bangkok')->translatedFormat('d F') }} {{ $reply->created_at->year + 543 }}
                                    {{ $reply->created_at->format('H:i') }} น.
                                </td>
                                <td>{{ $reply->message }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center">ยังไม่มีการตอบกลับ</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
