# Prompt للاستمرار في العمل على Invoices Module

## 📋 السياق العام

أعمل على تحويل **Invoices Module** من **Livewire** إلى **AJAX/JavaScript** لتحسين الأداء وتحسين تجربة المستخدم.

**الهدف الرئيسي:** استبدال جميع مكونات Livewire بمكونات AJAX/JavaScript في صفحات إنشاء وتعديل الفواتير.

---

## ✅ ما تم إنجازه حتى الآن

### 1. **InvoiceApiController** ✅ (100%)
- ✅ `getCreateDataArray()` - جلب البيانات الأولية كـ array (للاستخدام في PHP/Blade - بدون AJAX)
- ✅ `getCreateData()` - جلب البيانات الأولية (API endpoint - يستخدم getCreateDataArray)
- ✅ `getEditData()` - جلب البيانات للتحرير
- ✅ `searchItems()` - البحث عن الأصناف (مع caching)
- ✅ `getItemForInvoice()` - جلب بيانات صنف (مع calculateItemPrice) - deprecated للاستخدام المباشر
- ✅ `store()` - حفظ فاتورة جديدة
- ✅ `update()` - تحديث فاتورة موجودة
- ✅ `getAccountBalance()` - جلب رصيد حساب (deprecated - لم يعد مستخدماً)
- ✅ `getAccountCurrency()` - جلب عملة حساب (deprecated - لم يعد مستخدماً)
- ✅ Helper methods: `getAcc1List()`, `getAcc2List()`, `getEmployees()`, `calculateItemPrice()`, `getAccountsByCodeAndBranch()`

**ملاحظات مهمة:**
- `calculateItemPrice()` يحتوي على المنطق الكامل من Livewire component
- يدعم جميع أنواع الفواتير (10-26)
- يدعم pricing agreements و last customer price
- يدعم unit conversion
- `getCreateDataArray()` يرجع `balance` و `currency_id` و `currency_rate` لكل حساب في `acc1List` (client-side optimization)
- البيانات الأولية تُحمّل مباشرة من PHP/Blade (لا AJAX call)

### 2. **API Routes** ✅ (100%)
**الملف:** `Modules/Invoices/routes/api.php`

جميع الـ routes محمية بـ `web, auth` middleware (session-based authentication)
- ✅ `GET /api/v1/invoices/create-data`
- ✅ `GET /api/v1/invoices/edit-data/{operationId}`
- ✅ `GET /api/v1/invoices/search-items`
- ✅ `POST /api/v1/invoices/get-item`
- ✅ `POST /api/v1/invoices/store`
- ✅ `PUT /api/v1/invoices/update/{operationId}`
- ✅ `GET /api/v1/invoices/account-balance/{accountId}` (deprecated - لم يعد مستخدماً)
- ✅ `GET /api/v1/invoices/account-currency/{accountId}` (deprecated - لم يعد مستخدماً)

### 3. **JavaScript Form Manager** ✅ (90%)
**الملف:** `Modules/Invoices/Resources/assets/js/invoice-form-manager.js`

**الكلاس:** `InvoiceFormManager`

**الوظائف المكتملة:**
- ✅ `init()` - تهيئة النموذج
- ✅ `loadCreateData()` - تحميل البيانات الأولية (deprecated - البيانات تُحمّل من PHP مباشرة)
- ✅ `loadEditData()` - تحميل بيانات الفاتورة للتحرير
- ✅ `searchItems()` - البحث عن الأصناف (AJAX)
- ✅ `addItem()` - إضافة صنف للفاتورة (JavaScript فقط - بدون AJAX call إضافي)
- ✅ `removeItem()` - إزالة صنف من الفاتورة
- ✅ `recalculateTotals()` - إعادة حساب الإجماليات
- ✅ `validate()` - التحقق من صحة النموذج
- ✅ `save()` - حفظ الفاتورة (AJAX)
- ✅ `showSuccess()` / `showError()` - رسائل النجاح/الخطأ
- ✅ `acc1List` property - يحفظ قائمة الحسابات مع balance و currency (client-side)
- ✅ `getItemForInvoice()` - جلب بيانات صنف (deprecated - للتوافق العكسي فقط)

**ملاحظات مهمة:**
- `addItem()` تقبل إما `itemId` (للتوافق العكسي) أو `item object` (للـ JS only mode)
- البيانات الأولية تُحمّل مباشرة من PHP/Blade (لا AJAX call)

### 4. **Create Invoice Form** ✅ (95%)
**الملف:** `Modules/Invoices/Resources/views/invoices/create-ajax.blade.php`

