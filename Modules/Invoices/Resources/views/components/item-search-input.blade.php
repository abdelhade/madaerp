@props([
    'id' => 'item-search-input',
    'name' => 'item_search',
    'placeholder' => null,
    'class' => '',
    'inputClass' => '',
    'disabled' => false,
    'required' => false,
    'autofocus' => false,
    'onSelect' => null, // JavaScript callback function name
    'onCreate' => null, // JavaScript callback function name for create new item
    'showCreateOption' => true,
    'invoiceType' => 10,
    'branchId' => null,
    'priceType' => 1,
    'focusNextSelector' => null, // CSS selector for next element to focus after selection
])

@php
    $uniqueId = $id . '_' . uniqid();
    $placeholder = $placeholder ?? __('Search item name or barcode...');
@endphp

<div class="item-search-wrapper position-relative {{ $class }}" id="wrapper-{{ $uniqueId }}">
    <input 
        type="text" 
        id="{{ $id }}"
        name="{{ $name }}"
        class="form-control form-control-sm {{ $inputClass }}"
        placeholder="{{ $placeholder }}"
        autocomplete="off"
        {{ $disabled ? 'disabled' : '' }}
        {{ $required ? 'required' : '' }}
        {{ $autofocus ? 'autofocus' : '' }}
        data-search-id="{{ $uniqueId }}"
    >
    
    {{-- Search Results Dropdown --}}
    <div id="search-results-{{ $uniqueId }}" class="item-search-results list-group" 
         style="position: fixed; z-index: 99999; max-height: 300px; overflow-y: auto; background: white; box-shadow: 0 4px 12px rgba(0,0,0,0.25); border: 1px solid #ccc; border-radius: 4px; display: none; min-width: 300px;">
    </div>
</div>

@once
@push('styles')
<style>
    .item-search-results .list-group-item {
        cursor: pointer;
        padding: 6px 10px;
        font-size: 0.85rem;
    }
    .item-search-results .list-group-item:hover,
    .item-search-results .list-group-item.active {
        background-color: #0d6efd;
        color: white;
    }
    .item-search-results .list-group-item.active .text-muted,
    .item-search-results .list-group-item:hover .text-muted {
        color: rgba(255,255,255,0.8) !important;
    }
    .item-search-results .create-new-item-option {
        background-color: rgba(25, 135, 84, 0.1);
        border-color: #198754;
    }
    .item-search-results .create-new-item-option:hover,
    .item-search-results .create-new-item-option.active {
        background-color: #198754;
    }
</style>
@endpush
@endonce

