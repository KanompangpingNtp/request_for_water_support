@extends('layout.users_account_layout')
@section('account_layout')
@if ($message = Session::get('success'))
<script>
    Swal.fire({
        icon: 'success'
        , title: '{{ $message }}'
    , })

</script>
@endif
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
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#submitModal-{{ $request->id }}">
                        <i class="bi bi-filetype-pdf"></i>
                    </button>
                    @if(!is_null($request->user_id))
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#replyModal-{{ $request->id }}">
                        <i class="bi bi-reply"></i>
                    </button>
                    @endif
                    <a href="{{ route('ShowFormUserEdit', $request->id) }}" class="btn btn-primary btn-sm">แก้ไข</a>
                </td>
                <td>
                    @if($request->status == 1)
                    <p> </p>
                    @elseif($request->status == 2)
                    <p style="font-size: 20px; color:blue;"><i class="bi bi-check-circle"></i></p>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @foreach ($requests as $index => $request)
    <div class="modal fade" id="submitModal-{{ $request->id }}" tabindex="-1" aria-labelledby="submitModalLabel-{{ $request->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="submitModalLabel-{{ $request->id }}">แสดงข้อมูล</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span style="color: black;">preview</span>
                    <a href="{{ route('exportPDF', $request->id) }}" class="btn btn-danger btn-sm" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach($requests as $form)
    <div class="modal fade" id="replyModal-{{ $form->id }}" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">ตอบกลับฟอร์ม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><span style="color: black;">ชื่อผู้ส่งฟอร์ม : </span>{{ $form->user ? $form->salutation . ' ' . $form->user->first_name . ' ' .$form->user->last_name : 'ผู้ใช้งานทั่วไป' }}</p>
                    <p>ข้อความตอบกลับก่อนหน้า</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>ผู้ตอบกลับ</th>
                                <th>วันที่ตอบกลับ</th>
                                <th>ข้อความที่ตอบกลับ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($form->replyforms as $reply)
                            <tr class="text-center">
                                {{-- <td>{{ $reply->user->fullname ?? 'Unknown User' }}</td> --}}
                                <td>{{ $reply->user ? $reply->user->first_name . ' ' . $reply->user->last_name : 'ไม่ระบุชื่อ' }}</td>
                                <td>
                                    {{ $reply->created_at->timezone('Asia/Bangkok')->translatedFormat('d F') }} {{ $reply->created_at->year + 543 }}
                                    {{ $reply->created_at->format('H:i') }} น.
                                </td>
                                <td>{{ $reply->message }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">ยังไม่มีการตอบกลับ</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <form action="{{ route('userreply', $form->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="message" class="form-label">ข้อความตอบกลับ</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="submit" class="btn btn-primary">ส่งตอบกลับ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="submitModal-{{ $request->id }}" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="submitModalLabel">แสดงข้อมูล</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span style="color: black;">preview</span>
                <a href="{{ route('exportPDF', $request->id) }}" class="btn btn-danger btn-sm" target="_blank">
                    <i class="bi bi-file-earmark-pdf"></i>
                </a>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <span class="text-start" style="color: black;">รับฟอร์ม</span>
                <form action="{{ route('updateStatus', $request->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" @if($request->status == 2) disabled @endif>
                        กดรับแบบฟอร์ม
                    </button>
                </form>
            </div>
        </div>
    </div>
</div> --}}
@endforeach
</div>
@endsection
