/**
 * Invoice Create Form Manager
 * Handles all invoice creation functionality
 */

class InvoiceCreateManager {
    constructor(config) {
        // Configuration from server
        this.config = {
            type: config.type || 0,
            branchId: config.branchId || '',
            selectedPriceType: config.selectedPriceType || 1,
            debounceDelay: config.debounceDelay || 300,
            minSearchLength: config.minSearchLength || 2,
            searchLimit: config.searchLimit || 25,
            defaultVatPercentage: config.defaultVatPercentage || 0,
            // Translations
            translations: config.translations || {},
            // Edit mode
            isEditMode: config.isEditMode || false,
            operationId: config.operationId || null,
            updateUrl: config.updateUrl || '',
        };

        // Template configuration
        this.templateConfig = window.invoiceTemplateConfig || {
            visibleColumns: ['item_name', 'unit', 'quantity', 'price', 'discount', 'sub_value'],
            columnWidths: {},
            columnOrder: [],
            allColumns: {},
        };

        // State
        this.state = {
            items: [],
            selectedItem: null,
            searchTimeout: null,
            isSearching: false,
            rowIndex: 0,
            searchResults: [],
            selectedResultIndex: -1,
            lastSearchTerm: '',
            currentDiscPercent: 0,
            currentDiscValue: 0,
        };

        // DOM Elements
        this.elements = {};

        // Initialize
        this.init();
    }

    /**
     * Initialize the manager
     */
    init() {
        this.cacheElements();
        this.setupCallbacks();
        this.setupEventListeners();
        
        // Focus on search input
        if (this.elements.searchInput) {
            this.elements.searchInput.focus();
        }
    }

    /**
     * Cache DOM elements
     */
    cacheElements() {
        this.elements = {
            searchInput: document.getElementById('item-search-input'),
            inputRow: document.getElementById('input-row'),
            inputItemCode: document.getElementById('input-item-code'),
            inputUnit: document.getElementById('input-unit'),
            inputQty: document.getElementById('input-qty'),
            inputBatchNumber: document.getElementById('input-batch-number'),
            inputExpiryDate: document.getElementById('input-expiry-date'),
            inputLength: document.getElementById('input-length'),
            inputWidth: document.getElementById('input-width'),
            inputHeight: document.getElementById('input-height'),
            inputDensity: document.getElementById('input-density'),
            inputPrice: document.getElementById('input-price'),
            inputDiscPercent: document.getElementById('input-disc-percent'),
            inputDiscValue: document.getElementById('input-disc-value'),
            inputVatPercent: document.getElementById('input-vat-percent'),
            inputVatValue: document.getElementById('input-vat-value'),
            inputTotal: document.getElementById('input-total'),
            addItemBtn: document.getElementById('add-item-btn'),
            itemsTbody: document.getElementById('invoice-items-tbody'),
            itemRowTemplate: document.getElementById('item-row-template'),
            searchResults: document.getElementById('search-results'),
            // Footer totals
            totalQtyFooter: document.getElementById('total-qty-footer'),
            totalDiscFooter: document.getElementById('total-disc-footer'),
            totalVatFooter: document.getElementById('total-vat-footer'),
            totalAmountFooter: document.getElementById('total-amount-footer'),
            // Footer displays
            itemsCountDisplay: document.getElementById('items-count-display'),
            totalQtyDisplay: document.getElementById('total-qty-display'),
            footerTotalDisplay: document.getElementById('footer-total-display'),
            subtotalDisplay: document.getElementById('subtotal-display'),
            totalDisplay: document.getElementById('total-display'),
        };
    }

    /**
     * Setup global callbacks for item-search-input component
     */
    setupCallbacks() {
        const self = this;
        
        window.onItemSelected = function(item) {
            self.selectItem(item);
        };
        
        window.onItemCreated = function(item) {
            self.selectItem(item);
        };
        
        if (this.elements.searchInput) {
            this.elements.searchInput.addEventListener('itemSelected', (e) => {
                self.selectItem(e.detail);
            });
        }
    }

    /**
     * Get translation
     */
    t(key) {
        return this.config.translations[key] || key;
    }

    /**
     * Check if column is visible
     */
    isColumnVisible(col) {
        return this.templateConfig.visibleColumns.includes(col);
    }

    getAllColumns() {
        return this.templateConfig.allColumns || {};
    }


    getColumn(col) {
        return this.templateConfig.allColumns?.[col] || null;
    }


    debounceSearch(term) {
        clearTimeout(this.state.searchTimeout);
        
        if (term.length < this.config.minSearchLength) {
            this.hideSearchResults();
            return;
        }

        this.state.searchTimeout = setTimeout(() => {
            this.searchItems(term);
        }, this.config.debounceDelay);
    }

