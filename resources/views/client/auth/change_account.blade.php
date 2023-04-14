@extends('client.layouts.template')

@section('title', 'Cập nhật tài khoản')

@section('main')
<!-- Contact Form Begin -->
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>CẬP NHẬT TÀI KHOẢN</h2>
                </div>
            </div>
        </div>
        <form action="{{ route('auth.post.change.account') }}" method="POST">

            @csrf

            <div class="row justify-content-md-center">
                <div class="col-lg-6 col-md-6">
                    <input type="text" placeholder="Họ tên" style="margin-bottom: 10px;" name="name" value="{{ $user->name }}" required>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-lg-6 col-md-6">
                    <input type="text" placeholder="Email" style="margin-bottom: 10px;" name="email" value="{{ $user->email }}" required>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-lg-6 col-md-6" style="margin-bottom: 10px;">
                    <select name="sex" class="form-control" style="width: 100px;" required>
                        <option value="0" {{ $user->sex == 0 ? 'selected' : '' }}>Nam</option>
                        <option value="1" {{ $user->sex == 1 ? 'selected' : '' }}>Nữ</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-lg-6 col-md-6">
                    <input type="tel" placeholder="Số điện thoại" style="margin-bottom: 10px;" value="{{ $user->phone }}" name="phone" pattern="[0-9]{10}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="site-btn">Cập nhật tài khoản</button>
                </div>
                
            </div>
        </form>        
    </div>
</div>
<!-- Contact Form End -->
@stop