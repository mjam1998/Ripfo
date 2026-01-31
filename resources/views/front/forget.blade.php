@extends('front.layot.master')

@section('content')
    <section class="login-section py-5">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-xl-8 col-lg-9 col-md-11">
                    <div class="login-card">

                        <h3 class="login-title text-center mb-4">
                           فراموشی رمز عبور
                        </h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{route('forget.password.send')}}">
                            @csrf

                            <div class="row g-3">


                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <label class="form-label ">ایمیل خود را وارد کنید:</label>
                                    <input type="email" name="email" class="form-control" required>
                                    <span class="text text-secondary" style="font-size: small">پست الکترونیکی که با ان در سامانه ثبت نام کرده بودید را وارد کنید.</span>
                                </div>
                                <div class="col-md-3"></div>



                            </div>

                            <div class="d-flex justify-content-center mt-4 ">
                                <button type="submit" class="btn btn-login w-50">
                                    تایید
                                </button>
                            </div>



                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection


