@extends('layouts.app')

@section('title', 'menu')

@section('content')

    <body class="bg-light">
        <!-- Header -->
        <div class="bg-white shadow-sm border-bottom">
            <div class="container-xxl py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <a href="{{ route('menus.index') }}" class="btn btn-light rounded-circle p-2" aria-label="メニュー一覧に戻る">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                        <div>
                            <h1 class="h5 mb-0 fw-semibold">{{ $menu->name }}</h1>
                            <p class="small text-muted mb-0">メニュー詳細</p>
                        </div>
                    </div>

                    <!-- Desktop Action Buttons -->
                    <div class="d-none d-md-flex gap-2">
                        <a href="{{ route('menus.edit', $menu) }}" class="btn btn-primary d-flex align-items-center gap-2"
                            aria-label="メニューを編集">
                            <i class="bi bi-pencil"></i>
                            <span>編集</span>
                        </a>
                        <button type="button" class="btn btn-danger d-flex align-items-center gap-2" data-bs-toggle="modal"
                            data-bs-target="#deleteModal" aria-label="メニューを削除">
                            <i class="bi bi-trash"></i>
                            <span>削除</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container-xxl py-4">
            <!-- Menu Overview -->
            <div class="card shadow-sm border mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="flex-fill">
                            <h2 class="h3 fw-bold mb-2">{{ $menu->name }}</h2>
                            <p class="text-muted mb-3">{{ $menu->description ?? 'メニューの説明はありません。' }}</p>

                            <div class="d-flex flex-wrap gap-3 small text-muted mb-3">
                                <div class="d-flex align-items-center gap-1">
                                    <i class="bi bi-calendar"></i>
                                    <span>作成日: {{ $menu->created_at->format('Y年m月d日') }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="bi bi-person"></i>
                                    <span>作成者: あなた</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="bi bi-globe text-success"></i>
                                    <span class="text-success">公開</span>
                                </div>
                            </div>
                        </div>

                        <div class="ms-3">
                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">初級者</span>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="row g-3 mb-3">
                        <div class="col-6 col-md-3">
                            <div class="bg-primary-subtle rounded p-3 text-center">
                                <div class="h4 fw-bold text-primary mb-0">5</div>
                                <div class="small text-muted">種目数</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="bg-success-subtle rounded p-3 text-center">
                                <div class="h4 fw-bold text-success mb-0">45</div>
                                <div class="small text-muted">推定時間(分)</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="bg-info-subtle rounded p-3 text-center">
                                <div class="h4 fw-bold text-info mb-0">1200</div>
                                <div class="small text-muted">総ボリューム(kg)</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="bg-warning-subtle rounded p-3 text-center">
                                <div class="h4 fw-bold text-warning mb-0">15</div>
                                <div class="small text-muted">総セット数</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-secondary rounded-pill">全身</span>
                        <span class="badge bg-secondary rounded-pill">初心者</span>
                        <span class="badge bg-secondary rounded-pill">基本</span>
                    </div>
                </div>
            </div>

            <!-- Exercise List -->
            <div class="card shadow-sm border mb-5">
                <div class="card-body p-4">
                    <h3 class="h5 fw-semibold mb-4">エクササイズ一覧</h3>

                    <div class="d-flex flex-column gap-3">
                        <!-- Exercise 1 -->
                        <a href="#" class="text-decoration-none">
                            <div class="bg-light rounded p-3 border hover-shadow">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="flex-fill">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="badge bg-primary rounded-pill">1</span>
                                            <h4 class="h6 fw-medium mb-0 text-dark">ベンチプレス</h4>
                                        </div>

                                        <div class="row g-3 small text-muted">
                                            <div class="col-6 col-md-3">
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-bullseye"></i>
                                                    <span>3セット</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <span>10回</span>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <span>60kg</span>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-clock"></i>
                                                    <span>休憩 90秒</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-2 small text-muted">
                                            <span class="fw-medium">メモ:</span> 胸をしっかり張って行う
                                        </div>
                                    </div>

                                    <div class="ms-3">
                                        <i class="bi bi-chevron-right text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Exercise 2 -->
                        <a href="#" class="text-decoration-none">
                            <div class="bg-light rounded p-3 border hover-shadow">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="flex-fill">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="badge bg-primary rounded-pill">2</span>
                                            <h4 class="h6 fw-medium mb-0 text-dark">スクワット</h4>
                                        </div>

                                        <div class="row g-3 small text-muted">
                                            <div class="col-6 col-md-3">
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-bullseye"></i>
                                                    <span>4セット</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <span>8回</span>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <span>80kg</span>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-clock"></i>
                                                    <span>休憩 120秒</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ms-3">
                                        <i class="bi bi-chevron-right text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Exercise 3 -->
                        <a href="#" class="text-decoration-none">
                            <div class="bg-light rounded p-3 border hover-shadow">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="flex-fill">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="badge bg-primary rounded-pill">3</span>
                                            <h4 class="h6 fw-medium mb-0 text-dark">デッドリフト</h4>
                                        </div>

                                        <div class="row g-3 small text-muted">
                                            <div class="col-6 col-md-3">
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-bullseye"></i>
                                                    <span>3セット</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <span>5回</span>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <span>100kg</span>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-clock"></i>
                                                    <span>休憩 180秒</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ms-3">
                                        <i class="bi bi-chevron-right text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Exercise 4 -->
                        <a href="#" class="text-decoration-none">
                            <div class="bg-light rounded p-3 border hover-shadow">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="flex-fill">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="badge bg-primary rounded-pill">4</span>
                                            <h4 class="h6 fw-medium mb-0 text-dark">プランク</h4>
                                        </div>

                                        <div class="row g-3 small text-muted">
                                            <div class="col-6 col-md-3">
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-bullseye"></i>
                                                    <span>3セット</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-clock"></i>
                                                    <span>60秒</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <span>-</span>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-clock"></i>
                                                    <span>休憩 60秒</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ms-3">
                                        <i class="bi bi-chevron-right text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Exercise 5 -->
                        <a href="#" class="text-decoration-none">
                            <div class="bg-light rounded p-3 border hover-shadow">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="flex-fill">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="badge bg-primary rounded-pill">5</span>
                                            <h4 class="h6 fw-medium mb-0 text-dark">ラットプルダウン</h4>
                                        </div>

                                        <div class="row g-3 small text-muted">
                                            <div class="col-6 col-md-3">
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-bullseye"></i>
                                                    <span>3セット</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <span>12回</span>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <span>50kg</span>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-clock"></i>
                                                    <span>休憩 90秒</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ms-3">
                                        <i class="bi bi-chevron-right text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Action Buttons -->
        <div class="d-md-none position-fixed bottom-0 start-0 end-0 bg-white border-top p-3">
            <div class="d-flex gap-2">
                <a href="{{ route('menus.edit', $menu) }}"
                    class="btn btn-primary flex-fill d-flex align-items-center justify-content-center gap-2"
                    aria-label="メニューを編集">
                    <i class="bi bi-pencil"></i>
                    <span>編集</span>
                </a>
                <button type="button"
                    class="btn btn-danger flex-fill d-flex align-items-center justify-content-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#deleteModal" aria-label="メニューを削除">
                    <i class="bi bi-trash"></i>
                    <span>削除</span>
                </button>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-danger-subtle rounded-circle p-2">
                                    <i class="bi bi-exclamation-triangle text-danger fs-5"></i>
                                </div>
                                <h5 class="modal-title mb-0" id="deleteModalLabel">メニューを削除しますか？</h5>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="mb-4">
                            <p class="text-muted mb-0">
                                <span class="fw-medium text-dark">{{ $menu->name }}</span>
                                を削除します。この操作は取り消せません。
                            </p>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary flex-fill"
                                data-bs-dismiss="modal">キャンセル</button>
                            <form method="POST" action="{{ route('menus.destroy', $menu) }}" class="flex-fill">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">削除する</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Toast -->
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi bi-check-circle me-2"></i>
                        メニューが削除されました
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>

        <style>
            .hover-shadow {
                transition: all 0.2s ease;
            }

            .hover-shadow:hover {
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
                background-color: #f8f9fa !important;
            }
        </style>
    </body>
@endsection

@section('footer')

@endsection
