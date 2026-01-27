@php
    $subtotal = $createData['subtotal'] ?? 0;
    $discountValue = $createData['discount_value'] ?? 0;
    $discountPercentage = $createData['discount_percentage'] ?? 0;
    $additionalValue = $createData['additional_value'] ?? 0;
    $additionalPercentage = $createData['additional_percentage'] ?? 0;
    $vatValue = $createData['vat_value'] ?? 0;
    $vatPercentage = $createData['vat_percentage'] ?? 0;
    $withholdingTaxValue = $createData['withholding_tax_value'] ?? 0;
    $withholdingTaxPercentage = $createData['withholding_tax_percentage'] ?? 0;
    $total = $createData['total_after_additional'] ?? 0;
    $receivedFromClient = $createData['received_from_client'] ?? 0;
    $remaining = $total - $receivedFromClient;
    
    $isPurchaseInvoice = in_array($type, [11, 13, 15, 17, 24, 25]);
    $receivedLabel = $isPurchaseInvoice ? __('Paid') : __('Received');
    $remainingLabel = $isPurchaseInvoice ? __('Due to Supplier') : __('Due from Customer');
@endphp

<div class="card border border-secondary border-top-0 border-3" style="position: fixed; bottom: 0; left: 0; right: 0; z-index: 1050; margin: 0; border-radius: 0;">
    <div class="card-body p-1">
        <div class="row g-1">
            {{-- المربع الأول: الإجماليات والخصومات --}}
            <div class="col-md-4 border rounded p-1" style="background-color: #f8f9fa;">
                <div class="row g-1">
                    {{-- الصف الأول: Subtotal و Net --}}
                    <div class="col-6">
                        <label class="form-label mb-0 fw-semibold" style="font-size: 0.8rem;">{{ __('Subtotal') }}</label>
                        <input type="text" class="form-control form-control-sm text-end fw-bold bg-light p-1" 
                               value="{{ number_format($subtotal, 2) }}" readonly id="subtotal-display" style="height: 26px;">
                    </div>
                    <div class="col-6">
                        <label class="form-label mb-0 fw-bold text-primary" style="font-size: 0.8rem;">{{ __('Net Total') }}</label>
                        <input type="text" class="form-control form-control-sm text-end fw-bold border-primary p-1" 
                               value="{{ number_format($total, 2) }}" readonly id="total-display" 
                               style="background-color: #e3f2fd; font-size: 1rem; height: 26px;">
                    </div>
                    {{-- الصف الثاني: Discount --}}
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text p-1" style="font-size: 0.75rem; min-width: 50px;">{{ __('Disc') }} %</span>
                            <input type="number" class="form-control text-end p-1" id="discount-percentage" 
                                   name="discount_percentage" value="{{ number_format($discountPercentage, 2) }}" 
                                   step="0.01" min="0" max="100" style="height: 26px;">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text p-1" style="font-size: 0.75rem; min-width: 50px;">{{ __('Disc') }} $</span>
                            <input type="number" class="form-control text-end p-1" id="discount-value" 
                                   name="discount_value" value="{{ number_format($discountValue, 2) }}" 
                                   step="0.01" min="0" style="height: 26px;">
                        </div>
                    </div>
                    {{-- الصف الثالث: Additional --}}
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text p-1" style="font-size: 0.75rem; min-width: 50px;">{{ __('Add') }} %</span>
                            <input type="number" class="form-control text-end p-1" id="additional-percentage" 
                                   name="additional_percentage" value="{{ number_format($additionalPercentage, 2) }}" 
                                   step="0.01" min="0" max="100" style="height: 26px;">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text p-1" style="font-size: 0.75rem; min-width: 50px;">{{ __('Add') }} $</span>
                            <input type="number" class="form-control text-end p-1" id="additional-value" 
                                   name="additional_value" value="{{ number_format($additionalValue, 2) }}" 
                                   step="0.01" min="0" style="height: 26px;">
                        </div>
                    </div>
                    {{-- الصف الرابع: VAT --}}
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text p-1" style="font-size: 0.75rem; min-width: 50px;">{{ __('VAT') }} %</span>
                            <input type="number" class="form-control text-end p-1" id="vat-percentage" 
                                   name="vat_percentage" value="{{ number_format($vatPercentage, 2) }}" 
                                   step="0.01" min="0" max="100" style="height: 26px;">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text p-1" style="font-size: 0.75rem; min-width: 50px;">{{ __('VAT') }} $</span>
                            <input type="text" class="form-control text-end bg-light p-1" id="vat-value-display" 
                                   value="{{ number_format($vatValue, 2) }}" readonly style="height: 26px;">
                        </div>
                    </div>
                    {{-- الصف الخامس: Withholding Tax --}}
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text p-1" style="font-size: 0.7rem; min-width: 50px;">{{ __('W.Tax') }} %</span>
                            <input type="number" class="form-control text-end p-1" id="withholding-tax-percentage" 
                                   name="withholding_tax_percentage" value="{{ number_format($withholdingTaxPercentage, 2) }}" 
                                   step="0.01" min="0" max="100" style="height: 26px;">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text p-1" style="font-size: 0.7rem; min-width: 50px;">{{ __('W.Tax') }} $</span>
                            <input type="text" class="form-control text-end bg-light p-1" id="withholding-tax-value-display" 
                                   value="{{ number_format($withholdingTaxValue, 2) }}" readonly style="height: 26px;">
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- المربع الثاني: الدفع والملاحظات --}}
            <div class="col-md-3 border rounded p-1" style="background-color: #fff3cd;">
                @if($type != 21)
                    <div class="row g-1">
                        {{-- حساب الصندوق --}}
                        <div class="col-12">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text p-1" style="font-size: 0.75rem; min-width: 55px;">
                                    <i class="fas fa-cash-register me-1"></i>{{ __('Cash') }}
                                </span>
                                <select class="form-select form-select-sm p-1" id="cash-account-select" name="cash_account_id" style="height: 26px;">
                                    @foreach($createData['cash_accounts'] ?? [] as $cashAcc)
                                        <option value="{{ $cashAcc['id'] }}">{{ $cashAcc['aname'] ?? $cashAcc['name'] ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- المبلغ المدفوع --}}
                        <div class="col-12">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text p-1" style="font-size: 0.75rem; min-width: 55px;">{{ $receivedLabel }}</span>
                                <input type="number" class="form-control text-end p-1" id="received-from-client" 
                                       name="received_from_client" value="{{ number_format($receivedFromClient, 2) }}" 
                                       step="0.01" min="0" style="height: 26px;">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text p-1 {{ $remaining > 0.01 ? 'bg-danger text-white' : ($remaining < -0.01 ? 'bg-success text-white' : '') }}" 
                                      style="font-size: 0.7rem; min-width: 55px;">{{ $remainingLabel }}</span>
                                <input type="text" class="form-control text-end fw-bold p-1 {{ $remaining > 0.01 ? 'text-danger' : ($remaining < -0.01 ? 'text-success' : '') }}" 
                                       value="{{ number_format($remaining, 2) }}" readonly id="remaining-display" style="height: 26px;">
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center text-muted py-1" style="font-size: 0.75rem;">
                        <i class="fas fa-exchange-alt me-1"></i>{{ __('Transfer - No Payment') }}
                    </div>
                @endif
                <div class="mt-1">
                    <textarea class="form-control form-control-sm p-1" id="notes" name="notes" rows="2" 
                              placeholder="{{ __('Notes...') }}" style="font-size: 0.8rem; resize: none;">{{ $createData['notes'] ?? '' }}</textarea>
                </div>
            </div>
            
            {{-- المربع الثالث: بيانات الصنف المحدد --}}
            <div class="col-md-3 border rounded p-1" style="background-color: #d1ecf1;">
                <h6 class="mb-1 text-center fw-bold" style="font-size: 0.8rem; border-bottom: 1px solid #bee5eb; padding-bottom: 2px;">
                    <i class="fas fa-box me-1"></i>{{ __('Selected Item') }}
                </h6>
                <div id="item-details-content" style="font-size: 0.75rem;">
                    <div class="text-center text-muted py-2">
                        <i class="fas fa-hand-pointer fa-lg mb-1 d-block opacity-50"></i>
                        {{ __('Click on item row') }}
                    </div>
                </div>
            </div>
            
            {{-- المربع الرابع: ملخص + زر الحفظ --}}
            <div class="col-md-2 border rounded p-1 d-flex flex-column" style="background-color: #e8f5e9;">
                {{-- ملخص الفاتورة --}}
                <div class="mb-1" style="font-size: 0.8rem;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted"><i class="fas fa-list-ol me-1"></i>{{ __('Items') }}</span>
                        <span class="fw-bold badge bg-secondary p-1" id="items-count-display">0</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted"><i class="fas fa-cubes me-1"></i>{{ __('Qty') }}</span>
                        <span class="fw-bold badge bg-info p-1" id="total-qty-display">0</span>
                    </div>
                    <hr class="my-1" style="margin: 2px 0;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted"><i class="fas fa-coins me-1"></i>{{ __('Total') }}</span>
                        <span class="fw-bold text-primary" id="footer-total-display">0.00</span>
                    </div>
                </div>
                
                {{-- أزرار الحفظ --}}
                <div class="mt-auto">
                    <button type="submit" class="btn btn-success w-100 py-1 fw-bold btn-sm" id="save-invoice-btn">
                        <i class="fas fa-save me-1"></i>{{ __('Save') }}
                    </button>
                    <button type="button" class="btn btn-primary w-100 mt-1 py-1 fw-bold btn-sm" id="save-and-print-btn">
                        <i class="fas fa-save me-1"></i><i class="fas fa-print me-1"></i>{{ __('Save & Print') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
