@extends('panel.layout.master')

@section('content')


    <div class="profile-content ">
        <div class="profile-section active" >


            <h3 class="section-title"><i class="bi bi-person-gear"></i> اطلاعات حساب کاربری</h3>
            @if(session()->has('information_success'))
                <div class="alert alert-success">{{session('information_success')}}  </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>خطا در اطلاعات وارد شده:</strong>
                    <ul class="mt-2 mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="panel-body mt-4">
                <form method="POST" action="{{route('writer.user.information.update')}}">
                    @csrf

                    <div class="row g-3">

                        <!-- Title -->
                        <div class="col-md-3">
                            <label class="form-label required">عنوان</label>
                            <select name="title" class="form-select" required>
                                @foreach($titles as $title)
                                    <option value="{{ $title->value }}"
                                        @selected($user->title === $title)>
                                        {{ $title->falabel() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-5">
                            <label class="form-label required">نام و نام خانوادگی</label>
                            <input type="text" name="name" value="{{ old('name') ?? $user->name }}"  class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label required">نام (انگلیسی)</label>
                            <input type="text" name="name_en" value="{{old('name_en') ?? $user->name_en}}" class="form-control" dir="ltr" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required">پست الکترونیکی</label>
                            <input type="email" value="{{ $user->email}}" class="form-control" disabled>

                        </div>

                        <div class="col-md-6">
                            <label class="form-label required">نام کاربری</label>
                            <input type="text" value="{{$user->user_name}}" class="form-control" dir="ltr" disabled>

                        </div>
                        <div class="col-md-6">
                            <label class="form-label">پست الکترونیکی کمکی</label>
                            <input type="email" name="email_help" value="{{old('email_help') ?? $user->email_help}}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required">کد ملی</label>
                            <input type="text" name="national_code" dir="ltr" value="{{old('national_code')  ?? $user->national_code}}" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required">موبایل</label>
                            <input type="text" name="mobile" value="{{old('mobile') ?? $user->mobile}}" class="form-control" dir="ltr" placeholder="09-------" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">فکس</label>
                            <input type="text" name="fax" dir="ltr" value="{{old('fax') ?? $user->fax}}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">شماره تلفن ثابت</label>
                            <input type="text" name="phone" dir="ltr" value="{{old('phone') ?? $user->phone}}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">ادرس صفحه اینترنتی</label>
                            <input type="url" name="url" value="{{old('url') ?? $user->url}} " class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required">شهر</label>
                            <input type="text" name="city" value="{{old('city') ?? $user->city}}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required">شهر(انگلیسی)</label>
                            <input type="text" name="city_en" value="{{old('city_en') ?? $user->city_en}}" class="form-control" dir="ltr" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required">وابستگی سازمانی</label>
                            <textarea type="text" name="organ"  class="form-control"  rows="3"   required>{{old('organ') ?? $user->organ}}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required">وابستگی سازمانی(انگلیسی)</label>
                            <textarea type="text" name="organ_en" class="form-control"  rows="3" dir="ltr"  required>{{old('organ_en') ?? $user->organ_en}}
                             </textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">کدپستی</label>
                            <input type="text" name="postal_code" value="{{old('postal_code') ?? $user->postal_code}}" class="form-control">
                        </div>
                        <!-- Education -->
                        <div class="col-md-6">
                            <label class="form-label required"> تحصیلات</label>
                            <select name="education" class="form-select" required>
                                @foreach($educations as $education)
                                    <option value="{{ $education->value }}"
                                        @selected($user->education === $education)>
                                        {{ $education->falabel() }}
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
                                    <option value="{{ $rank->value }}"
                                        @selected($user->academic_rank === $rank)>
                                        {{ $rank->falabel() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required"> زمینه مورد علاقه پژوهش  </label>
                            <input type="text" name="research_favorite" value="{{old('research_favorite') ?? $user->research_favorite}}" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label @if($isOrcidReq)required @endif">     شناسه پژوهشگر(ORCID)</label>
                            <input type="text" name="orcid" value="{{old('orcid') ?? $user->orcid}}" class="form-control" placeholder="xxxx-xxxx-xxxx-xxxx" dir="ltr" @if($isOrcidReq)required @endif>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"> شماره کارت بانکی</label>
                            <input type="text" name="bank_card" dir="ltr" value="{{old('bank_card') ?? $user->bank_card}}" class="form-control">
                            <span class="text text-secondary" style="font-size: small">برای پرداخت های آینده سامانه به حساب شما</span>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"> شماره شبا </label>
                            <input type="text" name="bank_account"  dir="ltr" value="{{old('bank_account') ?? $user->bank_account}}" class="form-control">

                        </div>
                        <div class="col-md-6">
                            <label class="form-label"> نام بانک </label>
                            <input type="text" name="bank_name" value="{{old('bank_name') ?? $user->bank_name}}" class="form-control">

                        </div>


                        <!-- Password -->
                        <div class="col-md-6">
                            <label class="form-label ">رمز عبور</label>
                            <input type="text" name="password" class="form-control" >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label ">تکرار رمز عبور</label>
                            <input type="text" name="password_confirmation" class="form-control" >
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">توضیحات </label>
                            <textarea type="text" name="user_description" class="form-control" placeholder="توضیحات برای ادمین" rows="3">{{old('user_description') ?? $user->user_description }}
                                    </textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-4">
                       ویرایش
                    </button>



                </form>
            </div>
        </div>
    </div>

    @push('scripts')


    @endpush

@endsection


