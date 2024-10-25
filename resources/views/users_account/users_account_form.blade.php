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
    <form action="{{ route('user.request.submit') }}" method="POST">
        @csrf
        <div class="mb-3 col-md-2">
            <label for="request_date" class="form-label">วันที่ขอสนับสนุน</label>
            <input type="date" class="form-control" id="request_date" name="request_date" required>
        </div>
        <br>

        <div class="row">
            <div class="mb-3 col-md-2">
                <label for="salutation" class="form-label">คำนำหน้า</label>
                <select class="form-select" id="salutation" name="salutation">
                    <option value="">-- เลือกคำนำหน้า --</option>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                    <option value="ดร.">ดร.</option>
                    <option value="คุณ">คุณ</option>
                </select>
            </div>
            <div class="mb-3 col-md-3">
                <label for="first_name" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="โปรดระบุ" value="{{ old('fullname', $user->first_name	 ?? '') }}" required>
            </div>
            <div class="mb-3 col-md-3">
                <label for="last_name" class="form-label">นามสกุล</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="โปรดระบุ" value="{{ old('fullname', $user->last_name	 ?? '') }}" required>
            </div>
            <div class="mb-3 col-md-3">
                <label for="occupation" class="form-label">อาชีพ</label>
                <input type="text" class="form-control" id="occupation" placeholder="โปรดระบุ" name="occupation" required>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="mb-3 col-md-2">
                <label for="house_number" class="form-label">บ้านเลขที่</label>
                <input type="text" class="form-control" id="house_number" name="house_number" placeholder="โปรดระบุ" required>
            </div>
            <div class="mb-3 col-md-2">
                <label for="village" class="form-label">หมู่ที่</label>
                <input type="text" class="form-control" id="village" name="village" placeholder="โปรดระบุ" required>
            </div>
            <div class="mb-3 col-md-2">
                <label for="subdistrict" class="form-label">ตำบล</label>
                <input type="text" class="form-control" id="subdistrict" name="subdistrict" placeholder="โปรดระบุ" required>
            </div>
            <div class="mb-3 col-md-3">
                <label for="district" class="form-label">อำเภอ</label>
                <input type="text" class="form-control" id="district" name="district" placeholder="โปรดระบุ" required>
            </div>
            <div class="mb-3 col-md-3">
                <label for="province" class="form-label">จังหวัด</label>
                <input type="text" class="form-control" id="province" name="province" placeholder="โปรดระบุ" required>
            </div>
            <div class="mb-3 col-md-2">
                <label for="phone_number" class="form-label">หมายเลขโทรศัพท์ที่ติดต่อได้</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="โปรดระบุ" required>
            </div>
        </div>

        <br>

        <div class="mb-3 col-md-5">
            <label for="subject" class="form-label">เรื่อง</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="โปรดระบุ" required>
        </div>
        <div class="mb-3 col-md-5">
            <label for="reason" class="form-label">เนื่องจาก</label>
            <textarea class="form-control" id="reason" name="reason" placeholder="โปรดระบุ" required></textarea>
        </div>
        <div class="mb-3 col-md-5">
            <label for="support_address" class="form-label">สถานที่ขอสนับสนุน (ที่อยู่)</label>
            <textarea class="form-control" id="support_address" name="support_address" placeholder="โปรดระบุ" required></textarea>
        </div>
        <div class="mb-3 col-md-2">
            <label for="quantity" class="form-label">จำนวน</label>
            <div class="d-flex align-items-center">
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="โปรดระบุ" required>
                <span class="ms-2">รถ</span>
            </div>
        </div>
        <div class="mb-3 col-md-2">
            <label for="capacity" class="form-label">ปริมาณความจุ</label>
            <div class="d-flex align-items-center">
                <input type="number" class="form-control" id="capacity" name="capacity" step="0.01" placeholder="โปรดระบุ" required>
                <span class="ms-2">ลิตร</span>
            </div>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary float-end">ส่งคำร้อง</button>
        </div>
    </form>
</div>
@endsection
