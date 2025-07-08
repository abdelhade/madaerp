@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('Create Project'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('Projects'), 'url' => route('projects.index')], ['label' => __('Create Project')]],
    ])

    <livewire:projects.create />
@endsection
