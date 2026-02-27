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
                <form action="{{ route('writer.article.store.step-3', ['article' => $article]) }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label  class="control-label required" > خلاصه مقاله</label>
                                <textarea type="text" class="form-control auto-resize" name="summary" rows="3" >{{old('summary',$article->summary)}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label  class="control-label required" > خلاصه مقاله(انگلیسی)</label>
                                <textarea type="text" class="form-control auto-resize" dir="ltr" name="summary_en" rows="3" >{{old('summary_en',$article->summary_en)}}</textarea>
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