    async searchItems(term) {
        if (this.state.isSearching) return;
        
        this.state.isSearching = true;
        this.state.lastSearchTerm = term;
        this.showSearchLoading();

        try {
            const params = new URLSearchParams({
                term: term.trim(),
                type: this.config.type,
                branch_id: this.config.branchId,
                selected_price_type: this.config.selectedPriceType,
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
            this.displaySearchResults(data.items || []);
        } catch (error) {
            console.error('Search error:', error);
            this.showSearchError();
        } finally {
            this.state.isSearching = false;
        }
    }

    positionSearchResults() {
        if (!this.elements.searchInput || !this.elements.searchResults) return;
        
        const inputRect = this.elements.searchInput.getBoundingClientRect();
        this.elements.searchResults.style.top = (inputRect.bottom + window.scrollY) + 'px';
        this.elements.searchResults.style.left = inputRect.left + 'px';
        this.elements.searchResults.style.width = Math.max(inputRect.width, 300) + 'px';
    }

    displaySearchResults(items) {
        this.state.searchResults = items || [];
        this.state.selectedResultIndex = -1;
        
        let html = '';
        
        if (items && items.length > 0) {
            items.forEach((item, index) => {
                html += `
                    <a href="#" class="list-group-item list-group-item-action py-1 px-2 search-result-item" 
                       data-index="${index}" data-item='${JSON.stringify(item).replace(/'/g, "&#39;")}'>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong style="font-size: 0.85rem;">${item.name}</strong>
                                <small class="text-muted ms-2">${item.code || ''}</small>
                            </div>
                            <span class="badge bg-primary">${this.formatNumber(item.price || 0)}</span>
                        </div>
                    </a>
                `;
            });
        } else {
            html += `
                <div class="list-group-item text-muted text-center py-2">
                    <i class="fas fa-search me-1"></i>${this.t('No items found')}
                </div>
            `;
        }
        
        html += `
            <a href="#" class="list-group-item list-group-item-action py-2 px-2 create-new-item-option bg-success bg-opacity-10 border-success" 
               data-index="create-new">
                <div class="d-flex align-items-center text-success">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span><strong>${this.t('Create new item')}:</strong> "${this.state.lastSearchTerm}"</span>
                </div>
            </a>
        `;

        this.elements.searchResults.innerHTML = html;
        this.positionSearchResults();
        this.elements.searchResults.style.display = 'block';

        // Add click handlers
        const self = this;
        this.elements.searchResults.querySelectorAll('.search-result-item').forEach(el => {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                const item = JSON.parse(this.dataset.item);
                self.selectItem(item);
            });
        });
        
        const createNewBtn = this.elements.searchResults.querySelector('.create-new-item-option');
        if (createNewBtn) {
            createNewBtn.addEventListener('click', function(e) {
                e.preventDefault();
                self.promptCreateNewItem();
            });
        }
    }

    navigateSearchResults(direction) {
        const totalItems = this.state.searchResults.length + 1;
        
        if (direction === 'down') {
            this.state.selectedResultIndex = (this.state.selectedResultIndex + 1) % totalItems;
        } else if (direction === 'up') {
            this.state.selectedResultIndex = this.state.selectedResultIndex <= 0 ? totalItems - 1 : this.state.selectedResultIndex - 1;
        }
        
        this.highlightSelectedResult();
    }

    highlightSelectedResult() {
        this.elements.searchResults.querySelectorAll('.list-group-item').forEach(el => {
            el.classList.remove('active', 'bg-primary', 'text-white');
        });
        
        const allItems = this.elements.searchResults.querySelectorAll('.list-group-item');
        if (this.state.selectedResultIndex >= 0 && this.state.selectedResultIndex < allItems.length) {
            const selectedEl = allItems[this.state.selectedResultIndex];
            selectedEl.classList.add('active', 'bg-primary', 'text-white');
            selectedEl.scrollIntoView({ block: 'nearest' });
        }
    }

    selectHighlightedResult() {
        if (this.state.selectedResultIndex < 0) return;
        
        if (this.state.selectedResultIndex >= this.state.searchResults.length) {
            this.promptCreateNewItem();
        } else {
            const item = this.state.searchResults[this.state.selectedResultIndex];
            if (item) {
                this.selectItem(item);
            }
        }
    }

