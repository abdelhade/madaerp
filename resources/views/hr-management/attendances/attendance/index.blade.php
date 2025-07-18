@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('Attendances'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('HR Management')], ['label' => __('Attendances')]],
    ])

    <livewire:hr-management.attendances.attendance.index />
 
@endsection