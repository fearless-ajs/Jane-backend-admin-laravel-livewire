@extends('layouts.admin.app')

@section('content')
    @livewire('admin-company-workers-info', ['worker' => $worker])
@endsection
