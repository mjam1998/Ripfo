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
                <form action="{{ route('writer.article.store.step-4', ['article' => $article]) }}" method="POST">
                    @csrf

                    <div class="row g-3">
                      {{--  <div class="form-group">
                            <label class="required">کلمات کلیدی</label>

                            <div id="keywords-wrapper">
                                --}}{{-- یک ردیف نمونه --}}{{--
                                <div class="keyword-row d-flex gap-2 mb-2 ">
                                    <input
                                        type="text"
                                        name="keywords[0][title]"
                                        class="form-control"
                                        placeholder="کلمه کلیدی (مثلا اقتصاد)"
                                    >
                                    <input
                                        type="text"
                                        name="keywords[0][title_en]"
                                        class="form-control"
                                        placeholder="ترجمه انگلیسی (economy)"
                                    >
                                    <button type="button" class="btn btn-danger remove-keyword">✕</button>
                                </div>
                            </div>

                            <button type="button" id="add-keyword" class="btn btn-outline-primary btn-sm mt-2">
                                + افزودن کلمه کلیدی
                            </button>
                        </div>--}}
                        <div class="form-group">
                            <label class="required">کلمات کلیدی</label>

                            <div id="keywords-wrapper">

                                @if($article->keywords->isNotEmpty())
                                    {{-- حالت ویرایش - نمایش کلمات موجود --}}
                                    @foreach($article->keywords as $index => $keyword)
                                        <div class="keyword-row d-flex gap-2 mb-2">
                                            <input
                                                type="text"
                                                name="keywords[{{ $index }}][title]"
                                                class="form-control"
                                                placeholder="کلمه کلیدی (مثلا اقتصاد)"
                                                value="{{ old("keywords.{$index}.title", $keyword->title) }}"
                                            >
                                            <input
                                                type="text"
                                                name="keywords[{{ $index }}][title_en]"
                                                class="form-control"
                                                placeholder="ترجمه انگلیسی (economy)"
                                                value="{{ old("keywords.{$index}.title_en", $keyword->title_en) }}"
                                            >
                                            <button type="button" class="btn btn-danger remove-keyword">✕</button>
                                        </div>
                                    @endforeach
                                @else
                                    {{-- حالت ایجاد - یک ردیف خالی --}}
                                    <div class="keyword-row d-flex gap-2 mb-2">
                                        <input
                                            type="text"
                                            name="keywords[0][title]"
                                            class="form-control"
                                            placeholder="کلمه کلیدی (مثلا اقتصاد)"
                                            value="{{ old('keywords.0.title') }}"
                                        >
                                        <input
                                            type="text"
                                            name="keywords[0][title_en]"
                                            class="form-control"
                                            placeholder="ترجمه انگلیسی (economy)"
                                            value="{{ old('keywords.0.title_en') }}"
                                        >
                                        <button type="button" class="btn btn-danger remove-keyword">✕</button>
                                    </div>
                                @endif

                            </div>

                            <button type="button" id="add-keyword" class="btn btn-outline-primary btn-sm mt-2">
                                + افزودن کلمه کلیدی
                            </button>
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
{{--@push('scripts')
    <script>
        // در انتهای صفحه یا فایل جداگانه
        let keywordIndex = 1;

        document.getElementById('add-keyword').addEventListener('click', function () {
            const wrapper = document.getElementById('keywords-wrapper');

            const row = document.createElement('div');
            row.className = 'keyword-row d-flex gap-2 mb-2';
            row.innerHTML = `
        <input
            type="text"
            name="keywords[${keywordIndex}][title]"
            class="form-control"
            placeholder="نام فارسی (لاراول)"
        >
        <input
            type="text"
            name="keywords[${keywordIndex}][title_en]"
            class="form-control"
            placeholder="نام انگلیسی (laravel)"
        >
        <button type="button" class="btn btn-danger remove-keyword">✕</button>
    `;

            wrapper.appendChild(row);
            keywordIndex++;
        });

        // حذف ردیف
        document.getElementById('keywords-wrapper').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-keyword')) {
                // حداقل یک ردیف باقی بماند
                const rows = document.querySelectorAll('.keyword-row');
                if (rows.length > 1) {
                    e.target.closest('.keyword-row').remove();
                }
            }
        });

    </script>
@endpush--}}
@push('scripts')
    <script>
        // index را از تعداد ردیف‌های موجود شروع کن
        let keywordIndex = {{ $article->keywords->count() > 0 ? $article->keywords->count() : 1 }};

        document.getElementById('add-keyword').addEventListener('click', function () {
            const wrapper = document.getElementById('keywords-wrapper');

            const row = document.createElement('div');
            row.className = 'keyword-row d-flex gap-2 mb-2';
            row.innerHTML = `
            <input
                type="text"
                name="keywords[${keywordIndex}][title]"
                class="form-control"
                placeholder="کلمه کلیدی (مثلا اقتصاد)"
            >
            <input
                type="text"
                name="keywords[${keywordIndex}][title_en]"
                class="form-control"
                placeholder="ترجمه انگلیسی (economy)"
            >
            <button type="button" class="btn btn-danger remove-keyword">✕</button>
        `;

            wrapper.appendChild(row);
            keywordIndex++;
        });

        document.getElementById('keywords-wrapper').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-keyword')) {
                const rows = document.querySelectorAll('.keyword-row');
                if (rows.length > 1) {
                    e.target.closest('.keyword-row').remove();
                }
            }
        });
    </script>
@endpush
