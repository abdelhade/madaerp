/**
 * Invoice Form Manager (JavaScript)
 * 
 * Manages invoice form data and interactions using JavaScript only
 * 
 * Usage:
 * - Initialize: InvoiceFormManager.init('create', { type: 10 })
 * - Initialize Edit: InvoiceFormManager.init('edit', { operationId: 123 })
 */

class InvoiceFormManager {
    constructor() {
        this.mode = null; // 'create' or 'edit'
        this.type = null;
        this.operationId = null;
        this.formData = {
            type: null,
            acc1_id: null,
            acc2_id: null,
            emp_id: null,
            pro_date: null,
            accural_date: null,
            pro_id: null,
            serial_number: null,
            invoice_items: [],
            subtotal: 0,
            discount_percentage: 0,
            discount_value: 0,
            additional_percentage: 0,
            additional_value: 0,
            total_after_additional: 0,
            vat_percentage: 0,
            vat_value: 0,
            withholding_tax_percentage: 0,
            withholding_tax_value: 0,
            received_from_client: 0,
            notes: '',
            currency_id: null,
            currency_rate: 1,
        };
        this.availableTemplates = [];
        this.selectedTemplateId = null;
        this.acc1List = [];
        this.acc2List = [];
        this.employees = [];
        this.priceTypes = [];
        this.settings = {};
        this.branches = [];
        this.currencies = [];
        this.defaultCurrencyId = null;
    }

    /**
     * Initialize form manager
     */
    async init(mode, options = {}) {
        this.mode = mode;

        try {
            if (mode === 'create') {
                await this.loadCreateData(options.type, options.branch_id);
            } else if (mode === 'edit') {
                await this.loadEditData(options.operationId);
            } else {
                throw new Error('Invalid mode. Use "create" or "edit"');
            }

            this.setupEventListeners();
            return true;
        } catch (error) {
            console.error('Error initializing InvoiceFormManager:', error);
            this.showError('فشل تحميل البيانات');
            return false;
        }
    }

    /**
     * Load initial data for create form
     */
    async loadCreateData(type, branchId = null) {
        try {
            const params = new URLSearchParams({ type });
            if (branchId) params.append('branch_id', branchId);

            const response = await fetch(`/api/v1/invoices/create-data?${params}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                credentials: 'same-origin',
            });

            if (!response.ok) {
                throw new Error('Failed to load create data');
            }

            const data = await response.json();
            this.type = data.type;
            this.formData.type = data.type;
            this.formData.branch_id = data.branch_id;
            this.availableTemplates = data.available_templates || [];
            this.selectedTemplateId = data.selected_template_id;
            this.acc1List = data.acc1_list || [];
            this.acc2List = data.acc2_list || [];
            this.employees = data.employees || [];
            this.priceTypes = data.price_types || [];
            this.settings = data.settings || {};

            // Set default dates
            this.formData.pro_date = new Date().toISOString().split('T')[0];
            this.formData.accural_date = new Date().toISOString().split('T')[0];
            this.formData.pro_id = data.next_pro_id;

            return data;
        } catch (error) {
            console.error('Error loading create data:', error);
            throw error;
        }
    }

    /**
     * Load initial data for edit form
     */
    async loadEditData(operationId) {
        try {
            const response = await fetch(`/api/v1/invoices/edit-data/${operationId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                credentials: 'same-origin',
            });

            if (!response.ok) {
                throw new Error('Failed to load edit data');
            }

            const data = await response.json();
            this.operationId = operationId;
            this.type = data.type;
            this.formData = {
                ...this.formData,
                type: data.type,
                branch_id: data.branch_id,
                acc1_id: data.acc1_id,
                acc2_id: data.acc2_id,
                emp_id: data.emp_id,
                pro_date: data.pro_date,
                accural_date: data.accural_date,
                pro_id: data.pro_id,
                serial_number: data.serial_number,
                invoice_items: data.invoice_items || [],
                subtotal: data.subtotal || 0,
                discount_percentage: data.discount_percentage || 0,
                discount_value: data.discount_value || 0,
                additional_percentage: data.additional_percentage || 0,
                additional_value: data.additional_value || 0,
                total_after_additional: data.total_after_additional || 0,
                vat_percentage: data.vat_percentage || 0,
                vat_value: data.vat_value || 0,
                withholding_tax_percentage: data.withholding_tax_percentage || 0,
                withholding_tax_value: data.withholding_tax_value || 0,
                received_from_client: data.received_from_client || 0,
                notes: data.notes || '',
                currency_id: data.currency_id,
                currency_rate: data.currency_rate || 1,
                currentBalance: data.current_balance || 0,
            };
            this.availableTemplates = data.available_templates || [];
            this.selectedTemplateId = data.selected_template_id;
            this.acc1List = data.acc1_list || [];
            this.acc2List = data.acc2_list || [];
            this.employees = data.employees || [];
            this.priceTypes = data.price_types || [];
            this.settings = data.settings || {};
            this.branches = data.branches || [];
            this.currencies = data.currencies || [];
            this.defaultCurrencyId = data.default_currency_id;

            return data;
        } catch (error) {
            console.error('Error loading edit data:', error);
            throw error;
        }
    }

