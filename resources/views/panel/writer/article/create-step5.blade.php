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
                <form action="{{ route('writer.article.store.step-5', ['article' => $article]) }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">داور پیشنهادی</label>
                                <select id="juror_offer_id"
                                        class="form-control"
                                        name="juror_offer_id"
                                          >
                                    @if(isset($article) && $article->juror_offer_id)
                                        <option value="{{ $article->juror_offer_id }}" selected>
                                            {{ $article->jurorOffer->title->falabel() }}  {{ $article->jurorOffer->name ?? '' }}   {{ $article->jurorOffer->organ }}
                                        </option>
                                    @endif
                                </select>
                                <span style="font-size: small; color: grey">برای جست جو در بین داوران سامانه تایپ کنید اگر در لیست نیست مشخصات داور را وارد کنید.</span>

                            </div>


                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label "> نام داور پیشنهادی</label>
                                <input type="text" class="form-control " name="juror_offer_name"
                                       value="{{ old('juror_offer_name', $article->juror_offer_name) }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label ">موبایل </label>
                                <input type="text" class="form-control " name="juror_offer_mobile"
                                       value="{{ old('juror_offer_mobile', $article->juror_offer_mobile) }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label ">ایمیل</label>
                                <input type="text" class="form-control " name="juror_offer_email"
                                       value="{{ old('juror_offer_email', $article->juror_offer_email) }}" >
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

@push('scripts')


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const jurorSelect = document.getElementById('juror_offer_id');



            const jurorChoices = new Choices(jurorSelect, {
                removeItemButton: true,
                searchEnabled: true,
                shouldSort: false,
                rtl: true,
                placeholderValue: 'جستجوی داور...',
                noResultsText: 'نتیجه‌ای یافت نشد',
                noChoicesText: 'برای جستجو تایپ کنید',
            });



            let controller;

            jurorSelect.addEventListener('search', function (event) {
                const searchTerm = event.detail.value;

                if (searchTerm.length < 2) return;

                if (controller) controller.abort();
                controller = new AbortController();

                fetch(`{{ route('writer.jurors.search') }}?q=${encodeURIComponent(searchTerm)}`, {
                    signal: controller.signal
                })
                    .then(res => res.json())
                    .then(data => {

                        // ✅ انتخاب فعلی حفظ شود
                        const selectedValue = jurorChoices.getValue(true);

                        jurorChoices.clearChoices();



                        // ✅ نتایج سرور
                        jurorChoices.setChoices(data, 'value', 'label', false);

                        // ✅ restore selection اگر قبلاً انتخاب شده
                        if (selectedValue) {
                            jurorChoices.setChoiceByValue(selectedValue);
                        }
                    })
                    .catch(err => {
                        if (err.name !== 'AbortError') {
                            console.error(err);
                        }
                    });
            });

        });
    </script>




@endpush
