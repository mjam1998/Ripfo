@extends('front.layot.master')

@section('content')
    <section class="login-section py-5">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-xl-4 col-lg-5 col-md-7 col-sm-10">
                    <div class="login-card">

                        <h3 class="login-title text-center mb-4">
                            ورود به سامانه
                        </h3>
                        @if(session()->has('reset_password'))
                            <p class="alert alert-success">{{session('reset_password')}}</p>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{route('login.submit')}}">
                            @csrf

                            <!-- Username -->
                            <div class="mb-3">
                                <label class="form-label">نام کاربری</label>
                                <input type="text" name="user_name" class="form-control" placeholder="نام کاربری خود را وارد کنید">
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">رمز عبور</label>
                                <input type="text" name="password" class="form-control" placeholder="رمز عبور">
                            </div>



                            <!-- Submit -->
                            <button type="submit" class="btn btn-login w-100">
                                ورود به سامانه
                            </button>

                            <!-- Links -->
                            <div class="login-links text-center mt-4">
                                <a href="{{route('forget.password')}}" class="d-block mb-2">رمز عبور خود را فراموش کرده‌اید؟</a>
                                <a href="{{route('register')}}" class="register-link">ثبت نام در سامانه</a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
