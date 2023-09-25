<form class="row" method="post" action="{{$formAction}}" id="editPostForm" novalidate>
    @csrf
    @if(isset($post))
        @method('PUT')
    @endif
    <div class="col-12 mb-3">
        <label class="form-label">Title</label>
        <input required type="text" class="form-control" name="title" value="{{ $post->title ?? old('title') }}">
        <div class="invalid-feedback">
            Please provide a valid title.
        </div>
    </div>
    <div class="col-12 mb-3">
        <label class="form-label">Slug</label>
        <div class="input-group">
            <input type="text" class="form-control" name="slug" value="{{ $post->slug ?? old('slug') }}">
            <button class="btn btn-outline-secondary" type="button" id="generateSlugBtn">Generate</button>
        </div>
    </div>
    <div class="col-12 mb-3">
        <label class="form-label">Body</label>
        <div id="editor"></div>
        <input type="hidden" name="body_html">
        <input type="hidden" name="body_markdown" value="{{ $post->body_markdown ?? old('body_markdown') }}">
    </div>
    <div class="col-lg-6">
        <label class="form-label">Published</label>
        <input type="datetime-local" class="form-control" name="published_at" value="{{ $post->published_at ?? old('published_at') }}">
    </div>
    <div class="col-lg-6">
        <label class="form-label">Tags</label>
        <select class="form-select" name="tags[]" multiple>
            @foreach($tags as $tag)
                <option value="{{$tag->id}}" {{isset($post) && $post->tags->contains($tag->id) ? 'selected' : ''}}>{{$tag->title}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 mt-3 text-center">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
@push('scripts')
    <script src="{{asset('js/admin/edit-post-form.js')}}"></script>
@endpush
