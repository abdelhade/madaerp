
@extends('admin.dashboard')

@section('sidebar')
    @if (in_array($type, [10, 12, 14, 16, 22, 26]))
        @include('components.sidebar.sales-invoices')
    @elseif (in_array($type, [11, 13, 15, 17, 24, 25]))
        @include('components.sidebar.purchases-invoices')
    @elseif (in_array($type, [18, 19, 20, 21]))
        @include('components.sidebar.inventory-invoices')
    @endif
@endsection

@section('content')
    @php
        $titles = [
            10 => 'Sales Invoice',
            11 => 'Purchase Invoice',
            12 => 'Sales Return',
            13 => 'Purchase Return',
            14 => 'Sales Order',
            15 => 'Purchase Order',
            16 => 'Quotation to Customer',
            17 => 'Quotation from Supplier',
            18 => 'Damaged Goods Invoice',
            19 => 'Dispatch Order',
            20 => 'Addition Order',
            21 => 'Store-to-Store Transfer',
            22 => 'Booking Order',
            24 => 'Service Invoice',
            25 => 'Requisition',
            26 => 'Pricing Agreement',
        ];
        $invoiceTitle = $titles[$type] ?? 'Invoice';
    @endphp

    {{-- Hide Global Footer on this page only --}}
    <style>
        footer.footer {
            display: none !important;
        }
    </style>

    @include('components.breadcrumb', [
        'items' => [
            ['label' => __('Dashboard'), 'url' => route('admin.dashboard')],
            ['label' => __($invoiceTitle)],
            ['label' => __('Create')],
        ],
    ])

    <div class="content-wrapper">
        <section class="content">
            <form id="invoice-form" action="{{ route('invoices.store') }}" method="POST" class="d-flex flex-column g-0" style="height: calc(100vh - 70px); overflow: hidden;">
                @csrf
          
                <input type="hidden" name="invoice_data" id="invoice-data-input">
                <input type="hidden" name="pro_type" id="pro-type" value="{{ $type }}">
                
                {{-- Invoice Header --}}
                <div id="invoice-header-container">
                    @include('invoices::invoices.partials.create-header', [
                        'type' => $type,
                        'invoiceTitle' => $invoiceTitle,
                        'createData' => $createData
                    ])
                </div>

                {{-- Invoice Items Data Grid --}}
                <div class="row flex-grow-1 overflow-hidden g-0">
                    <div class="col-12 h-100">
                        @include('invoices::invoices.partials.create-items-table', [
                            'type' => $type,
                            'createData' => $createData
                        ])
                    </div>
                </div>

                {{-- Invoice Footer --}}
                @include('invoices::invoices.partials.create-footer', [
                    'type' => $type,
                    'createData' => $createData
                ])
            </form>
        </section>
    </div>

@endsection

{{-- Load Invoice Create JS --}}
@push('scripts')
{{-- Load Invoice Translations --}}
@include('invoices::invoices.partials.invoice-translations')

<script src="{{ asset('modules/invoices/js/invoice-create.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Invoice Create Manager with server-side config
    window.invoiceCreateManager = new InvoiceCreateManager({
        type: {{ $type }},
        branchId: '{{ $createData['branch_id'] ?? '' }}',
        selectedPriceType: 1,
        debounceDelay: 300,
        minSearchLength: 2,
        searchLimit: 25,
        defaultVatPercentage: {{ $createData['settings']['default_vat_percentage'] ?? 0 }},
        translations: window.invoiceTranslations || {}
    });
});
</script>
@endpush
