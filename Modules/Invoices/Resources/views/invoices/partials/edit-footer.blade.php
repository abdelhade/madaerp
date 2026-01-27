@php
    $type = $invoice->pro_type;
    $subtotal = $editData['subtotal'] ?? 0;
    $discountValue = $editData['discount_value'] ?? 0;
    $discountPercentage = $editData['discount_percentage'] ?? 0;
    $additionalValue = $editData['additional_value'] ?? 0;
    $additionalPercentage = $editData['additional_percentage'] ?? 0;
    $vatValue = $editData['vat_value'] ?? 0;
    $vatPercentage = $editData['vat_percentage'] ?? 0;
    $withholdingTaxValue = $editData['withholding_tax_value'] ?? 0;
    $withholdingTaxPercentage = $editData['withholding_tax_percentage'] ?? 0;
    $total = $editData['total_after_additional'] ?? 0;
    $receivedFromClient = $editData['received_from_client'] ?? 0;
    $remaining = $total - $receivedFromClient;
    
    $isPurchaseInvoice = in_array($type, [11, 13, 15, 17, 24, 25]);
    $receivedLabel = $isPurchaseInvoice ? __('Amount Paid to Supplier') : __('Amount Received from Customer');
    $remainingLabel = $isPurchaseInvoice ? __('Remaining to Supplier') : __('Remaining from Customer');
@endphp

