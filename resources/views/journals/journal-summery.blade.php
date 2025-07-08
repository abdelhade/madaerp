@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('Journals'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('Journals')]],
    ])


    <div class="card">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="journal_tr">
                            <th>م</th>
                            <th>رقم القيد</th>
                            <th>مدين</th>
                            <th>دائن</th>
                            <th>اسم الحساب</th>
                            <th>بيان</th>
                            <th>نوع العملية</th>
                            <th>التاريخ</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($journalHeads as $i => $head)
                  
                            @foreach ($head->dets as $j => $detail)
                                <tr class="">
                                    @if ($j == 0)
                                        <td rowspan="{{ $head->dets->count() }}">{{ $i + 1 }}</td>
                                        <td rowspan="{{ $head->dets->count() }}">{{ $head->journal_id }}</td>
                                    @endif

                                    <td>{{ $detail->debit }}</td>
                                    <td>{{ $detail->credit }}</td>
                                    <td>{{ $detail->accountHead->aname ?? '-' }}</td>

                                    @if ($j == 0)
                                        <td rowspan="{{ $head->dets->count() }}">{{ $head->details }}</td>
                                        <td rowspan="{{ $head->dets->count() }}">{{ $head->oper->type->ptext }}</td>
                                        <td rowspan="{{ $head->dets->count() }}">{{ $head->date }}</td>
                                    @endif
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="8" style="background: #bcbcbc; height: 1px;"></td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
