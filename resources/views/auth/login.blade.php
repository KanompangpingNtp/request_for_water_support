@extends('layout.users_layout')
@section('user_layout')

<div class="container">
    <a href="{{route('UserIndex')}}" class="btn btn-primary btn-sm"> กลับหน้าหลัก</a><br><br>

    <h3>เข้าสู่ระบบ</h3><br>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3 col-md-3">
            <label for="email" class="form-label">อีเมล</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="อีเมล" required>
        </div>
        <div class="mb-3 col-md-3">
            <label for="password" class="form-label">รหัสผ่าน</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน" required>
        </div>
        <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
    </form>

</div>

@endsection