    /**
     * Search items
     */
    async searchItems(term) {
        try {
            const params = new URLSearchParams({
                term: term.trim(),
                type: this.type,
                branch_id: this.formData.branch_id || '',
                selected_price_type: this.formData.selected_price_type || 1,
            });

            const response = await fetch(`/api/v1/invoices/search-items?${params}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                credentials: 'same-origin',
            });

            if (!response.ok) {
                throw new Error('Failed to search items');
            }

            const data = await response.json();
            return data.items || [];
        } catch (error) {
            console.error('Error searching items:', error);
            return [];
        }
    }

    /**
     * Get item for invoice
     */
    async getItemForInvoice(itemId) {
        try {
            const formData = new FormData();
            formData.append('item_id', itemId);
            formData.append('type', this.type);
            formData.append('selected_price_type', this.formData.selected_price_type || 1);
            formData.append('acc2_id', this.formData.acc2_id || '');

            const response = await fetch('/api/v1/invoices/get-item', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                credentials: 'same-origin',
                body: formData,
            });

            if (!response.ok) {
                const error = await response.json();
                throw new Error(error.error || 'Failed to get item');
            }

            return await response.json();
        } catch (error) {
            console.error('Error getting item:', error);
            throw error;
        }
    }

    /**
     * Add item to invoice
     * @param {object} itemData - Item object (JS only, no AJAX)
     */
    addItem(itemData) {
        try {
            // Only accept item object (no AJAX, no itemId)
            if (typeof itemData !== 'object' || itemData === null) {
                return { success: false, error: 'Item data must be an object' };
            }

            // Check if item already exists
            const existingIndex = this.formData.invoice_items.findIndex(
                item => item.item_id === itemData.item_id
            );

            if (existingIndex !== -1) {
                // Increment quantity
                this.formData.invoice_items[existingIndex].quantity += 1;
                // Recalculate item total
                const item = this.formData.invoice_items[existingIndex];
                const quantity = parseFloat(item.quantity || 0);
                const price = parseFloat(item.price || 0);
                const discount = parseFloat(item.discount || 0);
                item.sub_value = (quantity * price) - discount;
            } else {
                // Add new item - prepare item data structure
                const newItem = {
                    item_id: itemData.id || itemData.item_id,
                    unit_id: itemData.unit_id,
                    name: itemData.name,
                    code: itemData.code || '',
                    quantity: 1,
                    price: parseFloat(itemData.price || 0),
                    discount: 0,
                    sub_value: parseFloat(itemData.price || 0),
                    available_units: itemData.units || itemData.available_units || [],
                };
                this.formData.invoice_items.push(newItem);
            }

            this.recalculateTotals();
            return { success: true, item: itemData };
        } catch (error) {
            console.error('Error adding item:', error);
            return { success: false, error: error.message };
        }
    }

    /**
     * Remove item from invoice
     */
    removeItem(index) {
        if (index >= 0 && index < this.formData.invoice_items.length) {
            this.formData.invoice_items.splice(index, 1);
            this.recalculateTotals();
            return true;
        }
        return false;
    }

    /**
     * Recalculate totals
     */
    recalculateTotals() {
        // Calculate subtotal
        this.formData.subtotal = this.formData.invoice_items.reduce((sum, item) => {
            const quantity = parseFloat(item.quantity) || 0;
            const price = parseFloat(item.price) || 0;
            const discount = parseFloat(item.discount) || 0;
            const subValue = (quantity * price) - discount;
            item.sub_value = Math.max(0, subValue);
            return sum + item.sub_value;
        }, 0);

        // Calculate discount
        if (this.formData.discount_percentage > 0) {
            this.formData.discount_value = (this.formData.subtotal * this.formData.discount_percentage) / 100;
        }

        // Calculate additional
        if (this.formData.additional_percentage > 0) {
            this.formData.additional_value = (this.formData.subtotal * this.formData.additional_percentage) / 100;
        }

        // Calculate VAT
        const baseForTax = this.formData.subtotal - this.formData.discount_value + this.formData.additional_value;
        if (this.formData.vat_percentage > 0) {
            this.formData.vat_value = (baseForTax * this.formData.vat_percentage) / 100;
        }

        // Calculate withholding tax
        if (this.formData.withholding_tax_percentage > 0) {
            this.formData.withholding_tax_value = (baseForTax * this.formData.withholding_tax_percentage) / 100;
        }

        // Calculate total
        this.formData.total_after_additional = 
            this.formData.subtotal 
            - this.formData.discount_value 
            + this.formData.additional_value 
            + this.formData.vat_value 
            - this.formData.withholding_tax_value;

        // Round to 2 decimal places
        this.formData.total_after_additional = Math.round(this.formData.total_after_additional * 100) / 100;
    }

    /**
     * Save invoice
     */
    async save() {
        try {
            this.recalculateTotals();

            // Validate
            if (!this.validate()) {
                return false;
            }

            const url = this.mode === 'create' 
                ? '/api/v1/invoices/store'
                : `/api/v1/invoices/update/${this.operationId}`;

            const method = this.mode === 'create' ? 'POST' : 'PUT';

            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                credentials: 'same-origin',
                body: JSON.stringify(this.formData),
            });

            const result = await response.json();

            if (result.success) {
                this.showSuccess(result.message || 'تم الحفظ بنجاح');
                
                // Redirect or handle success
                if (this.mode === 'create') {
                    setTimeout(() => {
                        window.location.href = `/invoices?type=${this.type}`;
                    }, 1000);
                } else {
                    setTimeout(() => {
                        window.location.href = `/invoices/${result.operation_id}`;
                    }, 1000);
                }
                
                return true;
            } else {
                this.showError(result.message || 'فشل الحفظ');
                return false;
            }
        } catch (error) {
            console.error('Error saving invoice:', error);
            this.showError('حدث خطأ أثناء الحفظ');
            return false;
        }
    }

    /**
     * Validate form data
     */
    validate() {
        if (!this.formData.acc1_id) {
            this.showError('يرجى اختيار العميل/المورد');
            return false;
        }

        if (!this.formData.acc2_id) {
            this.showError('يرجى اختيار المخزن');
            return false;
        }

        if (!this.formData.pro_date) {
            this.showError('يرجى اختيار تاريخ الفاتورة');
            return false;
        }

        if (this.formData.invoice_items.length === 0) {
            this.showError('يرجى إضافة صنف واحد على الأقل');
            return false;
        }

        for (let i = 0; i < this.formData.invoice_items.length; i++) {
            const item = this.formData.invoice_items[i];
            if (parseFloat(item.quantity) <= 0) {
                this.showError(`الكمية في الصف ${i + 1} يجب أن تكون أكبر من صفر`);
                return false;
            }
            if (parseFloat(item.price) < 0) {
                this.showError(`السعر في الصف ${i + 1} لا يمكن أن يكون سالباً`);
                return false;
            }
        }

        return true;
    }

    /**
     * Setup event listeners
     */
    setupEventListeners() {
        // This will be called after DOM is ready
        // Add event listeners for form fields
        document.addEventListener('DOMContentLoaded', () => {
            // Add listeners here
        });
    }

    /**
     * Show success message
     */
    showSuccess(message) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'success',
                title: 'نجح!',
                text: message,
                timer: 2000,
                showConfirmButton: false,
            });
        } else {
            alert(message);
        }
    }

    /**
     * Show error message
     */
    showError(message) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'خطأ!',
                text: message,
            });
        } else {
            alert(message);
        }
    }

    /**
     * Get account balance
     */
    async getAccountBalance(accountId) {
        try {
            const response = await fetch(`/api/v1/invoices/account-balance/${accountId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                credentials: 'same-origin',
            });

            if (!response.ok) {
                return 0;
            }

            const data = await response.json();
            return data.balance || 0;
        } catch (error) {
            console.error('Error getting account balance:', error);
            return 0;
        }
    }

    /**
     * Get account currency
     */
    async getAccountCurrency(accountId) {
        try {
            const response = await fetch(`/api/v1/invoices/account-currency/${accountId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                credentials: 'same-origin',
            });

            if (!response.ok) {
                return { currency_id: null, currency_rate: 1 };
            }

            const data = await response.json();
            return {
                currency_id: data.currency_id || null,
                currency_rate: data.currency_rate || 1,
            };
        } catch (error) {
            console.error('Error getting account currency:', error);
            return { currency_id: null, currency_rate: 1 };
        }
    }
}

// Create global instance
window.InvoiceFormManager = new InvoiceFormManager();

// Export for ES6 modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = InvoiceFormManager;
}
