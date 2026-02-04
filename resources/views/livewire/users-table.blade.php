<div>

    <div class="row mb-2">
        <div class="col-md-9">
            <input
                type="text"
                class="form-control"
                placeholder="جستجو بر اساس نام..."
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
            <th wire:click="sortBy('id')" style="cursor:pointer">
                آیدی
                @if($sortField == 'id')
                    @if($sortAsc) ↑ @else ↓ @endif
                @endif
            </th>
            <th wire:click="sortBy('name')" style="cursor:pointer">
                نام
                @if($sortField == 'name')
                    @if($sortAsc) ↑ @else ↓ @endif
                @endif
            </th>
            <th wire:click="sortBy('email')" style="cursor:pointer">
                ایمیل
                @if($sortField == 'email')
                    @if($sortAsc) ↑ @else ↓ @endif
                @endif
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $users->links() }} <!-- صفحه‌بندی Bootstrap -->
</div>
