@extends('layout.users_layout')
@section('user_layout')
<div class="container">
    <a href="{{route('UserIndex')}}" class="btn btn-primary btn-sm"> กลับหน้าหลัก</a><br><br>
    <h3>สมัครสมาชิก</h3><br>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3 col-md-4">
            <label for="first_name" class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="ชื่อ" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="last_name" class="form-label">นามสกุล</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="นามสกุล" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="email" class="form-label">อีเมล</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="อีเมล" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="password" class="form-label">รหัสผ่าน</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="password_confirmation" class="form-label">ยืนยันรหัสผ่าน</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="ยืนยันรหัสผ่าน" required>
        </div>
        <button type="submit" class="btn btn-primary">สมัครสมาชิก</button>
    </form>
</div>
@endsection
