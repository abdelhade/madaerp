@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('Attendance Processing'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('HR Management')], ['label' => __('Attendance Processing')]],
    ])

    <livewire:hr-management.attendances.processing.manage-processing />
 
@endsection