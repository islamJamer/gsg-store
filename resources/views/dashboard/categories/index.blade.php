@extends('layouts.dashboard')

@section('title', $title)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="#">Categories</a></li>
@endsection

@section('content')
    <div class="table-toolbar">
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary">Create</a>
    </div>
    <dev class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Serial Num.</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $index=>$category)                
                <tr>
                    <td>{{ $index }}</td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent_name }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.categories.edit', [$category->id]) }}" class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </dev>

@endsection