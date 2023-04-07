@extends('client.layouts.template')

@section('title', 'Đăng nhập')

@section('css')
<style>
.btn-google {
    background: #ea4335;
    margin: 0 auto;
    color: white !important;
    width: 75%;
    border-radius: 0%;
    margin-bottom: 10px;
}
.btn-facebook {
    background: #3b5998;
    margin: 0 auto;
    width: 75%;
    border-radius: 0%;
    color: white !important;
}
</style>

@stop
@section('main')
<!-- Contact Form Begin -->
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if(Session::has('invalid'))
                    <div class="alert alert-danger alert-dismissible mt-2">
                         <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         {{Session::get('invalid')}}
                    </div>
                @endif
                @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible mt-2">
                            <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{Session::get('success')}}
                        </div>
                @endif
            </div>
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>TRANG ĐĂNG NHẬP</h2>
                </div>
            </div>
        </div>
        <form action="{{ route('auth.post.login') }}" method="POST">

            @csrf

            <div class="row justify-content-md-center">
                <div class="col-lg-6 col-md-6">
                    <input type="email" placeholder="Email" style="margin-bottom: 10px;" name="email" value="{{ old('email') }}">
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-lg-6 col-md-6">
                    <input type="password" placeholder="Mật khẩu" name="password">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="site-btn">Đăng nhập</button>
                </div>
                
            </div>
        </form>
        
    </div>
</div>
<!-- Contact Form End -->
@stop