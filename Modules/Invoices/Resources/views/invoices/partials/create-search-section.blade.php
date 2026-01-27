{{-- Search Section --}}
<div class="card border border-secondary border-top-0 border-3">
    <div class="card-header py-2 px-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-6">
                <label class="form-label mb-1" style="font-size: 0.9em;">{{ __('Search Items') }}</label>
                <div class="position-relative">
                    <input type="text" id="item-search-input" class="form-control form-control-sm"
                        placeholder="{{ __('Search by item name or barcode...') }}" autocomplete="off">
                    <button class="btn btn-outline-secondary btn-sm" type="button" id="refresh-items-btn"
                        title="{{ __('Refresh Items Data') }}">
                        <i class="fas fa-sync-alt" id="refresh-spinner" style="display: none;"></i>
                    </button>
                    {{-- Search Results Dropdown --}}
                    <div id="search-results" class="list-group position-absolute w-100" 
                        style="z-index: 999; max-height: 300px; overflow-y: auto; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 1px solid #ddd; display: none; top: 100%; margin-top: 2px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
