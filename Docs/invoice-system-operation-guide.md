# دليل تشغيل نظام الفواتير (Invoice System Operation Guide)

## جدول المحتويات
1. [نظرة عامة](#نظرة-عامة)
2. [أنواع الفواتير](#أنواع-الفواتير)
3. [مكونات النظام](#مكونات-النظام)
4. [عملية إنشاء الفاتورة](#عملية-إنشاء-الفاتورة)
5. [عملية حفظ الفاتورة](#عملية-حفظ-الفاتورة)
6. [القيود المحاسبية](#القيود-المحاسبية)
7. [السندات التلقائية](#السندات-التلقائية)
8. [حسابات الصندوق](#حسابات-الصندوق)
9. [الواجهات والملفات الرئيسية](#الواجهات-والملفات-الرئيسية)

---

## نظرة عامة

نظام الفواتير هو نظام متكامل لإدارة جميع أنواع الفواتير في النظام (مبيعات، مشتريات، مخزون، خدمات). يعمل النظام على إنشاء الفواتير وحفظها مع إنشاء القيود المحاسبية تلقائياً.

### المميزات الرئيسية:
- دعم 16 نوع مختلف من الفواتير
- حساب تلقائي للخصومات والإضافات والضرائب
- إنشاء قيود محاسبية تلقائية
- إنشاء سندات قبض/دفع تلقائية
- دعم العملات المتعددة
- دعم قوالب الفواتير (Templates)
- التحقق من المخزون قبل البيع
- إعادة حساب متوسط التكلفة تلقائياً

---

## أنواع الفواتير

### فواتير المبيعات (Sales Management)
| النوع | الكود | الاسم | وصف |
|------|------|------|-----|
| 10 | Sales Invoice | فاتورة مبيعات | فاتورة بيع للعملاء |
| 12 | Sales Return | مردود مبيعات | إرجاع بضاعة من العميل |
| 14 | Sales Order | طلب مبيعات | طلب بيع (غير محاسبي) |
| 16 | Quotation to Customer | عرض سعر للعميل | عرض أسعار |
| 22 | Booking Order | طلب حجز | حجز بضاعة |
| 26 | Pricing Agreement | اتفاقية أسعار | اتفاقية أسعار مع عميل |

### فواتير المشتريات (Purchases Management)
| النوع | الكود | الاسم | وصف |
|------|------|------|-----|
| 11 | Purchase Invoice | فاتورة مشتريات | فاتورة شراء من المورد |
| 13 | Purchase Return | مردود مشتريات | إرجاع بضاعة للمورد |
| 15 | Purchase Order | طلب مشتريات | طلب شراء (غير محاسبي) |
| 17 | Quotation from Supplier | عرض سعر من المورد | عرض أسعار من المورد |
| 24 | Service Invoice | فاتورة خدمات | فاتورة خدمات |
| 25 | Requisition | طلب توريد | طلب توريد |

### فواتير المخزون (Inventory Management)
| النوع | الكود | الاسم | وصف |
|------|------|------|-----|
| 18 | Damaged Goods Invoice | فاتورة توالف | تلف بضاعة |
| 19 | Dispatch Order | أمر صرف | صرف من المخزن |
| 20 | Addition Order | أمر إضافة | إضافة للمخزن |
| 21 | Store-to-Store Transfer | تحويل بين مخازن | نقل بين مخازن |

---

## مكونات النظام

### 1. Controllers

#### `InvoiceController.php`
الكونترولر الرئيسي للواجهة التقليدية (Web Interface)
- **الوظائف الرئيسية:**
  - `index()` - عرض قائمة الفواتير
  - `create()` - عرض صفحة إنشاء فاتورة جديدة
  - `store()` - حفظ فاتورة جديدة
  - `show()` - عرض تفاصيل فاتورة
  - `edit()` - عرض صفحة تعديل فاتورة
  - `destroy()` - حذف فاتورة
  - `print()` - طباعة فاتورة

#### `InvoiceApiController.php`
الكونترولر الخاص بواجهة API (للاستخدام مع JavaScript)
- **الوظائف الرئيسية:**
  - `getCreateData()` - جلب البيانات الأولية لإنشاء فاتورة
  - `getEditData()` - جلب بيانات فاتورة للتعديل
  - `searchItems()` - البحث عن الأصناف
  - `getItemForInvoice()` - جلب بيانات صنف للفاتورة
  - `store()` - حفظ فاتورة (API)
  - `update()` - تحديث فاتورة (API)
  - `getAccountBalance()` - جلب رصيد حساب
  - `getAccountCurrency()` - جلب عملة حساب

### 2. Services

#### `SaveInvoiceService.php`
الخدمة الرئيسية لحفظ الفواتير
- **الوظائف الرئيسية:**
  - `saveInvoice()` - حفظ/تحديث فاتورة
  - `createOperation()` - إنشاء سجل العملية (OperHead)
  - `createOperationItems()` - إنشاء أصناف الفاتورة
  - `createJournalEntries()` - إنشاء القيود المحاسبية
  - `createVoucher()` - إنشاء سند قبض/دفع تلقائي
  - `syncJournalEntries()` - مزامنة القيود عند التعديل

#### `DetailValueCalculator.php`
حاسبة قيم الأصناف مع الخصومات والإضافات
- حساب `detail_value` لكل صنف مع مراعاة:
  - الخصم على الصنف
  - الخصم على الفاتورة
  - الإضافة على الفاتورة
  - الضريبة المضافة (VAT)
  - ضريبة الاستقطاع (Withholding Tax)

#### `DetailValueValidator.php`
التحقق من صحة القيم المحسوبة

### 3. Views

#### `create.blade.php`
الصفحة الرئيسية لإنشاء فاتورة جديدة

#### `create-header.blade.php`
رأس الفاتورة (Header)
- اختيار الفرع
- اختيار المخزن (acc2)
- اختيار العميل/المورد (acc1)
- اختيار العملة
- عرض الرصيد
- اختيار نمط الفاتورة (Template)
- اختيار الموظف
- اختيار نوع السعر
- التواريخ والأرقام

#### `create-items-table.blade.php`
جدول الأصناف
- صف الإدخال (Input Row)
- صفوف الأصناف المضافة
- صف الإجمالي (Footer)
- دعم القوالب (Templates) لتخصيص الأعمدة

#### `create-footer.blade.php`
تذييل الفاتورة (Footer)
- مربع الإجماليات والخصومات
- مربع الدفع والملاحظات
- مربع بيانات الصنف المحدد
- مربع الملخص وأزرار الحفظ

---

## عملية إنشاء الفاتورة

### الخطوة 1: الوصول لصفحة الإنشاء
```
GET /invoices/create?type={type}&q={hash}
```

**المعاملات:**
- `type`: نوع الفاتورة (10, 11, 12, ...)
- `q`: hash للتحقق من الأمان (md5(type))

**التحقق:**
- التحقق من صلاحية المستخدم (`create {invoice_type}`)
- التحقق من صحة الـ hash

### الخطوة 2: جلب البيانات الأولية
يتم استدعاء `InvoiceApiController::getCreateDataArray()` الذي يقوم بـ:

1. **جلب الحسابات:**
   - `acc1_list`: العملاء/الموردين حسب نوع الفاتورة
   - `acc2_list`: المخازن
   - `employees`: الموظفين
   - `cash_accounts`: حسابات الصندوق والبنوك

2. **جلب الأصناف:**
   - أنواع الأسعار (`price_types`)
   - القوالب المتاحة (`available_templates`)

3. **جلب الإعدادات:**
   - نسب الضرائب الافتراضية
   - إعدادات العملات المتعددة
   - إعدادات التحقق من المخزون

4. **حساب الأرقام:**
   - `next_pro_id`: رقم الفاتورة التالي

### الخطوة 3: ملء بيانات الفاتورة

#### أ. اختيار الحسابات
- **acc1 (العميل/المورد):**
  - فواتير المبيعات (10, 12, 14, 16, 22, 26): عملاء (كود يبدأ بـ 1103%)
  - فواتير المشتريات (11, 13, 15, 17, 25): موردين (كود يبدأ بـ 2101%)
  - فواتير التوالف (18): حسابات توالف (كود يبدأ بـ 55%)
  - فواتير الصرف/الإضافة (19, 20): حسابات عامة (كود يبدأ بـ 1108%)
  - فواتير التحويل (21): مخازن (كود يبدأ بـ 1104%)
  - فواتير الخدمات (24): حسابات مصاريف (كود يبدأ بـ 5%)

- **acc2 (المخزن):**
  - معظم الفواتير: مخازن (كود يبدأ بـ 1104%)
  - فواتير الخدمات (24): موردين

- **cash_accounts (حسابات الصندوق):**
  - صندوق نقدي (acc_type = 3)
  - بنوك (acc_type = 4)

#### ب. إضافة الأصناف
1. البحث عن الصنف (Search)
2. اختيار الصنف من النتائج
3. تحديد الكمية والوحدة
4. تحديد السعر (يمكن تعديله)
5. تحديد الخصم (إن وجد)
6. إضافة الصنف للجدول

**حساب السعر:**
- فواتير المشتريات (11, 15): آخر سعر شراء أو متوسط التكلفة
- فواتير التوالف (18): متوسط التكلفة
- فواتير المبيعات (10): سعر البيع من قائمة الأسعار
- يمكن استخدام اتفاقية الأسعار (26) أو آخر سعر للعميل

#### ج. حساب الإجماليات
يتم الحساب في JavaScript (Alpine.js):

```
subtotal = sum(item.quantity * item.price - item.discount)

discount_value = subtotal * (discount_percentage / 100) + manual_discount_value
total_after_discount = subtotal - discount_value

additional_value = total_after_discount * (additional_percentage / 100) + manual_additional_value
total_after_additional = total_after_discount + additional_value

vat_value = total_after_additional * (vat_percentage / 100)
withholding_tax_value = total_after_additional * (withholding_tax_percentage / 100)

final_total = total_after_additional + vat_value - withholding_tax_value
```

#### د. تحديد الدفع
- **received_from_client**: المبلغ المدفوع
- **cash_account_id**: حساب الصندوق المستخدم
- **remaining**: المبلغ المتبقي (يُحسب تلقائياً)

---

## عملية حفظ الفاتورة

### الخطوة 1: التحقق من البيانات (Validation)
```php
- type: required|integer
- acc1_id: required|exists:acc_head,id
- acc2_id: required|exists:acc_head,id
- emp_id: nullable|exists:acc_head,id
- pro_date: required|date
- invoice_items: required|array|min:1
- invoice_items.*.item_id: required|exists:items,id
- invoice_items.*.quantity: required|numeric|min:0.001
- invoice_items.*.price: required|numeric|min:0
- subtotal: required|numeric
- total_after_additional: required|numeric
- ... (المزيد من الحقول)
```

### الخطوة 2: التحقق من المخزون (Stock Check)
للفواتير التي تستهلك مخزون (10, 12, 14, 16, 22):
- التحقق من توفر الكمية في المخزن المحدد
- منع البيع إذا كانت الكمية غير متوفرة (ما لم يكن للمستخدم صلاحية `prevent_transactions_without_stock`)

### الخطوة 3: حفظ الفاتورة (SaveInvoiceService)

#### أ. إنشاء سجل العملية (OperHead)
```php
OperHead::create([
    'pro_type' => $component->type,
    'pro_id' => $component->pro_id,
    'pro_date' => $component->pro_date,
    'accural_date' => $component->accural_date,
    'pro_serial' => $component->serial_number,
    'acc1' => $component->acc1_id,
    'acc2' => $component->acc2_id,
    'emp_id' => $component->emp_id,
    'pro_value' => $component->total_after_additional,
    'fat_total' => $component->subtotal,
    'fat_disc' => $component->discount_value,
    'fat_disc_per' => $component->discount_percentage,
    'fat_plus' => $component->additional_value,
    'fat_plus_per' => $component->additional_percentage,
    'fat_net' => $component->total_after_additional,
    'vat_percentage' => $component->vat_percentage,
    'vat_value' => $component->vat_value,
    'withholding_tax_percentage' => $component->withholding_tax_percentage,
    'withholding_tax_value' => $component->withholding_tax_value,
    'paid_from_client' => $component->received_from_client,
    'info' => $component->notes,
    'is_journal' => $isJournal,
    'is_stock' => $isStock,
    'user' => Auth::id(),
    'branch_id' => $component->branch_id,
    'currency_id' => $component->currency_id,
    'currency_rate' => $component->currency_rate,
]);
```

#### ب. إنشاء أصناف الفاتورة (OperationItems)
لكل صنف في الفاتورة:
```php
OperationItems::create([
    'pro_id' => $operation->id,
    'item_id' => $item['item_id'],
    'unit_id' => $unitId,
    'qty_in' => $qtyIn,
    'qty_out' => $qtyOut,
    'item_price' => $itemPrice,
    'item_discount' => $itemDiscount,
    'detail_value' => $detailValue, // محسوب بواسطة DetailValueCalculator
    'detail_store' => $component->acc2_id,
    'is_stock' => $isStock,
    'cost_price' => $costPrice,
    // ... (المزيد من الحقول)
]);
```

**حساب detail_value:**
يتم حساب `detail_value` لكل صنف باستخدام `DetailValueCalculator`:
- يأخذ في الاعتبار الخصم على الصنف
- يأخذ في الاعتبار الخصم على الفاتورة (نسبة من subtotal)
- يأخذ في الاعتبار الإضافة على الفاتورة (نسبة من total_after_discount)

#### ج. إنشاء القيود المحاسبية (Journal Entries)
للفواتير التي تحتاج قيود محاسبية (10, 11, 12, 13, 18, 19, 20, 21, 24):

**إنشاء JournalHead:**
```php
JournalHead::create([
    'journal_id' => $journalId, // يتم توليده تلقائياً
    'total' => $component->total_after_additional,
    'op_id' => $operation->id,
    'pro_type' => $component->type,
    'date' => $component->pro_date,
    'details' => $component->notes,
    'user' => Auth::id(),
    'branch_id' => $component->branch_id,
]);
```

**إنشاء JournalDetail:**
حسابات مدين/دائن حسب نوع الفاتورة:

| النوع | الحساب المدين | الحساب الدائن |
|------|---------------|---------------|
| 10 (مبيعات) | acc1 (العميل) | 47 (إيرادات المبيعات) |
| 11 (مشتريات) | acc2 (المخزن) | acc1 (المورد) |
| 12 (مردود مبيعات) | 48 (مردودات المبيعات) | acc1 (العميل) |
| 13 (مردود مشتريات) | acc1 (المورد) | acc2 (المخزن) |
| 18 (توالف) | acc1 (حساب التوالف) | acc2 (المخزن) |
| 19 (صرف) | acc1 (حساب الصرف) | acc2 (المخزن) |
| 20 (إضافة) | acc2 (المخزن) | acc1 (حساب الإضافة) |
| 21 (تحويل) | acc2 (المخزن المستقبل) | acc1 (المخزن المرسل) |
| 24 (خدمات) | acc1 (حساب المصروف) | acc2 (المورد) |

```php
JournalDetail::create([
    'journal_id' => $journalId,
    'account_id' => $debitAccount,
    'debit' => $total,
    'credit' => 0,
]);

JournalDetail::create([
    'journal_id' => $journalId,
    'account_id' => $creditAccount,
    'debit' => 0,
    'credit' => $total,
]);
```

#### د. إنشاء السند التلقائي (Voucher)
إذا كان هناك دفع (`received_from_client > 0`) وتم تحديد `cash_account_id`:

**سند قبض (Receipt Voucher - pro_type = 1):**
- للفواتير: 10 (مبيعات), 22 (حجز), 13 (مردود مشتريات)
- المدين: حساب الصندوق (`cash_account_id`)
- الدائن: حساب العميل/المورد (`acc1_id`)

**سند دفع (Payment Voucher - pro_type = 2):**
- للفواتير: 11 (مشتريات), 12 (مردود مبيعات)
- المدين: حساب المورد/العميل (`acc1_id`)
- الدائن: حساب الصندوق (`cash_account_id`)

```php
OperHead::create([
    'pro_type' => $proType, // 1 للقبض، 2 للدفع
    'pro_id' => $operation->pro_id,
    'acc1' => $component->acc1_id,
    'acc2' => $cashBoxId,
    'pro_value' => $voucherValue,
    'pro_date' => $component->pro_date,
    'info' => 'سند '.$voucherType.' آلي مرتبط بعملية رقم '.$operation->id,
    'op2' => $operation->id, // ربط بالسند الأصلي
    'is_journal' => 1,
    'is_stock' => 0,
    // ...
]);
```

---

## القيود المحاسبية

### أنواع القيود حسب نوع الفاتورة

#### فواتير المبيعات (10)
```
من حـ/ العميل (acc1)        إلى حـ/ إيرادات المبيعات (47)
```

#### فواتير المشتريات (11)
```
من حـ/ المخزن (acc2)        إلى حـ/ المورد (acc1)
```

#### مردودات المبيعات (12)
```
من حـ/ مردودات المبيعات (48)    إلى حـ/ العميل (acc1)
```

#### مردودات المشتريات (13)
```
من حـ/ المورد (acc1)        إلى حـ/ المخزن (acc2)
```

#### فواتير التوالف (18)
```
من حـ/ حساب التوالف (acc1)    إلى حـ/ المخزن (acc2)
```

#### أوامر الصرف (19)
```
من حـ/ حساب الصرف (acc1)    إلى حـ/ المخزن (acc2)
```

#### أوامر الإضافة (20)
```
من حـ/ المخزن (acc2)        إلى حـ/ حساب الإضافة (acc1)
```

#### التحويلات (21)
```
من حـ/ المخزن المستقبل (acc2)    إلى حـ/ المخزن المرسل (acc1)
```

---

## السندات التلقائية

### متى يتم إنشاء السند التلقائي؟
- عندما يكون `received_from_client > 0`
- عندما يتم تحديد `cash_account_id`

### أنواع السندات

#### 1. سند قبض (Receipt Voucher - pro_type = 1)
**للفواتير:**
- 10 (مبيعات)
- 22 (حجز)
- 13 (مردود مشتريات)

**القيود:**
```
من حـ/ الصندوق (cash_account_id)    إلى حـ/ العميل/المورد (acc1_id)
```

#### 2. سند دفع (Payment Voucher - pro_type = 2)
**للفواتير:**
- 11 (مشتريات)
- 12 (مردود مبيعات)

**القيود:**
```
من حـ/ المورد/العميل (acc1_id)    إلى حـ/ الصندوق (cash_account_id)
```

### ربط السند بالفاتورة
- يتم ربط السند بالفاتورة الأصلية عبر `op2 = operation.id`
- يمكن الوصول للسند من الفاتورة والعكس

---

## حسابات الصندوق

### تعريف حسابات الصندوق
حسابات الصندوق هي الحسابات التي تستخدم للدفع والقبض النقدي:
- **صندوق نقدي (Cash Box)**: `acc_type = 3`
- **بنوك (Banks)**: `acc_type = 4`

### جلب حسابات الصندوق
```php
$cashAccounts = AccHead::where('isdeleted', 0)
    ->where('is_basic', 0)
    ->whereIn('acc_type', [3, 4])
    ->orderBy('acc_type') // صندوق نقدي أولاً
    ->orderBy('code')
    ->get();
```

### استخدام حسابات الصندوق
- يتم اختيار حساب الصندوق من القائمة المنسدلة في Footer
- عند الحفظ، يتم تحويل `cash_account_id` إلى `cash_box_id` في `SaveInvoiceService`
- إذا كان هناك دفع (`received_from_client > 0`)، يتم إنشاء سند تلقائي

### ملاحظات مهمة
- فواتير التحويل (21) لا تحتاج حسابات صندوق
- يمكن ترك `cash_account_id` فارغاً إذا لم يكن هناك دفع فوري
- السند التلقائي يُنشأ فقط عند وجود دفع وحساب صندوق

---

## الواجهات والملفات الرئيسية

### Routes
```php
// Web Routes
GET  /invoices/create?type={type}&q={hash}
POST /invoices
GET  /invoices/{id}
GET  /invoices/{id}/edit
DELETE /invoices/{id}
GET  /invoices/{id}/print

// API Routes
GET  /api/invoices/create-data?type={type}
GET  /api/invoices/edit-data/{id}
POST /api/invoices/search-items
GET  /api/invoices/get-item
POST /api/invoices
PUT  /api/invoices/{id}
GET  /api/invoices/account-balance/{accountId}
GET  /api/invoices/account-currency/{accountId}
```

### Models
- `OperHead`: سجل العملية (الفاتورة)
- `OperationItems`: أصناف الفاتورة
- `JournalHead`: رأس القيد المحاسبي
- `JournalDetail`: تفاصيل القيد المحاسبي
- `AccHead`: الحسابات
- `Item`: الأصناف
- `InvoiceTemplate`: قوالب الفواتير

### JavaScript Files
- `create.blade.php` يحتوي على Alpine.js components
- `item-search-input.blade.php`: مكون البحث عن الأصناف
- الحسابات تتم في JavaScript (Alpine.js)

### Database Tables
- `oper_head`: جدول الفواتير
- `operation_items`: جدول أصناف الفواتير
- `journal_head`: جدول رؤوس القيود
- `journal_details`: جدول تفاصيل القيود
- `acc_head`: جدول الحسابات
- `items`: جدول الأصناف
- `invoice_templates`: جدول قوالب الفواتير

---

## ملاحظات مهمة

### الأمان والصلاحيات
- كل نوع فاتورة له صلاحية منفصلة:
  - `create {invoice_type}`
  - `view {invoice_type}`
  - `edit {invoice_type}`
  - `delete {invoice_type}`
  - `print {invoice_type}`

### المعاملات (Transactions)
- جميع عمليات الحفظ تتم داخل `DB::transaction()`
- في حالة الخطأ، يتم عمل `rollback` تلقائياً

### إعادة الحساب (Recalculation)
- عند حذف فاتورة، يتم إعادة حساب:
  - متوسط التكلفة (Average Cost) للأصناف المتأثرة
  - الأرباح والقيود للفواتير المتأثرة

### العملات المتعددة
- النظام يدعم العملات المتعددة
- كل حساب يمكن أن يكون له عملة خاصة
- يتم حفظ `currency_id` و `currency_rate` في الفاتورة

### القوالب (Templates)
- يمكن تخصيص أعمدة جدول الأصناف
- كل قالب يحتوي على:
  - `visible_columns`: الأعمدة المرئية
  - `column_widths`: عرض كل عمود
  - `column_order`: ترتيب الأعمدة

---

## أمثلة عملية

### مثال 1: إنشاء فاتورة مبيعات
1. الوصول: `/invoices/create?type=10&q=...`
2. اختيار العميل والمخزن
3. إضافة الأصناف
4. تحديد الخصومات والضرائب
5. تحديد المبلغ المدفوع وحساب الصندوق
6. حفظ الفاتورة
7. يتم إنشاء:
   - سجل العملية (OperHead)
   - أصناف الفاتورة (OperationItems)
   - قيد محاسبي (JournalHead + JournalDetail)
   - سند قبض تلقائي (إن وجد دفع)

### مثال 2: إنشاء فاتورة مشتريات
1. الوصول: `/invoices/create?type=11&q=...`
2. اختيار المورد والمخزن
3. إضافة الأصناف (السعر من آخر سعر شراء)
4. تحديد الخصومات والضرائب
5. تحديد المبلغ المدفوع وحساب الصندوق
6. حفظ الفاتورة
7. يتم إنشاء:
   - سجل العملية
   - أصناف الفاتورة (مع تحديث المخزون)
   - قيد محاسبي
   - سند دفع تلقائي (إن وجد دفع)
   - إعادة حساب متوسط التكلفة

---

## استكشاف الأخطاء

### مشكلة: لا يمكن حفظ الفاتورة
**التحقق من:**
- صلاحيات المستخدم
- صحة البيانات المدخلة
- توفر المخزون (للمبيعات)
- وجود حساب صندوق (إذا كان هناك دفع)

### مشكلة: لا يتم إنشاء القيود المحاسبية
**التحقق من:**
- نوع الفاتورة يدعم القيود (is_journal = 1)
- وجود الحسابات المطلوبة (47, 48, ...)
- صحة البيانات المحاسبية

### مشكلة: لا يتم إنشاء السند التلقائي
**التحقق من:**
- وجود `received_from_client > 0`
- وجود `cash_account_id`
- نوع الفاتورة يدعم السندات (10, 11, 12, 13, 22)

---

## التطوير المستقبلي

### تحسينات مقترحة:
1. دعم الفواتير متعددة العملات بشكل أفضل
2. إضافة تقارير متقدمة للفواتير
3. دعم الفواتير الإلكترونية (E-Invoicing)
4. تحسين واجهة المستخدم
5. إضافة دعم للباركود
6. دعم الفواتير المطبوعة مسبقاً

---

**آخر تحديث:** {{ date('Y-m-d') }}
**الإصدار:** 1.0
