{{--
運動詳細モーダルコンポーネント
用途: 運動の詳細情報を表示するモーダルダイアログ
制約事項:
- JavaScript使用禁止（静的表示のみ）
- Bootstrap 5.3クラスのみ使用
- FontAwesome 6アイコンのみ
- Laravel Blade変数使用禁止
- 動的なBladeディレクティブ使用禁止
- 全データはダミーテキストをハードコーディング
--}}

<!-- Exercise Detail Modal -->
<div class="modal fade" id="exerciseDetailModal" tabindex="-1" aria-labelledby="exerciseModalTitle" aria-describedby="exerciseModalDescription" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header border-bottom">
          <div class="flex-grow-1">
            <h2 class="modal-title fs-2 fw-bold text-dark mb-2" id="exerciseModalTitle">
              プッシュアップ
              <!-- 動的化時は{{ $exercise->name }}に置換 -->
            </h2>
            <div class="d-flex align-items-center gap-3">
              <span class="badge bg-success-subtle text-success-emphasis px-3 py-2 rounded-pill">
                初級
                <!-- 動的化時は{{ $exercise->difficulty_text }}に置換 -->
              </span>
              <span class="text-muted small">胸部トレーニング</span>
              <!-- 動的化時は{{ $exercise->category }}に置換 -->
              <span class="text-muted small">•</span>
              <span class="text-muted small">自重</span>
              <!-- 動的化時は{{ $exercise->equipment }}に置換 -->
            </div>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="詳細を閉じる"></button>
        </div>
  
        <!-- Modal Body -->
        <div class="modal-body">
          <!-- Media Section -->
          <div class="ratio ratio-16x9 bg-light rounded mb-4">
            <img src="#" alt="プッシュアップのデモ画像" class="object-fit-cover rounded">
            <!-- 動的化時は{{ $exercise->thumbnail }}に置換 -->
            <!-- ビデオがある場合はvideoタグに変更 -->
          </div>
  
          <!-- Stats Grid -->
          <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
              <div class="bg-primary-subtle rounded p-3 text-center">
                <i class="fas fa-bullseye text-primary fs-4 mb-2"></i>
                <div class="small text-muted">対象部位</div>
                <div class="fw-medium text-dark">3箇所</div>
                <!-- 動的化時は{{ count($exercise->muscle_groups) }}に置換 -->
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="bg-success-subtle rounded p-3 text-center">
                <i class="fas fa-dumbbell text-success fs-4 mb-2"></i>
                <div class="small text-muted">器具</div>
                <div class="fw-medium text-dark">自重</div>
                <!-- 動的化時は{{ $exercise->equipment }}に置換 -->
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="bg-warning-subtle rounded p-3 text-center">
                <i class="fas fa-clock text-warning fs-4 mb-2"></i>
                <div class="small text-muted">推定時間</div>
                <div class="fw-medium text-dark">15分</div>
                <!-- 動的化時は{{ $exercise->estimated_duration }}分に置換 -->
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="bg-danger-subtle rounded p-3 text-center">
                <i class="fas fa-star text-danger fs-4 mb-2"></i>
                <div class="small text-muted">消費カロリー</div>
                <div class="fw-medium text-dark">150kcal</div>
                <!-- 動的化時は{{ $exercise->calories_burn }}kcalに置換 -->
              </div>
            </div>
          </div>
  
          <!-- Description -->
          <div class="mb-4">
            <h3 class="fs-5 fw-semibold text-dark mb-3">説明</h3>
            <p class="text-muted lh-lg" id="exerciseModalDescription">
              プッシュアップは胸筋、三角筋前部、上腕三頭筋を主に鍛える基本的な自重トレーニングです。正しいフォームで行うことで、上半身の筋力向上と筋持久力の向上が期待できます。器具を使わずにどこでも実施できるため、初心者から上級者まで幅広く取り組めるエクササイズです。
              <!-- 動的化時は{{ $exercise->description }}に置換 -->
            </p>
          </div>
  
          <!-- Target Muscles -->
          <div class="mb-4">
            <h3 class="fs-5 fw-semibold text-dark mb-3">対象筋群</h3>
            <div class="d-flex flex-wrap gap-2">
              <span class="badge bg-primary-subtle text-primary-emphasis px-3 py-2 rounded-pill">大胸筋</span>
              <span class="badge bg-primary-subtle text-primary-emphasis px-3 py-2 rounded-pill">三角筋前部</span>
              <span class="badge bg-primary-subtle text-primary-emphasis px-3 py-2 rounded-pill">上腕三頭筋</span>
              <!-- 動的化時は@foreach($exercise->muscle_groups as $muscle)に置換 -->
            </div>
          </div>
  
          <!-- Instructions -->
          <div class="mb-4">
            <h3 class="fs-5 fw-semibold text-dark mb-3">実行手順</h3>
            <ol class="list-unstyled">
              <li class="d-flex align-items-start mb-3">
                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 24px; height: 24px; font-size: 0.75rem;">1</span>
                <span class="text-muted">うつ伏せになり、手のひらを肩幅よりやや広く床につけます。</span>
              </li>
              <li class="d-flex align-items-start mb-3">
                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 24px; height: 24px; font-size: 0.75rem;">2</span>
                <span class="text-muted">つま先を床につけ、頭からかかとまで一直線になるよう姿勢を保ちます。</span>
              </li>
              <li class="d-flex align-items-start mb-3">
                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 24px; height: 24px; font-size: 0.75rem;">3</span>
                <span class="text-muted">肘を曲げながら胸を床に近づけるようにゆっくりと体を下げます。</span>
              </li>
              <li class="d-flex align-items-start mb-3">
                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 24px; height: 24px; font-size: 0.75rem;">4</span>
                <span class="text-muted">胸が床につく手前で止め、腕の力で元の位置まで押し上げます。</span>
              </li>
              <li class="d-flex align-items-start">
                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 24px; height: 24px; font-size: 0.75rem;">5</span>
                <span class="text-muted">この動作を指定された回数繰り返します。</span>
              </li>
              <!-- 動的化時は@foreach($exercise->instructions as $index => $instruction)に置換 -->
            </ol>
          </div>
  
          <!-- Tips -->
          <div class="mb-4">
            <h3 class="fs-5 fw-semibold text-dark mb-3">コツ・注意点</h3>
            <ul class="list-unstyled">
              <li class="d-flex align-items-start mb-3">
                <span class="bg-success rounded-circle me-3 mt-2" style="width: 8px; height: 8px; flex-shrink: 0;"></span>
                <span class="text-muted">体は常に一直線を保ち、お尻が上がったり下がったりしないよう注意しましょう。</span>
              </li>
              <li class="d-flex align-items-start mb-3">
                <span class="bg-success rounded-circle me-3 mt-2" style="width: 8px; height: 8px; flex-shrink: 0;"></span>
                <span class="text-muted">呼吸を止めずに、下がる時に息を吸い、上がる時に息を吐きます。</span>
              </li>
              <li class="d-flex align-items-start mb-3">
                <span class="bg-success rounded-circle me-3 mt-2" style="width: 8px; height: 8px; flex-shrink: 0;"></span>
                <span class="text-muted">肘は体から45度程度の角度で開くようにし、真横に広げすぎないようにします。</span>
              </li>
              <li class="d-flex align-items-start">
                <span class="bg-success rounded-circle me-3 mt-2" style="width: 8px; height: 8px; flex-shrink: 0;"></span>
                <span class="text-muted">初心者の方は膝をついた状態から始めることをおすすめします。</span>
              </li>
              <!-- 動的化時は@foreach($exercise->tips as $tip)に置換 -->
            </ul>
          </div>
        </div>
  
        <!-- Modal Footer -->
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            閉じる
          </button>
          <button type="button" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>
            メニューに追加
          </button>
          <!-- 動的化時: showAddButtonの条件で表示制御 -->
        </div>
      </div>
    </div>
  </div>
  
  {{-- 
  使用方法:
  1. モーダルを表示するには、data-bs-toggle="modal" data-bs-target="#exerciseDetailModal" を持つボタンを作成
  2. Bootstrap 5のJavaScriptライブラリが必要
  3. 動的化時は以下を置換:
     - 全ての<!-- 動的化時は... -->コメント部分
     - ダミーデータを実際のBladeテンプレート変数に置換
     - 条件分岐が必要な部分は@ifディレクティブを追加
  --}}