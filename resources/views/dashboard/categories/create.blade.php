@extends('layouts.dashboard')

@section('title', 'Create')

@section('breadcrumb')
@parent
<li class="breadcrumb-item"><a href="#">Categories</a></li>
<li class="breadcrumb-item"><a href="#">Create</a></li>
@endsection

@section('content')
{{-- 
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
--}}

<form action="{{ route('dashboard.categories.post') }}" method="post">
    @include('dashboard.categories.shared.form',[
        'button' => 'Create'
    ])
</form>

@endsection