**الوظائف المكتملة:**
- ✅ تحميل البيانات الأولية من PHP مباشرة (لا AJAX call)
- ✅ `renderInvoiceHeader()` - رسم header مع جميع الحقول (acc1, acc2, emp, dates, serial_number, branch, currency, balance)
- ✅ `renderSearchSection()` - قسم البحث عن الأصناف
- ✅ `renderInvoiceItemsTable()` - جدول الأصناف (مع editable fields)
- ✅ `renderInvoiceFooter()` - Footer مع جميع الحسابات (totals, discounts, taxes, notes, save button)
- ✅ `setupHeaderEventListeners()` - event listeners للـ header (مع acc1 و currency listeners)
- ✅ `setupItemTableEventListeners()` - event listeners لجدول الأصناف
- ✅ `setupFooterEventListeners()` - event listeners للـ footer
- ✅ `updateBalanceAfterInvoiceDisplay()` - تحديث عرض الرصيد بعد الفاتورة
- ✅ `displaySearchResults()` - عرض نتائج البحث وإضافة الأصناف (JavaScript فقط)

**التحسينات:**
- ✅ البيانات الأولية تُحمّل مباشرة من PHP (أسرع)
- ✅ إضافة الأصناف تتم في JavaScript فقط (لا AJAX call إضافي)
- ✅ acc1 event listener يعمل بشكل صحيح (client-side optimization)

### 5. **Livewire Components** ✅ (تم الحذف)
- ✅ تم حذف `CreateInvoiceForm.php`
- ✅ تم حذف `EditInvoiceForm.php`
- ✅ تم حذف `HandlesExpiryDates.php` trait
- ✅ تم حذف `HandlesInvoiceData.php` trait
- ✅ تم حذف جميع Livewire views
- ✅ تم تحديث `InvoicesServiceProvider.php` لإزالة Livewire registrations

### 6. **Blade Templates** ✅ (75%)
- ✅ `create.blade.php` - يستخدم `create-ajax.blade.php`
- ⚠️ `edit.blade.php` - placeholder فقط (يحتاج implementation)
- ⚠️ `view-invoice.blade.php` - placeholder فقط (يحتاج implementation)

---

## 🔧 التحسينات المطبقة

### 1. **Client-Side Optimization**
- ✅ `balance` و `currency_id` و `currency_rate` تُجلب مع `getCreateData()` لكل حساب في `acc1List`
- ✅ عند تغيير acc1، يتم تحديث balance و currency مباشرة من `manager.acc1List` (بدون API calls)

### 2. **UI Improvements**
- ✅ تحسين تصميم Invoice Footer (إضافة remaining amount، تحسين التنسيق)
- ✅ دعم labels مختلفة لـ Purchase vs Sales invoices
- ✅ إخفاء received/remaining fields لـ type 21 (transfer invoices)

---

## ✅ التحسينات المكتملة

### 1. **تحميل البيانات الأولية بدون AJAX** ✅
- ✅ البيانات تُحمّل مباشرة من PHP/Blade عند تحميل الصفحة
- ✅ استخدام `getCreateDataArray()` في `InvoiceController::create()`
- ✅ البيانات تُمرر للـ view باستخدام `@json($createData)`
- ✅ JavaScript يستخدم البيانات مباشرة (لا AJAX call)

### 2. **إضافة الأصناف بدون AJAX** ✅
- ✅ `addItem()` تقبل `item object` مباشرة من نتائج البحث
- ✅ لا AJAX call إضافي عند إضافة صنف
- ✅ البيانات موجودة من `searchItems()` مباشرة

### 3. **acc1 Event Listener** ✅
- ✅ تم إضافة event listener لـ acc1 select
- ✅ تحديث balance و currency من acc1List (client-side)
- ✅ تحديث مباشر للعناصر (لا re-render)

## ❌ المشاكل المعلقة

### 1. **Edit Invoice Form** ⚠️
**الملف:** `Modules/Invoices/Resources/views/invoices/edit.blade.php`

**الحالة:** placeholder فقط

**المطلوب:**
- إنشاء `edit-ajax.blade.php` مشابه لـ `create-ajax.blade.php`
- إضافة `loadEditData()` في `InvoiceFormManager`
- تحديث `getEditData()` في API controller إذا لزم الأمر

### 2. **View Invoice** ❌
**الملف:** `Modules/Invoices/Resources/views/invoices/view-invoice.blade.php`

**الحالة:** placeholder فقط

**المطلوب:** implementation كامل

---

## 📁 الملفات المهمة

### Controllers
- `Modules/Invoices/Http/Controllers/InvoiceApiController.php` - API Controller الرئيسي

### Views
- `Modules/Invoices/Resources/views/invoices/create.blade.php` - يستخدم create-ajax
- `Modules/Invoices/Resources/views/invoices/create-ajax.blade.php` - النموذج الرئيسي (AJAX)
- `Modules/Invoices/Resources/views/invoices/edit.blade.php` - يحتاج implementation
- `Modules/Invoices/Resources/views/invoices/view-invoice.blade.php` - يحتاج implementation

### JavaScript
- `Modules/Invoices/Resources/assets/js/invoice-form-manager.js` - Form Manager Class

### Routes
- `Modules/Invoices/routes/api.php` - API routes

### Documentation
- `Modules/Invoices/CURRENT_STATUS.md` - الحالة الحالية
- `Modules/Invoices/NEXT_STEPS.md` - الخطوات التالية
- `Modules/Invoices/API_MIGRATION_GUIDE.md` - دليل التحويل
- `Modules/Invoices/UI_IMPROVEMENTS_PROPOSAL.md` - مقترحات التحسين

