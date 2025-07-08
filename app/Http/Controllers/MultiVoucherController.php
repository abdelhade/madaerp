<?php

namespace App\Http\Controllers;

use App\Models\AccHead;
use Illuminate\Support\Facades\DB;
use App\Models\MultiVoucher;
use App\Models\JournalHead;
use App\Models\JournalDetail;
use App\Models\CostCenter;
use App\Models\ProType;
use App\Models\OperHead;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MultiVoucherController extends Controller
{

    public function index()
    {
        $multis = MultiVoucher::where('isdeleted', 0)
            ->whereIn('pro_type',  [32, 33, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55])
            ->orderBy('pro_id', 'desc')
            ->get();
        return view('multi-vouchers.index', compact('multis'));
    }


    public function create(Request $request)
    {
        $type = $request->type;
        $pro_type = ProType::where('pname', $type)->first()?->id;
        $ptext = ProType::where('pname', $type)->first()?->ptext;

        if (!$pro_type) {
            abort(404, 'نوع العملية غير موجود');
        }
        $employees = \App\Models\AccHead::where('isdeleted', 0)
            ->where('is_basic', 0)
            ->where('code', 'like', '213%')
            ->get();

        $lastProId = OperHead::where('pro_type', $type)->max('pro_id') ?? 0;
        $newProId = $lastProId + 1;


        [$accounts1, $accounts2] = $this->getAccountsByType($pro_type);

        return view('multi-vouchers.create', compact('accounts1', 'accounts2', 'pro_type', 'ptext', 'employees', 'newProId'));
    }

    private function getAccountsByType($type)
    {
        $query = fn() => \App\Models\AccHead::where('isdeleted', 0)->where('is_basic', 0);

        switch ($type) {
            case 32:
                return [
                    $query()->where('is_fund', 1)->get(),
                    $query()->get()
                ];

            case 33:
                return [
                    $query()->get(),
                    $query()->where('is_fund', 1)->get()
                ];

            case 40:
                return [
                    $query()->where('employees_expensses', 1)->get(),
                    $query()->where('code', 'like', '213%')->get(),
                ];

            case 41:
                return [
                    $query()->where('employees_expensses', 1)->get(),
                    $query()->where('code', 'like', '213%')->get(),
                ];

            case 42:
            case 43:
            case 44:
                return [
                    $query()->where('code', 'like', '213%')->get(),
                    $query()->where('employees_expensses', 1)->get(),
                ];

            case 45:
                return [
                    $query()->where('code', 'like', '122%')->get(),
                    $query()->where('code', 'like', '321%')->get()
                ];

            case 46:
                return [
                    $query()->where('code', 'like', '44%')->get(),
                    $query()->get()
                ];

            case 47:
                return [
                    $query()->where('code', 'like', '321%')->get(),
                    $query()->get()
                ];

            case 48:
                return [
                    $query()->where('code', 'like', '124%')->get(),
                    $query()->where('code', 'like', '44%')->get(),
                ];

            case 49:
                return [
                    $query()->where('code', 'like', '122%')->get(),
                    $query()->where('code', 'like', '321%')->get()
                ];

            case 50:
                return [
                    $query()->where('code', 'like', '11%')->get(),
                    $query()->get()
                ];

            case 51:
            case 52:
            case 53:
                return [
                    $query()->get(),
                    $query()->where('code', 'like', '11%')->get()
                ];

            case 54:
                return [
                    $query()->where('code', 'like', '11%')->get(),
                    $query()->get()
                ];

            case 55:
                return [
                    $query()->where('code', '223')->get(),
                    $query()->where('code', 'like', '224%')->get()
                ];

            default:
                abort(404, 'نوع العملية غير مدعوم');
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'pro_date'      => 'required|date',
            'details'       => 'string|max:255',
            'sub_value'     => 'required|array|min:1',
            'sub_value.*'   => 'nullable|numeric|min:0',
            'note.*'        => 'nullable|string|max:255',
            'acc1'          => 'nullable|array',
            'acc1.*'        => 'nullable|exists:acc_head,id',
            'acc2'          => 'nullable|array',
            'acc2.*'        => 'nullable|exists:acc_head,id',
        ]);

        try {
            DB::beginTransaction();

            $pro_type = $request->pro_type;

            // تحديد رقم العملية الجديد
            $lastProId = OperHead::where('pro_type', $pro_type)->max('pro_id') ?? 0;
            $newProId = $lastProId + 1;

            // حساب القيمة الكلية
            $pro_value = collect($request->sub_value)
                ->filter(fn($v) => floatval($v) > 0)
                ->sum();

            // إنشاء رأس العملية
            $operHead = OperHead::create([
                'pro_id'      => $newProId,
                'pro_date'    => $request->pro_date,
                'pro_type'    => $pro_type,
                'pro_value'   => $pro_value,
                'details'     => $request->details ?? null,
                'pro_serial'  => $request->pro_serial ?? null,
                'pro_num'     => $request->pro_num ?? null,
                'branch'      => 1,
                'is_finance'  => 1,
                'is_journal'  => 1,
                'emp_id'      => $request->emp_id,
                'cost_center' => $request->cost_center ?? null,
                'user'        => Auth::id(),
            ]);

            // إنشاء رأس القيد
            $lastJournalId = JournalHead::max('journal_id') ?? 0;
            $newJournalId = $lastJournalId + 1;

            $journalHead = JournalHead::create([
                'journal_id' => $newJournalId,
                'total'      => $pro_value,
                'date'       => $request->pro_date,
                'op_id'      => $operHead->id,
                'pro_type'   => $pro_type,
                'details'    => $request->details,
                'user'       => Auth::id(),
            ]);

            // القوائم الخاصة بأنواع العمليات
            $account1_types = ['32', '40', '41', '46', '47', '50', '53', '55'];
            $account2_types = ['33', '42', '43', '44', '45', '48', '49', '51', '52', '54'];

            // الحساب الرئيسي
            $mainAcc = null;
            $mainIsDebit = null;

            if (in_array($pro_type, $account1_types)) {
                $mainAcc = $request->acc1[0] ?? null;
                $mainIsDebit = true;
            } elseif (in_array($pro_type, $account2_types)) {
                $mainAcc = $request->acc2[0] ?? null;
                $mainIsDebit = false;
            }

            if ($mainAcc) {
                JournalDetail::create([
                    'journal_id' => $journalHead->id,
                    'account_id' => $mainAcc,
                    'debit'      => $mainIsDebit ? $pro_value : 0,
                    'credit'     => $mainIsDebit ? 0 : $pro_value,
                    'op_id'      => $operHead->id,
                    'type'       => $mainIsDebit ? 0 : 1,
                    'info'       => null,
                    'isdeleted'  => 0,
                ]);
            }

            // الحسابات الفرعية
            foreach ($request->sub_value as $index => $value) {
                $value = floatval($value);
                if ($value <= 0) continue;

                $acc_id = null;
                $debit = 0;
                $credit = 0;
                $type = null;

                if (in_array($pro_type, $account1_types)) {
                    $acc_id = $request->acc2[$index] ?? null;
                    $debit = 0;
                    $credit = $value;
                    $type = 1;
                } elseif (in_array($pro_type, $account2_types)) {
                    $acc_id = $request->acc1[$index] ?? null;
                    $debit = $value;
                    $credit = 0;
                    $type = 0;
                }

                if (!$acc_id) continue;

                JournalDetail::create([
                    'journal_id' => $journalHead->id,
                    'account_id' => $acc_id,
                    'debit'      => $debit,
                    'credit'     => $credit,
                    'op_id'      => $operHead->id,
                    'type'       => $type,
                    'info'       => $request->note[$index] ?? null,
                    'isdeleted'  => 0,
                ]);
            }

            DB::commit();

            return redirect()->route('multi-vouchers.index')
                ->with('success', 'تم حفظ القيد بنجاح.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'حدث خطأ أثناء حفظ البيانات: ' . $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $oper = OperHead::findOrFail($id);
        $journal = JournalHead::where('op_id', $id)->firstOrFail();
        $details = JournalDetail::where('journal_id', $journal->journal_id)->get();
        $accounts = AccHead::where('is_basic', '0')
            ->get();
        $costCenters = CostCenter::all();
        $employees = AccHead::where('code', 'like', '213%')
            ->where('is_basic', '0')
            ->get();

        return view('multi-vouchers.edit', compact('oper', 'journal', 'details', 'accounts', 'costCenters', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $totalDebit = collect($request->debit)->sum();
        $totalCredit = collect($request->credit)->sum();

        if (number_format($totalDebit, 2) !== number_format($totalCredit, 2)) {
            return back()->withErrors(['error' => 'يجب أن تتساوى المجاميع المدينة والدائنة.'])->withInput();
        }

        $request->validate([
            'pro_type'    => 'required|integer',
            'pro_date'    => 'required|date',
            'account_id'  => 'required|array',
            'debit'       => 'required|array',
            'credit'      => 'required|array',
        ]);

        try {
            DB::beginTransaction();

            // تحديث رأس القيد في oper_heads
            $oper = OperHead::findOrFail($id);
            $oper->update([
                'info'          => $request->info,
                'info2'         => $request->info2,
                'info3'         => $request->info3,
                'details'       => $request->details,
                'pro_date'      => $request->pro_date,
                'pro_num'       => $request->pro_num,
                'emp_id'        => $request->emp_id,
                'pro_value'     => $totalDebit,
                'cost_center'   => $request->cost_center,
                'user'          => Auth::user()->id,
                'pro_type'      => $request->pro_type,
            ]);

            // حذف journal_head القديم إن وجد
            $journalHead = JournalHead::where('op_id', $oper->id)->first();
            if ($journalHead) {
                JournalDetail::where('journal_id', $journalHead->journal_id)->delete();
                $journalHead->delete();
            }

            // إنشاء journal_head الجديد
            $newJournalId = JournalHead::max('journal_id') + 1;

            $journalHead = JournalHead::create([
                'journal_id' => $newJournalId,
                'total'      => $totalDebit,
                'date'       => $request->pro_date,
                'op_id'      => $oper->id,
                'pro_type'   => $request->pro_type,
                'details'    => $request->details,
                'user'       => Auth::user()->id,
            ]);

            // إنشاء journal_details الجديد
            foreach ($request->account_id as $i => $accId) {
                if ((!$accId || ($request->debit[$i] == 0 && $request->credit[$i] == 0))) {
                    continue;
                }

                JournalDetail::create([
                    'journal_id' => $newJournalId,
                    'account_id' => $accId,
                    'debit'      => $request->debit[$i] ?? 0,
                    'credit'     => $request->credit[$i] ?? 0,
                    'type'       => ($request->debit[$i] > 0) ? 0 : 1,
                    'info'       => $request->note[$i] ?? null,
                    'op_id'      => $oper->id,
                    'isdeleted'  => 0,
                ]);
            }

            DB::commit();

            return redirect()->route('multi-vouchers.index')->with('success', 'تم تعديل القيد المتعدد بنجاح');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'خطأ في التعديل: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            // جلب رأس القيد من جدول oper_heads
            $oper = OperHead::findOrFail($id);

            // حذف journal_head المرتبط (إن وُجد)
            $journalHead = JournalHead::where('op_id', $oper->id)->first();

            if ($journalHead) {
                // حذف التفاصيل المرتبطة به
                JournalDetail::where('journal_id', $journalHead->journal_id)->delete();
                $journalHead->delete();
            }

            // حذف الرأس من جدول oper_heads
            $oper->delete();

            DB::commit();

            return redirect()->route('multi-vouchers.index')->with('success', 'تم حذف القيد بنجاح.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'حدث خطأ أثناء الحذف: ' . $e->getMessage()]);
        }
    }
}
