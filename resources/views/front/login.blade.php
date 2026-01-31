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

                        <form method="POST" action="#">
                            @csrf

                            <!-- Username -->
                            <div class="mb-3">
                                <label class="form-label">نام کاربری</label>
                                <input type="text" class="form-control" placeholder="نام کاربری خود را وارد کنید">
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">رمز عبور</label>
                                <input type="password" class="form-control" placeholder="رمز عبور">
                            </div>



                            <!-- Submit -->
                            <button type="submit" class="btn btn-login w-100">
                                ورود به سامانه
                            </button>

                            <!-- Links -->
                            <div class="login-links text-center mt-4">
                                <a href="#" class="d-block mb-2">رمز عبور خود را فراموش کرده‌اید؟</a>
                                <a href="#" class="register-link">ثبت نام در سامانه</a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
