@extends('front.layot.master')

@section('content')
    <section class="login-section py-5">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-xl-8 col-lg-9 col-md-11">
                    <div class="login-card">

                        <h3 class="login-title text-center mb-4">
                            ثبت نام در سامانه
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
                        <form method="POST" action="{{route('register.send')}}">
                            @csrf

                            <div class="row g-3">

                                <!-- Title -->
                                <div class="col-md-3">
                                    <label class="form-label required">عنوان</label>
                                    <select name="title" class="form-select" required>
                                        @foreach($titles as $title)
                                            <option value="{{ $title->value }}">
                                                {{ $title->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-5">
                                    <label class="form-label required">نام و نام خانوادگی</label>
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label required">نام (انگلیسی)</label>
                                    <input type="text" name="name_en" value="{{old('name_en')}}" class="form-control" dir="ltr" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">پست الکترونیکی</label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control" required>
                                    <span class="text text-secondary" style="font-size: small">پست الکترونیکی برای بازیابی رمز عبور هم استفاده میشود از درست بودن ان اطمینان حاصل کنید.</span>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">نام کاربری</label>
                                    <input type="text" name="user_name" value="{{old('user_name')}}" class="form-control" dir="ltr" required>
                                    <span class="text text-secondary" style="font-size: small">برای ورود به سامانه استفاده میشود.</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">پست الکترونیکی کمکی</label>
                                    <input type="email" name="email_help" value="{{old('email_help')}}" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">کد ملی</label>
                                    <input type="text" name="national_code" value="{{old('national_code')}}" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">موبایل</label>
                                    <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" placeholder="09-------" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">فکس</label>
                                    <input type="text" name="fax" value="{{old('fax')}}" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">شماره تلفن ثابت</label>
                                    <input type="text" name="phone" value="{{old('phone')}}" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">ادرس صفحه اینترنتی</label>
                                    <input type="url" name="url" value="{{old('url')}}" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">شهر</label>
                                    <input type="text" name="city" value="{{old('city')}}" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">شهر(انگلیسی)</label>
                                    <input type="text" name="city_en" value="{{old('city_en')}}" class="form-control" dir="ltr" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">وابستگی سازمانی</label>
                                    <textarea type="text" name="organ"  class="form-control" placeholder="گروه آموزشی، دانشکده، دانشگاه ، شهر، کشور / یا
نام موسسه آموزشی، شهر، کشور                                      " rows="3" required>{{old('organ')}}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">وابستگی سازمانی(انگلیسی)</label>
                                    <textarea type="text" name="organ_en" class="form-control" placeholder="Department, Faculty, University (Institution), City, Country" rows="3" dir="ltr" required>
                                        {{old('organ_en')}}
                                    </textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">کدپستی</label>
                                    <input type="text" name="postal_code" value="{{old('postal_code')}}" class="form-control">
                                </div>
                                <!-- Education -->
                                <div class="col-md-6">
                                    <label class="form-label required">مقطع تحصیلی</label>
                                    <select name="education" class="form-select" required>
                                        @foreach($educations as $education)
                                            <option value="{{ $education->value }}">
                                                {{ $education->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">رشته تحصیلی</label>
                                    <select name="education_filed_id" class="form-select" required>
                                        @foreach($educationFields as $field)
                                            <option value="{{ $field->id }}">{{ $field->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <label class="form-label required">مرتبه علمی</label>
                                    <select name="academic_rank" class="form-select" required>
                                        @foreach($academicRanks as $rank)
                                            <option value="{{ $rank->value }}">
                                                {{ $rank->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required"> زمینه مورد علاقه پژوهش  </label>
                                    <input type="text" name="research_favorite" value="{{old('research_favorite')}}" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label @if($isOrcidReq)required @endif">     شناسه پژوهشگر(ORCID)</label>
                                    <input type="text" name="orcid" value="{{old('orcid')}}" class="form-control" placeholder="xxxx-xxxx-xxxx-xxxx" dir="ltr" @if($isOrcidReq)required @endif>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"> شماره کارت بانکی</label>
                                    <input type="text" name="bank_card" value="{{old('bank_card')}}" class="form-control">
                                    <span class="text text-secondary" style="font-size: small">برای پرداخت های آینده سامانه به حساب شما</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"> شماره شبا </label>
                                    <input type="text" name="bank_account" value="{{old('bank_account')}}" class="form-control">

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"> نام بانک </label>
                                    <input type="text" name="bank_name" value="{{old('bank_name')}}" class="form-control">

                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_juror_want" id="is_juror_want">
                                        <label class="form-check-label" for="is_juror_want">
                                            آمادگی برای داوری مقالات
                                        </label>
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-md-6">
                                    <label class="form-label required">رمز عبور</label>
                                    <input type="text" name="password" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">تکرار رمز عبور</label>
                                    <input type="text" name="password_confirmation" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">توضیحات </label>
                                    <textarea type="text" name="user_description" class="form-control" placeholder="توضیحات برای ادمین" rows="3">
                                      {{old('user_description')}}
                                    </textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-login w-100 mt-4">
                                ثبت نام
                            </button>

                            <div class="text-center mt-3">
                                <a href="{{ route('login') }}">قبلاً ثبت نام کرده‌اید؟ ورود</a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