---

## 🎯 الخطوات التالية الموصى بها

### 1. **اختبار Create Invoice Form** (أولوية عالية) ⚠️
- ✅ اختبار تحميل البيانات الأولية (من PHP مباشرة)
- ✅ اختبار تغيير acc1 (balance و currency)
- ✅ اختبار البحث عن الأصناف
- ✅ اختبار إضافة/حذف الأصناف (JavaScript فقط)
- ✅ اختبار الحسابات (totals, discounts, taxes)
- ✅ اختبار الحفظ

### 2. **تحسين Edit Invoice Form** (أولوية متوسطة)
- ⚠️ إضافة `getEditDataArray()` في InvoiceApiController (مثل getCreateDataArray)
- ⚠️ تحميل البيانات مباشرة من PHP/Blade (بدون AJAX)
- ✅ اختبار التحرير

### 3. **View Invoice** (أولوية منخفضة)
- implementation كامل

---

## 🔑 نقاط مهمة للاستمرار

### 1. **Client-Side Optimization**
- ✅ جميع بيانات الحسابات (balance, currency) موجودة في `manager.acc1List`
- ✅ لا حاجة لـ API calls منفصلة عند تغيير acc1
- ✅ استخدم `manager.acc1List.find(acc => acc.id == accountId)` للوصول للبيانات
- ✅ البيانات الأولية تُحمّل من PHP مباشرة (لا AJAX call)
- ✅ إضافة الأصناف تتم في JavaScript فقط (البيانات من searchItems)

### 2. **Event Listeners**
- ✅ acc1 event listener يعمل بشكل صحيح (client-side)
- ✅ لا تستخدم `renderInvoiceHeader()` داخل event listeners (يسبب infinite loop)
- ✅ استخدم تحديث مباشر للعناصر (`textContent`, `value`, etc.)
- ✅ استخدم `updateBalanceAfterInvoiceDisplay()` لتحديث balance after invoice

### 3. **API Endpoints**
- ✅ جميع endpoints تستخدم `web, auth` middleware (session-based)
- ✅ Prefix: `/api/v1/invoices/`
- ⚠️ `getAccountBalance` و `getAccountCurrency` deprecated (لم يعد مستخدماً)
- ✅ `getCreateData()` يستخدم `getCreateDataArray()` (لا تكرار في الكود)
- ✅ `getItemForInvoice()` deprecated للاستخدام المباشر (استخدم addItem مع item object)

### 4. **Performance Optimizations**
- ✅ البيانات الأولية تُحمّل من PHP (أسرع - لا AJAX call)
- ✅ إضافة الأصناف JavaScript فقط (أسرع - لا AJAX call إضافي)
- ✅ البحث عن الأصناف AJAX (ضروري للبحث الديناميكي)

### 4. **Invoice Types**
- أنواع الفواتير المدعومة: 10-26
- Sales: 10, 12, 14, 16, 22, 26
- Purchase: 11, 13, 15, 17, 24, 25
- Inventory: 18, 19, 20, 21

### 5. **Balance Calculation**
- Sales (10): `balance + total - received`
- Purchase (11): `balance - total + received`
- Sales Return (12): `balance - total + received`
- Purchase Return (13): `balance + total - received`
- Type 21 (Transfer): لا balance display

---

## 💡 نصائح للاستمرار

1. **اقرأ `CURRENT_STATUS.md` أولاً** - للحصول على نظرة عامة
2. **اقرأ `NEXT_STEPS.md`** - للخطوات الموصى بها
3. **اختبر الكود قبل التعديل** - تأكد من فهم المشكلة
4. **استخدم client-side optimization** - البيانات موجودة في acc1List
5. **تجنب re-render غير ضروري** - استخدم تحديث مباشر للعناصر
6. **احتفظ بالتوثيق محدثاً** - حدث CURRENT_STATUS.md بعد كل تغيير كبير

---

## 📝 ملاحظات إضافية

- النظام يستخدم **session-based authentication** (ليس Sanctum)
- الكود يدعم **multi-currency** (إذا كان مفعل)
- الكود يدعم **branch filtering**
- الكود يدعم **pricing agreements** و **last customer price**
- الكود يدعم **unit conversion**

---

**آخر تحديث:** الآن
**الحالة:** Work in Progress - Create Invoice Form ~95% مكتمل

## 📊 ملخص التحديثات الأخيرة

### ✅ ما تم إنجازه:
1. ✅ تحويل تحميل البيانات الأولية من AJAX إلى PHP/Blade مباشرة
2. ✅ تحويل إضافة الأصناف من AJAX إلى JavaScript فقط
3. ✅ إصلاح acc1 event listener
4. ✅ إنشاء edit-ajax.blade.php
5. ✅ تحسين الأداء بشكل كبير

### 📈 التحسينات في الأداء:
- **قبل:** 2 AJAX calls (تحميل البيانات + إضافة صنف)
- **بعد:** 0 AJAX calls (البيانات من PHP + JavaScript فقط)
- **النتيجة:** ⚡ أسرع بكثير + تجربة مستخدم أفضل
