@extends ('layouts.management')
@section ('content')
<h2>Add New Page</h2>
<hr> @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{route('pages.store')}}" method="POST">
    {{csrf_field()}}
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" placeholder="Enter Page Title" >
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug')}}" aria-describedby="slugHelpText" placeholder="enter-slug-in-dashed-format" required>
                        <small id="slugHelpText" class="form-text text-muted">Type correctly; Slug cannot be edited.</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <input type="submit" name="draft" class="btn btn-secondary m-r-5" value="Save as Draft">
                        <input type="submit" name="publish" class="btn btn-primary m-r-5" value="Create New Page">
                        <a class="btn btn-danger" href="{{route('pages.index')}}">Cancel</a>
                    </div>
                    <hr>
                    <strong>Status:</strong><span class="m-l-10">Pubished</span>
                    <hr>

                </div>
            </div>
        </div>
    </div>
    <hr>
    <div>
        <div class="col">
            <div class="form-group">
                <label for="body"><strong>Page Content</strong></label>
                <textarea id="editor" class="form-control" id="body" name="body" placeholder="Enter Page Content"
                    rows="30">{!! old('body') !!}</textarea>
            </div>
        </div>
    </div>

    <div class="row m-t-20 m-b-30">
        <div class="col">
            <input type="submit" name="draft" class="btn btn-secondary" value="Save as Draft">
            <input type="submit" name="publish" class="btn btn-primary" value="Create New Page">
            <a class="btn btn-danger" href="{{route('pages.index')}}">Cancel</a>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#editor').summernote({
            height:300,
            minHeight: null,
            maxHeight: null
            // focus:true
        });
    });
</script>
@endsection
