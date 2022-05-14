@extends('layouts.company.app')


@section('content')
    @livewire('company-workers-info', ['worker' => $worker])
@endsection
