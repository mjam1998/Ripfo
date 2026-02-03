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
                                <input type="text" class="form-control " name="title_en" value="{{old('title_en')}}" required >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label  class="control-label " > داور پیشنهادی</label>
                                <select id="juror_offer_id" type="text" class="form-control " name="juror_offer_id"   >
                                    <option value="-1">انتخاب کنید...</option>
                                    <option value="0">وارد کردن اسم داور دلخواه</option>
                                    @foreach($jurors as $juror)
                                        <option value="{{ $juror->id }}">
                                            {{ $juror->title?->falabel() }} {{ $juror->name }}- {{ $juror->organ }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 d-none" id="jurorNameWrapper">
                            <div class="form-group">
                                <label  class="control-label " > نام داور پیشنهادی</label>
                                <input  type="text" class="form-control " name="juror_offer_name"  value="{{ old('juror_offer_name') }}">
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group ">
                                <label  class="control-label " >نویسندگان دیگر</label>
                            <select name="writers_id[]" id="writers" class="form-control "  size="6"  multiple>
                            @foreach($writers as $writer)
                                <option value="{{ $writer->id }}">
                                    {{ $writer->title?->falabel() }} {{ $writer->name }}- {{ $writer->organ }}
                                </option>
                            @endforeach
                           </select>
                                <span style="font-size: small;color: grey" >در صورتی که مقاله علاوه بر شما نویسندگان دیگری دارد انتخاب کنید.</span>
                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="form-group">
                                <label  class="control-label required" > خلاصه مقاله</label>
                                <textarea type="text" class="form-control auto-resize" name="summary" rows="3" >
                                   {{old('summary')}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label  class="control-label required" > خلاصه مقاله(انگلیسی)</label>
                                <textarea type="text" class="form-control auto-resize" name="summary_en" rows="3" >
                                   {{old('summary_en')}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label  class="control-label required" > فایل اصلی مقاله(pdf)</label>
                                <input type="file" class="form-control mt-2" name="file_primary" value="{{old('file_primary')}}" required >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label  class="control-label " > فایل پیوست مقاله</label>
                                <input type="file" class="form-control mt-2" name="file_secondary" value="{{old('file_secondary')}}"  >
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
            new Choices('#writers', {
                removeItemButton: true,
                searchEnabled: true,

                shouldSort: false,
                rtl: true
            });
        </script>
        <script>
            new Choices('#juror_offer_id', {
                removeItemButton: true,
                searchEnabled: true,

                shouldSort: false,
                rtl: true
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