@push('scripts')
<script>
(function() {
    const searchId = '{{ $uniqueId }}';
    const inputEl = document.getElementById('{{ $id }}');
    const resultsEl = document.getElementById('search-results-{{ $uniqueId }}');
    const wrapperEl = document.getElementById('wrapper-{{ $uniqueId }}');
    
    if (!inputEl || !resultsEl) return;
    
    // Configuration
    const config = {
        invoiceType: {{ $invoiceType }},
        branchId: '{{ $branchId ?? '' }}',
        priceType: {{ $priceType }},
        showCreateOption: {{ $showCreateOption ? 'true' : 'false' }},
        onSelectCallback: {!! $onSelect ? "window['{$onSelect}']" : 'null' !!},
        onCreateCallback: {!! $onCreate ? "window['{$onCreate}']" : 'null' !!},
        focusNextSelector: {!! $focusNextSelector ? "'{$focusNextSelector}'" : 'null' !!},
        debounceDelay: 50,
        minSearchLength: 1,
    };
    
    // State
    let searchTimeout = null;
    let isSearching = false;
    let searchResults = [];
    let selectedIndex = -1;
    let lastSearchTerm = '';
    
    // Client-side cache for instant repeat searches
    const searchCache = {};
    
    // Normalize Arabic text
    function normalizeArabic(text) {
        return text
            .replace(/[أإآٱ]/g, 'ا')
            .replace(/ة/g, 'ه')
            .replace(/ى/g, 'ي')
            .replace(/ؤ/g, 'و')
            .replace(/ئ/g, 'ي')
            .replace(/[\u064B-\u065F]/g, ''); // Remove diacritics
    }
    
    // Position dropdown
    function positionDropdown() {
        const rect = inputEl.getBoundingClientRect();
        resultsEl.style.top = (rect.bottom + window.scrollY) + 'px';
        resultsEl.style.left = rect.left + 'px';
        resultsEl.style.width = Math.max(rect.width, 300) + 'px';
    }
    
    // Show dropdown
    function showDropdown() {
        positionDropdown();
        resultsEl.style.display = 'block';
    }
    
    // Hide dropdown
    function hideDropdown() {
        resultsEl.style.display = 'none';
        resultsEl.innerHTML = '';
        selectedIndex = -1;
    }
    
    // Search items
    async function searchItems(term) {
        lastSearchTerm = term;
        const cacheKey = term.toLowerCase().trim();
        
        // Check cache first - instant results!
        if (searchCache[cacheKey]) {
            displayResults(searchCache[cacheKey]);
            return;
        }
        
        if (isSearching) return;
        
        isSearching = true;
        
        // Show loading
        resultsEl.innerHTML = `
            <div class="list-group-item text-center py-2">
                <i class="fas fa-spinner fa-spin me-1"></i>{{ __('Searching...') }}
            </div>
        `;
        showDropdown();
        
        try {
            const params = new URLSearchParams({
                term: term.trim(),
                type: config.invoiceType,
                branch_id: config.branchId,
                selected_price_type: config.priceType,
            });
            
            const response = await fetch(`/api/v1/invoices/search-items?${params}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                credentials: 'same-origin',
            });
            
            if (!response.ok) throw new Error('Search failed');
            
            const data = await response.json();
            const items = data.items || [];
            
            // Save to cache
            searchCache[cacheKey] = items;
            
            displayResults(items);
        } catch (error) {
            console.error('Search error:', error);
            resultsEl.innerHTML = `
                <div class="list-group-item text-danger text-center py-2">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ __('Search error') }}
                </div>
            `;
        } finally {
            isSearching = false;
        }
    }
    
    // Display results
    function displayResults(items) {
        searchResults = items || [];
        selectedIndex = -1;
        
        let html = '';
        
        if (items && items.length > 0) {
            items.forEach((item, index) => {
                html += `
                    <a href="#" class="list-group-item list-group-item-action search-result-item" 
                       data-index="${index}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>${item.name}</strong>
                                <small class="text-muted ms-2">${item.code || ''}</small>
                            </div>
                            <span class="badge bg-primary">${parseFloat(item.price || 0).toFixed(2)}</span>
                        </div>
                    </a>
                `;
            });
        } else {
            html += `
                <div class="list-group-item text-muted text-center py-2">
                    <i class="fas fa-search me-1"></i>{{ __('No items found') }}
                </div>
            `;
        }
        
        // Add create new option
        if (config.showCreateOption && lastSearchTerm.length >= 2) {
            html += `
                <a href="#" class="list-group-item list-group-item-action create-new-item-option" 
                   data-index="create-new">
                    <div class="d-flex align-items-center text-success">
                        <i class="fas fa-plus-circle me-2"></i>
                        <span><strong>{{ __('Create new item') }}:</strong> "${lastSearchTerm}"</span>
                    </div>
                </a>
            `;
        }
        
        resultsEl.innerHTML = html;
        showDropdown();
        
        // Add click handlers
        resultsEl.querySelectorAll('.search-result-item').forEach(el => {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                const index = parseInt(this.dataset.index);
                selectItem(searchResults[index]);
            });
        });
        
        const createBtn = resultsEl.querySelector('.create-new-item-option');
        if (createBtn) {
            createBtn.addEventListener('click', function(e) {
                e.preventDefault();
                promptCreateItem();
            });
        }
    }
    
    // Select item
    function selectItem(item) {
        if (!item) return;
        
        inputEl.value = item.name;
        hideDropdown();
        
        // Call callback
        if (config.onSelectCallback && typeof config.onSelectCallback === 'function') {
            config.onSelectCallback(item);
        }
        
        // Dispatch custom event
        inputEl.dispatchEvent(new CustomEvent('itemSelected', { 
            detail: item,
            bubbles: true 
        }));
        
        // Focus next element if configured (delay to ensure callback has finished)
        if (config.focusNextSelector) {
            setTimeout(() => {
                const nextEl = document.querySelector(config.focusNextSelector);
                if (nextEl && !nextEl.disabled) {
                    nextEl.focus();
                    if (nextEl.select) nextEl.select();
                }
            }, 150);
        }
    }
    
    // Prompt create item
    function promptCreateItem() {
        const itemName = lastSearchTerm;
        if (!itemName || itemName.length < 2) return;
        
        hideDropdown();
        
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: '{{ __("Create new item") }}',
                text: `{{ __("Do you want to create a new item with name") }}: "${itemName}"?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '{{ __("Yes, create") }}',
                cancelButtonText: '{{ __("Cancel") }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    createItem(itemName);
                } else {
                    inputEl.focus();
                }
            });
        } else if (confirm(`{{ __("Do you want to create a new item with name") }}: "${itemName}"?`)) {
            createItem(itemName);
        }
    }
    
    // Create item via API
    async function createItem(name) {
        try {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: '{{ __("Creating item...") }}',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });
            }
            
            const response = await fetch('/api/v1/invoices/quick-create-item', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                credentials: 'same-origin',
                body: JSON.stringify({ name: name }),
            });
            
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to create item');
            }
            
            const data = await response.json();
            
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: '{{ __("Success") }}',
                    text: '{{ __("Item created successfully") }}',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
            
            // Select the new item
            if (data.item) {
                selectItem(data.item);
                
                // Call create callback
                if (config.onCreateCallback && typeof config.onCreateCallback === 'function') {
                    config.onCreateCallback(data.item);
                }
            }
            
        } catch (error) {
            console.error('Create item error:', error);
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: '{{ __("Error") }}',
                    text: error.message || '{{ __("Failed to create item") }}',
                    icon: 'error'
                });
            } else {
                alert(error.message || '{{ __("Failed to create item") }}');
            }
            inputEl.focus();
        }
    }
    
    // Navigate results
    function navigateResults(direction) {
        const totalItems = searchResults.length + (config.showCreateOption ? 1 : 0);
        if (totalItems === 0) return;
        
        if (direction === 'down') {
            selectedIndex = (selectedIndex + 1) % totalItems;
        } else {
            selectedIndex = selectedIndex <= 0 ? totalItems - 1 : selectedIndex - 1;
        }
        
        highlightSelected();
    }
    
    // Highlight selected
    function highlightSelected() {
        resultsEl.querySelectorAll('.list-group-item').forEach(el => {
            el.classList.remove('active');
        });
        
        const allItems = resultsEl.querySelectorAll('.list-group-item[data-index]');
        if (selectedIndex >= 0 && selectedIndex < allItems.length) {
            allItems[selectedIndex].classList.add('active');
            allItems[selectedIndex].scrollIntoView({ block: 'nearest' });
        }
    }
    
    // Select highlighted
    function selectHighlighted() {
        if (selectedIndex < 0) return;
        
        if (selectedIndex >= searchResults.length) {
            promptCreateItem();
        } else {
            selectItem(searchResults[selectedIndex]);
        }
    }
    
    // Debounced search
    function debounceSearch(term) {
        clearTimeout(searchTimeout);
        
        if (term.length < config.minSearchLength) {
            hideDropdown();
            return;
        }
        
        searchTimeout = setTimeout(() => {
            searchItems(term);
        }, config.debounceDelay);
    }
    
    // Event: Input
    inputEl.addEventListener('input', function() {
        debounceSearch(this.value);
    });
    
    // Event: Keydown
    inputEl.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideDropdown();
        } else if (e.key === 'ArrowDown') {
            e.preventDefault();
            e.stopPropagation();
            if (resultsEl.style.display !== 'none') {
                navigateResults('down');
            }
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            e.stopPropagation();
            if (resultsEl.style.display !== 'none') {
                navigateResults('up');
            }
        } else if (e.key === 'Enter') {
            // Only handle Enter if dropdown is visible and item is selected
            if (resultsEl.style.display !== 'none' && selectedIndex >= 0) {
                e.preventDefault();
                e.stopPropagation();
                selectHighlighted();
            }
            // Otherwise, let the event bubble up to parent handlers
        }
    });
    
    // Event: Focus
    inputEl.addEventListener('focus', function() {
        if (this.value.length >= config.minSearchLength && searchResults.length > 0) {
            showDropdown();
        }
    });
    
    // Event: Click outside
    document.addEventListener('click', function(e) {
        if (!wrapperEl.contains(e.target) && !resultsEl.contains(e.target)) {
            hideDropdown();
        }
    });
    
    // Event: Scroll/Resize - reposition dropdown
    window.addEventListener('scroll', positionDropdown, true);
    window.addEventListener('resize', positionDropdown);
    
    // Expose methods globally for this instance
    window['itemSearch_' + searchId] = {
        clear: function() {
            inputEl.value = '';
            hideDropdown();
            searchResults = [];
        },
        focus: function() {
            inputEl.focus();
        },
        setValue: function(value) {
            inputEl.value = value;
        },
        getValue: function() {
            return inputEl.value;
        }
    };
})();
</script>
@endpush
