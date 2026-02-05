@extends('panel.layout.master')

@section('content')

    <div class="profile-content">
        <div class="profile-section active">
            <h3 class="section-title mb-4">
                <i class="bi bi-vector-pen"></i> داشبورد نویسندگی
            </h3>

            <!-- آمار کلی -->
            <div class="row g-4 mb-4">
                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm h-100 status-card total-card">
                        <div class="card-body text-center">
                            <div class="status-icon mb-3">
                                <i class="bi bi-file-earmark-text fs-1"></i>
                            </div>
                            <h2 class="fw-bold mb-2">{{ $totalArticles ?? 0 }}</h2>
                            <p class="text-muted mb-0">مجموع مقالات</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm h-100 status-card success-card">
                        <div class="card-body text-center">
                            <div class="status-icon mb-3">
                                <i class="bi bi-check-circle fs-1"></i>
                            </div>
                            <h2 class="fw-bold mb-2">{{ $acceptedCount ?? 0 }}</h2>
                            <p class="text-muted mb-0">تایید شده</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm h-100 status-card warning-card">
                        <div class="card-body text-center">
                            <div class="status-icon mb-3">
                                <i class="bi bi-hourglass-split fs-1"></i>
                            </div>
                            <h2 class="fw-bold mb-2">{{ $reviewingCount ?? 0 }}</h2>
                            <p class="text-muted mb-0">در حال بررسی</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm h-100 status-card danger-card">
                        <div class="card-body text-center">
                            <div class="status-icon mb-3">
                                <i class="bi bi-x-circle fs-1"></i>
                            </div>
                            <h2 class="fw-bold mb-2">{{ $rejectedCount ?? 0 }}</h2>
                            <p class="text-muted mb-0">رد شده</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- وضعیت‌های تفصیلی -->
            <h5 class="mb-3"><i class="bi bi-bar-chart-fill"></i> جزئیات وضعیت مقالات</h5>
            <div class="row g-3">
                @foreach($articleStatuses ?? [] as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card border-start border-4 shadow-sm h-100 hover-card
                    @if($item['status'] == \App\Enums\ArticleStatus::Accepted) border-success
                    @elseif($item['status'] == \App\Enums\ArticleStatus::Rejected) border-danger
                    @elseif($item['status'] == \App\Enums\ArticleStatus::NeedEdit || $item['status'] == \App\Enums\ArticleStatus::NeedReSend) border-warning
                    @else border-primary
                    @endif">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1 small">{{ $item['status']->falabel() }}</h6>
                                        <h3 class="fw-bold mb-0">{{ $item['count'] }}</h3>
                                    </div>
                                    <div class="status-badge">
                                        @if($item['status'] == \App\Enums\ArticleStatus::SendedReview)
                                         <i class="bi bi-send fs-3 text-primary"></i>
                                        @elseif($item['status'] == \App\Enums\ArticleStatus::NeedReSend)
                                            <i class="bi bi-arrow-repeat fs-3 text-warning"></i>
                                        @elseif($item['status'] == \App\Enums\ArticleStatus::NeedEdit)
                                            <i class="bi bi-pencil-square fs-3 text-warning"></i>
                                        @elseif($item['status'] == \App\Enums\ArticleStatus::EditedReview)
                                            <i class="bi bi-file-earmark-check fs-3 text-info"></i>
                                        @elseif($item['status'] == \App\Enums\ArticleStatus::Cancel)
                                            <i class="bi bi-slash-circle fs-3 text-secondary"></i>
                                        @elseif($item['status'] == \App\Enums\ArticleStatus::AcceptedFinalReview)
                                            <i class="bi bi-clipboard-check fs-3 text-success"></i>
                                        @elseif($item['status'] == \App\Enums\ArticleStatus::Accepted)
                                            <i class="bi bi-trophy fs-3 text-success"></i>
                                        @elseif($item['status'] == \App\Enums\ArticleStatus::Rejected)
                                            <i class="bi bi-x-octagon fs-3 text-danger"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <style>
        .status-card {
            transition: all 0.3s ease;
            border-radius: 12px;
        }

        .status-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .total-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .total-card .text-muted {
            color: rgba(255, 255, 255, 0.9) !important;
        }

        .success-card {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
        }

        .success-card .text-muted {
            color: rgba(255, 255, 255, 0.9) !important;
        }

        .warning-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .warning-card .text-muted {
            color: rgba(255, 255, 255, 0.9) !important;
        }

        .danger-card {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
        }

        .danger-card .text-muted {
            color: rgba(255, 255, 255, 0.9) !important;
        }

        .status-icon {
            opacity: 0.9;
        }

        .hover-card {
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .hover-card:hover {
            transform: translateX(-5px);
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1) !important;
        }

        .section-title {
            color: #2d3748;
            font-weight: 600;
        }
    </style>

@endsection
