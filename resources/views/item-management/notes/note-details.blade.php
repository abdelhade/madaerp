@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('Notes Details'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('Notes Details')]],
    ])

    <livewire:item-management.notes.note-details :noteId="$noteId" />
@endsection
