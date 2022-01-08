@extends('layouts.dashboard')

@section('title', 'Edit')

@section('breadcrumb')
@parent
<li class="breadcrumb-item"><a href="#">Categories</a></li>
<li class="breadcrumb-item"><a href="#">Edit</a></li>
@endsection

@section('content')

<form action="{{ route('dashboard.categories.update', $category->id) }}" method="post">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-md-8">
            <div class="form-group mb-3">
                <label for="name">Category Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}">
            </div>

            <div>
                <label for="parent_id">Category Parent</label>
                <select name="parent_id" id="parent_id" class="form-control">
                    <option value="">No Parent</option>
                    @foreach($parents as $parent)
                    <option value="{{ $parent->id }}" @if($parent->id == $category->id) selected @endif>{{ $parent->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description">{{ $category->description }}</textarea>
            </div>

            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="{{ route('dashboard.categories.index') }}" class="btn btn-light">Cancel</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group mb-3">
                <label for="image">Thumbnail</label>
                <input type="file" name="image" class="form-control" id="image">
            </div>
        </div>
    </div>


</form>

@endsection