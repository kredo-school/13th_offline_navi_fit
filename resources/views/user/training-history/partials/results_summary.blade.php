{{-- 
/**
 * Training History Results Summary
 * 検索結果・統計の要約パネル
 */
--}}

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="h6 mb-3">結果サマリー</h3>

        <ul class="list-group list-group-flush small">
            <li class="list-group-item d-flex justify-content-between">
                <span>表示件数</span>
                <span>{{ $records->total() }} 件中 {{ $records->firstItem() }} - {{ $records->lastItem() }} 件表示</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>合計セット数</span>
                <span>{{ $totalSets }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>合計回数</span>
                <span>{{ $totalReps }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>合計ボリューム</span>
                <span>{{ number_format($totalVolume) }} kg</span>
            </li>
        </ul>
    </div>
</div>
