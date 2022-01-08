@extends('layouts.dashboard')

@section('title', 'Edit')

@section('breadcrumb')
@parent
<li class="breadcrumb-item"><a href="#">Categories</a></li>
<li class="breadcrumb-item"><a href="#">Edit</a></li>
@endsection

@section('content')

<form action="{{ route('dashboard.categories.update', $category->id) }}" method="post">
    @method('put')
    @include('dashboard.categories.shared.form',[
        'button' => 'Edit'
    ])
</form>

@endsection