@csrf
<div class="row">
    <div class="col-md-8">
        <div class="form-group mb-3">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $category->name) }}">

            {{-- @if($errors->has('name'))
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @endif --}}
            @error('name')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="parent_id">Category Parent</label>
            <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                <option value="">No Parent</option>
                @foreach($parents as $parent)
                <option value="{{ $parent->id }}" @if($parent->id == old('parent_id', $category->parent_id)) selected @endif>{{ $parent->name }}</option>
                @endforeach
            </select>
            @error('parent_id')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group mb-3">
            <button type="submit" class="btn btn-primary">{{ $button }}</button>
            <a href="{{ route('dashboard.categories.index') }}" class="btn btn-light">Cancel</a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="image">Thumbnail</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
            @error('image')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
