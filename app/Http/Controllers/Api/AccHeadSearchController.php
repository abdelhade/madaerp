<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Modules\Accounts\Models\AccHead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AccHeadSearchController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        try {
            // ✅ Debug: تسجيل جميع المعاملات الواردة
            $query = $request->get('search', '');
            $type = (int) $request->get('type', 0);
            $branchId = (int) $request->get('branch_id', 0);
            
            // ✅ Debug: تسجيل كل شيء
            Log::info('AccHeadSearchController::search - Request Data', [
                'search' => $query,
                'type' => $type,
                'branch_id' => $branchId,
                'all_params' => $request->all(),
                'query_string' => $request->getQueryString(),
                'full_url' => $request->fullUrl(),
            ]);
            
            // ✅ تحديد branch_id النهائي
            $user = Auth::user();
            $finalBranchId = $branchId > 0 
                ? $branchId 
                : (session('branch_id') ?? ($user?->branch_id ?? 1));
            
            // ✅ التحقق من أن branch_id موجود في branches المستخدم
            if ($user instanceof User) {
                // العلاقة branches() معرفة في User model (line 74-77)
                $userBranchIds = $user->branches()
                    ->where('is_active', 1)
                    ->pluck('branches.id')
                    ->toArray();
                
                // إذا كان branch_id الممرر غير موجود في branches المستخدم، نستخدم أول branch
                if (!empty($userBranchIds) && !in_array($finalBranchId, $userBranchIds)) {
                    $finalBranchId = $userBranchIds[0];
                    Log::warning('AccHeadSearchController::search - Branch ID not in user branches', [
                        'requested_branch_id' => $branchId,
                        'user_branches' => $userBranchIds,
                        'using_branch_id' => $finalBranchId,
                    ]);
                }
            }
            
            // ✅ استخدام withoutGlobalScopes لتجاوز BranchScope مؤقتاً
            // لأننا نريد التحكم في branch_id يدوياً
            $accountsQuery = AccHead::withoutGlobalScopes()
                ->where('isdeleted', 0)
                ->where('is_basic', 0)
                ->where('branch_id', $finalBranchId);
            
            // ✅ فلترة حسب نوع الفاتورة (نوع الحساب)
            // ملاحظة: إذا كان type = 0 أو غير معرف، نعرض كل الحسابات (للاختبار)
            if ($type > 0) {
                if (in_array($type, [10, 12, 14, 16, 22, 26])) {
                    // عملاء (Clients) - الكود يبدأ بـ 1103
                    $accountsQuery->where('code', 'like', '1103%');
                } elseif (in_array($type, [11, 13, 15, 17, 25])) {
                    // موردين (Suppliers) - الكود يبدأ بـ 2101
                    $accountsQuery->where('code', 'like', '2101%');
                } elseif ($type == 21) {
                    // تحويل من مخزن (المخازن) - الكود يبدأ بـ 1107
                    $accountsQuery->where('code', 'like', '1107%');
                }
            }
            
            // ✅ البحث في الكود والاسم
            if (!empty($query)) {
                $accountsQuery->where(function ($q) use ($query) {
                    $q->where('code', 'like', "%{$query}%")
                      ->orWhere('aname', 'like', "%{$query}%");
                    
                    // إذا كان البحث رقم، جرب البحث في ID
                    if (is_numeric($query)) {
                        $q->orWhere('id', (int) $query);
                    }
                });
            }
            
            // ✅ Debug: تسجيل SQL Query
            $sql = $accountsQuery->toSql();
            $bindings = $accountsQuery->getBindings();
            Log::info('AccHeadSearchController::search - SQL Query', [
                'sql' => $sql,
                'bindings' => $bindings,
            ]);
            
            // ✅ جلب النتائج مع حد أقصى
            $accounts = $accountsQuery
                ->select('id', 'code', 'aname')
                ->orderBy('aname')
                ->limit(50)
                ->get();
            
            // ✅ Debug: تسجيل عدد النتائج
            $accountsCount = $accounts->count();
            Log::info('AccHeadSearchController::search - Results Count', [
                'count' => $accountsCount,
                'first_item' => $accounts->first(),
                'sql' => $sql,
                'bindings' => $bindings,
            ]);
            
            // ✅ إذا لم توجد نتائج، نتحقق من البيانات الموجودة
            if ($accountsCount === 0) {
                // جلب عينة من البيانات للتحقق
                $sampleQuery = AccHead::withoutGlobalScopes()
                    ->where('isdeleted', 0)
                    ->where('is_basic', 0)
                    ->where('branch_id', $finalBranchId)
                    ->select('id', 'code', 'aname')
                    ->limit(5)
                    ->get();
                
                Log::warning('AccHeadSearchController::search - No results found', [
                    'type' => $type,
                    'branch_id' => $finalBranchId,
                    'sample_accounts' => $sampleQuery->toArray(),
                    'query' => $query,
                ]);
            }
            
            // ✅ تحويل النتائج إلى الصيغة المطلوبة
            // المكون drpshtiwan/livewire-async-select يتوقع:
            // {'data': [{'id': 1, 'name': 'Text'}]}
            // حيث optionValue='id' و optionLabel='name'
            $formattedAccounts = $accounts->map(function($account) {
                return [
                    'id' => $account->id, // integer (كما هو)
                    'name' => $account->aname . ' (' . $account->code . ')',
                ];
            })->values();
            
            // ✅ Debug: تسجيل النتائج النهائية
            Log::info('AccHeadSearchController::search - Formatted Results', [
                'count' => $formattedAccounts->count(),
                'data' => $formattedAccounts->take(5)->toArray(), // أول 5 فقط للـ log
            ]);
            
            // ✅ إرجاع البيانات - التأكد من أن الصيغة صحيحة
            // المكون يتوقع array مباشر أو {'data': [...]}
            $responseData = $formattedAccounts->toArray();
            
            // ✅ Debug: التحقق من صيغة البيانات
            Log::info('AccHeadSearchController::search - Response Format', [
                'data_count' => count($responseData),
                'first_item_structure' => $responseData[0] ?? null,
                'has_id' => isset($responseData[0]['id']),
                'has_name' => isset($responseData[0]['name']),
            ]);
            
            // ✅ إرجاع البيانات بصيغة المكون المتوقع
            $response = [
                'data' => $responseData,
            ];
            
            // ✅ إضافة debug فقط في development
            if (config('app.debug')) {
                $response['debug'] = [
                    'search' => $query,
                    'type' => $type,
                    'branch_id' => $branchId,
                    'final_branch_id' => $finalBranchId,
                    'count' => $formattedAccounts->count(),
                    'response_format' => 'data array',
                ];
            }
            
            // ✅ التأكد من Content-Type
            return response()->json($response, 200, [
                'Content-Type' => 'application/json',
                'Cache-Control' => 'no-cache',
            ]);
            
        } catch (\Exception $e) {
            // ✅ Debug: تسجيل الأخطاء
            Log::error('AccHeadSearchController::search - Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);
            
            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'debug' => [
                    'message' => 'حدث خطأ أثناء البحث',
                ],
            ], 500);
        }
    }
}
