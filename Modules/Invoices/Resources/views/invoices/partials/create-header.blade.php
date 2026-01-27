@php
    $colorClass = '';
    if (in_array($type, [10, 14, 16, 22])) {
        $colorClass = 'bg-primary';
    } elseif (in_array($type, [11, 15, 17, 24, 25])) {
        $colorClass = 'bg-danger';
    } elseif (in_array($type, [12, 13, 18, 19, 20, 21])) {
        $colorClass = 'bg-warning';
    }
@endphp

<div class="card border border-secondary border-3" style="border-radius: 0;">
    {{-- السطر الأول: العنوان + العميل + المخزن + الرصيد --}}
    <div class="card-header p-1 border-bottom">
        <div class="row g-1 align-items-center">
            {{-- العنوان --}}
            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <h5 class="fw-bold m-0 me-2" style="font-size: 1.1rem;">{{ __($invoiceTitle) }}</h5>
                    <div class="rounded-circle {{ $colorClass }}" style="width: 18px; height: 18px;"></div>
                </div>
            </div>
            
            {{-- المخزن --}}
            <div class="col-auto">
                <div class="input-group input-group-sm">
                    <span class="input-group-text p-1" style="font-size: 0.75rem;">{{ __('Store') }}</span>
                    <select id="acc2-select" name="acc2_id" class="form-select form-select-sm p-1" style="min-width: 120px; height: 26px;">
                        @foreach($createData['acc2_list'] ?? [] as $acc)
                            <option value="{{ $acc['id'] }}">{{ $acc['aname'] ?? $acc['name'] ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            {{-- العميل/المورد --}}
            <div class="col-auto">
                <div class="input-group input-group-sm">
                    <span class="input-group-text p-1" style="font-size: 0.75rem;">{{ __('Client') }}</span>
                    <select id="acc1-select" name="acc1_id" class="form-select form-select-sm p-1" style="min-width: 150px; height: 26px;">
                        @foreach($createData['acc1_list'] ?? [] as $acc)
                            <option value="{{ $acc['id'] }}" data-balance="{{ $acc['balance'] ?? 0 }}" data-currency-id="{{ $acc['currency_id'] ?? '' }}" data-currency-rate="{{ $acc['currency_rate'] ?? 1 }}">{{ $acc['aname'] ?? $acc['name'] ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            {{-- العملة --}}
            @if(($createData['settings']['multi_currency_enabled'] ?? '0') == '1' && count($createData['currencies'] ?? []) > 0)
                <div class="col-auto">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text p-1" style="font-size: 0.75rem;">{{ __('Curr') }}</span>
                        <select id="currency-select" name="currency_id" class="form-select form-select-sm p-1" style="min-width: 80px; height: 26px;">
                            @foreach($createData['currencies'] ?? [] as $currency)
                                <option value="{{ $currency['id'] }}" data-rate="{{ $currency['rate'] ?? 1 }}" {{ ($currency['id'] == ($createData['default_currency_id'] ?? '')) ? 'selected' : '' }}>
                                    {{ $currency['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            
            {{-- الرصيد --}}
            @if($type != 21)
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-2" style="font-size: 0.8rem;">
                        <div>
                            <span class="text-muted">{{ __('Balance') }}:</span>
                            <span class="fw-bold text-primary" id="current-balance-display">0.00</span>
                        </div>
                        <div class="border-start ps-2">
                            <span class="text-muted">{{ __('After') }}:</span>
                            <span class="fw-bold text-success" id="balance-after-display">0.00</span>
                        </div>
                    </div>
                </div>
            @endif
            
            {{-- نمط الفاتورة (Invoice Pattern) --}}
            @if(count($createData['available_templates'] ?? []) > 0)
                <div class="col-auto {{ $type == 21 ? 'ms-auto' : '' }}">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text p-1 bg-info text-white" style="font-size: 0.75rem;">
                            <i class="fas fa-th-list me-1"></i>{{ __('Pattern') }}
                        </span>
                        <select id="invoice-pattern-select" name="template_id" class="form-select form-select-sm p-1" style="min-width: 120px; height: 26px;">
                            @foreach($createData['available_templates'] ?? [] as $template)
                                <option value="{{ $template['id'] }}" 
                                        data-visible-columns='@json($template['visible_columns'] ?? [])'
                                        data-column-widths='@json($template['column_widths'] ?? [])'
                                        data-column-order='@json($template['column_order'] ?? [])'
                                        {{ ($template['id'] == ($createData['selected_template_id'] ?? '')) ? 'selected' : '' }}>
                                    {{ $template['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            
            {{-- الفرع --}}
            @if(count($createData['branches'] ?? []) > 1)
                <div class="col-auto ms-3" style="min-width: 150px;">
                    <label class="form-label mb-0" style="font-size: 1em;">{{ __('Branch') }}</label>
                    <select id="branch-select" name="branch_id" class="form-control form-control-sm"
                        style="font-size: 0.85em; height: 2em; padding: 2px 6px;">
                        @foreach($createData['branches'] ?? [] as $branch)
                            <option value="{{ $branch['id'] }}" {{ ($branch['id'] == ($createData['branch_id'] ?? '')) ? 'selected' : '' }}>{{ $branch['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
    </div>
    
    {{-- السطر الثاني: الموظف + السعر + التواريخ + الأرقام --}}
    <div class="card-body p-1">
        <div class="row g-1 align-items-center">
            {{-- الموظف --}}
            <div class="col-auto">
                <div class="input-group input-group-sm">
                    <span class="input-group-text p-1" style="font-size: 0.75rem;">{{ __('Emp') }}</span>
                    <select id="emp-select" name="emp_id" class="form-select form-select-sm p-1" style="min-width: 120px; height: 26px;">
                        <option value="">{{ __('Select') }}...</option>
                        @foreach($createData['employees'] ?? [] as $emp)
                            <option value="{{ $emp['id'] }}">{{ $emp['aname'] ?? $emp['name'] ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            {{-- نوع السعر --}}
            <div class="col-auto">
                <div class="input-group input-group-sm">
                    <span class="input-group-text p-1" style="font-size: 0.75rem;">{{ __('Price') }}</span>
                    <select id="selectedPriceType" name="selected_price_type" class="form-select form-select-sm p-1" style="min-width: 100px; height: 26px;">
                        @if(count($createData['price_types'] ?? []) > 0)
                            @foreach($createData['price_types'] ?? [] as $id => $name)
                                <option value="{{ $id }}" {{ $id == 1 ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        @else
                            <option value="1">{{ __('Default') }}</option>
                        @endif
                    </select>
                </div>
            </div>
            
            {{-- التاريخ --}}
            <div class="col-auto">
                <div class="input-group input-group-sm">
                    <span class="input-group-text p-1" style="font-size: 0.75rem;">{{ __('Date') }}</span>
                    <input type="date" id="pro-date" name="pro_date" class="form-control form-control-sm p-1" value="{{ date('Y-m-d') }}" style="height: 26px;">
                </div>
            </div>
            
            {{-- تاريخ الاستحقاق --}}
            <div class="col-auto">
                <div class="input-group input-group-sm">
                    <span class="input-group-text p-1" style="font-size: 0.7rem;">{{ __('Accrual') }}</span>
                    <input type="date" id="accural-date" name="accural_date" class="form-control form-control-sm p-1" value="{{ date('Y-m-d') }}" style="height: 26px;">
                </div>
            </div>
            
            {{-- رقم الفاتورة --}}
            <div class="col-auto">
                <div class="input-group input-group-sm">
                    <span class="input-group-text p-1" style="font-size: 0.65rem;">#</span>
                    <input type="number" id="pro-id" name="pro_id" class="form-control form-control-sm p-1 bg-light text-center fw-bold" 
                           value="{{ $createData['next_pro_id'] ?? '' }}" readonly style="width: 60px; height: 26px; font-size: 0.8rem;">
                </div>
            </div>
            
            {{-- الرقم التسلسلي --}}
            <div class="col-auto">
                <div class="input-group input-group-sm">
                    <span class="input-group-text p-1" style="font-size: 0.75rem;">{{ __('S.N') }}</span>
                    <input type="text" id="serial-number" name="serial_number" class="form-control form-control-sm p-1" value="" style="width: 80px; height: 26px;">
                </div>
            </div>
        </div>
    </div>
</div>
