@extends('layout.app_with_login')
@section('title','User List')
@section('container')
<div class="row mt-5">

    <div class="col-12 text-end"><a href="{{  route('auth.logout') }}">Logout</a></div>
    <div class="col-12">
        <h1>User List</h1>
    </div>
    <div class="col-12">
        {!! $html->table(
        ['class' => 'user_listing table text-center table-sortable responsive table', 'width' => '100%'],
        true,
        ) !!}
    </div>
</div>
@endsection
@push('custom-styles')

@endpush
@push('custom-scripts')
{!! $html->scripts() !!}
@endpush