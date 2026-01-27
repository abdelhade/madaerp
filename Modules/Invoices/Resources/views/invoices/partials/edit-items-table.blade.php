{{-- Invoice Items Data Grid for Edit --}}
@php
    $type = $invoice->pro_type;
    $operationItems = $editData['operation_items'] ?? [];
    
    // Get template configuration (same as create)
    $template = $editData['selected_template'] ?? null;
    $visibleColumns = $template['visible_columns'] ?? ['item_name', 'unit', 'quantity', 'price', 'discount', 'sub_value'];
    $columnWidths = $template['column_widths'] ?? [];
    $columnOrder = $template['column_order'] ?? $visibleColumns;
    
    // Column definitions with defaults
    $allColumns = [
        'item_name' => ['label' => __('Item Name'), 'default_width' => 20, 'type' => 'search'],
        'item_code' => ['label' => __('Code'), 'default_width' => 8, 'type' => 'text'],
        'unit' => ['label' => __('Unit'), 'default_width' => 8, 'type' => 'select'],
        'quantity' => ['label' => __('Qty'), 'default_width' => 8, 'type' => 'number'],
        'batch_number' => ['label' => __('Batch'), 'default_width' => 10, 'type' => 'text'],
        'expiry_date' => ['label' => __('Expiry'), 'default_width' => 10, 'type' => 'date'],
        'length' => ['label' => __('L'), 'default_width' => 6, 'type' => 'number'],
        'width' => ['label' => __('W'), 'default_width' => 6, 'type' => 'number'],
        'height' => ['label' => __('H'), 'default_width' => 6, 'type' => 'number'],
        'density' => ['label' => __('D'), 'default_width' => 6, 'type' => 'number'],
        'price' => ['label' => __('Price'), 'default_width' => 10, 'type' => 'number'],
        'disc_percent' => ['label' => __('Disc') . ' %', 'default_width' => 7, 'type' => 'number'],
        'discount' => ['label' => __('Disc') . ' $', 'default_width' => 8, 'type' => 'number'],
        'vat_percent' => ['label' => __('VAT') . ' %', 'default_width' => 7, 'type' => 'readonly'],
        'vat_value' => ['label' => __('VAT') . ' $', 'default_width' => 8, 'type' => 'readonly'],
        'sub_value' => ['label' => __('Total'), 'default_width' => 10, 'type' => 'readonly'],
    ];
    
    // Get width for a column
    $getWidth = function($col) use ($columnWidths, $allColumns) {
        return $columnWidths[$col] ?? $allColumns[$col]['default_width'] ?? 10;
    };
    
    // Check if column is visible
    $isVisible = function($col) use ($visibleColumns) {
        return in_array($col, $visibleColumns);
    };
@endphp

<style>
    #invoice-items-table {
        border-collapse: collapse !important;
    }
    #invoice-items-table th,
    #invoice-items-table td {
        padding: 1px 2px !important;
        margin: 0 !important;
        font-size: 0.75rem !important;
        vertical-align: middle !important;
        height: auto !important;
        min-height: 24px !important;
        line-height: 1.2 !important;
    }
    #invoice-items-table input,
    #invoice-items-table select {
        height: 24px !important;
        min-height: 24px !important;
        font-size: 0.75rem !important;
        padding: 1px 3px !important;
        margin: 0 !important;
        line-height: 1.2 !important;
        border-radius: 0 !important;
    }
    #invoice-items-table .btn-sm {
        width: 22px !important;
        height: 22px !important;
        min-height: 22px !important;
        padding: 0 !important;
        font-size: 0.65rem !important;
        line-height: 1 !important;
        border-radius: 0 !important;
    }
    #invoice-items-table tbody tr {
        height: auto !important;
        min-height: 24px !important;
    }
    /* Limit table body height to 8 rows with scroll */
    #invoice-items-table tbody {
        display: block;
        max-height: calc(8 * 24px + 2px); /* 8 rows * 24px per row + border */
        overflow-y: auto;
        overflow-x: hidden;
    }
    #invoice-items-table thead,
    #invoice-items-table tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }
    #invoice-items-table thead {
        width: calc(100% - 1em); /* Adjust for scrollbar */
    }
