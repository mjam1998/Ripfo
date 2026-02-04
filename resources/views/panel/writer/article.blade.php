@extends('panel.layout.master')

@section('content')


    <div class="profile-content ">
        <div class="profile-section active" >


            <h3 class="section-title"><i class="bi bi-file-text"></i> ثبت مقاله جدید</h3>
            @if(session()->has('article_success'))
                <div class="alert alert-success">{{session('article_success')}}  </div>
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
                <form method="post" action="{{route('writer.article.store')}}" enctype="multipart/form-data" >
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label  class="control-label required" > عنوان مقاله</label>
                                <input type="text" class="form-control mt-2" name="title" value="{{old('title')}}" required >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label  class="control-label required" > عنوان مقاله(انگلیسی)</label>
                                <input type="text" class="form-control " name="title_en" dir="ltr" value="{{old('title_en')}}" required >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label  class="control-label " > داور پیشنهادی</label>
                                <select id="juror_offer_id" type="text" class="form-control " name="juror_offer_id"   >



                                </select>
                                <span style="font-size: small;color: grey" >برای جست جو تایپ کنید</span>
                            </div>
                        </div>
                        <div class="col-md-4 d-none" id="jurorNameWrapper">
                            <div class="form-group">
                                <label  class="control-label " > نام داور پیشنهادی</label>
                                <input  type="text" class="form-control " name="juror_offer_name"  value="{{ old('juror_offer_name') }}">
                                <span style="font-size: small;color: grey" >نام و نام خانوادگی داور به همراه اسم دانشگاه یا سازمان مربوطه</span>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group ">
                                <label  class="control-label " >دیگر نویسندگان </label>
                            <select name="writers_id[]" id="writers" class="form-control "  size="6"  multiple>

                           </select>
                                <span style="font-size: small;color: grey" >در صورتی که مقاله علاوه بر شما نویسندگان دیگری دارد انتخاب کنید.</span>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group ">
                                <label  class="control-label required " >کلمات کلیدی</label>
                                <select name="keywords_id[]" id="keywords" class="form-control "  size="6"  multiple>

                                </select>

                            </div>
                        </div>




                        <div class="col-md-12">
                            <div class="form-group">
                                <label  class="control-label required" > خلاصه مقاله</label>
                                <textarea type="text" class="form-control auto-resize" name="summary" rows="3" >{{old('summary')}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label  class="control-label required" > خلاصه مقاله(انگلیسی)</label>
                                <textarea type="text" class="form-control auto-resize" dir="ltr" name="summary_en" rows="3" >{{old('summary_en')}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label  class="control-label required" > فایل اصلی مقاله(pdf)</label>
                                <input type="file" class="form-control mt-2" name="file_primary" value="{{old('file_primary')}}" required >
                                <span style="font-size: small;color: grey" >فایل خود مقاله با فرمت pdf و حداکثر 10 مگابایت</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label  class="control-label " > فایل پیوست مقاله(pdf)</label>
                                <input type="file" class="form-control mt-2" name="file_secondary" value="{{old('file_secondary')}}"  >
                                <span style="font-size: small;color: grey" >فایل pdf و حداکثر 10 مگابایت</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary   w-100" >
                           ثبت مقاله
                        </button>
                    </div>




                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const keywordsSelect = document.getElementById('keywords');

                const keywordsChoices = new Choices(keywordsSelect, {
                    removeItemButton: true,
                    searchEnabled: true,
                    shouldSort: false,
                    rtl: true,
                    searchResultLimit: 20,
                    placeholderValue: 'جستجوی کلمه کلیدی...',
                    noResultsText: 'نتیجه‌ای یافت نشد',
                    noChoicesText: 'برای جستجو تایپ کنید',
                });

                let controller;

                keywordsSelect.addEventListener('search', function (event) {
                    const searchTerm = event.detail.value;

                    if (searchTerm.length < 2) return;

                    if (controller) controller.abort();
                    controller = new AbortController();

                    fetch(`{{ route('keywords.search') }}?q=${encodeURIComponent(searchTerm)}`, {
                        signal: controller.signal
                    })
                        .then(res => res.json())
                        .then(data => {

                            // ✅ حفظ انتخاب‌های قبلی
                            const selectedValues = keywordsChoices.getValue(true);

                            keywordsChoices.clearChoices();

                            keywordsChoices.setChoices(data, 'value', 'label', true);

                            // ✅ restore selections
                            selectedValues.forEach(value => {
                                keywordsChoices.setChoiceByValue(value);
                            });
                        })
                        .catch(err => {
                            if (err.name !== 'AbortError') {
                                console.error(err);
                            }
                        });
                });

            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const writersSelect = document.getElementById('writers');

                const writersChoices = new Choices(writersSelect, {
                    removeItemButton: true,
                    searchEnabled: true,
                    shouldSort: false,
                    rtl: true,
                    searchResultLimit: 20,
                    placeholderValue: 'جستجوی نویسنده...',
                    noResultsText: 'نتیجه‌ای یافت نشد',
                    noChoicesText: 'برای جستجو تایپ کنید',
                });

                let controller;

                writersSelect.addEventListener('search', function (event) {
                    const searchTerm = event.detail.value;

                    if (searchTerm.length < 2) return;

                    if (controller) controller.abort();
                    controller = new AbortController();

                    fetch(`{{ route('writers.search') }}?q=${encodeURIComponent(searchTerm)}`, {
                        signal: controller.signal
                    })
                        .then(res => res.json())
                        .then(data => {

                            // ✅ آیتم‌های انتخاب‌شده حفظ می‌شوند
                            const selectedValues = writersChoices.getValue(true);

                            writersChoices.clearChoices();

                            writersChoices.setChoices(data, 'value', 'label', true);

                            // ✅ restore selections
                            selectedValues.forEach(value => {
                                writersChoices.setChoiceByValue(value);
                            });
                        })
                        .catch(err => {
                            if (err.name !== 'AbortError') {
                                console.error(err);
                            }
                        });
                });

            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const jurorSelect = document.getElementById('juror_offer_id');

                const STATIC_CHOICE = {
                    value: '0',
                    label: 'وارد کردن اسم داور دلخواه',
                    selected: false,
                    disabled: false,
                };

                const jurorChoices = new Choices(jurorSelect, {
                    removeItemButton: true,
                    searchEnabled: true,
                    shouldSort: false,
                    rtl: true,
                    placeholderValue: 'جستجوی داور...',
                    noResultsText: 'نتیجه‌ای یافت نشد',
                    noChoicesText: 'برای جستجو تایپ کنید',
                });

                // ✅ گزینه ثابت همیشه اول کار
                jurorChoices.setChoices([STATIC_CHOICE], 'value', 'label', true);

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

                            // ✅ دوباره گزینه ثابت را اضافه کن
                            jurorChoices.setChoices([STATIC_CHOICE], 'value', 'label', false);

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

        <script>

        document.addEventListener('DOMContentLoaded', function () {
            const textareas = document.querySelectorAll('.auto-resize');

            textareas.forEach(textarea => {
                const resize = () => {
                    textarea.style.height = 'auto';
                    textarea.style.height = textarea.scrollHeight + 'px';
                };

                textarea.addEventListener('input', resize);

                // برای زمانی که old('summary') مقدار دارد
                resize();
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            const jurorSelect = document.getElementById('juror_offer_id');
            const jurorNameWrapper = document.getElementById('jurorNameWrapper');
            const jurorNameInput = jurorNameWrapper.querySelector('input');

            function toggleJurorName() {
                if (jurorSelect.value === '0') {
                    jurorNameWrapper.classList.remove('d-none');

                } else {
                    jurorNameWrapper.classList.add('d-none');

                    jurorNameInput.value = '';
                }
            }

            // هنگام تغییر select
            jurorSelect.addEventListener('change', toggleJurorName);

            // برای زمانی که صفحه با old() رفرش می‌شود
            toggleJurorName();
        });
    </script>


    @endpush

@endsection

