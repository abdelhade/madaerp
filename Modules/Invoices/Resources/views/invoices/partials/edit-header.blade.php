@php
    $type = $invoice->pro_type;
    $colorClass = '';
    if (in_array($type, [10, 14, 16, 22])) {
        $colorClass = 'bg-primary';
    } elseif (in_array($type, [11, 15, 17, 24, 25])) {
        $colorClass = 'bg-danger';
    } elseif (in_array($type, [12, 13, 18, 19, 20, 21])) {
        $colorClass = 'bg-warning';
    }

    $multiCurrencyEnabled = ($editData['settings']['multi_currency_enabled'] ?? '0') == '1';
    $currentBalance = $editData['current_balance'] ?? 0;
    $calculatedBalanceAfter = $currentBalance;
@endphp

<div class="card border border-secondary border-3">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap py-2">
        <div class="d-flex align-items-center flex-wrap">
            <h3 class="card-title fw-bold fs-2 m-0 ms-3">{{ __($invoiceTitle) }}</h3>
            <div class="rounded-circle {{ $colorClass }}" style="width: 25px; height: 25px; min-width: 25px; margin-left: 10px;"></div>
            
            @if(count($editData['branches'] ?? []) > 1)
                <div class="ms-3" style="min-width: 150px;">
                    <label class="form-label" style="font-size: 1em;">{{ __('Branch') }}</label>
                    <select id="branch-select" name="branch_id" class="form-control form-control-sm" style="font-size: 0.85em; height: 2em; padding: 2px 6px;">
                        @foreach($editData['branches'] ?? [] as $branch)
                            <option value="{{ $branch['id'] }}" {{ $branch['id'] == ($invoice->branch_id ?? ($editData['branch_id'] ?? '')) ? 'selected' : '' }}>{{ $branch['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            
            <div class="ms-3" style="min-width: 180px;">
                <label class="form-label small mb-1">{{ __('Client/Supplier') }}</label>
                <select id="acc1-select" name="acc1_id" class="form-control form-control-sm">
                    <option value="">{{ __('Select') }}...</option>
                    @foreach($editData['acc1_list'] ?? [] as $acc)
                        <option value="{{ $acc['id'] }}"
                                data-balance="{{ $acc['balance'] ?? 0 }}"
                                data-currency-id="{{ $acc['currency_id'] ?? '' }}"
                                data-currency-rate="{{ $acc['currency_rate'] ?? 1 }}"
                                {{ $acc['id'] == ($invoice->acc1_id ?? ($editData['acc1_id'] ?? null)) ? 'selected' : '' }}>
                            {{ $acc['aname'] ?? $acc['name'] ?? '' }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="ms-3" style="min-width: 180px;">
                <label class="form-label small mb-1">{{ __('Store') }}</label>
                <select id="acc2-select" name="acc2_id" class="form-control form-control-sm">
                    <option value="">{{ __('Select') }}...</option>
                    @foreach($editData['acc2_list'] ?? [] as $acc)
                        <option value="{{ $acc['id'] }}" {{ $acc['id'] == ($invoice->acc2_id ?? ($editData['acc2_id'] ?? null)) ? 'selected' : '' }}>{{ $acc['aname'] ?? $acc['name'] ?? '' }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        @if ($multiCurrencyEnabled && count($editData['currencies'] ?? []) > 0)
            <div class="col-lg-3">
                <label class="form-label" style="font-size: 0.9em;">{{ __('Currency') }}</label>
                <select id="currency-select" name="currency_id" class="form-control form-control-sm">
                    @foreach($editData['currencies'] ?? [] as $currency)
                        <option value="{{ $currency['id'] }}" data-rate="{{ $currency['rate'] ?? 1 }}" {{ $currency['id'] == ($invoice->currency_id ?? ($editData['currency_id'] ?? $editData['default_currency_id'])) ? 'selected' : '' }}>
                            {{ $currency['name'] }} ({{ $currency['rate'] ?? 1 }})
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
        
        @if ($type != 21)
            <div class="mt-1">
                <div class="row" style="min-width: 400px">
                    <div class="col-6">
                        <label>{{ __('Current Balance: ') }}</label>
                        <span class="fw-bold text-primary" id="current-balance-display">{{ number_format($currentBalance, 2) }}</span>
                    </div>
                    <div class="col-6">
                        <label>{{ __('Balance After Invoice: ') }}</label>
                        <span class="fw-bold {{ $calculatedBalanceAfter < 0 ? 'text-danger' : 'text-success' }}" id="balance-after-display">{{ number_format($calculatedBalanceAfter, 2) }}</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-2">
                <label class="form-label">{{ __('Employee') }}</label>
                <select id="emp-select" name="emp_id" class="form-control form-control-sm">
                    <option value="">{{ __('Select') }}...</option>
                    @foreach($editData['employees'] ?? [] as $emp)
                        <option value="{{ $emp['id'] }}" {{ $emp['id'] == ($invoice->emp_id ?? ($editData['emp_id'] ?? null)) ? 'selected' : '' }}>{{ $emp['aname'] ?? $emp['name'] ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2">
                <label class="form-label">{{ __('Price Type') }}</label>
                <select id="selectedPriceType" name="selected_price_type" class="form-control form-control-sm">
                    @if($editData['price_types'] && count($editData['price_types']) > 0)
                        @foreach($editData['price_types'] as $id => $name)
                            <option value="{{ $id }}" {{ $id == ($editData['selected_price_type'] ?? 1) ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    @else
                        <option value="1">{{ __('Default Price') }}</option>
                    @endif
                </select>
            </div>
            <div class="col-lg-1">
                <label class="form-label">{{ __('Date') }}</label>
                <input type="date" id="pro-date" name="pro_date" class="form-control form-control-sm" value="{{ $invoice->pro_date ?? ($editData['pro_date'] ?? date('Y-m-d')) }}">
            </div>
            <div class="col-lg-1">
                <label class="form-label">{{ __('Accrual Date') }}</label>
                <input type="date" id="accural-date" name="accural_date" class="form-control form-control-sm" value="{{ $invoice->accural_date ?? ($editData['accural_date'] ?? date('Y-m-d')) }}">
            </div>
            <div class="col-lg-1">
                <label class="form-label">{{ __('Invoice Number') }}</label>
                <input type="number" id="pro-id" name="pro_id" class="form-control form-control-sm" value="{{ $invoice->pro_id ?? ($editData['pro_id'] ?? '') }}" readonly>
            </div>
            <div class="col-lg-1">
                <label class="form-label">{{ __('S.N') }}</label>
                <input type="text" id="serial-number" name="serial_number" class="form-control form-control-sm" value="{{ $invoice->serial_number ?? ($editData['serial_number'] ?? '') }}">
            </div>
        </div>
    </div>
</div>