</style>
<div class="card border border-secondary border-top-0 border-3" style="border-radius: 0;">
    <div class="card-body p-0" style="overflow-x: auto; overflow-y: hidden;">
        <table class="table table-bordered table-hover mb-0" id="invoice-items-table" style="width: auto !important; font-size: 0.75rem;">
            {{-- Header Row --}}
            <thead class="table-light sticky-top">
                <tr>
                    <th class="text-center" style="width: 10px;">#</th>
                    @foreach($columnOrder as $col)
                        @if($isVisible($col) && isset($allColumns[$col]))
                            <th class="text-center" style="width: {{ $getWidth($col) }}px !important;" data-column="{{ $col }}">
                                {{ $allColumns[$col]['label'] }}
                            </th>
                        @endif
                    @endforeach
                    <th class="text-center" style="width: 25px;"><i class="fas fa-cog" style="font-size: 0.65rem;"></i></th>
                </tr>
            </thead>
            
            <tbody id="invoice-items-tbody">
                {{-- Input Row (للإدخال والبحث) --}}
                <tr class="table-warning input-row" id="input-row">
                    <td class="text-center align-middle">
                        <i class="fas fa-plus-circle text-success" style="font-size: 0.8rem;"></i>
                    </td>
                    
                    @foreach($columnOrder as $col)
                        @if($isVisible($col) && isset($allColumns[$col]))
                            @php $colDef = $allColumns[$col]; @endphp
                            <td data-column="{{ $col }}">
                                @switch($col)
                                    @case('item_name')
                                        @include('invoices::components.item-search-input', [
                                            'id' => 'item-search-input',
                                            'inputClass' => 'border-0',
                                            'placeholder' => __('Search...'),
                                            'invoiceType' => $type,
                                            'branchId' => $editData['branch_id'] ?? null,
                                            'priceType' => 1,
                                            'onSelect' => 'onItemSelected',
                                            'onCreate' => 'onItemCreated',
                                            'showCreateOption' => true,
                                            'focusNextSelector' => '#input-qty',
                                        ])
                                        @break
                                    @case('item_code')
                                        <input type="text" class="form-control form-control-sm text-center bg-light border-0" id="input-item-code" readonly>
                                        @break
                                    @case('unit')
                                        <select class="form-select form-select-sm border-0" id="input-unit" disabled>
                                            <option value="">--</option>
                                        </select>
                                        @break
                                    @case('quantity')
                                        <input type="number" class="form-control form-control-sm text-center border-0" id="input-qty" 
                                               value="1" min="0.01" step="0.01" disabled>
                                        @break
                                    @case('batch_number')
                                        <input type="text" class="form-control form-control-sm text-center border-0" id="input-batch-number" disabled>
                                        @break
                                    @case('expiry_date')
                                        <input type="date" class="form-control form-control-sm text-center border-0" id="input-expiry-date" disabled>
                                        @break
                                    @case('length')
                                        <input type="number" class="form-control form-control-sm text-center border-0" id="input-length" 
                                               value="0" min="0" step="0.01" disabled>
                                        @break
                                    @case('width')
                                        <input type="number" class="form-control form-control-sm text-center border-0" id="input-width" 
                                               value="0" min="0" step="0.01" disabled>
                                        @break
                                    @case('height')
                                        <input type="number" class="form-control form-control-sm text-center border-0" id="input-height" 
                                               value="0" min="0" step="0.01" disabled>
                                        @break
                                    @case('density')
                                        <input type="number" class="form-control form-control-sm text-center border-0" id="input-density" 
                                               value="1" min="0.01" step="0.01" disabled>
                                        @break
                                    @case('price')
                                        <input type="number" class="form-control form-control-sm text-end border-0" id="input-price" 
                                               value="0" min="0" step="0.01" disabled>
                                        @break
                                    @case('disc_percent')
                                        <input type="number" class="form-control form-control-sm text-center border-0" id="input-disc-percent" 
                                               value="0" min="0" max="100" step="0.01" disabled>
                                        @break
                                    @case('discount')
                                        <input type="number" class="form-control form-control-sm text-end border-0" id="input-disc-value" 
                                               value="0" min="0" step="0.01" disabled>
                                        @break
                                    @case('vat_percent')
                                        <input type="number" class="form-control form-control-sm text-center bg-light border-0" id="input-vat-percent" 
                                               value="0" min="0" max="100" step="0.01" readonly>
                                        @break
                                    @case('vat_value')
                                        <input type="text" class="form-control form-control-sm text-end bg-light border-0" id="input-vat-value" 
                                               value="0.00" readonly>
                                        @break
                                    @case('sub_value')
                                        <input type="text" class="form-control form-control-sm text-end bg-light fw-bold border-0" id="input-total" 
                                               value="0.00" readonly>
                                        @break
                                @endswitch
                            </td>
                        @endif
                    @endforeach
                    
                    <td class="text-center align-middle">
                        <button type="button" class="btn btn-success btn-sm" id="add-item-btn" disabled title="{{ __('Add Item') }}">
                            <i class="fas fa-check"></i>
                        </button>
                    </td>
                </tr>
                
                {{-- Existing items will be loaded via JavaScript --}}
            </tbody>
            
            {{-- Footer Row (الإجمالي) --}}
            <tfoot class="table-secondary">
                <tr>
                    <td class="text-end fw-bold">{{ __('Total') }}:</td>
                    @foreach($columnOrder as $col)
                        @if($isVisible($col) && isset($allColumns[$col]))
                            <td data-column="{{ $col }}">
                                @switch($col)
                                    @case('item_name')
                                    @case('item_code')
                                    @case('unit')
                                    @case('batch_number')
                                    @case('expiry_date')
                                    @case('length')
                                    @case('width')
                                    @case('height')
                                    @case('density')
                                    @case('disc_percent')
                                    @case('vat_percent')
                                        {{-- Empty cell --}}
                                        @break
                                    @case('quantity')
                                        <span class="d-block text-center fw-bold" id="total-qty-footer">0</span>
                                        @break
                                    @case('price')
                                        {{-- Empty cell --}}
                                        @break
                                    @case('discount')
                                        <span class="d-block text-end fw-bold" id="total-disc-footer">0.00</span>
                                        @break
                                    @case('vat_value')
                                        <span class="d-block text-end fw-bold" id="total-vat-footer">0.00</span>
                                        @break
                                    @case('sub_value')
                                        <span class="d-block text-end fw-bold text-primary" id="total-amount-footer">0.00</span>
                                        @break
                                @endswitch
                            </td>
                        @endif
                    @endforeach
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

