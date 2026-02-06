<div>

    <div class="row mb-2">
        @if(session()->has('article-cancel-message'))
            <p class="alert alert-danger">{{session('article-cancel-message')}}</p>
        @endif

        <div class="col-md-9">
            <input
                type="text"
                class="form-control"
                placeholder="جستجو براساس کد یا عنوان مقاله..."
                wire:model.defer="searchInput"
                wire:keydown.enter="applySearch"
            >
        </div>

        <div class="col-md-3">
            <button
                class="btn btn-primary w-100"
                wire:click="applySearch"
            >
                جستجو
            </button>
        </div>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th wire:click="sortBy('code')" style="cursor:pointer">
                کد
                @if($sortField == 'code')
                    @if($sortAsc) ↑ @else ↓ @endif
                @endif
            </th>
            <th wire:click="sortBy('title')" style="cursor:pointer">
                عنوان
                @if($sortField == 'title')
                    @if($sortAsc) ↑ @else ↓ @endif
                @endif
            </th>
            <th>
                عملیات
            </th>

        </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
            <tr>
                <td>{{ $article->code }}</td>
                <td title="{{ $article->title }}">
                    {{ \Illuminate\Support\Str::limit($article->title, 25) }}
                </td>
                <td class=" gap-2" style="text-align: center;">
                    <a href="{{ route('writer.article.detail', $article->code) }}" class="btn btn-sm btn-primary">
                        جزئیات
                    </a>
                    @if($article->status==\App\Enums\ArticleStatus::SendedReview
                       ||$article->status==\App\Enums\ArticleStatus::NeedReSend
                       ||$article->status==\App\Enums\ArticleStatus::NeedEdit
                       ||$article->status==\App\Enums\ArticleStatus::EditedReview
                     )
                        <button
                            type="button"
                            class="btn btn-sm btn-primary"
                            style="background-color: red;color: white;"
                            onclick="cancelArticle('{{ route('writer.article.cancel', $article->code) }}')">
                            لغو مقاله
                        </button>
                        <form id="cancel-article-form"  method="POST" style="display:none;">
                            @csrf
                        </form>

                    @endif

                </td>

            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $articles->links() }} <!-- صفحه‌بندی Bootstrap -->
</div>

@push('scripts')
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
