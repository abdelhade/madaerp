@extends('admin.dashboard')

@section('content')
<div class="content-wrapper">
    

    @php
        $type = request()->get('type');
        $proTypeMap = [
            'cash_to_cash' => 3,
            'cash_to_bank' => 4,
            'bank_to_cash' => 5,
            'bank_to_bank' => 6,
        ];

        $pro_type = $proTypeMap[$type] ?? null;
  
    @endphp

    <section class="content">
    @if (in_array($type, ['cash_to_cash', 'cash_to_bank', 'bank_to_cash', 'bank_to_bank']))
        <form id="myForm" action="{{ route('transfers.store') }}" method="POST">
            @csrf
            <input type="hidden" name="pro_type" value="{{ $pro_type }}">
            
            
            
            <div class="card  col-md-8 container">
                <div class="card-header  bg-primary  ">
                    <h2 class="card-title text-white">
                        @switch($type)
                            @case('cash_to_cash') تحويل من صندوق إلى صندوق @break
                            @case('cash_to_bank') تحويل من صندوق إلى بنك @break
                            @case('bank_to_cash') تحويل من بنك إلى صندوق @break
                            @case('bank_to_bank') تحويل من بنك إلى بنك @break
                        @endswitch
                    </h2>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-2">
                            <label class="cake cake-headShake">رقم العملية</label>
                            <input type="text" name="pro_id" class="form-control " value="{{$pro_type}}" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label class="cake cake-headShake">الرقم الدفتري</label>
                            <input type="text" name="pro_serial" class="form-control ">
                        </div>
                        <div class="col-lg-2">
                            <label class="cake cake-headShake">رقم الإيصال</label>
                            <input type="text" name="pro_num" class="form-control " onblur="validateRequired(this)">
                        </div>
                        <div class="col-lg-4">
                            <label class="cake cake-headShake">التاريخ</label>
                            <input type="date" name="pro_date" class="form-control " value="{{ date('Y-m-d') }}" onblur="validateRequired(this)">
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-3">
                            <label class="cake cake-headShake">المبلغ</label>
                            <input type="number" step="0.01" name="pro_value" class="form-control " onblur="validateRequired(this)">
                        </div>
                        <div class="col-lg-9">
                            <label class="cake cake-headShake">البيان</label>
                            <input type="text" name="details" class="form-control " onblur="validateRequired(this)">
                        </div>
                    </div>

                    <hr>
                    <br>
                        @php
                            $types = [
                                'cash_to_cash' => ['الصندوق', 'الصندوق', 'تحويل من صندوق إلى صندوق'],
                                'cash_to_bank' => ['الصندوق', 'البنك', 'تحويل من صندوق إلى بنك'],
                                'bank_to_cash' => ['البنك', 'الصندوق', 'تحويل من بنك إلى صندوق'],
                                'bank_to_bank' => ['البنك', 'البنك', 'تحويل من بنك إلى بنك'],
                            ];

                            [$acc1_text, $acc2_text, $description] = $types[$type] ?? ['حساب 1', 'حساب 2', 'نوع التحويل غير معروف'];
                        @endphp



                    <div class="row">
                        <div class="col-lg-6">
                            <label class="cake cake-headShake">من حساب: {{ $acc1_text }}<span class="badge badge-outline-info">دائن</span></label>
                            <select name="acc2" required id="acc1" class="form-control " onblur="validateRequired(this); checkSameAccounts();">
                                <option value="">اختر الحساب</option>
                                @if ($type === 'cash_to_cash' || $type === 'cash_to_bank')
                                    @foreach ($cashAccounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->aname }}</option>
                                    @endforeach
                                @elseif ($type === 'bank_to_cash' || $type === 'bank_to_bank')
                                    @foreach ($bankAccounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->aname }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="cake cake-headShake">إلى حساب: {{ $acc2_text }}<span class="badge badge-outline-info">مدين</span></label>
                            <select name="acc1" id="acc2" required class="form-control " onblur="validateRequired(this); checkSameAccounts();">
                                <option value="">اختر الحساب</option>
                                @if ($type === 'cash_to_cash' || $type === 'bank_to_cash')
                                    @foreach ($cashAccounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->aname }}</option>
                                    @endforeach
                                @elseif ($type === 'cash_to_bank' || $type === 'bank_to_bank')
                                    @foreach ($bankAccounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->aname }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>


                    <hr>

                    <div class="row">
                        <div class="col-lg-6">
                            <label class="cake cake-headShake">الموظف</label>
                            <select name="emp_id" class="form-control ">
                                <option value="">اختر موظف</option>
                                @foreach ($employeeAccounts as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->aname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="cake cake-headShake">مندوب التحصيل</label>
                            <select name="emp2_id" class="form-control ">
                                <option value="">اختر مندوب</option>
                                @foreach ($employeeAccounts as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->aname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-6">
                            <label class="cake cake-headShake">مركز التكلفة</label>
                            <select name="cost_center" class="form-control ">
                                <option value="">بدون مركز تكلفة</option>
                                {{-- املأ قائمة مراكز التكلفة هنا إذا توفرت --}}
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="cake cake-headShake">ملاحظات</label>
                            <input type="text" name="info" class="form-control ">
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-primary" type="submit">تأكيد</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-default" type="reset">مسح</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="alert alert-danger">
            <p>نوع التحويل غير معروف. يرجى التحقق من الرابط.</p>
        </div>
    @endif
    </section>
    <script>
form.onsubmit = e => {
  if (acc1.value === acc2.value) {
    e.preventDefault();
    errorMsg.style.display = 'block';
  } else {
    errorMsg.style.display = 'none';
  }
};
</script>
</div>

<!-- التحقق من الحقول -->
<script>
function validateRequired(input) {
    if (!input.value.trim()) {
        input.classList.add('is-invalid');
        if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('invalid-feedback')) {
            const errorMsg = document.createElement('div');
            errorMsg.className = 'invalid-feedback';
            errorMsg.innerText = 'هذا الحقل مطلوب';
            input.parentNode.appendChild(errorMsg);
        }
    } else {
        input.classList.remove('is-invalid');
        const next = input.nextElementSibling;
        if (next && next.classList.contains('invalid-feedback')) {
            next.remove();
        }
    }
}
</script>

@endsection

