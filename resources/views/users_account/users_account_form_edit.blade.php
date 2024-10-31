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
    <h2>แก้ไขคำร้อง</h2>
    <form action="{{ route('FormUpdate', $request->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="request_date" class="form-label">วันที่ส่งแบบฟอร์ม</label>
            <input type="date" class="form-control" id="request_date" name="request_date" value="{{ old('request_date', $request->request_date) }}" required>
        </div>

        <div class="mb-3">
            <label for="salutation" class="form-label">คำนำหน้า</label>
            <input type="text" class="form-control" id="salutation" name="salutation" value="{{ old('salutation', $request->salutation) }}">
        </div>

        <div class="mb-3">
            <label for="first_name" class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $request->first_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">นามสกุล</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $request->last_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="occupation" class="form-label">อาชีพ</label>
            <input type="text" class="form-control" id="occupation" name="occupation" value="{{ old('occupation', $request->occupation) }}">
        </div>

        <div class="mb-3">
            <label for="house_number" class="form-label">บ้านเลขที่</label>
            <input type="text" class="form-control" id="house_number" name="house_number" value="{{ old('house_number', $request->house_number) }}">
        </div>

        <div class="mb-3">
            <label for="village" class="form-label">หมู่บ้าน</label>
            <input type="text" class="form-control" id="village" name="village" value="{{ old('village', $request->village) }}">
        </div>

        <div class="mb-3">
            <label for="subdistrict" class="form-label">ตำบล</label>
            <input type="text" class="form-control" id="subdistrict" name="subdistrict" value="{{ old('subdistrict', $request->subdistrict) }}">
        </div>

        <div class="mb-3">
            <label for="district" class="form-label">อำเภอ</label>
            <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $request->district) }}">
        </div>

        <div class="mb-3">
            <label for="province" class="form-label">จังหวัด</label>
            <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $request->province) }}">
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">หมายเลขโทรศัพท์</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $request->phone_number) }}">
        </div>

        <div class="mb-3">
            <label for="subject" class="form-label">เรื่อง</label>
            <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject', $request->subject) }}">
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">เหตุผล</label>
            <textarea class="form-control" id="reason" name="reason">{{ old('reason', $request->reason) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="support_address" class="form-label">ที่อยู่ในการขอความอนุเคราะห์</label>
            <input type="text" class="form-control" id="support_address" name="support_address" value="{{ old('support_address', $request->support_address) }}" required>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">ปริมาณ</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $request->quantity) }}" required>
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">ความจุ</label>
            <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity', $request->capacity) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
    </form>
</div>

@endsection