    promptCreateNewItem() {
        const itemName = this.state.lastSearchTerm;
        if (!itemName || itemName.length < 2) {
            alert(this.t('Please enter item name'));
            return;
        }
        
        this.hideSearchResults();
        const self = this;
        
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: this.t('Create new item'),
                text: `${this.t('Do you want to create a new item with name')}: "${itemName}"?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: this.t('Yes, create'),
                cancelButtonText: this.t('Cancel'),
            }).then((result) => {
                if (result.isConfirmed) {
                    self.createNewItem(itemName);
                } else {
                    self.elements.searchInput.focus();
                }
            });
        } else {
            if (confirm(`${this.t('Do you want to create a new item with name')}: "${itemName}"?`)) {
                this.createNewItem(itemName);
            } else {
                this.elements.searchInput.focus();
            }
        }
    }

    async createNewItem(name) {
        const self = this;
        try {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: this.t('Creating item...'),
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
                body: JSON.stringify({
                    name: name,
                    code: name,
                }),
            });
            
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to create item');
            }
            
            const data = await response.json();
            
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: this.t('Success'),
                    text: this.t('Item created successfully'),
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
            
            if (data.item) {
                this.selectItem(data.item);
            }
            
        } catch (error) {
            console.error('Create item error:', error);
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: this.t('Error'),
                    text: error.message || this.t('Failed to create item'),
                    icon: 'error'
                });
            } else {
                alert(error.message || this.t('Failed to create item'));
            }
            this.elements.searchInput.focus();
        }
    }

    showSearchLoading() {
        this.elements.searchResults.innerHTML = `
            <div class="list-group-item text-center py-2">
                <i class="fas fa-spinner fa-spin me-1"></i>${this.t('Searching...')}
            </div>
        `;
        this.positionSearchResults();
        this.elements.searchResults.style.display = 'block';
    }

    showSearchError() {
        this.elements.searchResults.innerHTML = `
            <div class="list-group-item text-danger text-center py-2">
                <i class="fas fa-exclamation-circle me-1"></i>${this.t('Search error')}
            </div>
        `;
        this.positionSearchResults();
        this.elements.searchResults.style.display = 'block';
    }

    hideSearchResults() {
        if (this.elements.searchResults) {
            this.elements.searchResults.style.display = 'none';
            this.elements.searchResults.innerHTML = '';
        }
    }

    // ==================== Item Selection ====================

    selectItem(item) {
        this.state.selectedItem = item;
        
        if (this.elements.searchInput) {
            this.elements.searchInput.value = item.name;
        }
        
        if (this.elements.inputItemCode) {
            this.elements.inputItemCode.value = item.code || '';
        }
        
        this.fillUnitsDropdown(item.units || []);
        
        if (this.elements.inputQty) this.elements.inputQty.value = 1;
        if (this.elements.inputPrice) this.elements.inputPrice.value = item.price || 0;
        if (this.elements.inputDiscPercent) this.elements.inputDiscPercent.value = 0;
        if (this.elements.inputDiscValue) this.elements.inputDiscValue.value = 0;
        if (this.elements.inputVatPercent) this.elements.inputVatPercent.value = item.vat_percentage || this.config.defaultVatPercentage;
        if (this.elements.inputBatchNumber) this.elements.inputBatchNumber.value = '';
        if (this.elements.inputExpiryDate) this.elements.inputExpiryDate.value = '';
        if (this.elements.inputLength) this.elements.inputLength.value = 0;
        if (this.elements.inputWidth) this.elements.inputWidth.value = 0;
        if (this.elements.inputHeight) this.elements.inputHeight.value = 0;
        if (this.elements.inputDensity) this.elements.inputDensity.value = 1;
        
        this.enableInputRow();
        this.calculateInputRowTotal();
        this.hideSearchResults();
        
        setTimeout(() => {
            if (this.elements.inputQty) {
                this.elements.inputQty.focus();
                this.elements.inputQty.select();
            }
        }, 100);
    }

    fillUnitsDropdown(units) {
        if (!this.elements.inputUnit) return;
        
        this.elements.inputUnit.innerHTML = '';
        
        if (!units || units.length === 0) {
            this.elements.inputUnit.innerHTML = '<option value="">--</option>';
            return;
        }

        units.forEach((unit, index) => {
            const option = document.createElement('option');
            option.value = unit.unit_id || unit.id;
            option.textContent = unit.unit_name || unit.name;
            option.dataset.price = unit.price || 0;
            option.dataset.factor = unit.factor || 1;
            if (index === 0) option.selected = true;
            this.elements.inputUnit.appendChild(option);
        });
    }

    enableInputRow() {
        if (this.elements.inputUnit) this.elements.inputUnit.disabled = false;
        if (this.elements.inputQty) this.elements.inputQty.disabled = false;
        if (this.elements.inputPrice) this.elements.inputPrice.disabled = false;
        if (this.elements.inputDiscPercent) this.elements.inputDiscPercent.disabled = false;
        if (this.elements.inputDiscValue) this.elements.inputDiscValue.disabled = false;
        if (this.elements.inputBatchNumber) this.elements.inputBatchNumber.disabled = false;
        if (this.elements.inputExpiryDate) this.elements.inputExpiryDate.disabled = false;
        if (this.elements.inputLength) this.elements.inputLength.disabled = false;
        if (this.elements.inputWidth) this.elements.inputWidth.disabled = false;
        if (this.elements.inputHeight) this.elements.inputHeight.disabled = false;
        if (this.elements.inputDensity) this.elements.inputDensity.disabled = false;
        if (this.elements.addItemBtn) this.elements.addItemBtn.disabled = false;
    }

    resetInputRow() {
        this.state.selectedItem = null;
        this.state.currentDiscPercent = 0;
        this.state.currentDiscValue = 0;
        
        if (this.elements.searchInput) this.elements.searchInput.value = '';
        if (this.elements.inputItemCode) this.elements.inputItemCode.value = '';
        if (this.elements.inputUnit) {
            this.elements.inputUnit.innerHTML = '<option value="">--</option>';
            this.elements.inputUnit.disabled = true;
        }
        if (this.elements.inputQty) {
            this.elements.inputQty.value = 1;
            this.elements.inputQty.disabled = true;
        }
        if (this.elements.inputPrice) {
            this.elements.inputPrice.value = 0;
            this.elements.inputPrice.disabled = true;
        }
        if (this.elements.inputDiscPercent) {
            this.elements.inputDiscPercent.value = 0;
            this.elements.inputDiscPercent.disabled = true;
        }
        if (this.elements.inputDiscValue) {
            this.elements.inputDiscValue.value = 0;
            this.elements.inputDiscValue.disabled = true;
        }
        if (this.elements.inputVatPercent) this.elements.inputVatPercent.value = 0;
        if (this.elements.inputVatValue) this.elements.inputVatValue.value = '0.00';
        if (this.elements.inputTotal) this.elements.inputTotal.value = '0.00';
        if (this.elements.inputBatchNumber) {
            this.elements.inputBatchNumber.value = '';
            this.elements.inputBatchNumber.disabled = true;
        }
        if (this.elements.inputExpiryDate) {
            this.elements.inputExpiryDate.value = '';
            this.elements.inputExpiryDate.disabled = true;
        }
        if (this.elements.inputLength) {
            this.elements.inputLength.value = 0;
            this.elements.inputLength.disabled = true;
        }
        if (this.elements.inputWidth) {
            this.elements.inputWidth.value = 0;
            this.elements.inputWidth.disabled = true;
        }
        if (this.elements.inputHeight) {
            this.elements.inputHeight.value = 0;
            this.elements.inputHeight.disabled = true;
        }
        if (this.elements.inputDensity) {
            this.elements.inputDensity.value = 1;
            this.elements.inputDensity.disabled = true;
        }
        if (this.elements.addItemBtn) this.elements.addItemBtn.disabled = true;
        if (this.elements.searchInput) this.elements.searchInput.focus();
    }

    calculateInputRowTotal() {
        const qty = this.elements.inputQty ? (parseFloat(this.elements.inputQty.value) || 0) : 1;
        const price = this.elements.inputPrice ? (parseFloat(this.elements.inputPrice.value) || 0) : 0;
        const discPercent = this.elements.inputDiscPercent ? (parseFloat(this.elements.inputDiscPercent.value) || 0) : this.state.currentDiscPercent;
        let discValue = this.elements.inputDiscValue ? (parseFloat(this.elements.inputDiscValue.value) || 0) : this.state.currentDiscValue;
        const vatPercent = this.elements.inputVatPercent ? (parseFloat(this.elements.inputVatPercent.value) || 0) : 0;

        const subtotal = qty * price;
        
        if (discPercent > 0) {
            discValue = (subtotal * discPercent) / 100;
            this.state.currentDiscValue = discValue;
            if (this.elements.inputDiscValue) this.elements.inputDiscValue.value = this.formatNumber(discValue);
        }

        const afterDiscount = subtotal - discValue;
        const vatValue = (afterDiscount * vatPercent) / 100;
        if (this.elements.inputVatValue) this.elements.inputVatValue.value = this.formatNumber(vatValue);

        const total = afterDiscount + vatValue;
        if (this.elements.inputTotal) this.elements.inputTotal.value = this.formatNumber(total);
    }

    // ==================== Add Item to Grid ====================

    addItemToInvoice() {
        if (!this.state.selectedItem) return;

        const itemData = {
            item_id: this.state.selectedItem.id,
            name: this.state.selectedItem.name,
            code: this.state.selectedItem.code || '',
            unit_id: this.elements.inputUnit?.value || '',
            unit_name: this.elements.inputUnit?.options[this.elements.inputUnit.selectedIndex]?.text || '',
            qty: this.elements.inputQty ? (parseFloat(this.elements.inputQty.value) || 1) : 1,
            price: this.elements.inputPrice ? (parseFloat(this.elements.inputPrice.value) || 0) : 0,
            disc_percent: this.elements.inputDiscPercent ? (parseFloat(this.elements.inputDiscPercent.value) || 0) : this.state.currentDiscPercent,
            disc_value: this.elements.inputDiscValue ? (parseFloat(this.elements.inputDiscValue.value) || 0) : this.state.currentDiscValue,
            vat_percent: this.elements.inputVatPercent ? (parseFloat(this.elements.inputVatPercent.value) || 0) : 0,
            vat_value: this.elements.inputVatValue ? (parseFloat(this.elements.inputVatValue.value.replace(/,/g, '')) || 0) : 0,
            total: this.elements.inputTotal ? (parseFloat(this.elements.inputTotal.value.replace(/,/g, '')) || 0) : 0,
            units: this.state.selectedItem.units || [],
            batch_number: this.elements.inputBatchNumber?.value || '',
            expiry_date: this.elements.inputExpiryDate?.value || '',
            length: this.elements.inputLength ? (parseFloat(this.elements.inputLength.value) || 0) : 0,
            width: this.elements.inputWidth ? (parseFloat(this.elements.inputWidth.value) || 0) : 0,
            height: this.elements.inputHeight ? (parseFloat(this.elements.inputHeight.value) || 0) : 0,
            density: this.elements.inputDensity ? (parseFloat(this.elements.inputDensity.value) || 1) : 1,
        };

        const existingRow = document.querySelector(`.item-row[data-item-id="${itemData.item_id}"]`);
        if (existingRow) {
            const qtyInput = existingRow.querySelector('.qty-input');
            if (qtyInput) {
                qtyInput.value = parseFloat(qtyInput.value) + itemData.qty;
                this.calculateRowTotal(existingRow);
            }
        } else {
            this.addNewRow(itemData);
        }

        this.state.items.push(itemData);
        this.resetInputRow();
        this.recalculateAllTotals();
    }

    addNewRow(itemData) {
        this.state.rowIndex++;
        
        const template = this.elements.itemRowTemplate.content.cloneNode(true);
        const row = template.querySelector('tr');
        
        row.dataset.itemId = itemData.item_id;
        row.dataset.rowIndex = this.state.rowIndex;
        
        const rowNumber = row.querySelector('.row-number');
        if (rowNumber) rowNumber.textContent = this.state.rowIndex;
        
        const itemName = row.querySelector('.item-name');
        if (itemName) itemName.textContent = itemData.name;
        
        const itemCode = row.querySelector('.item-code');
        if (itemCode) itemCode.textContent = itemData.code;
        
        const unitSelect = row.querySelector('.unit-select');
        if (unitSelect && itemData.units && itemData.units.length > 0) {
            itemData.units.forEach(unit => {
                const option = document.createElement('option');
                option.value = unit.unit_id || unit.id;
                option.textContent = unit.unit_name || unit.name;
                option.dataset.price = unit.price || 0;
                if ((unit.unit_id || unit.id) == itemData.unit_id) option.selected = true;
                unitSelect.appendChild(option);
            });
        }
        
        const qtyInput = row.querySelector('.qty-input');
        if (qtyInput) qtyInput.value = itemData.qty;
        
        const priceInput = row.querySelector('.price-input');
        if (priceInput) priceInput.value = itemData.price;
        
        const discPercentInput = row.querySelector('.disc-percent-input');
        if (discPercentInput) discPercentInput.value = itemData.disc_percent;
        
        const discValueInput = row.querySelector('.disc-value-input');
        if (discValueInput) discValueInput.value = itemData.disc_value;
        
        const vatPercentInput = row.querySelector('.vat-percent-input');
        if (vatPercentInput) vatPercentInput.value = itemData.vat_percent;
        
        const vatValueDisplay = row.querySelector('.vat-value-display');
        if (vatValueDisplay) vatValueDisplay.value = this.formatNumber(itemData.vat_value);
        
        const totalDisplay = row.querySelector('.total-display');
        if (totalDisplay) totalDisplay.value = this.formatNumber(itemData.total);
        
        const batchInput = row.querySelector('.batch-number-input');
        if (batchInput) batchInput.value = itemData.batch_number || '';
        
        const expiryInput = row.querySelector('.expiry-date-input');
        if (expiryInput) expiryInput.value = itemData.expiry_date || '';
        
        const lengthInput = row.querySelector('.length-input');
        if (lengthInput) lengthInput.value = itemData.length || 0;
        
        const widthInput = row.querySelector('.width-input');
        if (widthInput) widthInput.value = itemData.width || 0;
        
        const heightInput = row.querySelector('.height-input');
        if (heightInput) heightInput.value = itemData.height || 0;
        
        const densityInput = row.querySelector('.density-input');
        if (densityInput) densityInput.value = itemData.density || 1;
        
        this.setupRowEventListeners(row);
        this.elements.inputRow.parentNode.insertBefore(row, this.elements.inputRow);
    }

    /**
     * Add existing item from edit data (for edit mode)
     */
    addExistingItem(item) {
        const itemData = {
            item_id: item.item_id || item.id,
            name: item.item_name || item.name || '',
            code: item.item_code || item.code || '',
            unit_id: item.unit_id || '',
            unit_name: item.unit_name || '',
            qty: parseFloat(item.quantity || item.qty || 1),
            price: parseFloat(item.price || 0),
            disc_percent: parseFloat(item.disc_percent || item.discount_percentage || 0),
            disc_value: parseFloat(item.disc_value || item.discount || 0),
            vat_percent: parseFloat(item.vat_percent || item.vat_percentage || 0),
            vat_value: parseFloat(item.vat_value || 0),
            total: parseFloat(item.sub_value || item.total || 0),
            units: item.units || item.available_units || [],
            batch_number: item.batch_number || '',
            expiry_date: item.expiry_date || '',
            length: parseFloat(item.length || 0),
            width: parseFloat(item.width || 0),
            height: parseFloat(item.height || 0),
            density: parseFloat(item.density || 1),
        };

        // Calculate total if not provided
        if (!itemData.total) {
            const subtotal = itemData.qty * itemData.price;
            const afterDisc = subtotal - itemData.disc_value;
            itemData.vat_value = (afterDisc * itemData.vat_percent) / 100;
            itemData.total = afterDisc + itemData.vat_value;
        }

        this.addNewRow(itemData);
        this.state.items.push(itemData);
    }

    /**
     * Save invoice (supports both create and update)
     */
    saveInvoice(isUpdate = false) {
        const itemRows = document.querySelectorAll('.item-row');
        if (itemRows.length === 0) {
            alert(this.t('Please add at least one item'));
            return false;
        }
        
        const formData = this.collectFormData();
        
        if (!formData.acc1_id) {
            alert(this.t('Please select customer/supplier'));
            return false;
        }
        
        if (!formData.acc2_id) {
            alert(this.t('Please select store'));
            return false;
        }
        
        if (isUpdate || this.config.isEditMode) {
            this.updateInvoiceViaApi(formData);
        } else {
            this.saveInvoiceViaApi(formData, false);
        }
    }

    /**
     * Update invoice via API
     */
    async updateInvoiceViaApi(formData) {
        try {
            const url = this.config.updateUrl || `/api/v1/invoices/update/${this.config.operationId}`;
            
            const response = await fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                credentials: 'same-origin',
                body: JSON.stringify(formData),
            });

            const result = await response.json();

            if (result.success) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: this.t('Success'),
                        text: result.message || this.t('Invoice updated successfully'),
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    alert(result.message || this.t('Invoice updated successfully'));
                }
                
                setTimeout(() => {
                    window.location.href = `/invoices?type=${this.config.type}`;
                }, 1500);
                
                return true;
            } else {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: this.t('Error'),
                        text: result.message || this.t('Failed to update invoice'),
                    });
                } else {
                    alert(result.message || this.t('Failed to update invoice'));
                }
                return false;
            }
        } catch (error) {
            console.error('Error updating invoice:', error);
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: this.t('Error'),
                    text: this.t('An error occurred while updating'),
                });
            } else {
                alert(this.t('An error occurred while updating'));
            }
            return false;
        }
    }

    /**
     * Recalculate all totals
     */
    recalculateTotals() {
        this.recalculateAllTotals();
    }

    setupRowEventListeners(row) {
        const self = this;
        const qtyInput = row.querySelector('.qty-input');
        const priceInput = row.querySelector('.price-input');
        
        if (qtyInput) qtyInput.addEventListener('input', () => self.calculateRowTotal(row));
        if (priceInput) priceInput.addEventListener('input', () => self.calculateRowTotal(row));
        
        const discPercentInput = row.querySelector('.disc-percent-input');
        if (discPercentInput) {
            discPercentInput.addEventListener('input', () => {
                const discPercent = parseFloat(discPercentInput.value) || 0;
                const qty = qtyInput ? (parseFloat(qtyInput.value) || 0) : 1;
                const price = priceInput ? (parseFloat(priceInput.value) || 0) : 0;
                const subtotal = qty * price;
                const discValueInput = row.querySelector('.disc-value-input');
                if (discValueInput) discValueInput.value = self.formatNumber((subtotal * discPercent) / 100);
                self.calculateRowTotal(row);
            });
        }
        
        const discValueInput = row.querySelector('.disc-value-input');
        if (discValueInput) discValueInput.addEventListener('input', () => self.calculateRowTotal(row));
        
        const unitSelect = row.querySelector('.unit-select');
        if (unitSelect) {
            unitSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption && selectedOption.dataset.price && priceInput) {
                    priceInput.value = selectedOption.dataset.price;
                    self.calculateRowTotal(row);
                }
            });
        }
        
        const removeBtn = row.querySelector('.remove-item-btn');
        if (removeBtn) removeBtn.addEventListener('click', () => self.removeRow(row));
    }

    calculateRowTotal(row) {
        const qtyInput = row.querySelector('.qty-input');
        const priceInput = row.querySelector('.price-input');
        const discValueInput = row.querySelector('.disc-value-input');
        const vatPercentInput = row.querySelector('.vat-percent-input');
        const vatValueDisplay = row.querySelector('.vat-value-display');
        const totalDisplay = row.querySelector('.total-display');
        
        const qty = qtyInput ? (parseFloat(qtyInput.value) || 0) : 1;
        const price = priceInput ? (parseFloat(priceInput.value) || 0) : 0;
        const discValue = discValueInput ? (parseFloat(discValueInput.value) || 0) : 0;
        const vatPercent = vatPercentInput ? (parseFloat(vatPercentInput.value) || 0) : 0;

        const subtotal = qty * price;
        const afterDiscount = subtotal - discValue;
        const vatValue = (afterDiscount * vatPercent) / 100;
        const total = afterDiscount + vatValue;

        if (vatValueDisplay) vatValueDisplay.value = this.formatNumber(vatValue);
        if (totalDisplay) totalDisplay.value = this.formatNumber(total);

        this.recalculateAllTotals();
    }

    removeRow(row) {
        const itemId = row.dataset.itemId;
        this.state.items = this.state.items.filter(item => item.item_id != itemId);
        row.remove();
        this.renumberRows();
        this.recalculateAllTotals();
    }

    renumberRows() {
        const rows = document.querySelectorAll('.item-row');
        rows.forEach((row, index) => {
            const rowNumber = row.querySelector('.row-number');
            if (rowNumber) rowNumber.textContent = index + 1;
            row.dataset.rowIndex = index + 1;
        });
        this.state.rowIndex = rows.length;
    }

    // ==================== Totals Calculation ====================

    recalculateAllTotals() {
        let totalQty = 0;
        let totalDisc = 0;
        let totalVat = 0;
        let totalAmount = 0;

        const rows = document.querySelectorAll('.item-row');
        rows.forEach(row => {
            const qtyInput = row.querySelector('.qty-input');
            const discValueInput = row.querySelector('.disc-value-input');
            const vatValueDisplay = row.querySelector('.vat-value-display');
            const totalDisplay = row.querySelector('.total-display');
            
            if (qtyInput) totalQty += parseFloat(qtyInput.value) || 0;
            if (discValueInput) totalDisc += parseFloat(discValueInput.value) || 0;
            if (vatValueDisplay) totalVat += parseFloat(vatValueDisplay.value.replace(/,/g, '')) || 0;
            if (totalDisplay) totalAmount += parseFloat(totalDisplay.value.replace(/,/g, '')) || 0;
        });

        if (this.elements.totalQtyFooter) this.elements.totalQtyFooter.textContent = this.formatNumber(totalQty);
        if (this.elements.totalDiscFooter) this.elements.totalDiscFooter.textContent = this.formatNumber(totalDisc);
        if (this.elements.totalVatFooter) this.elements.totalVatFooter.textContent = this.formatNumber(totalVat);
        if (this.elements.totalAmountFooter) this.elements.totalAmountFooter.textContent = this.formatNumber(totalAmount);

        if (this.elements.itemsCountDisplay) this.elements.itemsCountDisplay.textContent = rows.length;
        if (this.elements.totalQtyDisplay) this.elements.totalQtyDisplay.textContent = this.formatNumber(totalQty);
        if (this.elements.footerTotalDisplay) this.elements.footerTotalDisplay.textContent = this.formatNumber(totalAmount);
        if (this.elements.subtotalDisplay) this.elements.subtotalDisplay.value = this.formatNumber(totalAmount);
        if (this.elements.totalDisplay) this.elements.totalDisplay.value = this.formatNumber(totalAmount);
    }

    // ==================== Form Submission ====================

    collectFormData() {
        const acc1Id = document.querySelector('[name="acc1_id"]')?.value || 
                      document.getElementById('acc1_id')?.value || '';
        const acc2Id = document.querySelector('[name="acc2_id"]')?.value || 
                      document.getElementById('acc2_id')?.value || '';
        const empId = document.querySelector('[name="emp_id"]')?.value || 
                     document.getElementById('emp_id')?.value || '';
        const proDate = document.querySelector('[name="pro_date"]')?.value || 
                       document.getElementById('pro_date')?.value || '';
        const accuralDate = document.querySelector('[name="accural_date"]')?.value || 
                           document.getElementById('accural_date')?.value || '';
        const proId = document.querySelector('[name="pro_id"]')?.value || 
                     document.getElementById('pro_id')?.value || '';
        const serialNumber = document.querySelector('[name="serial_number"]')?.value || 
                            document.getElementById('serial_number')?.value || '';
        
        const cashAccountId = document.querySelector('[name="cash_account_id"]')?.value || 
                             document.getElementById('cash-account-select')?.value || '';
        const receivedFromClient = document.querySelector('[name="received_from_client"]')?.value || 
                                  document.getElementById('received-from-client')?.value || 0;
        const notes = document.querySelector('[name="notes"]')?.value || 
                     document.getElementById('notes')?.value || '';
        
        const discountPercentage = document.getElementById('discount-percentage')?.value || 0;
        const discountValue = document.getElementById('discount-value')?.value || 0;
        const additionalPercentage = document.getElementById('additional-percentage')?.value || 0;
        const additionalValue = document.getElementById('additional-value')?.value || 0;
        const vatPercentage = document.getElementById('vat-percentage')?.value || 0;
        const vatValue = document.getElementById('vat-value-display')?.value || 0;
        const withholdingTaxPercentage = document.getElementById('withholding-tax-percentage')?.value || 0;
        const withholdingTaxValue = document.getElementById('withholding-tax-value-display')?.value || 0;
        
        const subtotal = parseFloat(document.getElementById('subtotal-display')?.value?.replace(/,/g, '') || 0);
        const total = parseFloat(document.getElementById('total-display')?.value?.replace(/,/g, '') || 0);
        
        const invoiceItems = [];
        const itemRows = document.querySelectorAll('.item-row');
        itemRows.forEach(row => {
            const itemId = row.dataset.itemId;
            const qtyInput = row.querySelector('.qty-input');
            const priceInput = row.querySelector('.price-input');
            const discValueInput = row.querySelector('.disc-value-input');
            const unitSelect = row.querySelector('.unit-select');
            const totalDisplay = row.querySelector('.total-display');
            
            if (itemId && qtyInput && priceInput) {
                const qty = parseFloat(qtyInput.value) || 0;
                const price = parseFloat(priceInput.value) || 0;
                const discount = discValueInput ? (parseFloat(discValueInput.value) || 0) : 0;
                const subValue = totalDisplay ? 
                    parseFloat(totalDisplay.value?.replace(/,/g, '') || 0) : 
                    (price * qty) - discount;
                
                invoiceItems.push({
                    item_id: parseInt(itemId),
                    unit_id: unitSelect ? parseInt(unitSelect.value) : null,
                    quantity: qty,
                    price: price,
                    discount: discount,
                    sub_value: subValue,
                });
            }
        });
        
        const urlParams = new URLSearchParams(window.location.search);
        const templateId = urlParams.get('template_id') || null;
        
        return {
            type: this.config.type,
            branch_id: this.config.branchId,
            acc1_id: acc1Id,
            acc2_id: acc2Id,
            emp_id: empId || null,
            pro_date: proDate,
            accural_date: accuralDate || proDate,
            pro_id: proId || null,
            serial_number: serialNumber || null,
            invoice_items: invoiceItems,
            subtotal: subtotal,
            discount_percentage: parseFloat(discountPercentage) || 0,
            discount_value: parseFloat(discountValue) || 0,
            additional_percentage: parseFloat(additionalPercentage) || 0,
            additional_value: parseFloat(additionalValue) || 0,
            total_after_additional: total,
            vat_percentage: parseFloat(vatPercentage) || 0,
            vat_value: parseFloat(vatValue) || 0,
            withholding_tax_percentage: parseFloat(withholdingTaxPercentage) || 0,
            withholding_tax_value: parseFloat(withholdingTaxValue) || 0,
            received_from_client: parseFloat(receivedFromClient) || 0,
            notes: notes,
            cash_box_id: cashAccountId || null,
            price_list: this.config.selectedPriceType || 1,
            template_id: templateId,
        };
    }

    async saveInvoiceViaApi(formData, shouldPrint = false) {
        try {
            const response = await fetch('/api/v1/invoices/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                credentials: 'same-origin',
                body: JSON.stringify(formData),
            });

            const result = await response.json();

            if (result.success) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: this.t('Success'),
                        text: result.message || this.t('Invoice saved successfully'),
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    alert(result.message || this.t('Invoice saved successfully'));
                }
                
                setTimeout(() => {
                    if (shouldPrint && result.operation_id) {
                        window.location.href = `/invoices/${result.operation_id}?print=1`;
                    } else {
                        window.location.href = `/invoices?type=${this.config.type}`;
                    }
                }, 1500);
                
                return true;
            } else {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: this.t('Error'),
                        text: result.message || this.t('Failed to save invoice'),
                    });
                } else {
                    alert(result.message || this.t('Failed to save invoice'));
                }
                return false;
            }
        } catch (error) {
            console.error('Error saving invoice:', error);
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: this.t('Error'),
                    text: this.t('An error occurred while saving'),
                });
            } else {
                alert(this.t('An error occurred while saving'));
            }
            return false;
        }
    }

    handleFormSubmit(shouldPrint = false) {
        const itemRows = document.querySelectorAll('.item-row');
        if (itemRows.length === 0) {
            alert(this.t('Please add at least one item'));
            return false;
        }
        
        const formData = this.collectFormData();
        
        if (!formData.acc1_id) {
            alert(this.t('Please select customer/supplier'));
            return false;
        }
        
        if (!formData.acc2_id) {
            alert(this.t('Please select store'));
            return false;
        }
        
        this.saveInvoiceViaApi(formData, shouldPrint);
    }

    // ==================== Event Listeners ====================

    setupEventListeners() {
        const self = this;

        // Add item button
        if (this.elements.addItemBtn) {
            this.elements.addItemBtn.addEventListener('click', () => self.addItemToInvoice());
        }

        // Input row calculations
        if (this.elements.inputQty) {
            this.elements.inputQty.addEventListener('input', () => self.calculateInputRowTotal());
        }
        if (this.elements.inputPrice) {
            this.elements.inputPrice.addEventListener('input', () => self.calculateInputRowTotal());
        }
        if (this.elements.inputDiscPercent) {
            this.elements.inputDiscPercent.addEventListener('input', function() {
                const discPercent = parseFloat(this.value) || 0;
                self.state.currentDiscPercent = discPercent;
                const qty = self.elements.inputQty ? (parseFloat(self.elements.inputQty.value) || 0) : 1;
                const price = self.elements.inputPrice ? (parseFloat(self.elements.inputPrice.value) || 0) : 0;
                const subtotal = qty * price;
                const discValue = (subtotal * discPercent) / 100;
                self.state.currentDiscValue = discValue;
                if (self.elements.inputDiscValue) {
                    self.elements.inputDiscValue.value = self.formatNumber(discValue);
                }
                self.calculateInputRowTotal();
            });
        }
        if (this.elements.inputDiscValue) {
            this.elements.inputDiscValue.addEventListener('input', function() {
                self.state.currentDiscValue = parseFloat(this.value) || 0;
                self.calculateInputRowTotal();
            });
        }

        // Unit change in input row
        if (this.elements.inputUnit) {
            this.elements.inputUnit.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption && selectedOption.dataset.price && self.elements.inputPrice) {
                    self.elements.inputPrice.value = selectedOption.dataset.price;
                    self.calculateInputRowTotal();
                }
            });
        }

        // Enter key to add item
        if (this.elements.inputRow) {
            this.elements.inputRow.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && self.elements.addItemBtn && !self.elements.addItemBtn.disabled) {
                    e.preventDefault();
                    self.addItemToInvoice();
                }
            });
        }

        // Price type change
        const priceTypeSelect = document.getElementById('selectedPriceType');
        if (priceTypeSelect) {
            priceTypeSelect.addEventListener('change', function() {
                self.config.selectedPriceType = this.value;
            });
        }

        // Branch change
        const branchSelect = document.getElementById('branch-select');
        if (branchSelect) {
            branchSelect.addEventListener('change', function() {
                self.config.branchId = this.value;
            });
        }

        // Invoice Pattern change
        const patternSelect = document.getElementById('invoice-pattern-select');
        if (patternSelect) {
            patternSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption) {
                    if (self.state.items.length > 0) {
                        sessionStorage.setItem('invoice_items_backup', JSON.stringify(self.state.items));
                    }
                    
                    const url = new URL(window.location.href);
                    url.searchParams.set('template_id', this.value);
                    window.location.href = url.toString();
                }
            });
        }

        // Form submission
        const invoiceForm = document.getElementById('invoice-form');
        if (invoiceForm) {
            invoiceForm.addEventListener('submit', function(e) {
                e.preventDefault();
                self.handleFormSubmit(false);
            });
        }

        // Save and print button
        const saveAndPrintBtn = document.getElementById('save-and-print-btn');
        if (saveAndPrintBtn) {
            saveAndPrintBtn.addEventListener('click', function(e) {
                e.preventDefault();
                self.handleFormSubmit(true);
            });
        }
    }

    // ==================== Utility Functions ====================

    formatNumber(num) {
        return parseFloat(num || 0).toFixed(2);
    }
}

// Export for use
window.InvoiceCreateManager = InvoiceCreateManager;
