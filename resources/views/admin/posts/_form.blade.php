<form class="row" method="post" action="{{$formAction}}" id="editPostForm" novalidate>
    @csrf
    <div class="col-12 mb-3">
        <label class="form-label">Title</label>
        <input required type="text" class="form-control" name="title" value="{{ $post->title ?? old('title') }}">
        <div class="invalid-feedback">
            Please provide a valid title.
        </div>
    </div>
    <div class="col-12 mb-3">
        <label class="form-label">Slug</label>
        <input type="text" class="form-control" name="slug" value="{{ $post->slug ?? old('slug') }}">
    </div>
    <div class="col-12 mb-3">
        <label class="form-label">Body</label>
        <div id="editor" class="form-control"></div>
        <input type="hidden" name="body_html">
        <input type="hidden" name="body_markdown" value="{{ $post->body_markdown ?? old('body_markdown') }}">
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
@push('scripts')
    <script src="{{asset('js/admin/edit-post-form.js')}}"></script>
@endpush
