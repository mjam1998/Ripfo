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
                <div class="text-start mb-3">
                    <button type="button" class="btn btn-outline-info btn-sm px-4"
                            data-bs-toggle="modal" data-bs-target="#articlePreviewModal">
                        <i class="bi bi-eye me-1"></i>
                        پیش‌نمایش مقاله
                    </button>
                </div>
                <form action="{{ route('writer.article.store.step-8', ['article' => $article]) }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">نامه برای سردبیر</label>
                                <textarea type="text" class="form-control auto-resize" name="juror_des_admin" rows="3">{{ old('juror_des_admin', $article->juror_des_admin) }}</textarea>
                                <span style="font-size: small; color: grey">در صورت داشتن توضیحاتی در مورد مقاله برای سردبیر وارد کنید.</span>
                            </div>
                        </div>

                        {{-- ✅ باکس تعهد --}}
                        <div class="col-md-12">
                            <div class="card border-warning mt-3">
                                <div class="card-header bg-warning bg-opacity-10 text-warning fw-bold">
                                    <i class="bi bi-shield-check me-2"></i>
                                    تعهد عدم ارسال یا انتشار قبلی
                                </div>
                                <div class="card-body">
                                    <p class="text-muted mb-3" style="font-size: 0.9rem; line-height: 2;">
                                        اینجانب تأیید می‌نمایم که مقاله ارسالی:
                                    </p>
                                    <ul class="text-muted mb-4" style="font-size: 0.9rem; line-height: 2.2;">
                                        <li>قبلاً به هیچ نشریه، کنفرانس یا مجله‌ای ارسال نشده و در حال بررسی در جای دیگری نمی‌باشد.</li>
                                        <li>به‌صورت آنلاین یا آفلاین (چاپی) در هیچ رسانه‌ای منتشر نشده است.</li>
                                        <li>متعلق به پروژه یا کار همکاران دیگر نبوده و حقوق مالکیت معنوی آن متعلق به نویسنده/نویسندگان ذکرشده است.</li>
                                    </ul>

                                    <div class="form-check p-3 rounded" style="background: #fff8e1; border: 1px solid #ffe082;">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="commitment_checkbox"
                                            name="commitment"
                                            value="1"
                                            {{ old('commitment') ? 'checked' : '' }}
                                            style="width: 1.2rem; height: 1.2rem; cursor: pointer;"
                                        >
                                        <label class="form-check-label fw-bold me-2" for="commitment_checkbox" style="cursor: pointer; line-height: 1.8;">
                                            موارد فوق را مطالعه نموده و صحت آن‌ها را تأیید می‌نمایم.
                                        </label>
                                    </div>

                                    {{-- پیام خطا در صورت تیک نزدن --}}
                                    <div id="commitment_error" class="text-danger mt-2 d-none" style="font-size: 0.85rem;">
                                        <i class="bi bi-exclamation-circle me-1"></i>
                                        برای ادامه باید تعهدنامه را تأیید کنید.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary btn-sm px-4" id="submit_btn">
                                مرحله بعد
                                <i class="bi bi-arrow-left ms-1"></i>
                            </button>
                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>
    {{-- ====== مودال پیش‌نمایش مقاله ====== --}}
    <div class="modal fade" id="articlePreviewModal" tabindex="-1" aria-labelledby="articlePreviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">

                {{-- هدر --}}
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="articlePreviewLabel">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        پیش‌نمایش مقاله
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                {{-- بدنه --}}
                <div class="modal-body p-4" style="font-family: 'Vazir', sans-serif; direction: rtl;">

                    {{-- ===== عنوان‌ها ===== --}}
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-light fw-bold text-secondary">
                            <i class="bi bi-type-h1 me-2 text-primary"></i> عنوان مقاله
                        </div>
                        <div class="card-body">
                            <p class="fw-bold fs-6 mb-1">{{ $article->title }}</p>
                            <p class="text-muted" style="direction: ltr; text-align: left; font-size: 0.95rem;">
                                {{ $article->title_en }}
                            </p>
                        </div>
                    </div>

                    {{-- ===== نویسندگان ===== --}}
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-light fw-bold text-secondary">
                            <i class="bi bi-people me-2 text-primary"></i> نویسندگان
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm mb-0 text-center">
                                    <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>نام و نام خانوادگی</th>
                                        <th>سازمان</th>
                                        <th>ایمیل</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($article->users()->orderBy('sort')->get() as $writer)
                                        <tr>
                                            <td>{{ $writer->pivot->sort }}</td>
                                            <td>
                                                {{ $writer->name }}
                                                @if($writer->id === $article->user_id)
                                                    <span class="badge bg-primary ms-1" style="font-size:0.7rem;">نویسنده اصلی</span>
                                                @endif
                                            </td>

                                            <td>{{ $writer->organ }}</td>
                                            <td style="direction: ltr;">{{ $writer->email }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- ===== چکیده‌ها ===== --}}
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-light fw-bold text-secondary">
                            <i class="bi bi-text-paragraph me-2 text-primary"></i> چکیده
                        </div>
                        <div class="card-body">
                            <p class="text-dark" style="line-height: 2; text-align: justify;">
                                {{ $article->summary }}
                            </p>
                            <hr>
                            <p class="text-muted" style="direction: ltr; text-align: justify; line-height: 1.9; font-size: 0.9rem;">
                                {{ $article->summary_en }}
                            </p>
                        </div>
                    </div>

                    {{-- ===== کلمات کلیدی ===== --}}
                    @if($article->keywords->count())
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-light fw-bold text-secondary">
                                <i class="bi bi-tags me-2 text-primary"></i> کلمات کلیدی
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    @foreach($article->keywords as $kw)
                                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary me-1 mb-1 px-3 py-2">
                                    {{ $kw->title }}
                                </span>
                                    @endforeach
                                </div>
                                <div>
                                    @foreach($article->keywords as $kw)
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary me-1 mb-1 px-3 py-2" style="direction:ltr;">
                                    {{ $kw->title_en }}
                                </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- ===== داور پیشنهادی ===== --}}
                    @if($article->juror_offer_name)
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-light fw-bold text-secondary">
                                <i class="bi bi-person-check me-2 text-primary"></i> داور پیشنهادی
                            </div>
                            <div class="card-body">
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <span class="text-muted small">نام:</span>
                                        <span class="fw-bold ms-2">{{ $article->juror_offer_name }}</span>
                                    </div>
                                    @if($article->juror_offer_mobile)
                                        <div class="col-md-4">
                                            <span class="text-muted small">موبایل:</span>
                                            <span class="fw-bold ms-2" style="direction:ltr;">{{ $article->juror_offer_mobile }}</span>
                                        </div>
                                    @endif
                                    @if($article->juror_offer_email)
                                        <div class="col-md-4">
                                            <span class="text-muted small">ایمیل:</span>
                                            <span class="fw-bold ms-2" style="direction:ltr;">{{ $article->juror_offer_email }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($article->juror_offer_id)
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-light fw-bold text-secondary">
                                <i class="bi bi-person-check me-2 text-primary"></i> داور پیشنهادی
                            </div>
                            <div class="card-body">
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <span class="text-muted small">نام:</span>
                                        <span class="fw-bold ms-2">{{ $article->jurorOffer->name }}</span>
                                    </div>
                                    @if($article->jurorOffer->mobile)
                                        <div class="col-md-4">
                                            <span class="text-muted small">موبایل:</span>
                                            <span class="fw-bold ms-2" style="direction:ltr;">{{ $article->jurorOffer->mobile }}</span>
                                        </div>
                                    @endif
                                    @if($article->jurorOffer->email)
                                        <div class="col-md-4">
                                            <span class="text-muted small">ایمیل:</span>
                                            <span class="fw-bold ms-2" style="direction:ltr;">{{ $article->jurorOffer->email }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- ===== هوش مصنوعی ===== --}}
                    @if($article->ai_name)
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-light fw-bold text-secondary">
                                <i class="bi bi-robot me-2 text-primary"></i> استفاده از هوش مصنوعی
                            </div>
                            <div class="card-body">
                                <p class="mb-1"><span class="text-muted small">نام ابزار:</span> <span class="fw-bold">{{ $article->ai_name }}</span></p>
                                <p class="mb-0 text-muted" style="line-height: 1.9; text-align: justify;">{{ $article->ai_description }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- ===== فایل‌ها ===== --}}
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-light fw-bold text-secondary">
                            <i class="bi bi-paperclip me-2 text-primary"></i> فایل‌های پیوست
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    @if($article->file_primary)
                                        <div class="d-flex align-items-center p-3 rounded" style="background:#fff5f5; border:1px solid #ffcdd2;">
                                            <i class="bi bi-file-pdf-fill text-danger fs-3 me-3"></i>
                                            <div>
                                                <div class="fw-bold text-danger">فایل PDF</div>
                                                <div class="text-muted small">{{ $article->file_primary }}</div>
                                            </div>
                                            <a href="{{ route('writer.article.pdf.download', $article) }}"
                                               class="btn btn-outline-danger btn-sm ms-auto">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        </div>
                                    @else
                                        <div class="text-muted text-center p-3 border rounded">
                                            <i class="bi bi-file-pdf text-secondary fs-3"></i>
                                            <div class="small mt-1">فایل PDF بارگذاری نشده</div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @if($article->file_secondary)
                                        <div class="d-flex align-items-center p-3 rounded" style="background:#f0f4ff; border:1px solid #c5cae9;">
                                            <i class="bi bi-file-word-fill text-primary fs-3 me-3"></i>
                                            <div>
                                                <div class="fw-bold text-primary">فایل Word</div>
                                                <div class="text-muted small">{{ $article->file_secondary }}</div>
                                            </div>
                                            <a href="{{ route('writer.article.word.download', $article) }}"
                                               class="btn btn-outline-primary btn-sm ms-auto">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        </div>
                                    @else
                                        <div class="text-muted text-center p-3 border rounded">
                                            <i class="bi bi-file-word text-secondary fs-3"></i>
                                            <div class="small mt-1">فایل Word بارگذاری نشده</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ===== نامه به سردبیر ===== --}}
                    @if($article->juror_des_admin)
                        <div class="card mb-2 border-0 shadow-sm">
                            <div class="card-header bg-light fw-bold text-secondary">
                                <i class="bi bi-envelope me-2 text-primary"></i> نامه برای سردبیر
                            </div>
                            <div class="card-body">
                                <p class="mb-0 text-muted" style="line-height: 2; text-align: justify;">
                                    {{ $article->juror_des_admin }}
                                </p>
                            </div>
                        </div>
                    @endif

                </div>

                {{-- فوتر --}}
                <div class="modal-footer">
                <span class="text-muted small me-auto">
                    <i class="bi bi-hash me-1"></i> کد مقاله: {{ $article->code }}
                </span>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x me-1"></i> بستن
                    </button>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.querySelector('form').addEventListener('submit', function (e) {
                const checkbox = document.getElementById('commitment_checkbox');
                const errorBox = document.getElementById('commitment_error');

                if (!checkbox.checked) {
                    e.preventDefault();
                    errorBox.classList.remove('d-none');
                    checkbox.closest('.form-check').style.border = '1px solid #dc3545';

                    // اسکرول به چک‌باکس
                    checkbox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else {
                    errorBox.classList.add('d-none');
                    checkbox.closest('.form-check').style.border = '1px solid #ffe082';
                }
            });

            // وقتی تیک زده شد خطا پنهان بشه
            document.getElementById('commitment_checkbox').addEventListener('change', function () {
                if (this.checked) {
                    document.getElementById('commitment_error').classList.add('d-none');
                    this.closest('.form-check').style.border = '1px solid #198754';
                }
            });
        </script>
        <script>
            function cancelArticle(url) {
                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: 'این عملیات قابل بازگشت نیست!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'بله، لغو شود',
                    cancelButtonText: 'خیر'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('cancel-article-form');
                        form.action = url;
                        form.submit();
                    }
                });
            }
        </script>
    @endpush

@endsection


