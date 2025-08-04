{{-- resources/views/user/menus/partials/modals/exercise-details-modal.blade.php --}}
{{-- 
エクササイズ詳細モーダル
Bootstrap 5.3のモーダルコンポーネントを使用
--}}

<div class="modal fade" id="exerciseDetailModal" tabindex="-1" aria-labelledby="exerciseModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
          {{-- Modal Header --}}
          <div class="modal-header border-bottom">
              <div class="flex-grow-1">
                  <h2 class="modal-title fs-4 fw-bold text-dark mb-2" id="exerciseModalTitle">
                      エクササイズの詳細
                  </h2>
                  <div class="d-flex align-items-center gap-3">
                      <span class="badge bg-success px-3 py-2 rounded-pill" id="exerciseDifficulty">
                          初級
                      </span>
                      <span class="text-muted small" id="exerciseCategory">胸部トレーニング</span>
                      <span class="text-muted small">•</span>
                      <span class="text-muted small" id="exerciseEquipment">自重</span>
                  </div>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
          </div>

          {{-- Modal Body --}}
          <div class="modal-body">
              {{-- Media Section --}}
              <div class="ratio ratio-16x9 bg-light rounded mb-4">
                  <img src="" alt="エクササイズのデモ画像" class="object-fit-cover rounded" id="exerciseImage">
              </div>

              {{-- Stats Grid --}}
              <div class="row g-3 mb-4">
                  <div class="col-6 col-md-3">
                      <div class="bg-primary bg-opacity-10 rounded p-3 text-center">
                          <i class="bi bi-bullseye text-primary fs-4 mb-2"></i>
                          <div class="small text-muted">対象部位</div>
                          <div class="fw-medium text-dark" id="muscleGroupCount">-</div>
                      </div>
                  </div>
                  <div class="col-6 col-md-3">
                      <div class="bg-success bg-opacity-10 rounded p-3 text-center">
                          <i class="bi bi-gear text-success fs-4 mb-2"></i>
                          <div class="small text-muted">器具</div>
                          <div class="fw-medium text-dark" id="equipmentDisplay">-</div>
                      </div>
                  </div>
                  <div class="col-6 col-md-3">
                      <div class="bg-warning bg-opacity-10 rounded p-3 text-center">
                          <i class="bi bi-clock text-warning fs-4 mb-2"></i>
                          <div class="small text-muted">推定時間</div>
                          <div class="fw-medium text-dark" id="estimatedTime">-分</div>
                      </div>
                  </div>
                  <div class="col-6 col-md-3">
                      <div class="bg-danger bg-opacity-10 rounded p-3 text-center">
                          <i class="bi bi-lightning text-danger fs-4 mb-2"></i>
                          <div class="small text-muted">消費カロリー</div>
                          <div class="fw-medium text-dark" id="caloriesBurn">-kcal</div>
                      </div>
                  </div>
              </div>

              {{-- Description --}}
              <div class="mb-4">
                  <h5 class="fw-semibold text-dark mb-3">説明</h5>
                  <p class="text-muted lh-lg" id="exerciseDescription">
                      エクササイズの詳細な説明がここに表示されます。
                  </p>
              </div>

              {{-- Target Muscles --}}
              <div class="mb-4">
                  <h5 class="fw-semibold text-dark mb-3">対象筋群</h5>
                  <div class="d-flex flex-wrap gap-2" id="muscleGroupsList">
                      {{-- 筋群バッジがここに動的に追加されます --}}
                  </div>
              </div>

              {{-- Instructions --}}
              <div class="mb-4">
                  <h5 class="fw-semibold text-dark mb-3">実行手順</h5>
                  <ol class="list-unstyled" id="instructionsList">
                      {{-- 手順がここに動的に追加されます --}}
                  </ol>
              </div>

              {{-- Tips --}}
              <div class="mb-4">
                  <h5 class="fw-semibold text-dark mb-3">コツ・注意点</h5>
                  <ul class="list-unstyled" id="tipsList">
                      {{-- コツがここに動的に追加されます --}}
                  </ul>
              </div>
          </div>

          {{-- Modal Footer --}}
          <div class="modal-footer bg-light">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                  閉じる
              </button>
              <button type="button" class="btn btn-primary" id="addToMenuBtn">
                  <i class="bi bi-plus-lg me-2"></i>
                  メニューに追加
              </button>
          </div>
      </div>
  </div>
</div>