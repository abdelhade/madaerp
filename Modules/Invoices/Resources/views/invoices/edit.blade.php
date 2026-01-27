@extends('admin.dashboard')

@section('sidebar')
    @if (in_array($invoice->pro_type, [10, 12, 14, 16, 22, 26]))
        @include('components.sidebar.sales-invoices')
    @elseif (in_array($invoice->pro_type, [11, 13, 15, 17, 24, 25]))
        @include('components.sidebar.purchases-invoices')
    @elseif (in_array($invoice->pro_type, [18, 19, 20, 21]))
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
        $invoiceTitle = $titles[$invoice->pro_type] ?? 'Invoice';
    @endphp

    {{-- Hide Global Footer on this page only --}}
    <style>
        footer.footer {
            display: none !important;
        }
    </style>

    @include('components.breadcrumb', [
        'title' => __('Edit') . ' ' . __($invoiceTitle),
        'items' => [
            ['label' => __('Dashboard'), 'url' => route('admin.dashboard')],
            ['label' => __($invoiceTitle)],
            ['label' => __('Edit')],
        ],
    ])

    <div class="content-wrapper">
        <section class="content">
            <form id="invoice-form" action="{{ route('invoices.update', $invoice->id) }}" method="POST" class="d-flex flex-column g-0" style="height: calc(100vh - 70px); overflow: hidden;">
                @csrf
                @method('PUT')
                
                {{-- Hidden field for invoice data (will be updated by JavaScript before submit) --}}
                <input type="hidden" name="invoice_data" id="invoice-data-input">
                
                {{-- Invoice Header --}}
                <div id="invoice-header-container">
                    @include('invoices::invoices.partials.edit-header', [
                        'invoice' => $invoice,
                        'invoiceTitle' => $invoiceTitle,
                        'editData' => $editData
                    ])
                </div>

                {{-- Invoice Items Data Grid --}}
                <div class="row flex-grow-1 overflow-hidden g-0">
                    <div class="col-12 h-100">
                        @include('invoices::invoices.partials.edit-items-table', [
                            'invoice' => $invoice,
                            'editData' => $editData
                        ])
                    </div>
                </div>

                {{-- Invoice Footer --}}
                @include('invoices::invoices.partials.edit-footer', [
                    'invoice' => $invoice,
                    'editData' => $editData
                ])
            </form>
        </section>
    </div>
@endsection

{{-- Load Invoice Edit JS --}}
@push('scripts')
{{-- Load Invoice Translations --}}
@include('invoices::invoices.partials.invoice-translations')

<script src="{{ asset('modules/invoices/js/invoice-create.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Invoice Manager for Edit Mode
    window.invoiceCreateManager = new InvoiceCreateManager({
        type: {{ $invoice->pro_type }},
        branchId: '{{ $editData['branch_id'] ?? '' }}',
        selectedPriceType: {{ $editData['selected_price_type'] ?? 1 }},
        debounceDelay: 300,
        minSearchLength: 2,
        searchLimit: 25,
        defaultVatPercentage: {{ $editData['settings']['default_vat_percentage'] ?? 0 }},
        translations: window.invoiceTranslations || {},
        // Edit mode specific
        isEditMode: true,
        operationId: {{ $invoice->id }},
        updateUrl: '{{ route("api.invoices.update", $invoice->id) }}'
    });

    // Load existing items from server
    const existingItems = @json($editData['invoice_items'] ?? []);
    if (existingItems && existingItems.length > 0) {
        existingItems.forEach(function(item, index) {
            window.invoiceCreateManager.addExistingItem(item);
        });
        window.invoiceCreateManager.recalculateTotals();
    }

    // Override form submission for edit mode
    const form = document.getElementById('invoice-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            window.invoiceCreateManager.saveInvoice(true); // true = isUpdate
        });
    }
});
</script>
@endpush
