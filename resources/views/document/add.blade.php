@include('document.navbar')

<div class="container mt-5">

    <h3>Add Document</h3> <br>

    <form action="{{ route('document.save') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="doc_cat_id" class="form-label">Select Document Category</label>
            <select class="form-select" name="doc_cat_id" aria-label="Document Category">
                @foreach ($categories as $category)
                    <option value={{ $category->id }} @if ($category->id == old('doc_cat_id')) selected @endif>
                        {{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="doc_file" class="form-label">Select Document</label>
            <input class="form-control" type="file" name="doc_file" required>
        </div>

        @if ($errors->has('doc_file'))
            <span class="text-danger">{{ $errors->first('doc_file') }}</span>
        @endif

        <div class="mb-3">
            <label for="expiry_date" class="form-label">Expiry Date</label>
            <input type="date" class="form-control" id="expiry_date" name="expiry_date"
                value="{{ old('expiry_date', '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
