@extends('admin.dashboard')
@section('content')

    @php
        $permissionTypes = [
            'client' => 'العملاء',
            'supplier' => 'الموردين',
            'fund' => 'الصناديق',
            'bank' => 'البنوك',
            'employee' => 'الموظفين',
            'store' => 'المخازن',
            'expense' => 'المصروفات',
            'revenue' => 'الإيرادات',
            'creditor' => 'دائنين متنوعين',
            'depitor' => 'مدينين متنوعين',
            'partner' => 'الشركاء',
            'current-partner' => 'جارى الشركاء',
            'asset' => 'الأصول الثابتة',
            'rentable' => 'الأصول القابلة للتأجير',
        ];

        $parentCodes = [
            'client' => '1103', // العملاء
            'supplier' => '2101', // الموردين
            'bank' => '1102', // البنوك
            'fund' => '1101', // الصناديق
            'store' => '1104', // المخازن
            'expense' => '57', // المصروفات
            'revenue' => '42', // الإيرادات
            'creditor' => '2104', // دائنين اخرين
            'depitor' => '1106', // مدينين آخرين
            'partner' => '31', // الشريك الرئيسي
            'current-partner' => '3201', // جاري الشريك
            'asset' => '12', // الأصول
            'employee' => '2102', // الموظفين
            'rentable' => '1202', // مباني (أصل قابل للإيجار)
        ];

        $type = request('type');
        $permName = $permissionTypes[$type] ?? null;
        $parentCode = $parentCodes[$type] ?? null;
    @endphp

    <div class="container">

        {{-- رسائل الأخطاء --}}
        @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        {{-- البريدكرامب --}}
        <section class="content-header">
            <div class="container-fluid">
                @include('components.breadcrumb', [
                    'title' => $permName ? __('قائمة الحسابات - ' . $permName) : __('قائمة الحسابات'),
                    'items' => [
                        ['label' => __('الرئيسيه'), 'url' => route('admin.dashboard')],
                        $permName ? ['label' => $permName] : ['label' => __('قائمة الحسابات')],
                    ],
                ])
            </div>
        </section>

        {{-- الأكشنات (إضافة + بحث) --}}
        <div class="row mt-3 justify-content-between align-items-center">
            <div class="col-md-3">
                @if ($parentCode)
                    @can("إضافة $permName")
                        <a href="{{ route('accounts.create', ['parent' => $parentCode]) }}" class="btn btn-primary">
                            <i class="las la-plus"></i> {{ __('إضافة حساب جديد') }}
                        </a>
                    @endcan
                @endif
            </div>

            <div class="col-md-4 text-end">
                <input class="form-control form-control-lg" type="text" id="itmsearch"
                    placeholder="بحث بالكود | اسم الحساب | ID">
            </div>
        </div>

        {{-- الجدول --}}
        <div class="card-body px-0 mt-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">{{ $permName ? 'قائمة ' . $permName : 'قائمة الحسابات' }}</h5>
                    <x-table-export-actions table-id="myTable" filename="accounts" excel-label="تصدير Excel"
                        pdf-label="تصدير PDF" print-label="طباعة" />
                </div>

                <div class="table-responsive" id="printed" style="overflow-x: auto;">
                    <table id="myTable" class="table table-striped table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>الرصيد</th>
                                <th>العنوان</th>
                                <th>التليفون</th>
                                <th>ID</th>
                                @canany(["تعديل $permName", "حذف $permName"])
                                    <th>عمليات</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($accounts as $index => $acc)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $acc->code }} - {{ $acc->aname }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-primary"
                                            href="{{ route('account-movement', ['accountId' => $acc['id']]) }}">
                                            {{ $acc->balance ?? 0.0 }}
                                        </a>
                                    </td>
                                    <td>{{ $acc->address ?? '__' }}</td>
                                    <td>{{ $acc->phone ?? '__' }}</td>
                                    <td>{{ $acc->id }}</td>

                                    @canany(["تعديل $permName", "حذف $permName"])
                                        <td>
                                            @can("تعديل $permName")
                                                <a href="{{ route('accounts.edit', $acc->id) }}" class="btn btn-success btn-sm">
                                                    <i class="las la-pen"></i>
                                                </a>
                                            @endcan

                                            @can("حذف $permName")
                                                <form action="{{ route('accounts.destroy', $acc->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                        <i class="las la-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    @endcanany
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="alert alert-info py-3 mb-0">
                                            <i class="las la-info-circle me-2"></i>
                                            لا توجد بيانات
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- البحث --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('itmsearch');
                const table = document.getElementById('myTable');
                if (!searchInput || !table) return;

                searchInput.addEventListener('keyup', function() {
                    const filter = this.value.trim().toLowerCase();
                    const rows = table.querySelectorAll('tbody tr');
                    rows.forEach(function(row) {
                        let text = row.textContent.replace(/\s+/g, ' ').toLowerCase();
                        row.style.display = (filter === '' || text.indexOf(filter) !== -1) ? '' :
                        'none';
                    });
                });
            });
        </script>
    @endpush

@endsection
