<?php

namespace Modules\CRM\Livewire;

use App\Models\User;
use Livewire\Component;
use Modules\CRM\Models\Lead;
use Modules\CRM\Models\CrmClient;
use Modules\CRM\Models\LeadStatus;
use Modules\CRM\Models\ChanceSource;

class LeadsBoard extends Component
{
    public $statuses;
    public $leads;
    public $showAddModal = false;
    public $selectedStatus = null;
    public $sources;

    // بيانات الفرصة الجديدة
    public $newLead = [
        'title' => '',
        'client_id' => '',
        'amount' => '',
        'source' => '',
        'assigned_to' => '',
        'description' => ''
    ];

    public $clients;
    public $users;

    protected $rules = [
        'newLead.title' => 'required|string|max:255',
        'newLead.client_id' => 'required|exists:crm_clients,id',
        'newLead.amount' => 'nullable|numeric|min:0',
        'newLead.source' => 'nullable|exists:chance_sources,id', // تحديث القاعدة لاستقبال ID
        'newLead.assigned_to' => 'nullable|exists:users,id',
        'newLead.description' => 'nullable|string'
    ];

    protected $messages = [
        'newLead.title.required' => 'عنوان الفرصة مطلوب',
        'newLead.title.max' => 'عنوان الفرصة يجب أن يكون أقل من 255 حرف',
        'newLead.client_id.required' => 'يجب اختيار العميل',
        'newLead.client_id.exists' => 'العميل المحدد غير موجود',
        'newLead.amount.numeric' => 'القيمة يجب أن تكون رقماً',
        'newLead.amount.min' => 'القيمة يجب أن تكون أكبر من أو تساوي صفر',
        'newLead.assigned_to.exists' => 'المستخدم المسؤول غير موجود',
        'newLead.source_id.exists' => 'المصدر المحدد غير موجود', // إضافة رسالة جديدة

    ];

    public function mount()
    {
        // تحقق من وجود حالات الفرص
        $statusCount = LeadStatus::count();
        if ($statusCount === 0) {
            // إنشاء حالات افتراضية
            $this->createDefaultStatuses();
        }

        $this->loadData();
        $this->clients = CrmClient::all();
        $this->users = User::all();
        $this->sources = ChanceSource::all();
    }

    private function createDefaultStatuses()
    {
        $defaultStatuses = [
            ['name' => 'جديد', 'color' => '#007bff', 'order_column' => 1],
            ['name' => 'قيد المتابعة', 'color' => '#ffc107', 'order_column' => 2],
            ['name' => 'مؤهل', 'color' => '#28a745', 'order_column' => 3],
            ['name' => 'مُتم', 'color' => '#6f42c1', 'order_column' => 4],
            ['name' => 'مُلغى', 'color' => '#dc3545', 'order_column' => 5],
        ];

        foreach ($defaultStatuses as $status) {
            LeadStatus::create($status);
        }
    }

    public function loadData()
    {
        try {
            $this->statuses = LeadStatus::orderBy('order_column')->get();

            $this->leads = Lead::with(['client', 'status', 'assignedTo'])
                ->get()
                ->groupBy('status_id')
                ->map(function ($leads) {
                    return $leads->map(function ($lead) {
                        return [
                            'id' => $lead->id,
                            'title' => $lead->title,
                            'client' => $lead->client ? $lead->client->only('name') : null,
                            'amount' => $lead->amount,
                            'source' => $lead->source, //
                            'assigned_to' => $lead->assignedTo ? $lead->assignedTo->only('name') : null,
                            'description' => $lead->description
                        ];
                    });
                });
        } catch (\Exception $e) {
            $this->statuses = collect([]);
            $this->leads = collect([]);
            session()->flash('error', 'حدث خطأ في تحميل البيانات: ' . $e->getMessage());
        }
    }

    // دالة تغيير الحالة عن طريق drag & drop
    public function updateLeadStatus($leadId, $newStatusId)
    {
        try {
            $lead = Lead::find($leadId);
            if ($lead) {
                $lead->changeStatus($newStatusId);
                $this->loadData();

                $this->dispatch('lead-moved', [
                    'leadId' => $leadId,
                    'newStatus' => LeadStatus::find($newStatusId)->name
                ]);

                session()->flash('message', 'تم تحديث حالة الفرصة بنجاح!');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'حدث خطأ في تحديث الحالة: ' . $e->getMessage());
        }
    }

    // فتح نافذة إضافة فرصة جديدة
    public function openAddModal($statusId = null)
    {
        $this->selectedStatus = $statusId;
        $this->showAddModal = true;
        $this->resetNewLead();
    }

    // إغلاق النافذة
    public function closeModal()
    {
        $this->showAddModal = false;
        $this->selectedStatus = null;
        $this->resetNewLead();
        $this->resetErrorBag();
    }

    // إضافة فرصة جديدة
    public function addLead()
    {
        $this->validate();

        try {
            $leadData = $this->newLead;
            if ($this->selectedStatus) {
                $leadData['status_id'] = $this->selectedStatus;
            } else {
                $firstStatus = LeadStatus::orderBy('order_column')->first();
                if ($firstStatus) {
                    $leadData['status_id'] = $firstStatus->id;
                } else {
                    session()->flash('error', 'يجب إنشاء حالات الفرص أولاً');
                    return;
                }
            }
            Lead::create($leadData);
            $this->closeModal();
            $this->loadData();

            session()->flash('message', 'تم إضافة الفرصة بنجاح!');
        } catch (\Exception $e) {
            session()->flash('error', 'حدث خطأ أثناء إضافة الفرصة: ' . $e->getMessage());
        }
    }

    // إعادة تعيين بيانات الفرصة الجديدة
    private function resetNewLead()
    {
        $this->newLead = [
            'title' => '',
            'client_id' => '',
            'amount' => '',
            'source' => '',
            'assigned_to' => '',
            'description' => ''
        ];
    }

    // حذف فرصة
    public function deleteLead($leadId)
    {
        try {
            $lead = Lead::find($leadId);
            if ($lead) {
                $lead->delete();
                $this->loadData();
                session()->flash('message', 'تم حذف الفرصة بنجاح!');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'حدث خطأ أثناء حذف الفرصة: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('crm::livewire.leads-board');
    }
}
