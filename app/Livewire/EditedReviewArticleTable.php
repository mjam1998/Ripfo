<?php

namespace App\Livewire;

use App\Enums\ArticleStatus;
use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class EditedReviewArticleTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchInput = ''; // input کاربر
    public $search = '';      // سرچ واقعی
    public $sortField = 'created_at';
    public $sortAsc = false;

    public function applySearch()
    {
        $this->search = $this->searchInput;
        $this->resetPage(); // خیلی مهم
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortField = $field;
            $this->sortAsc = true;
        }
    }

    public function render()
    {
        $articles = Article::query()
            ->where('status', ArticleStatus::EditedReview->value)
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('code', 'like', '%' . $this->search . '%')
                        ->orWhere('title', 'like', '%' . $this->search . '%');

                });
            })
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate(3);

        return view('livewire.article-table', compact('articles'));
    }
}
