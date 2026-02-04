
@extends('panel.layout.master')

@section('content')

    <div class="profile-content ">
        <div class="profile-section active" >
    <h3> لیست مقالات تازه ارسال شده/در حال بررسی</h3>
    <livewire:sended-review-article-table />
        </div>
    </div>
    <div class="profile-content ">
        <div class="profile-section active" >
            <h3> لیست مقالات نیاز به ارسال دوباره</h3>
            <livewire:need-re-send-article-table />

        </div>
    </div>
    <div class="profile-content ">
        <div class="profile-section active" >
            <h3> لیست مقالات نیاز به ویرایش</h3>
            <livewire:need-edit-article-table />

        </div>
    </div>
        <div class="profile-content ">
            <div class="profile-section active" >
                <h3> لیست مقالات ویرایش شده/در حال بررسی</h3>
                <livewire:edited-review-article-table />

            </div>
        </div>
    <div class="profile-content ">
        <div class="profile-section active" >
            <h3> لیست مقالات پذیرفته شده/در حال بررسی نهایی فایل ها</h3>
            <livewire:accepted-final-review-article-table />

        </div>
    </div>
    <div class="profile-content ">
        <div class="profile-section active" >
            <h3> لیست مقالات پذیرفته شده/منتشر شده</h3>
            <livewire:accepted-article-table />

        </div>
    </div>
    <div class="profile-content ">
        <div class="profile-section active" >
            <h3> لیست مقالات رد شده</h3>
            <livewire:rejected-article-table />

        </div>
    </div>
    <div class="profile-content ">
        <div class="profile-section active" >
            <h3> لیست مقالات لغو شده توسط نویسنده</h3>
            <livewire:cancel-article-table />

        </div>
    </div>



@endsection



    @push('scripts')

    @endpush



