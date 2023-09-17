<form class="row" action="{{$formAction}}">
    @csrf
    <div class="col-12 mb-3">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="col-12 mb-3">
        <label class="form-label">Slug</label>
        <input type="text" class="form-control" name="slug">
    </div>
    <div class="col-12 mb-3">
        <label class="form-label">Body</label>
        <textarea class="form-control" name="body" rows="3"></textarea>
    </div>
    <div class="col-lg-6">
        <label class="form-label">Category</label>
        <select class="form-select" name="category_id">
            <option selected disabled>Select category</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6">
        <label class="form-label">Published</label>
        <input type="datetime-local" class="form-control" name="published_at">
    </div>
    <div class="col-12 mt-3 text-center">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
