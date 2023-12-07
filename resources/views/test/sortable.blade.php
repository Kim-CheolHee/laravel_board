@extends('layouts.app')

@section('content')
    <div class="container-fluid" x-data="sortableList()">
        <ul id="sortable-list" class="list-group">
            <template x-for="(item, index) in items" :key="index">
                <li class="list-group-item d-flex align-items-center sortable-item">
                    <span class="material-icons tw-text-lg drag-handle tw-cursor-move">view_headline</span>
                    <span x-text="item" class="ml-3"></span>
                </li>
            </template>
        </ul>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset(mix('js/test/categories/index.js')) }}"></script>
@endsection
