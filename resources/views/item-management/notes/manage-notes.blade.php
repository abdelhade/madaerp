@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('Notes'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('Notes')]],
    ])

    <livewire:item-management.notes.manage-notes />
@endsection
