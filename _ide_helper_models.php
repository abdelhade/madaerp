<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $aname
 * @property int $acc_type
 * @property int|null $parent_id
 * @property string $crtime
 * @property string $mdtime
 * @property string|null $code
 * @property int $isdeleted
 * @property int $tenant
 * @property int $branch
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccGroup whereAccType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccGroup whereAname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccGroup whereBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccGroup whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccGroup whereCrtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccGroup whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccGroup whereMdtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccGroup whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccGroup whereTenant($value)
 */
	class AccGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $employee_id
 * @property int|null $user_id
 * @property int|null $employee_attendance_finger_print_id
 * @property string|null $employee_attendance_finger_print_name
 * @property string|null $project_code
 * @property string $type
 * @property \Illuminate\Support\Carbon $date
 * @property string $time
 * @property array<array-key, mixed>|null $location
 * @property string $status
 * @property int|null $attandance_processing_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AttendanceProcessingDetail> $attendanceProcessingDetails
 * @property-read int|null $attendance_processing_details_count
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \App\Models\Employee $employee
 * @property-read mixed $formatted_time
 * @property-read mixed $location_address
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance whereAttandanceProcessingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance whereEmployeeAttendanceFingerPrintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance whereEmployeeAttendanceFingerPrintName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance whereProjectCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attendance whereUserId($value)
 */
	class Attendance extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $type
 * @property int|null $employee_id
 * @property int|null $department_id
 * @property \Illuminate\Support\Carbon $period_start
 * @property \Illuminate\Support\Carbon $period_end
 * @property int $total_days
 * @property int $working_days
 * @property numeric $total_hours
 * @property numeric $calculated_salary_for_day
 * @property numeric $calculated_salary_for_hour
 * @property int $actual_work_days
 * @property numeric $actual_work_hours
 * @property int $overtime_work_minutes
 * @property int $total_late_minutes
 * @property int $overtime_work_days
 * @property int $absent_days
 * @property numeric $unpaid_leave_days
 * @property numeric $employee_productivity_salary
 * @property numeric $salary_due
 * @property numeric $total_salary
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AttendanceProcessingDetail> $attendanceProcessingDetails
 * @property-read int|null $attendance_processing_details_count
 * @property-read \App\Models\Department|null $department
 * @property-read \App\Models\Employee|null $employee
 * @property-read int $duration
 * @property-read int $present_days
 * @property-read string $status_badge
 * @property-read string $status_label
 * @property-read float $total_actual_hours
 * @property-read int $total_employees
 * @property-read float $total_late_hours
 * @property-read float $total_overtime_hours
 * @property-read float $total_salary_calculated
 * @property-read string $type_label
 * @property-read int $vacation_days
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereAbsentDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereActualWorkDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereActualWorkHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereCalculatedSalaryForDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereCalculatedSalaryForHour($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereEmployeeProductivitySalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereOvertimeWorkDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereOvertimeWorkMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing wherePeriodEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing wherePeriodStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereSalaryDue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereTotalDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereTotalHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereTotalLateMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereTotalSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereUnpaidLeaveDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessing whereWorkingDays($value)
 */
	class AttendanceProcessing extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $attendance_processing_id
 * @property int $employee_id
 * @property int|null $department_id
 * @property \Illuminate\Support\Carbon $attendance_date
 * @property string|null $day_type
 * @property string $attendance_status
 * @property \Illuminate\Support\Carbon|null $shift_start_time
 * @property \Illuminate\Support\Carbon|null $shift_end_time
 * @property numeric $working_hours_in_shift
 * @property \Illuminate\Support\Carbon|null $check_in_time
 * @property \Illuminate\Support\Carbon|null $check_out_time
 * @property numeric $attendance_basic_hours_count
 * @property numeric $attendance_actual_hours_count
 * @property int $attendance_overtime_minutes_count
 * @property int $attendance_late_minutes_count
 * @property numeric $early_hours
 * @property numeric $attendance_total_hours_count
 * @property numeric $total_due_hourly_salary
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AttendanceProcessing $attendanceProcessing
 * @property-read \App\Models\Department|null $department
 * @property-read \App\Models\Employee $employee
 * @property-read float $attendance_efficiency
 * @property-read string $formatted_check_in_time
 * @property-read string $formatted_check_out_time
 * @property-read string $formatted_shift_time
 * @property-read float $late_percentage
 * @property-read float $overtime_percentage
 * @property-read string $status_badge
 * @property-read string $working_day_badge
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereAttendanceActualHoursCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereAttendanceBasicHoursCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereAttendanceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereAttendanceLateMinutesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereAttendanceOvertimeMinutesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereAttendanceProcessingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereAttendanceStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereAttendanceTotalHoursCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereCheckInTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereCheckOutTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereDayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereEarlyHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereShiftEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereShiftStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereTotalDueHourlySalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendanceProcessingDetail whereWorkingHoursInShift($value)
 */
	class AttendanceProcessingDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $item_id
 * @property int $unit_id
 * @property string $barcode
 * @property int $isdeleted
 * @property int $tenant
 * @property int|null $branch_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\Unit $unit
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barcode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barcode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barcode query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barcode whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barcode whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barcode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barcode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barcode whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barcode whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barcode whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barcode whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barcode whereUpdatedAt($value)
 */
	class Barcode extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cheque newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cheque newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cheque query()
 */
	class Cheque extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property numeric|null $latitude
 * @property numeric|null $longitude
 * @property int $state_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\State $state
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Town> $towns
 * @property-read int|null $towns_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereUpdatedAt($value)
 */
	class City extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $cname
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $phone2
 * @property string|null $company
 * @property string|null $address
 * @property string|null $address2
 * @property \Illuminate\Support\Carbon|null $date_of_birth
 * @property string|null $national_id
 * @property string|null $contact_person
 * @property string|null $contact_phone
 * @property string|null $contact_relation
 * @property string|null $info
 * @property string|null $job
 * @property string|null $gender
 * @property int $isdeleted
 * @property int $is_active
 * @property int $created_by
 * @property int|null $client_type_id
 * @property int $tenant
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property int|null $client_category_id
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \Modules\CRM\Models\ClientCategory|null $category
 * @property-read \Modules\CRM\Models\ClientType|null $clientType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\CRM\Models\Lead> $leads
 * @property-read int|null $leads_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Inquiries\Models\Inquiry> $projectsAsClient
 * @property-read int|null $projects_as_client_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Inquiries\Models\Inquiry> $projectsAsMainContractor
 * @property-read int|null $projects_as_main_contractor_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereClientCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereClientTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereContactRelation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereJob($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereNationalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client wherePhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereUpdatedAt($value)
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $name
 * @property int $contract_type_id
 * @property string $contract_start_date
 * @property string $contract_end_date
 * @property numeric|null $fixed_work_hours
 * @property numeric|null $additional_work_hours
 * @property numeric|null $monthly_holidays
 * @property numeric|null $monthly_sick_days
 * @property string|null $information
 * @property int|null $job_id
 * @property string|null $job_description
 * @property int|null $employee_id
 * @property int|null $interview_id
 * @property int|null $cv_id
 * @property int|null $user_id
 * @property \App\Models\User $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractPoint> $contract_points
 * @property-read int|null $contract_points_count
 * @property-read \App\Models\ContractType $contract_type
 * @property-read \App\Models\Employee|null $employee
 * @property-read \App\Models\EmployeesJob|null $job
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SalaryPoint> $salary_points
 * @property-read int|null $salary_points_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereAdditionalWorkHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereContractEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereContractStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereContractTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereCvId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereFixedWorkHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereInterviewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereJobDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereMonthlyHolidays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereMonthlySickDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereUserId($value)
 */
	class Contract extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $contract_id
 * @property int $sequence
 * @property string $name
 * @property string|null $information
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Contract $contract
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractPoint query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractPoint whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractPoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractPoint whereInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractPoint whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractPoint whereSequence($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractPoint whereUpdatedAt($value)
 */
	class ContractPoint extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contract> $contracts
 * @property-read int|null $contracts_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContractType whereUpdatedAt($value)
 */
	class ContractType extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $cname
 * @property int|null $parent_id
 * @property string|null $info
 * @property int $tenant
 * @property int $deleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \App\Models\OperHead|null $operHead
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostCenter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostCenter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostCenter query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostCenter whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostCenter whereCname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostCenter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostCenter whereDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostCenter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostCenter whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostCenter whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostCenter whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostCenter whereUpdatedAt($value)
 */
	class CostCenter extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\State> $states
 * @property-read int|null $states_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereUpdatedAt($value)
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $image
 * @property int|null $employee_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee|null $employee
 * @property-read string|null $image_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Covenant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Covenant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Covenant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Covenant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Covenant whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Covenant whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Covenant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Covenant whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Covenant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Covenant whereUpdatedAt($value)
 */
	class Covenant extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $symbol
 * @property int $decimal_places
 * @property int $is_default
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereDecimalPlaces($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereUpdatedAt($value)
 */
	class Currency extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string $phone
 * @property string|null $country
 * @property string|null $state
 * @property string|null $city
 * @property string|null $address
 * @property string $birth_date
 * @property string $gender
 * @property string $marital_status
 * @property string $nationality
 * @property string $religion
 * @property string|null $summary
 * @property string|null $skills
 * @property string|null $experience
 * @property string|null $education
 * @property string|null $projects
 * @property string|null $certifications
 * @property string|null $languages
 * @property string|null $interests
 * @property string|null $references
 * @property string|null $cover_letter
 * @property string|null $portfolio
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property int|null $job_posting_id
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereCertifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereCoverLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereInterests($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereJobPostingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereMaritalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv wherePortfolio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereProjects($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereReferences($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereReligion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cv whereUpdatedAt($value)
 */
	class Cv extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property numeric|null $max_leave_percentage النسبة المئوية القصوى للموظفين في الإجازة لهذا القسم
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property int|null $parent_id
 * @property int|null $director_id
 * @property int|null $deputy_director_id
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Department> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Department> $childrenRecursive
 * @property-read int|null $children_recursive_count
 * @property-read \App\Models\Employee|null $deputyDirector
 * @property-read \App\Models\Employee|null $director
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employee> $employees
 * @property-read int|null $employees_count
 * @property-read Department|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereDeputyDirectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereDirectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereMaxLeavePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereUpdatedAt($value)
 */
	class Department extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string|null $image
 * @property string|null $position
 * @property int|null $project_id
 * @property int|null $user_id
 * @property string|null $gender
 * @property \Illuminate\Support\Carbon|null $date_of_birth
 * @property string|null $nationalId
 * @property string|null $marital_status
 * @property string|null $education
 * @property string|null $information
 * @property string $status
 * @property int|null $country_id
 * @property int|null $city_id
 * @property int|null $state_id
 * @property int|null $town_id
 * @property int|null $job_id
 * @property int|null $department_id
 * @property \Illuminate\Support\Carbon|null $date_of_hire
 * @property \Illuminate\Support\Carbon|null $date_of_fire
 * @property string|null $job_level
 * @property numeric|null $salary
 * @property int|null $finger_print_id
 * @property string|null $finger_print_name
 * @property string|null $salary_type
 * @property int|null $shift_id
 * @property string|null $password
 * @property numeric|null $additional_hour_calculation
 * @property numeric|null $additional_day_calculation
 * @property numeric|null $late_hour_calculation
 * @property numeric|null $late_day_calculation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property int $allowed_permission_days
 * @property int $allowed_late_days
 * @property int $allowed_absent_days
 * @property bool $is_errand_allowed
 * @property int $allowed_errand_days
 * @property int|null $line_manager_id
 * @property numeric $flexible_hourly_wage
 * @property-read \Modules\Accounts\Models\AccHead|null $account
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EmployeeAdvance> $advances
 * @property-read int|null $advances_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AttendanceProcessing> $attendanceProcessings
 * @property-read int|null $attendance_processings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Attendance> $attendances
 * @property-read int|null $attendances_count
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \App\Models\City|null $city
 * @property-read \App\Models\Country|null $country
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Covenant> $covenants
 * @property-read int|null $covenants_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EmployeeDeductionReward> $deductionsRewards
 * @property-read int|null $deductions_rewards_count
 * @property-read \App\Models\Department|null $department
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EmployeeProduction> $employeeProductions
 * @property-read int|null $employee_productions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Errand> $errands
 * @property-read int|null $errands_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employee_Evaluation> $evaluations
 * @property-read int|null $evaluations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FlexibleSalaryProcessing> $flexibleSalaryProcessings
 * @property-read int|null $flexible_salary_processings_count
 * @property-read float $daily_rate
 * @property-read string|null $education_english
 * @property-read float $expected_hours
 * @property-read float $hourly_rate
 * @property-read string|null $image_url
 * @property-read string|null $marital_status_english
 * @property-read string $status_english
 * @property-read \App\Models\EmployeesJob|null $job
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Kpi> $kpis
 * @property-read int|null $kpis_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EmployeeLeaveBalance> $leaveBalances
 * @property-read int|null $leave_balances_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LeaveRequest> $leaveRequests
 * @property-read int|null $leave_requests_count
 * @property-read Employee|null $lineManager
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PayrollEntry> $payrollEntries
 * @property-read int|null $payroll_entries_count
 * @property-read \App\Models\Shift|null $shift
 * @property-read \App\Models\State|null $state
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Recruitment\Models\Termination> $terminations
 * @property-read int|null $terminations_count
 * @property-read \App\Models\Town|null $town
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WorkPermission> $workPermissions
 * @property-read int|null $work_permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereAdditionalDayCalculation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereAdditionalHourCalculation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereAllowedAbsentDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereAllowedErrandDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereAllowedLateDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereAllowedPermissionDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereDateOfFire($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereDateOfHire($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereFingerPrintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereFingerPrintName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereFlexibleHourlyWage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereIsErrandAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereJobLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereLateDayCalculation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereLateHourCalculation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereLineManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereMaritalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereNationalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereSalaryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereShiftId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereTownId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereUserId($value)
 */
	class Employee extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $employee_id
 * @property numeric $amount
 * @property \Illuminate\Support\Carbon $date
 * @property string $reason
 * @property string|null $notes
 * @property int|null $journal_id
 * @property bool $deducted_from_salary
 * @property int|null $deduction_journal_id
 * @property string $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $approved_by
 * @property \Illuminate\Support\Carbon|null $approved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $approvedBy
 * @property-read \App\Models\User|null $createdBy
 * @property-read \App\Models\Employee $employee
 * @property-read \App\Models\User|null $updatedBy
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance whereDeductedFromSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance whereDeductionJournalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance whereJournalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeAdvance whereUpdatedBy($value)
 */
	class EmployeeAdvance extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $employee_id
 * @property int|null $attendance_processing_id
 * @property int|null $flexible_salary_processing_id
 * @property string $type
 * @property string $reason
 * @property numeric $amount
 * @property \Illuminate\Support\Carbon $date
 * @property string|null $notes
 * @property int|null $journal_id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AttendanceProcessing|null $attendanceProcessing
 * @property-read \App\Models\User|null $createdBy
 * @property-read \App\Models\Employee $employee
 * @property-read \App\Models\FlexibleSalaryProcessing|null $flexibleSalaryProcessing
 * @property-read \App\Models\User|null $updatedBy
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward whereAttendanceProcessingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward whereFlexibleSalaryProcessingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward whereJournalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDeductionReward whereUpdatedBy($value)
 */
	class EmployeeDeductionReward extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $employee_id
 * @property int $leave_type_id
 * @property int $year
 * @property numeric $opening_balance_days
 * @property numeric $used_days
 * @property numeric $pending_days
 * @property numeric|null $max_monthly_days
 * @property array<array-key, mixed>|null $monthly_used_days
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee $employee
 * @property-read float $remaining_days
 * @property-read \App\Models\LeaveType $leaveType
 * @method static \Database\Factories\EmployeeLeaveBalanceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeLeaveBalance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeLeaveBalance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeLeaveBalance query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeLeaveBalance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeLeaveBalance whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeLeaveBalance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeLeaveBalance whereLeaveTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeLeaveBalance whereMaxMonthlyDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeLeaveBalance whereMonthlyUsedDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeLeaveBalance whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeLeaveBalance whereOpeningBalanceDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeLeaveBalance wherePendingDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeLeaveBalance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeLeaveBalance whereUsedDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeLeaveBalance whereYear($value)
 */
	class EmployeeLeaveBalance extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $employee_id
 * @property int $attendance_processing_id
 * @property int $units_count
 * @property int $units_price
 * @property int $units_total_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AttendanceProcessing $attendanceProcessing
 * @property-read \App\Models\Employee $employee
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProduction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProduction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProduction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProduction whereAttendanceProcessingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProduction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProduction whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProduction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProduction whereUnitsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProduction whereUnitsPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProduction whereUnitsTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeProduction whereUpdatedAt($value)
 */
	class EmployeeProduction extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $employee_id
 * @property \Illuminate\Support\Carbon $evaluation_date
 * @property string|null $direct_manager
 * @property \Illuminate\Support\Carbon $evaluation_period_from
 * @property \Illuminate\Support\Carbon $evaluation_period_to
 * @property numeric $total_score
 * @property string $final_rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee $employee
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Kpi> $kpis
 * @property-read int|null $kpis_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee_Evaluation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee_Evaluation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee_Evaluation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee_Evaluation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee_Evaluation whereDirectManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee_Evaluation whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee_Evaluation whereEvaluationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee_Evaluation whereEvaluationPeriodFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee_Evaluation whereEvaluationPeriodTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee_Evaluation whereFinalRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee_Evaluation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee_Evaluation whereTotalScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee_Evaluation whereUpdatedAt($value)
 */
	class Employee_Evaluation extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employee> $employees
 * @property-read int|null $employees_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeesJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeesJob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeesJob query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeesJob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeesJob whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeesJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeesJob whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeesJob whereUpdatedAt($value)
 */
	class EmployeesJob extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $title
 * @property string|null $details
 * @property int $employee_id
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property \App\Models\User|null $created_by
 * @property \App\Models\User|null $updated_by
 * @property \App\Models\User|null $approved_by
 * @property \Illuminate\Support\Carbon|null $approved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee $employee
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errand query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errand whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errand whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errand whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errand whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errand whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errand whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errand whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errand whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errand whereUpdatedBy($value)
 */
	class Errand extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $title
 * @property numeric|null $amount
 * @property int|null $pro_type
 * @property int|null $op_id
 * @property int|null $account_id
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereOpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereProType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Expense whereUpdatedAt($value)
 */
	class Expense extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $employee_id
 * @property int|null $department_id
 * @property \Illuminate\Support\Carbon $period_start
 * @property \Illuminate\Support\Carbon $period_end
 * @property numeric $fixed_salary
 * @property numeric $hours_worked
 * @property numeric $hourly_wage
 * @property numeric $total_salary
 * @property string $status
 * @property int|null $journal_id
 * @property string|null $notes
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $createdBy
 * @property-read \App\Models\Department|null $department
 * @property-read \App\Models\Employee $employee
 * @property-read string $status_badge
 * @property-read string $status_label
 * @property-read \App\Models\User|null $updatedBy
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing whereFixedSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing whereHourlyWage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing whereHoursWorked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing whereJournalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing wherePeriodEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing wherePeriodStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing whereTotalSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlexibleSalaryProcessing whereUpdatedBy($value)
 */
	class FlexibleSalaryProcessing extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property numeric $company_max_leave_percentage النسبة المئوية القصوى للشركة ككل
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HRSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HRSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HRSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HRSetting whereCompanyMaxLeavePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HRSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HRSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HRSetting whereUpdatedAt($value)
 */
	class HRSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property int $is_active
 * @property int $code
 * @property string|null $info
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $tenant
 * @property numeric $average_cost
 * @property int $min_order_quantity
 * @property int $max_order_quantity
 * @property int|null $branch_id
 * @property \App\Enums\ItemType $type
 * @property int $isdeleted
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Barcode> $barcodes
 * @property-read int|null $barcodes_count
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Note> $notes
 * @property-read int|null $notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Price> $prices
 * @property-read int|null $prices_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Unit> $units
 * @property-read int|null $units_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item active()
 * @method static \Database\Factories\ItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item inactive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item notDeleted()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereAverageCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereMaxOrderQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereMinOrderQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereUpdatedAt($value)
 */
	class Item extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $queue
 * @property string $payload
 * @property int $attempts
 * @property int|null $reserved_at
 * @property int $available_at
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereAvailableAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereQueue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereReservedAt($value)
 */
	class Job extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $pro_id
 * @property int|null $is_stock
 * @property int|null $is_finance
 * @property int|null $is_manager
 * @property int|null $is_journal
 * @property int|null $journal_type
 * @property int|null $currency_id
 * @property numeric $currency_rate
 * @property string|null $info
 * @property string $start_time
 * @property string $end_time
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $pro_date
 * @property string|null $accural_date
 * @property int|null $pro_pattren
 * @property string|null $pro_num
 * @property string|null $pro_serial
 * @property string|null $tax_num
 * @property int|null $price_list
 * @property int|null $store_id
 * @property int|null $emp_id
 * @property int|null $emp2_id
 * @property int|null $acc1
 * @property numeric|null $acc1_before
 * @property numeric|null $acc1_after
 * @property int|null $acc2
 * @property numeric|null $acc2_before
 * @property numeric|null $acc2_after
 * @property numeric|null $pro_value
 * @property numeric|null $fat_cost
 * @property int|null $cost_center
 * @property numeric|null $profit
 * @property numeric|null $fat_total
 * @property numeric $fat_net
 * @property numeric|null $fat_disc
 * @property numeric|null $fat_disc_per
 * @property numeric|null $fat_plus
 * @property numeric|null $fat_plus_per
 * @property numeric|null $fat_tax
 * @property numeric|null $fat_tax_per
 * @property string $crtime
 * @property int $acc_fund
 * @property int $op2
 * @property int $isdeleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user
 * @property int $tenant
 * @property int $closed
 * @property int $is_locked
 * @property string|null $info2
 * @property string|null $info3
 * @property string|null $details
 * @property int|null $project_id
 * @property int|null $acc3
 * @property int|null $pro_type
 * @property int $status
 * @property int $workflow_state workflow stage for multi-stage operations
 * @property int|null $origin_id
 * @property int|null $parent_id
 * @property int|null $approved_by
 * @property string|null $approved_at
 * @property string|null $approval_notes
 * @property numeric $paid_from_client
 * @property string|null $expected_time
 * @property int|null $production_order_id
 * @property int|null $branch_id
 * @property int|null $manufacturing_order_id
 * @property int|null $manufacturing_stage_id
 * @property-read \Modules\Accounts\Models\AccHead|null $account1
 * @property-read \Modules\Accounts\Models\AccHead|null $account2
 * @property-read \Modules\Accounts\Models\AccHead|null $emp1
 * @property-read \Modules\Accounts\Models\AccHead|null $emp2
 * @property-read \App\Models\ProType|null $type
 * @property-read \App\Models\User|null $user_id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal receipts()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereAcc1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereAcc1After($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereAcc1Before($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereAcc2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereAcc2After($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereAcc2Before($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereAcc3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereAccFund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereAccuralDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereApprovalNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereCostCenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereCrtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereCurrencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereEmp2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereEmpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereExpectedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereFatCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereFatDisc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereFatDiscPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereFatNet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereFatPlus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereFatPlusPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereFatTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereFatTaxPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereFatTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereInfo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereInfo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereIsFinance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereIsJournal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereIsLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereIsManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereIsStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereJournalType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereManufacturingOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereManufacturingStageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereOp2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereOriginId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal wherePaidFromClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal wherePriceList($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereProDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereProId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereProNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereProPattren($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereProSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereProType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereProValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereProductionOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereTaxNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Journal whereWorkflowState($value)
 */
	class Journal extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $journal_id
 * @property int $account_id
 * @property int $debit
 * @property int $credit
 * @property int $type
 * @property string|null $info
 * @property string $crtime
 * @property int $op2
 * @property int $op_id
 * @property int $isdeleted
 * @property string $mdtime
 * @property int $tenant
 * @property int|null $branch_id
 * @property-read \Modules\Accounts\Models\AccHead|null $accHead
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \App\Models\CostCenter|null $costCenter
 * @property-read \App\Models\JournalHead|null $head
 * @property-read \App\Models\OperHead|null $operHead
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail whereCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail whereCrtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail whereDebit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail whereJournalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail whereMdtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail whereOp2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail whereOpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalDetail whereType($value)
 */
	class JournalDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $journal_id
 * @property float $total
 * @property string $date
 * @property int|null $op_id
 * @property int|null $pro_type
 * @property string|null $details
 * @property string $crtime
 * @property int $op2
 * @property int $isdeleted
 * @property string $mdtime
 * @property int|null $user
 * @property int $tenant
 * @property int|null $branch_id
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JournalDetail> $dets
 * @property-read int|null $dets_count
 * @property-read \App\Models\OperHead|null $oper
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead whereCrtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead whereJournalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead whereMdtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead whereOp2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead whereOpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead whereProType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalHead whereUser($value)
 */
	class JournalHead extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalTybe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalTybe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JournalTybe query()
 */
	class JournalTybe extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employee> $employees
 * @property-read int|null $employees_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employee_Evaluation> $evaluations
 * @property-read int|null $evaluations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kpi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kpi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kpi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kpi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kpi whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kpi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kpi whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kpi whereUpdatedAt($value)
 */
	class Kpi extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $employee_id
 * @property int $leave_type_id
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property numeric $duration_days
 * @property string $status
 * @property int|null $approver_id
 * @property \Illuminate\Support\Carbon|null $approved_at
 * @property string|null $reason
 * @property bool $overlaps_attendance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $approver
 * @property-read \App\Models\Employee $employee
 * @property-read \App\Models\LeaveType $leaveType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest approved()
 * @method static \Database\Factories\LeaveRequestFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest forEmployee(int $employeeId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest forYear(int $year)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest overlapping(string $startDate, string $endDate)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest pending()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest whereApproverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest whereDurationDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest whereLeaveTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest whereOverlapsAttendance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveRequest whereUpdatedAt($value)
 */
	class LeaveRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $code
 * @property bool $is_paid
 * @property bool $requires_approval
 * @property int|null $max_per_request_days
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EmployeeLeaveBalance> $employeeLeaveBalances
 * @property-read int|null $employee_leave_balances_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LeaveRequest> $leaveRequests
 * @property-read int|null $leave_requests_count
 * @method static \Database\Factories\LeaveTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveType whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveType whereMaxPerRequestDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveType whereRequiresApproval($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LeaveType whereUpdatedAt($value)
 */
	class LeaveType extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string|null $device
 * @property \Illuminate\Support\Carbon|null $login_at
 * @property \Illuminate\Support\Carbon|null $logout_at
 * @property string|null $session_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginSession query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginSession whereDevice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginSession whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginSession whereLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginSession whereLogoutAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginSession whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginSession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginSession whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginSession whereUserId($value)
 */
	class LoginSession extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicForm query()
 */
	class MagicForm extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $magical_id
 * @property string $name
 * @property string $type
 * @property string|null $option
 * @property string|null $class
 * @property string|null $value
 * @property string|null $placeholder
 * @property int $hidden
 * @property int $readonly
 * @property string|null $label
 * @property string|null $help_text
 * @property int $order
 * @property int $required
 * @property string|null $options
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Magical $magical
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet whereHelpText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet whereMagicalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet whereOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet wherePlaceholder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet whereReadonly($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MagicaDet whereValue($value)
 */
	class MagicaDet extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $magic_name
 * @property string $magic_link
 * @property string $info
 * @property int $is_journal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Magical newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Magical newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Magical query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Magical whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Magical whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Magical whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Magical whereIsJournal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Magical whereMagicLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Magical whereMagicName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Magical whereUpdatedAt($value)
 */
	class Magical extends \Eloquent {}
}

namespace App\Models\Modules\Checks\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CheckPortfolio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CheckPortfolio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CheckPortfolio query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CheckPortfolio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CheckPortfolio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CheckPortfolio whereUpdatedAt($value)
 */
	class CheckPortfolio extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $pro_id
 * @property int|null $is_stock
 * @property int|null $is_finance
 * @property int|null $is_manager
 * @property int|null $is_journal
 * @property int|null $journal_type
 * @property int|null $currency_id
 * @property numeric $currency_rate
 * @property string|null $info
 * @property string $start_time
 * @property string $end_time
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $pro_date
 * @property string|null $accural_date
 * @property int|null $pro_pattren
 * @property string|null $pro_num
 * @property string|null $pro_serial
 * @property string|null $tax_num
 * @property int|null $price_list
 * @property int|null $store_id
 * @property int|null $emp_id
 * @property int|null $emp2_id
 * @property int|null $acc1
 * @property numeric|null $acc1_before
 * @property numeric|null $acc1_after
 * @property int|null $acc2
 * @property numeric|null $acc2_before
 * @property numeric|null $acc2_after
 * @property numeric|null $pro_value
 * @property numeric|null $fat_cost
 * @property int|null $cost_center
 * @property numeric|null $profit
 * @property numeric|null $fat_total
 * @property numeric $fat_net
 * @property numeric|null $fat_disc
 * @property numeric|null $fat_disc_per
 * @property numeric|null $fat_plus
 * @property numeric|null $fat_plus_per
 * @property numeric|null $fat_tax
 * @property numeric|null $fat_tax_per
 * @property string $crtime
 * @property int $acc_fund
 * @property int $op2
 * @property int $isdeleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user
 * @property int $tenant
 * @property int $closed
 * @property int $is_locked
 * @property string|null $info2
 * @property string|null $info3
 * @property string|null $details
 * @property int|null $project_id
 * @property int|null $acc3
 * @property int|null $pro_type
 * @property int $status
 * @property int $workflow_state workflow stage for multi-stage operations
 * @property int|null $origin_id
 * @property int|null $parent_id
 * @property int|null $approved_by
 * @property string|null $approved_at
 * @property string|null $approval_notes
 * @property numeric $paid_from_client
 * @property string|null $expected_time
 * @property int|null $production_order_id
 * @property int|null $branch_id
 * @property int|null $manufacturing_order_id
 * @property int|null $manufacturing_stage_id
 * @property-read \Modules\Accounts\Models\AccHead|null $account1
 * @property-read \Modules\Accounts\Models\AccHead|null $account2
 * @property-read \Modules\Accounts\Models\AccHead|null $emp1
 * @property-read \Modules\Accounts\Models\AccHead|null $emp2
 * @property-read \App\Models\ProType|null $type
 * @property-read \App\Models\User|null $user_id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal receipts()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereAcc1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereAcc1After($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereAcc1Before($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereAcc2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereAcc2After($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereAcc2Before($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereAcc3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereAccFund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereAccuralDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereApprovalNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereCostCenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereCrtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereCurrencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereEmp2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereEmpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereExpectedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereFatCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereFatDisc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereFatDiscPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereFatNet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereFatPlus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereFatPlusPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereFatTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereFatTaxPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereFatTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereInfo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereInfo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereIsFinance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereIsJournal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereIsLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereIsManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereIsStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereJournalType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereManufacturingOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereManufacturingStageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereOp2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereOriginId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal wherePaidFromClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal wherePriceList($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereProDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereProId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereProNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereProPattren($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereProSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereProType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereProValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereProductionOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereTaxNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiJournal whereWorkflowState($value)
 */
	class MultiJournal extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $pro_id
 * @property int|null $is_stock
 * @property int|null $is_finance
 * @property int|null $is_manager
 * @property int|null $is_journal
 * @property int|null $journal_type
 * @property int|null $currency_id
 * @property numeric $currency_rate
 * @property string|null $info
 * @property string $start_time
 * @property string $end_time
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $pro_date
 * @property string|null $accural_date
 * @property int|null $pro_pattren
 * @property string|null $pro_num
 * @property string|null $pro_serial
 * @property string|null $tax_num
 * @property int|null $price_list
 * @property int|null $store_id
 * @property int|null $emp_id
 * @property int|null $emp2_id
 * @property int|null $acc1
 * @property numeric|null $acc1_before
 * @property numeric|null $acc1_after
 * @property int|null $acc2
 * @property numeric|null $acc2_before
 * @property numeric|null $acc2_after
 * @property numeric|null $pro_value
 * @property numeric|null $fat_cost
 * @property int|null $cost_center
 * @property numeric|null $profit
 * @property numeric|null $fat_total
 * @property numeric $fat_net
 * @property numeric|null $fat_disc
 * @property numeric|null $fat_disc_per
 * @property numeric|null $fat_plus
 * @property numeric|null $fat_plus_per
 * @property numeric|null $fat_tax
 * @property numeric|null $fat_tax_per
 * @property string $crtime
 * @property int $acc_fund
 * @property int $op2
 * @property int $isdeleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\User|null $user
 * @property int $tenant
 * @property int $closed
 * @property int $is_locked
 * @property string|null $info2
 * @property string|null $info3
 * @property string|null $details
 * @property int|null $project_id
 * @property int|null $acc3
 * @property int|null $pro_type
 * @property int $status
 * @property int $workflow_state workflow stage for multi-stage operations
 * @property int|null $origin_id
 * @property int|null $parent_id
 * @property int|null $approved_by
 * @property string|null $approved_at
 * @property string|null $approval_notes
 * @property numeric $paid_from_client
 * @property string|null $expected_time
 * @property int|null $production_order_id
 * @property int|null $branch_id
 * @property int|null $manufacturing_order_id
 * @property int|null $manufacturing_stage_id
 * @property-read \Modules\Accounts\Models\AccHead|null $account1
 * @property-read \Modules\Accounts\Models\AccHead|null $account2
 * @property-read \Modules\Accounts\Models\AccHead|null $emp1
 * @property-read \Modules\Accounts\Models\AccHead|null $emp2
 * @property-read \App\Models\JournalHead|null $journalHead
 * @property-read \App\Models\ProType|null $type
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher receipts()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereAcc1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereAcc1After($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereAcc1Before($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereAcc2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereAcc2After($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereAcc2Before($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereAcc3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereAccFund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereAccuralDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereApprovalNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereCostCenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereCrtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereCurrencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereEmp2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereEmpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereExpectedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereFatCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereFatDisc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereFatDiscPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereFatNet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereFatPlus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereFatPlusPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereFatTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereFatTaxPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereFatTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereInfo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereInfo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereIsFinance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereIsJournal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereIsLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereIsManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereIsStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereJournalType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereManufacturingOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereManufacturingStageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereOp2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereOriginId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher wherePaidFromClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher wherePriceList($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereProDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereProId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereProNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereProPattren($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereProSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereProType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereProValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereProductionOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereTaxNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiVoucher whereWorkflowState($value)
 */
	class MultiVoucher extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\NoteDetails> $noteDetails
 * @property-read int|null $note_details_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereUpdatedAt($value)
 */
	class Note extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $note_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Note $note
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NoteDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NoteDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NoteDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NoteDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NoteDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NoteDetails whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NoteDetails whereNoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NoteDetails whereUpdatedAt($value)
 */
	class NoteDetails extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $pro_id
 * @property int|null $is_stock
 * @property int|null $is_finance
 * @property int|null $is_manager
 * @property int|null $is_journal
 * @property int|null $journal_type
 * @property int|null $currency_id
 * @property numeric $currency_rate
 * @property string|null $info
 * @property string $start_time
 * @property string $end_time
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $pro_date
 * @property string|null $accural_date
 * @property int|null $pro_pattren
 * @property string|null $pro_num
 * @property string|null $pro_serial
 * @property string|null $tax_num
 * @property int|null $price_list
 * @property int|null $store_id
 * @property int|null $emp_id
 * @property int|null $emp2_id
 * @property int|null $acc1
 * @property numeric|null $acc1_before
 * @property numeric|null $acc1_after
 * @property int|null $acc2
 * @property numeric|null $acc2_before
 * @property numeric|null $acc2_after
 * @property numeric|null $pro_value
 * @property numeric|null $fat_cost
 * @property int|null $cost_center
 * @property numeric|null $profit
 * @property numeric|null $fat_total
 * @property numeric $fat_net
 * @property numeric|null $fat_disc
 * @property numeric|null $fat_disc_per
 * @property numeric|null $fat_plus
 * @property numeric|null $fat_plus_per
 * @property numeric|null $fat_tax
 * @property numeric|null $fat_tax_per
 * @property string $crtime
 * @property int $acc_fund
 * @property int $op2
 * @property int $isdeleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\User|null $user
 * @property int $tenant
 * @property int $closed
 * @property int $is_locked
 * @property string|null $info2
 * @property string|null $info3
 * @property string|null $details
 * @property int|null $project_id
 * @property int|null $acc3
 * @property int|null $pro_type
 * @property int $status
 * @property int $workflow_state workflow stage for multi-stage operations
 * @property int|null $origin_id
 * @property int|null $parent_id
 * @property int|null $approved_by
 * @property string|null $approved_at
 * @property string|null $approval_notes
 * @property numeric $paid_from_client
 * @property string|null $expected_time
 * @property int|null $production_order_id
 * @property int|null $branch_id
 * @property int|null $manufacturing_order_id
 * @property int|null $manufacturing_stage_id
 * @property-read \Modules\Accounts\Models\AccHead|null $acc1Head
 * @property-read \Modules\Accounts\Models\AccHead|null $acc1Headuser
 * @property-read \Modules\Accounts\Models\AccHead|null $acc2Head
 * @property-read \Modules\Accounts\Models\AccHead|null $acc3Head
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \App\Models\CostCenter|null $costCenter
 * @property-read \Modules\Accounts\Models\AccHead|null $employee
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JournalDetail> $journalDetails
 * @property-read int|null $journal_details_count
 * @property-read \App\Models\JournalHead|null $journalHead
 * @property-read \Modules\Manufacturing\Models\ManufacturingOrder|null $manufacturingOrder
 * @property-read \Modules\Manufacturing\Models\ManufacturingStage|null $manufacturingStage
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OperationItems> $operationItems
 * @property-read int|null $operation_items_count
 * @property-read \App\Models\ProductionOrder|null $productionOrder
 * @property-read \App\Models\Project|null $project
 * @property-read \Modules\Accounts\Models\AccHead|null $store
 * @property-read \App\Models\ProType|null $type
 * @method static \Database\Factories\OperHeadFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereAcc1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereAcc1After($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereAcc1Before($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereAcc2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereAcc2After($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereAcc2Before($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereAcc3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereAccFund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereAccuralDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereApprovalNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereCostCenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereCrtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereCurrencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereEmp2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereEmpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereExpectedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereFatCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereFatDisc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereFatDiscPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereFatNet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereFatPlus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereFatPlusPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereFatTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereFatTaxPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereFatTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereInfo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereInfo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereIsFinance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereIsJournal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereIsLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereIsManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereIsStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereJournalType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereManufacturingOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereManufacturingStageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereOp2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereOriginId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead wherePaidFromClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead wherePriceList($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereProDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereProId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereProNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereProPattren($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereProSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereProType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereProValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereProductionOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereTaxNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperHead whereWorkflowState($value)
 */
	class OperHead extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $pro_tybe
 * @property int|null $detail_store
 * @property int|null $pro_id
 * @property int $item_id
 * @property int|null $unit_id
 * @property numeric $unit_value
 * @property numeric $qty_in
 * @property numeric $qty_out
 * @property numeric|null $fat_quantity
 * @property numeric|null $fat_price
 * @property numeric $item_price
 * @property numeric $cost_price
 * @property numeric $current_stock_value
 * @property numeric $item_discount
 * @property numeric $additional
 * @property numeric $detail_value
 * @property numeric $profit
 * @property string|null $notes
 * @property string|null $batch_number
 * @property string|null $expiry_date
 * @property string|null $serial_numbers
 * @property int $is_stock
 * @property int $isdeleted
 * @property int|null $currency_id
 * @property numeric $currency_rate
 * @property int $tenant
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property numeric|null $length
 * @property numeric|null $width
 * @property numeric|null $height
 * @property numeric $density
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \App\Models\Currency|null $currency
 * @property-read \App\Models\Item|null $item
 * @property-read \App\Models\OperHead|null $operhead
 * @property-read \App\Models\Unit|null $unit
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereAdditional($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereBatchNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereCostPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereCurrencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereCurrentStockValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereDensity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereDetailStore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereDetailValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereFatPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereFatQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereIsStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereItemDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereItemPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereProId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereProTybe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereQtyIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereQtyOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereSerialNumbers($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereUnitValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OperationItems whereWidth($value)
 */
	class OperationItems extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $payroll_run_id
 * @property int $employee_id
 * @property numeric $leave_days_paid
 * @property numeric $leave_days_unpaid
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \App\Models\Employee $employee
 * @property-read float $total_leave_days
 * @property-read \App\Models\PayrollRun $payrollRun
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollEntry whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollEntry whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollEntry whereLeaveDaysPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollEntry whereLeaveDaysUnpaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollEntry whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollEntry wherePayrollRunId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollEntry whereUpdatedAt($value)
 */
	class PayrollEntry extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon $period_start
 * @property \Illuminate\Support\Carbon $period_end
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PayrollEntry> $payrollEntries
 * @property-read int|null $payroll_entries_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollRun newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollRun newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollRun query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollRun whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollRun whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollRun whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollRun wherePeriodEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollRun wherePeriodStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollRun whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PayrollRun whereUpdatedAt($value)
 */
	class PayrollRun extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property int|null $pos_id
 * @property numeric $opening_balance
 * @property numeric|null $closing_balance
 * @property string $opened_at
 * @property string|null $closed_at
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PosShift newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PosShift newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PosShift query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PosShift whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PosShift whereClosedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PosShift whereClosingBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PosShift whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PosShift whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PosShift whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PosShift whereOpenedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PosShift whereOpeningBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PosShift wherePosId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PosShift whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PosShift whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PosShift whereUserId($value)
 */
	class PosShift extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_deleted
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Unit> $units
 * @property-read int|null $units_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Price newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Price newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Price query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Price whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Price whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Price whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Price whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Price whereUpdatedAt($value)
 */
	class Price extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $pname
 * @property string|null $ptext
 * @property string|null $ptype
 * @property string|null $info
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $isdeleted
 * @property int $tenant
 * @property int|null $branch_id
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProType whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProType whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProType whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProType wherePname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProType wherePtext($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProType wherePtype($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProType whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProType whereUpdatedAt($value)
 */
	class ProType extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Process newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Process newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Process query()
 */
	class Process extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $order_number
 * @property \Illuminate\Support\Carbon $order_date
 * @property int $customer_id
 * @property numeric $total_amount
 * @property string $status
 * @property string|null $notes
 * @property int $created_by
 * @property int $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \App\Models\User $createdBy
 * @property-read \Modules\Accounts\Models\AccHead $customer
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @property-read \App\Models\OperHead|null $productionInvoice
 * @property-read \App\Models\User $updatedBy
 * @method static \Database\Factories\ProductionOrderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductionOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductionOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductionOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductionOrder whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductionOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductionOrder whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductionOrder whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductionOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductionOrder whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductionOrder whereOrderDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductionOrder whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductionOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductionOrder whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductionOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductionOrder whereUpdatedBy($value)
 */
	class ProductionOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $client_id
 * @property int $working_days
 * @property int $daily_work_hours
 * @property int $holidays
 * @property string|null $working_zone
 * @property int|null $project_type_id
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property \Illuminate\Support\Carbon|null $actual_end_date
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property string|null $project_code
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \App\Models\User|null $createdBy
 * @property-read \App\Models\User|null $updatedBy
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereActualEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDailyWorkHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereHolidays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereProjectCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereProjectTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereWorkingDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereWorkingZone($value)
 */
	class Project extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rental newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rental newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rental query()
 */
	class Rental extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $pro_id
 * @property int|null $is_stock
 * @property int|null $is_finance
 * @property int|null $is_manager
 * @property int|null $is_journal
 * @property int|null $journal_type
 * @property int|null $currency_id
 * @property numeric $currency_rate
 * @property string|null $info
 * @property string $start_time
 * @property string $end_time
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $pro_date
 * @property string|null $accural_date
 * @property int|null $pro_pattren
 * @property string|null $pro_num
 * @property string|null $pro_serial
 * @property string|null $tax_num
 * @property int|null $price_list
 * @property int|null $store_id
 * @property int|null $emp_id
 * @property int|null $emp2_id
 * @property int|null $acc1
 * @property numeric|null $acc1_before
 * @property numeric|null $acc1_after
 * @property int|null $acc2
 * @property numeric|null $acc2_before
 * @property numeric|null $acc2_after
 * @property numeric|null $pro_value
 * @property numeric|null $fat_cost
 * @property int|null $cost_center
 * @property numeric|null $profit
 * @property numeric|null $fat_total
 * @property numeric $fat_net
 * @property numeric|null $fat_disc
 * @property numeric|null $fat_disc_per
 * @property numeric|null $fat_plus
 * @property numeric|null $fat_plus_per
 * @property numeric|null $fat_tax
 * @property numeric|null $fat_tax_per
 * @property string $crtime
 * @property int $acc_fund
 * @property int $op2
 * @property int $isdeleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user
 * @property int $tenant
 * @property int $closed
 * @property int $is_locked
 * @property string|null $info2
 * @property string|null $info3
 * @property string|null $details
 * @property int|null $project_id
 * @property int|null $acc3
 * @property int|null $pro_type
 * @property int $status
 * @property int $workflow_state workflow stage for multi-stage operations
 * @property int|null $origin_id
 * @property int|null $parent_id
 * @property int|null $approved_by
 * @property string|null $approved_at
 * @property string|null $approval_notes
 * @property numeric $paid_from_client
 * @property string|null $expected_time
 * @property int|null $production_order_id
 * @property int|null $branch_id
 * @property int|null $manufacturing_order_id
 * @property int|null $manufacturing_stage_id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereAcc1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereAcc1After($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereAcc1Before($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereAcc2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereAcc2After($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereAcc2Before($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereAcc3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereAccFund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereAccuralDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereApprovalNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereCostCenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereCrtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereCurrencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereEmp2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereEmpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereExpectedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereFatCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereFatDisc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereFatDiscPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereFatNet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereFatPlus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereFatPlusPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereFatTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereFatTaxPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereFatTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereInfo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereInfo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereIsFinance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereIsJournal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereIsLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereIsManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereIsStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereJournalType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereManufacturingOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereManufacturingStageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereOp2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereOriginId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report wherePaidFromClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report wherePriceList($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereProDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereProId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereProNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereProPattren($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereProSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereProType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereProValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereProductionOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereTaxNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereWorkflowState($value)
 */
	class Report extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $contract_id
 * @property int $sequence
 * @property string $name
 * @property string|null $information
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Contract $contract
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryPoint query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryPoint whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryPoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryPoint whereInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryPoint whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryPoint whereSequence($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SalaryPoint whereUpdatedAt($value)
 */
	class SalaryPoint extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $company_name
 * @property string|null $company_add
 * @property string|null $company_email
 * @property string|null $company_tel
 * @property string|null $edit_pass
 * @property string|null $lic
 * @property string|null $updateline
 * @property int $acc_rent
 * @property string|null $startdate
 * @property string|null $enddate
 * @property string $lang
 * @property string|null $bodycolor
 * @property int $showhr
 * @property int $showclinc
 * @property int $showatt
 * @property int $showpayroll
 * @property int $showrent
 * @property int $showpay
 * @property int $showtsk
 * @property int|null $def_pos_client
 * @property int|null $def_pos_store
 * @property int|null $def_pos_employee
 * @property int|null $def_pos_fund
 * @property int $isdeleted
 * @property int $tenant
 * @property int|null $show_all_tasks
 * @property string|null $logo
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $branch_id
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereAccRent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereBodycolor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereCompanyAdd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereCompanyEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereCompanyTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereDefPosClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereDefPosEmployee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereDefPosFund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereDefPosStore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereEditPass($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereEnddate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereLic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereShowAllTasks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereShowatt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereShowclinc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereShowhr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereShowpay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereShowpayroll($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereShowrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereShowtsk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereStartdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereUpdateline($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $start_time
 * @property string|null $beginning_check_in
 * @property string|null $ending_check_in
 * @property int|null $allowed_late_minutes الوقت المسموح به للتأخير بعد بداية وقت الدخول بالدقائق
 * @property string $end_time
 * @property string|null $beginning_check_out
 * @property string|null $ending_check_out
 * @property int|null $allowed_early_leave_minutes الوقت المسموح به للخروج المبكر قبل نهاية الوردية بالدقائق
 * @property string $shift_type
 * @property string|null $notes
 * @property string $days
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employee> $employees
 * @property-read int|null $employees_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift whereAllowedEarlyLeaveMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift whereAllowedLateMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift whereBeginningCheckIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift whereBeginningCheckOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift whereEndingCheckIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift whereEndingCheckOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift whereShiftType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shift whereUpdatedAt($value)
 */
	class Shift extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property int $country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\City> $cities
 * @property-read int|null $cities_count
 * @property-read \App\Models\Country $country
 * @method static \Illuminate\Database\Eloquent\Builder<static>|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|State query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|State whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|State whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|State whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|State whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|State whereUpdatedAt($value)
 */
	class State extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property numeric|null $latitude
 * @property numeric|null $longitude
 * @property int $city_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property numeric|null $distance
 * @property numeric|null $distance_from_headquarters
 * @property-read \App\Models\City $city
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Town newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Town newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Town query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Town whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Town whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Town whereDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Town whereDistanceFromHeadquarters($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Town whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Town whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Town whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Town whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Town whereUpdatedAt($value)
 */
	class Town extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $pro_id
 * @property int|null $is_stock
 * @property int|null $is_finance
 * @property int|null $is_manager
 * @property int|null $is_journal
 * @property int|null $journal_type
 * @property int|null $currency_id
 * @property numeric $currency_rate
 * @property string|null $info
 * @property string $start_time
 * @property string $end_time
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $pro_date
 * @property string|null $accural_date
 * @property int|null $pro_pattren
 * @property string|null $pro_num
 * @property string|null $pro_serial
 * @property string|null $tax_num
 * @property int|null $price_list
 * @property int|null $store_id
 * @property int|null $emp_id
 * @property int|null $emp2_id
 * @property int|null $acc1
 * @property numeric|null $acc1_before
 * @property numeric|null $acc1_after
 * @property int|null $acc2
 * @property numeric|null $acc2_before
 * @property numeric|null $acc2_after
 * @property numeric|null $pro_value
 * @property numeric|null $fat_cost
 * @property int|null $cost_center
 * @property numeric|null $profit
 * @property numeric|null $fat_total
 * @property numeric $fat_net
 * @property numeric|null $fat_disc
 * @property numeric|null $fat_disc_per
 * @property numeric|null $fat_plus
 * @property numeric|null $fat_plus_per
 * @property numeric|null $fat_tax
 * @property numeric|null $fat_tax_per
 * @property string $crtime
 * @property int $acc_fund
 * @property int $op2
 * @property int $isdeleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user
 * @property int $tenant
 * @property int $closed
 * @property int $is_locked
 * @property string|null $info2
 * @property string|null $info3
 * @property string|null $details
 * @property int|null $project_id
 * @property int|null $acc3
 * @property int|null $pro_type
 * @property int $status
 * @property int $workflow_state workflow stage for multi-stage operations
 * @property int|null $origin_id
 * @property int|null $parent_id
 * @property int|null $approved_by
 * @property string|null $approved_at
 * @property string|null $approval_notes
 * @property numeric $paid_from_client
 * @property string|null $expected_time
 * @property int|null $production_order_id
 * @property int|null $branch_id
 * @property int|null $manufacturing_order_id
 * @property int|null $manufacturing_stage_id
 * @property-read \Modules\Accounts\Models\AccHead|null $account1
 * @property-read \Modules\Accounts\Models\AccHead|null $account2
 * @property-read \Modules\Branches\Models\Branch|null $branch
 * @property-read \Modules\Accounts\Models\AccHead|null $emp1
 * @property-read \Modules\Accounts\Models\AccHead|null $emp2
 * @property-read \App\Models\ProType|null $type
 * @property-read \App\Models\User|null $user_name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer receipts()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereAcc1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereAcc1After($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereAcc1Before($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereAcc2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereAcc2After($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereAcc2Before($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereAcc3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereAccFund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereAccuralDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereApprovalNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereCostCenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereCrtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereCurrencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereEmp2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereEmpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereExpectedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereFatCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereFatDisc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereFatDiscPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereFatNet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereFatPlus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereFatPlusPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereFatTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereFatTaxPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereFatTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereInfo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereInfo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereIsFinance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereIsJournal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereIsLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereIsManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereIsStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereJournalType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereManufacturingOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereManufacturingStageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereOp2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereOriginId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer wherePaidFromClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer wherePriceList($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereProDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereProId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereProNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereProPattren($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereProSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereProType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereProValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereProductionOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereTaxNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfer whereWorkflowState($value)
 */
	class Transfer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $isdeleted
 * @property int $tenant
 * @property int|null $branch_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Barcode> $barcodes
 * @property-read int|null $barcodes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Price> $prices
 * @property-read int|null $prices_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit whereUpdatedAt($value)
 */
	class Unit extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property string|null $last_login_ip
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LoginSession> $activeSessions
 * @property-read int|null $active_sessions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Inquiries\Models\Inquiry> $assignedInquiries
 * @property-read int|null $assigned_inquiries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Branches\Models\Branch> $branches
 * @property-read int|null $branches_count
 * @property-read \App\Models\Employee|null $employee
 * @property-read mixed $employee_id
 * @property-read mixed $finger_print_id
 * @property-read mixed $finger_print_name
 * @property-read \Modules\Inquiries\Models\UserInquiryPreference|null $inquiryPreferences
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LoginSession> $loginSessions
 * @property-read int|null $login_sessions_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Authorization\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Authorization\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastLoginIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VaribalValue> $varibalValues
 * @property-read int|null $varibal_values_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Varibal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Varibal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Varibal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Varibal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Varibal whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Varibal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Varibal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Varibal whereUpdatedAt($value)
 */
	class Varibal extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $varibal_id
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Varibal $varibal
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VaribalValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VaribalValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VaribalValue query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VaribalValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VaribalValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VaribalValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VaribalValue whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VaribalValue whereVaribalId($value)
 */
	class VaribalValue extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $pro_id
 * @property int|null $is_stock
 * @property int|null $is_finance
 * @property int|null $is_manager
 * @property int|null $is_journal
 * @property int|null $journal_type
 * @property int|null $currency_id
 * @property numeric $currency_rate
 * @property string|null $info
 * @property string $start_time
 * @property string $end_time
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $pro_date
 * @property string|null $accural_date
 * @property int|null $pro_pattren
 * @property string|null $pro_num
 * @property string|null $pro_serial
 * @property string|null $tax_num
 * @property int|null $price_list
 * @property int|null $store_id
 * @property int|null $emp_id
 * @property int|null $emp2_id
 * @property int|null $acc1
 * @property numeric|null $acc1_before
 * @property numeric|null $acc1_after
 * @property int|null $acc2
 * @property numeric|null $acc2_before
 * @property numeric|null $acc2_after
 * @property numeric|null $pro_value
 * @property numeric|null $fat_cost
 * @property int|null $cost_center
 * @property numeric|null $profit
 * @property numeric|null $fat_total
 * @property numeric $fat_net
 * @property numeric|null $fat_disc
 * @property numeric|null $fat_disc_per
 * @property numeric|null $fat_plus
 * @property numeric|null $fat_plus_per
 * @property numeric|null $fat_tax
 * @property numeric|null $fat_tax_per
 * @property string $crtime
 * @property int $acc_fund
 * @property int $op2
 * @property int $isdeleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user
 * @property int $tenant
 * @property int $closed
 * @property int $is_locked
 * @property string|null $info2
 * @property string|null $info3
 * @property string|null $details
 * @property int|null $project_id
 * @property int|null $acc3
 * @property int|null $pro_type
 * @property int $status
 * @property int $workflow_state workflow stage for multi-stage operations
 * @property int|null $origin_id
 * @property int|null $parent_id
 * @property int|null $approved_by
 * @property string|null $approved_at
 * @property string|null $approval_notes
 * @property numeric $paid_from_client
 * @property string|null $expected_time
 * @property int|null $production_order_id
 * @property int|null $branch_id
 * @property int|null $manufacturing_order_id
 * @property int|null $manufacturing_stage_id
 * @property-read \Modules\Accounts\Models\AccHead|null $account1
 * @property-read \Modules\Accounts\Models\AccHead|null $account2
 * @property-read \Modules\Accounts\Models\AccHead|null $emp1
 * @property-read \Modules\Accounts\Models\AccHead|null $emp2
 * @property-read \App\Models\ProType|null $type
 * @property-read \App\Models\User|null $user_id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher receipts()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereAcc1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereAcc1After($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereAcc1Before($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereAcc2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereAcc2After($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereAcc2Before($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereAcc3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereAccFund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereAccuralDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereApprovalNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereCostCenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereCrtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereCurrencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereEmp2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereEmpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereExpectedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereFatCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereFatDisc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereFatDiscPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereFatNet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereFatPlus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereFatPlusPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereFatTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereFatTaxPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereFatTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereInfo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereInfo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereIsFinance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereIsJournal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereIsLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereIsManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereIsStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereIsdeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereJournalType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereManufacturingOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereManufacturingStageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereOp2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereOriginId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher wherePaidFromClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher wherePriceList($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereProDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereProId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereProNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereProPattren($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereProSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereProType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereProValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereProductionOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereTaxNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereTenant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereWorkflowState($value)
 */
	class Voucher extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $employee_id
 * @property \Illuminate\Support\Carbon $date
 * @property string $status
 * @property \App\Models\User|null $created_by
 * @property \App\Models\User|null $updated_by
 * @property \App\Models\User|null $approved_by
 * @property \Illuminate\Support\Carbon|null $approved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee $employee
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkPermission whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkPermission whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkPermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkPermission whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkPermission whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkPermission whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkPermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkPermission whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkPermission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkPermission whereUpdatedBy($value)
 */
	class WorkPermission extends \Eloquent {}
}

