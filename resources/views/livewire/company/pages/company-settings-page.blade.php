@extends('layouts.company.app')


@section('content')
    @livewire('company-settings', ['company' => $company])
@endsection
