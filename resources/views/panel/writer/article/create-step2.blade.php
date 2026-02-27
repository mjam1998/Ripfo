@extends('panel.layout.master')

@section('content')
    @php
        $steps = [
            1 => 'عنوان‌ها',
            2 => 'نویسنده ها',
             3 => 'چکیده',
              4 => 'کلمات کلیدی',
            5 => 'داور پیشنهادی',
            6 => 'هوش مصنوعی',
            7 => 'فایل ها',
             8 => 'تکمیل ارسال',
        ];
    @endphp



    <div class="profile-content ">
        <div class="profile-section active">
            <h3 class="section-title"><i class="bi bi-file-text"></i> ثبت مقاله </h3>



            <div class="mb-5">
                {{-- Wrapper برای اسکرول موبایل --}}
                <div class="progress-wrapper" style="overflow-x: auto; padding-bottom: 8px;">
                    <div class="d-flex justify-content-between align-items-center position-relative"
                         style="min-width: 480px;">

                        {{-- خط پس‌زمینه --}}
                        <div class="position-absolute top-50 start-0 w-100 translate-middle-y"
                             style="height:4px; background:#e9ecef; z-index:1;"></div>

                        {{-- خط فعال --}}
                        <div class="position-absolute top-50 start-0 translate-middle-y"
                             style="height:4px; background:#198754; width: {{ ($step-1)/(count($steps)-1)*100 }}%; z-index:2; transition: width .4s ease;"></div>

                        @foreach($steps as $key => $label)
                            @php
                                $isClickable = $key <= $article->step;

                                if ($key == 1) {
                                    $url = isset($article)
                                        ? route('writer.article.edit.step-1', ['article' => $article])
                                        : route('writer.article.create.step-1');
                                } else {
                                    $url = isset($article)
                                        ? route('writer.article.create.step-' . $key, ['article' => $article])
                                        : '#';
                                }
                            @endphp

                            <div class="text-center position-relative flex-shrink-0"
                                 style="z-index:3; width: calc(100% / {{ count($steps) }});">

                                @if($isClickable)
                                    <a href="{{ $url }}" class="text-decoration-none d-flex flex-column align-items-center">
                                        @else
                                            <div class="d-flex flex-column align-items-center">
                                                @endif

                                                {{-- دایره --}}
                                                <div class="rounded-circle d-flex align-items-center justify-content-center step-circle
                            {{ $step > $key ? 'bg-success text-white' : ($step == $key ? 'bg-primary text-white shadow' : 'bg-light text-muted border') }}"
                                                     style="{{ $isClickable ? 'cursor:pointer;' : 'opacity:.6;' }}">
                                                    @if($step > $key)
                                                        <i class="bi bi-check-lg"></i>
                                                    @else
                                                        {{ $key }}
                                                    @endif
                                                </div>

                                                {{-- لیبل --}}
                                                <div class="step-label mt-2 small {{ $step == $key ? 'fw-bold text-primary' : 'text-muted' }}">
                                                    {{ $label }}
                                                </div>

                                            @if($isClickable)
                                    </a>
                                @else
                            </div>
                            @endif

                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        @if(session()->has('success'))
            <p class="alert alert-success">{{session('success')}}</p>
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
                <h3 class="section-title"> افزودن نویسنده همکار</h3>
                <form method="post" action="{{route('writer.article.store.step-2',['article'=>$article])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">

                        <!-- Title -->
                        <div class="col-md-3">
                            <label class="form-label required">عنوان</label>
                            <select name="title" class="form-select" required>
                                @foreach($titles as $title)
                                    <option value="{{ $title->value }}">
                                        {{ $title->falabel() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-5">
                            <label class="form-label required">نام و نام خانوادگی</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label required">نام و نام خانوادگی(انگلیسی)</label>
                            <input type="text" name="name_en" value="{{old('name_en')}}" class="form-control" dir="ltr" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required">پست الکترونیکی</label>
                            <input type="email" name="email" value="{{old('email')}}" class="form-control" required>
                            <span class="text text-secondary" style="font-size: small">برای نویسنده همکار ایمیل تایید فرستاده میشود ایمیل معتبر وارد کنید.</span>
                        </div>


                        <div class="col-md-6">
                            <label class="form-label required">کد ملی</label>
                            <input type="text" name="national_code" dir="ltr" value="{{old('national_code')}}" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required">موبایل</label>
                            <input type="text" name="mobile" dir="ltr" value="{{old('mobile')}}" class="form-control" placeholder="09-------" required>
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
                            <textarea type="text" name="organ_en" class="form-control" placeholder="Department, Faculty, University (Institution), City, Country" rows="3" dir="ltr" required>{{old('organ_en')}}</textarea>
                        </div>

                        <!-- Education -->
                        <div class="col-md-6">
                            <label class="form-label required"> تحصیلات</label>
                            <select name="education" class="form-select" required>
                                @foreach($educations as $education)
                                    <option value="{{ $education->value }}">
                                        {{ $education->falabel()  }}
                                    </option>
                                @endforeach
                            </select>
                        </div>




                        <div class="col-md-6">
                            <label class="form-label required">مرتبه علمی</label>
                            <select name="academic_rank" class="form-select" required>
                                @foreach($academicRanks as $rank)
                                    <option value="{{ $rank->value }}">
                                        {{ $rank->falabel() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>



                        <div class="col-md-6">
                            <label class="form-label @if($isOrcidReq)required @endif"> شناسه پژوهشگر(ORCID)</label>

                            <input type="text" name="orcid" value= "{{old('orcid')}}" class="form-control" placeholder="xxxx-xxxx-xxxx-xxxx" dir="ltr" @if($isOrcidReq)required @endif>
                        </div>






                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary btn-sm px-4">
                               افزودن
                            </button>
                        </div>
                    </div>


                </form>

                <div class="table-responsive mt-4">
                    <h5>لیست نویسندگان</h5>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ترتیب </th>
                            <th>نام و نام خانوادگی</th>
                            <th>ایمیل</th>
                            <th>تحصیلات</th>
                            <th>رتبه علمی</th>
                            <th>موبایل</th>
                            <th>شهر</th>

                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($writers as $writer)
                            <tr>
                                <td>{{ $writer->pivot->sort }}</td>
                                <td>{{$writer->name}}</td>
                                <td>{{$writer->email}}</td>
                                <td>{{$writer->education->falabel()}}</td>
                                <td>{{$writer->academic_rank->falabel()}}</td>
                                <td>{{$writer->mobile}}</td>
                                <td>{{$writer->city}}</td>
                                <td>
                                    @if($writer->pivot->sort != 1)
                                        {{-- دکمه بالا --}}
                                        @if($writer->pivot->sort > 2)

                                        <form method="POST"
                                                  action="{{ route('writer.article.writer.sort', ['article' => $article, 'user' => $writer->id]) }}"
                                                  class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="direction" value="up">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary" title="بالاتر">
                                                    <i class="bi bi-arrow-up"></i>
                                                </button>
                                            </form>
                                        @endif

                                        {{-- دکمه پایین --}}
                                        @if(!$loop->last)
                                            <form method="POST"
                                                  action="{{ route('writer.article.writer.sort', ['article' => $article, 'user' => $writer->id]) }}"
                                                  class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="direction" value="down">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary" title="پایین‌تر">
                                                    <i class="bi bi-arrow-down"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form method="POST"
                                              action="{{ route('writer.article.writer.delete', ['article' => $article, 'user' => $writer]) }}"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-outline-danger" >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="badge bg-primary">نویسنده اصلی</span>
                                    @endif

                                </td>
                            </tr>


                        @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="text-end mt-4">
                    <a href="{{route('writer.article.create.step-3',['article'=>$article])}}" class="btn btn-primary btn-sm px-4">
                         مرحله بعد
                    </a>
                </div>

        </div>
    </div>

@endsection
