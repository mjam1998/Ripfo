@extends('panel.layout.master')

@section('content')


    <div class="profile-content ">
        <div class="profile-section active" >


            <h3 class="section-title"><i class="bi bi-file-text"></i>  جزییات مقاله </h3>
            @if(session()->has('article_success'))
                <div class="alert alert-success">{{session('article_success')}}  </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>پیغام :</strong>
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
                                <label  class="control-label " > کد مقاله</label>
                                <input type="text" class="form-control mt-2" value=" {{$article->code}}" disabled >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label  class="control-label " > وضعیت مقاله</label>
                                <input type="text" class="form-control mt-2" value=" {{$article->status->falabel()}}" disabled >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label  class="control-label required" > عنوان مقاله</label>
                                <input type="text" class="form-control mt-2" name="title" value="{{old('title') ?? $article->title}}" @if($isEdit==false)disabled @else required @endif  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label  class="control-label required" > عنوان مقاله(انگلیسی)</label>
                                <input type="text" class="form-control " name="title_en" dir="ltr" value="{{old('title_en') ?? $article->title_en}}" @if($isEdit==false)disabled @else required @endif >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">داور پیشنهادی</label>
                                <select id="juror_offer_id"
                                        class="form-control"
                                        name="juror_offer_id" @if($isEdit==false)disabled  @endif>
                                    @if(isset($article) && $article->juror_offer_id)
                                        <option value="{{ $article->juror_offer_id }}" selected>
                                            {{ $article->jurorOffer->title->falabel() }}  {{ $article->jurorOffer->name ?? '' }}   {{ $article->jurorOffer->organ }}
                                        </option>
                                    @endif
                                </select>
                                <span style="font-size: small; color: grey">برای جست جو تایپ کنید</span>
                            </div>
                        </div>
                        <div class="col-md-4 d-none" id="jurorNameWrapper">
                            <div class="form-group">
                                <label  class="control-label " > نام داور پیشنهادی</label>
                                <input  type="text" class="form-control " name="juror_offer_name"  value="{{ old('juror_offer_name') ?? $article->juror_offer_name}}" @if($isEdit==false)disabled  @endif>
                                <span style="font-size: small;color: grey" >نام و نام خانوادگی داور به همراه اسم دانشگاه یا سازمان مربوطه</span>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group ">
                                <label  class="control-label " >دیگر نویسندگان </label>
                                <select name="writers_id[]" id="writers" class="form-control" multiple @if($isEdit==false)disabled  @endif>

                                    @foreach($article->users->except(auth()->user()->id) as $writer)
                                        <option value="{{ $writer->id }}" selected>
                                            {{ $writer->title->falabel() }}  {{ $writer->name ?? '' }}   {{ $writer->organ }}
                                        </option>
                                    @endforeach

                                </select>
                                <span style="font-size: small;color: grey" >در صورتی که مقاله علاوه بر شما نویسندگان دیگری دارد انتخاب کنید.</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label required">کلمات کلیدی</label>
                                <select name="keywords_id[]"
                                        id="keywords"
                                        class="form-control"
                                        size="6"
                                        multiple
                                        @if($isEdit==false)disabled  @endif>

                                        @foreach($article->keywords as $keyword)
                                            <option value="{{ $keyword->id }}" selected>
                                                {{ $keyword->title }}/{{$keyword->title_en}}
                                            </option>
                                        @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label  class="control-label " > کد doi  مقاله</label>
                                <input type="text" class="form-control mt-2" value=" {{$article->doi}}" disabled >
                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="form-group">
                                <label  class="control-label required" > خلاصه مقاله</label>
                                <textarea type="text" class="form-control auto-resize" name="summary" rows="3" @if($isEdit==false)disabled @else required @endif>{{old('summary') ?? $article->summary}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label  class="control-label required" > خلاصه مقاله(انگلیسی)</label>
                                <textarea type="text" class="form-control auto-resize" dir="ltr" name="summary_en" rows="3" @if($isEdit==false)disabled @else required @endif>{{old('summary_en') ?? $article->summary_en}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label  class="control-label " > داور مقاله</label>
                                <input type="text" class="form-control mt-2" value="{{$article->juror?->title->falabel()}} {{$article->juror?->name}} {{$article->juror?->organ}}" disabled >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label  class="control-label " > تعداد مشاهده مقاله</label>
                                <input type="text" class="form-control mt-2" value="{{$article->visitor_number}} " disabled >
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label  class="control-label " > توضیحات داور برای نویسنده</label>
                                <textarea type="text" class="form-control auto-resize" name="summary" rows="3" disabled>{{ $article->juror_des_writer}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label  class="control-label " > فایل پیوست داور</label>
                            <a href="{{ route('writer.article.download.juror', $article->code) }}"
                               class="btn btn-primary mt-2">
                                دانلودو مشاهده
                            </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label  class="control-label " > توضیحات نویسنده برای داور</label>
                                <textarea type="text" class="form-control auto-resize" name="summary" rows="3" @if($isEdit==false)disabled  @endif>{{old('writer_des_juror') ?? $article->writer_des_juror}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label  class="control-label required" > فایل اصلی مقاله(pdf)</label>
                                 @if($isEdit==true)
                                    <input type="file" class="form-control mt-2" name="file_primary" value="{{old('file_primary')}}" required >
                                    <p style="font-size: small;color: grey" >فایل خود مقاله با فرمت pdf و حداکثر 10 مگابایت</p>
                                 @endif

                                <a href="{{ route('writer.article.download', $article->code) }}"
                                   class="btn btn-primary mt-2">
                                    دانلودو مشاهده فایل اصلی مقاله
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label  class="control-label " > فایل پیوست مقاله(pdf)</label>
                                @if($isEdit==true)
                                    <input type="file" class="form-control mt-2" name="file_secondary" value="{{old('file_secondary')}}"  >
                                    <p style="font-size: small;color: grey" >فایل pdf و حداکثر 10 مگابایت</p>
                                @endif

                                <a href="{{ route('writer.article.download.second', $article->code) }}"
                                   class="btn btn-primary mt-2">
                                    دانلودو مشاهده فایل پیوست مقاله
                                </a>
                            </div>
                        </div>
                        @if($isEdit==true)
                            <button type="submit" class="btn btn-primary  "  style="margin-top: 40px; background-color: forestgreen;color: white;">
                                ویرایش مقاله
                            </button>
                        @endif

                        <a class="btn btn-primary " href="{{ route('writer.articles', $article->status->value) }}" style="background-color: grey;color: white;">
                            بازگشت
                        </a>
                    </div>




                </form>
            </div>
        </div>
    </div>
    <div class="profile-content ">
        <div class="profile-section active" >

            <h3 class="section-title"><i class="bi bi-star"></i>  امتیاز مقاله </h3>
            <div class="row g-3">
            <div class="col-md-4">
                <div class="form-group">
                    <label  class="control-label " > نوآوری</label>
                    <input type="text" class="form-control mt-2" value=" {{$article->articleScore?->innovation}}" disabled >
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label  class="control-label " > اهمیت و ضرورت موضوع</label>
                    <input type="text" class="form-control mt-2" value=" {{$article->articleScore?->subject_importance}}" disabled >
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label  class="control-label " >   کاربردی بودن نتایج مقاله</label>
                    <input type="text" class="form-control mt-2" value=" {{$article->articleScore?->result_usage}}" disabled >
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label  class="control-label " >   سازگاری ساختار مقاله با ساختار مقالات علمی</label>
                    <input type="text" class="form-control mt-2" value=" {{$article->articleScore?->struct_science}}" disabled >
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label  class="control-label " >   سازگاری ساختار مقاله با ساختار مقالات علمی</label>
                    <input type="text" class="form-control mt-2" value=" {{$article->articleScore?->struct_science}}" disabled >
                </div>
            </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label  class="control-label " >   رعایت اصول و آیین نگارش</label>
                        <input type="text" class="form-control mt-2" value=" {{$article->articleScore?->write_principle}}" disabled >
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label  class="control-label " >ارزش علمی محتوای مقاله</label>
                        <input type="text" class="form-control mt-2" value=" {{$article->articleScore?->science_content}}" disabled >
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label  class="control-label " >رعایت اخلاق علمی و استناد به منابع </label>
                        <input type="text" class="form-control mt-2" value=" {{$article->articleScore?->resource}}" disabled >
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label  class="control-label " >سازگاری مقاله با شیوه نگارش مجله </label>
                        <input type="text" class="form-control mt-2" value=" {{$article->articleScore?->pen}}" disabled >
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label  class="control-label " >به روز بودن و اعتبار داده های آماری </label>
                        <input type="text" class="form-control mt-2" value=" {{$article->articleScore?->update}}" disabled >
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label  class="control-label " >اعتبار یافته های تجربی</label>
                        <input type="text" class="form-control mt-2" value=" {{$article->articleScore?->prestige}}" disabled >
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label  class="control-label " >جمع کل امتیار(از 100 امتیاز)</label>
                        <input type="text" class="form-control mt-2" value=" {{$article->articleScore?->total_score}}" disabled >
                    </div>
                </div>



            </div>

        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // ✅ Keywords Select با Choices.js
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

                let keywordsController;

                keywordsSelect.addEventListener('search', function (event) {
                    const searchTerm = event.detail.value;
                    if (searchTerm.length < 2) return;

                    if (keywordsController) keywordsController.abort();
                    keywordsController = new AbortController();

                    fetch(`{{ route('keywords.search') }}?q=${encodeURIComponent(searchTerm)}`, {
                        signal: keywordsController.signal
                    })
                        .then(res => res.json())
                        .then(data => {
                            const selectedValues = keywordsChoices.getValue(true);
                            keywordsChoices.clearChoices();
                            keywordsChoices.setChoices(data, 'value', 'label', true);
                            selectedValues.forEach(value => {
                                keywordsChoices.setChoiceByValue(value);
                            });
                        })
                        .catch(err => {
                            if (err.name !== 'AbortError') console.error(err);
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