<div class="card border border-secondary border-top-0 border-3">
    <div class="card-body py-2 px-3">
        <div class="row g-2">
            {{-- المربع الرابع: فارغ / زر الحفظ --}}
            <div class="col-md-3 border rounded p-2 d-flex flex-column" style="background-color: #f8f9fa;">
                <div class="flex-grow-1"></div>
                <div class="mt-auto">
                    <button type="submit" class="btn btn-primary w-100 py-2" id="save-invoice-btn" style="font-size: 0.9rem;">
                        <i class="fas fa-save me-1"></i>
                        {{ __('Update Invoice') }}
                    </button>
                </div>
            </div>
            
            {{-- المربع الثالث: بيانات الصنف --}}
            <div class="col-md-3 border rounded p-2" style="background-color: #d1ecf1;">
                <h6 class="mb-2 text-center fw-bold" style="font-size: 0.85rem; border-bottom: 1px solid #dee2e6; padding-bottom: 0.25rem;">
                    <i class="fas fa-box me-1"></i>{{ __('Item Details') }}
                </h6>
                <div id="item-details-content" class="text-center text-muted" style="font-size: 0.75rem; padding-top: 1rem;">
                    {{ __('Select an item to view details') }}
                </div>
            </div>
            
            {{-- المربع الثاني: الصندوق والدفع --}}
            <div class="col-md-3 border rounded p-2" style="background-color: #fff3cd;">
                <h6 class="mb-2 text-center fw-bold" style="font-size: 0.85rem; border-bottom: 1px solid #dee2e6; padding-bottom: 0.25rem;">
                    <i class="fas fa-money-bill-wave me-1"></i>{{ __('Cash & Payment') }}
                </h6>
                @if($type != 21)
                    <div class="mb-2">
                        <label class="form-label small fw-bold mb-0" style="font-size: 0.7rem;">{{ $receivedLabel }}</label>
                        <input type="number" class="form-control form-control-sm text-end py-1" 
                               id="received-from-client" name="received_from_client" value="{{ number_format($receivedFromClient, 2) }}" 
                               step="0.01" min="0" style="font-size: 0.85rem;">
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold mb-0" style="font-size: 0.7rem;">{{ $remainingLabel }}</label>
                        <input type="text" class="form-control form-control-sm text-end fw-bold py-1 {{ $remaining > 0.01 ? 'text-danger' : ($remaining < -0.01 ? 'text-success' : '') }}" 
                               value="{{ number_format($remaining, 2) }}" readonly id="remaining-display" style="background-color: #fff; font-size: 0.9rem;">
                    </div>
                @else
                    <div class="text-center text-muted" style="font-size: 0.75rem; padding-top: 1rem;">
                        {{ __('Not applicable for transfers') }}
                    </div>
                @endif
                <div class="mt-2">
                    <label class="form-label small fw-bold mb-0" style="font-size: 0.7rem;">{{ __('Notes') }}</label>
                    <textarea class="form-control form-control-sm py-1" id="notes" name="notes" rows="2" placeholder="{{ __('Additional notes...') }}" style="font-size: 0.75rem; resize: vertical;">{{ $invoice->notes ?? ($editData['notes'] ?? '') }}</textarea>
                </div>
            </div>
            
            {{-- المربع الأول: الإجمالي والصافي --}}
            <div class="col-md-3 border rounded p-2" style="background-color: #f8f9fa;">
                <h6 class="mb-2 text-center fw-bold" style="font-size: 0.85rem; border-bottom: 1px solid #dee2e6; padding-bottom: 0.25rem;">
                    <i class="fas fa-calculator me-1"></i>{{ __('Total & Net') }}
                </h6>
                <div class="mb-1">
                    <label class="form-label small mb-0" style="font-size: 0.7rem;">{{ __('Subtotal') }}</label>
                    <input type="text" class="form-control form-control-sm text-end fw-bold bg-light py-1" 
                           value="{{ number_format($subtotal, 2) }}" readonly id="subtotal-display" style="font-size: 0.8rem;">
                </div>
                <div class="mb-1">
                    <label class="form-label small mb-0 fw-bold" style="font-size: 0.75rem;">{{ __('Net') }}</label>
                    <input type="text" class="form-control form-control-sm text-end fw-bold border-primary py-1" 
                           value="{{ number_format($total, 2) }}" readonly id="total-display" style="font-size: 0.95rem; background-color: #e3f2fd;">
                </div>
                <div class="row g-1 mt-1">
                    <div class="col-6">
                        <label class="form-label small mb-0" style="font-size: 0.65rem;">{{ __('Discount') }} (%)</label>
                        <input type="number" class="form-control form-control-sm text-end py-1" 
                               id="discount-percentage" name="discount_percentage" value="{{ number_format($discountPercentage, 2) }}" 
                               step="0.01" min="0" max="100" style="font-size: 0.75rem;">
                    </div>
                    <div class="col-6">
                        <label class="form-label small mb-0" style="font-size: 0.65rem;">{{ __('Discount') }} ({{ __('Value') }})</label>
                        <input type="number" class="form-control form-control-sm text-end py-1" 
                               id="discount-value" name="discount_value" value="{{ number_format($discountValue, 2) }}" 
                               step="0.01" min="0" style="font-size: 0.75rem;">
                    </div>
                    <div class="col-6">
                        <label class="form-label small mb-0" style="font-size: 0.65rem;">{{ __('Additional') }} (%)</label>
                        <input type="number" class="form-control form-control-sm text-end py-1" 
                               id="additional-percentage" name="additional_percentage" value="{{ number_format($additionalPercentage, 2) }}" 
                               step="0.01" min="0" max="100" style="font-size: 0.75rem;">
                    </div>
                    <div class="col-6">
                        <label class="form-label small mb-0" style="font-size: 0.65rem;">{{ __('Additional') }} ({{ __('Value') }})</label>
                        <input type="number" class="form-control form-control-sm text-end py-1" 
                               id="additional-value" name="additional_value" value="{{ number_format($additionalValue, 2) }}" 
                               step="0.01" min="0" style="font-size: 0.75rem;">
                    </div>
                    <div class="col-6">
                        <label class="form-label small mb-0" style="font-size: 0.65rem;">{{ __('VAT') }} (%)</label>
                        <input type="number" class="form-control form-control-sm text-end py-1" 
                               id="vat-percentage" name="vat_percentage" value="{{ number_format($vatPercentage, 2) }}" 
                               step="0.01" min="0" max="100" style="font-size: 0.75rem;">
                    </div>
                    <div class="col-6">
                        <label class="form-label small mb-0" style="font-size: 0.65rem;">{{ __('VAT') }} ({{ __('Value') }})</label>
                        <input type="text" class="form-control form-control-sm text-end fw-bold bg-light py-1" 
                               value="{{ number_format($vatValue, 2) }}" readonly id="vat-value-display" style="font-size: 0.75rem;">
                    </div>
                    <div class="col-6">
                        <label class="form-label small mb-0" style="font-size: 0.65rem;">{{ __('Withholding Tax') }} (%)</label>
                        <input type="number" class="form-control form-control-sm text-end py-1" 
                               id="withholding-tax-percentage" name="withholding_tax_percentage" value="{{ number_format($withholdingTaxPercentage, 2) }}" 
                               step="0.01" min="0" max="100" style="font-size: 0.75rem;">
                    </div>
                    <div class="col-6">
                        <label class="form-label small mb-0" style="font-size: 0.65rem;">{{ __('Withholding Tax') }} ({{ __('Value') }})</label>
                        <input type="text" class="form-control form-control-sm text-end fw-bold bg-light py-1" 
                               value="{{ number_format($withholdingTaxValue, 2) }}" readonly id="withholding-tax-value-display" style="font-size: 0.75rem;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
