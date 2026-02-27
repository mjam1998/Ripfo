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
                <form action="{{ route('writer.article.store.step-7', ['article' => $article]) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label  class="control-label required" > فایل اصلی مقاله(pdf)</label>
                                <input type="file" class="form-control mt-2" name="file_primary" value="{{old('file_primary')}}"  >
                                <span style="font-size: small;color: grey" >فایل خود مقاله با فرمت pdf و حداکثر 10 مگابایت</span>
                                @if($article->file_primary)
                                    <div class="mt-3 p-3 rounded-3 border d-flex align-items-center justify-content-between"
                                         style="background: linear-gradient(135deg, #fff5f5, #ffe8e8); border-color: #f5c2c2 !important;">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                                 style="width:40px; height:40px; background:#dc3545; color:white; font-size:18px; flex-shrink:0;">
                                                <i class="bi bi-file-earmark-pdf-fill"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-danger" style="font-size:13px;">فایل PDF بارگذاری شده</div>
                                                <div class="text-muted" style="font-size:11px;">فایل قبلی موجود است</div>
                                            </div>
                                        </div>
                                        <a href="{{ route('writer.article.pdf.download', $article) }}"
                                           class="btn btn-danger btn-sm d-flex align-items-center gap-1 px-3"
                                           style="border-radius: 20px; font-size:12px;">
                                            <i class="bi bi-download"></i>
                                            دانلود
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label  class="control-label required" > فایل اصلی مقاله(word)</label>
                                <input type="file" class="form-control mt-2" name="file_secondary" value="{{old('file_secondary')}}"  >
                                <span style="font-size: small;color: grey" >فایل خود مقاله word با فرمت doc,docx و حداکثر 10 مگابایت</span>
                                @if($article->file_secondary)
                                    <div class="mt-3 p-3 rounded-3 border d-flex align-items-center justify-content-between"
                                         style="background: linear-gradient(135deg, #f0f7ff, #ddeeff); border-color: #b8d4f5 !important;">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                                 style="width:40px; height:40px; background:#0d6efd; color:white; font-size:18px; flex-shrink:0;">
                                                <i class="bi bi-file-earmark-word-fill"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-primary" style="font-size:13px;">فایل Word بارگذاری شده</div>
                                                <div class="text-muted" style="font-size:11px;">فایل قبلی موجود است</div>
                                            </div>
                                        </div>
                                        <a href="{{ route('writer.article.word.download', $article) }}"
                                           class="btn btn-primary btn-sm d-flex align-items-center gap-1 px-3"
                                           style="border-radius: 20px; font-size:12px;">
                                            <i class="bi bi-download"></i>
                                            دانلود
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>



                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary btn-sm px-4">
                                مرحله بعد
                            </button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

@endsection



