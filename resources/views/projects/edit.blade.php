@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('Edit Project'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('Projects'), 'url' => route('projects.index')], ['label' => __('Edit Project')]],
    ])

    <livewire:projects.edit :project="$project" />
@endsection