{{-- Template Configuration for JavaScript --}}
<script>
    window.invoiceTemplateConfig = {
        visibleColumns: @json($visibleColumns),
        columnWidths: @json($columnWidths),
        columnOrder: @json($columnOrder),
        allColumns: @json($allColumns),
    };
</script>

{{-- Template for Data Row (سيُستخدم بواسطة JavaScript) --}}
<template id="item-row-template">
    <tr class="item-row" data-item-id="" data-row-index="">
        <td class="text-center align-middle row-number"></td>
        
        @foreach($columnOrder as $col)
            @if($isVisible($col) && isset($allColumns[$col]))
                @php $colDef = $allColumns[$col]; @endphp
                <td data-column="{{ $col }}">
                    @switch($col)
                        @case('item_name')
                            <span class="d-block item-name"></span>
                            @break
                        @case('item_code')
                            <span class="d-block text-center item-code"></span>
                            @break
                        @case('unit')
                            <select class="form-select form-select-sm border-0 unit-select"></select>
                            @break
                        @case('quantity')
                            <input type="number" class="form-control form-control-sm text-center border-0 qty-input" 
                                   value="1" min="0.01" step="0.01">
                            @break
                        @case('batch_number')
                            <input type="text" class="form-control form-control-sm text-center border-0 batch-number-input">
                            @break
                        @case('expiry_date')
                            <input type="date" class="form-control form-control-sm text-center border-0 expiry-date-input">
                            @break
                        @case('length')
                            <input type="number" class="form-control form-control-sm text-center border-0 length-input" 
                                   value="0" min="0" step="0.01">
                            @break
                        @case('width')
                            <input type="number" class="form-control form-control-sm text-center border-0 width-input" 
                                   value="0" min="0" step="0.01">
                            @break
                        @case('height')
                            <input type="number" class="form-control form-control-sm text-center border-0 height-input" 
                                   value="0" min="0" step="0.01">
                            @break
                        @case('density')
                            <input type="number" class="form-control form-control-sm text-center border-0 density-input" 
                                   value="1" min="0.01" step="0.01">
                            @break
                        @case('price')
                            <input type="number" class="form-control form-control-sm text-end border-0 price-input" 
                                   value="0" min="0" step="0.01">
                            @break
                        @case('disc_percent')
                            <input type="number" class="form-control form-control-sm text-center border-0 disc-percent-input" 
                                   value="0" min="0" max="100" step="0.01">
                            @break
                        @case('discount')
                            <input type="number" class="form-control form-control-sm text-end border-0 disc-value-input" 
                                   value="0" min="0" step="0.01">
                            @break
                        @case('vat_percent')
                            <input type="number" class="form-control form-control-sm text-center bg-light border-0 vat-percent-input" 
                                   value="0" readonly>
                            @break
                        @case('vat_value')
                            <input type="text" class="form-control form-control-sm text-end bg-light border-0 vat-value-display" 
                                   value="0.00" readonly>
                            @break
                        @case('sub_value')
                            <input type="text" class="form-control form-control-sm text-end bg-light fw-bold border-0 total-display" 
                                   value="0.00" readonly>
                            @break
                    @endswitch
                </td>
            @endif
        @endforeach
        
        <td class="text-center align-middle">
            <button type="button" class="btn btn-danger btn-sm remove-item-btn" title="{{ __('Remove') }}">
                <i class="fas fa-times"></i>
            </button>
        </td>
    </tr>
</template>
