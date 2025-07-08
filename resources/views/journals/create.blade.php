@extends('admin.dashboard')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="cake cake-flash">قيد يومية</h1>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="myForm" action="{{ route('journals.store') }}" method="POST">
                    @csrf

                    <input type="text" hidden name="pro_type" value="7">


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-control">
                                <label for="pro_date">التاريخ</label>
                                <input type="date" class="form-control" name="pro_date"
                                    value="{{ now()->format('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-control">
                                <label for="pro_num">الرقم الدفتري</label>
                                <input type="text" class="form-control" name="pro_num" value=""
                                    placeholder="EX:7645">
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-control">
                                <label for="emp_id">الموظف</label>
                                <select class="form-control" name="emp_id" id="" required>
                                    <option value="">اختر حساب</option>
                                    @foreach ($employees as $emp)
                                        <option value="{{ $emp->id }}">{{ $emp->code }} _
                                            {{ $emp->aname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-control">
                                <label for="cost_center">مركز التكلفة</label>
                                <select class="form-control" name="cost_center" id="" required>
                                    <option value="">اختر مركز تكلفة</option>
                                    @foreach ($cost_centers as $cost)
                                        <option value="{{ $cost->id }}">{{ $cost->cname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                    </div>


                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-control">
                                <label for="details">بيان</label>
                                <input name="details" type="text" name="details" class="form-control frst">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hoverable table-bordered" style="border: 0 solid white">
                            <thead>
                                <tr>
                                    <th width="15%">مدين</th>
                                    <th width="15%">دائن</th>
                                    <th width="30%">الحساب</th>
                                    <th width="40%">ملاحظات</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td><input type="number" required name="debit" placeholder="Debit" value="0.00"
                                            class="form-control debit" id="debit" step="0.01"></td>
                                    <td></td>
                                    <td>
                                        <select class="form-control select2 " name="acc1" id="" required>
                                            <option value="">اختر حساب</option>
                                            @foreach ($accounts as $acc)
                                                <option value="{{ $acc->id }}">{{ $acc->code }} _
                                                    {{ $acc->aname }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="info2" class="form-control" id=""></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td><input type="number" name="credit" value="0.00" class="form-control credit"
                                            id="credit" step="0.01"></td>
                                    <td>

                                        <select class="form-control" name="acc2" id="" required>
                                            <option value="">اختر حساب</option>
                                            @foreach ($accounts as $acc)
                                                <option value="{{ $acc->id }}">{{ $acc->code }} _
                                                    {{ $acc->aname }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="info3" class="form-control" id=""></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-control">
                                <label for="">ملاحظات عامة</label>
                                <input type="text" name="info" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">حفظ</button>

                </form>
            </div>
        </div>

    </div>


    <script>
        document.getElementById("myForm").addEventListener("submit", function(e) {
            const debit = +document.getElementById("debit").value;
            const credit = +document.getElementById("credit").value;

            if (debit !== credit) {
                e.preventDefault(); // منع الإرسال
                alert("يجب أن تكون القيمة المدينة مساوية للقيمة الدائنة.");
            }
        });
    </script>
@endsection
