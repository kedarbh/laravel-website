@extends ('layouts.management')
@section ('content')
<h1>Edit Post</h1>
<hr> @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}{{method_field('PUT')}}
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{old('title', $post->title)}}" placeholder="Enter Post Title" >
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug:</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{$post->slug}}" aria-describedby="slugHelpText" disabled>
                        <small id="slugHelpText" class="form-text text-muted">Slug cannot be edited.</small>
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <label for="post_image">Image</label>
                            <input type="file" class="form-control-file" id="post_image" name="post_image" accept="image/*">
                        </div>
                        <div class="preview m-t-5">
                            @if ($post->image)
                                @if ($post->image === 'noimage.jpg')
                                    <img src="/storage/{{$post->image}}" alt="no image available" width="100%">
                                @else
                                    <img src="/storage/post_images/{{$post->image}}" alt="featured image of {{$post->title}}" width="100%">
                                @endif
                            @else
                                <P>No Image uploaded.</P>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <input type="submit" name="draft" class="btn btn-secondary m-r-5" value="Save as Draft">
                        <input type="submit" name="publish" class="btn btn-primary m-r-5" value="Update Post">
                        <a class="btn btn-danger" href="{{route('posts.index')}}">Cancel</a>
                    </div>
                    <hr>
                    <p>
                        <strong>Status:</strong>
                        <span class="m-l-10">
                            @if ($post->status === 0)
                                Draft
                            @elseif ($post->status === 1)
                                Published
                            @endif
                        </span>
                    </p>
                    <hr>

                </div>
            </div>
        </div>
    </div>
    <hr>
    <div>
        <div class="col">
            <div class="form-group">
                <label for="body"><strong>Post Content</strong></label>
                <textarea id="editor" class="form-control" id="body" name="body" placeholder="Enter Post Content">{{old('body', $post->body)}}</textarea>
            </div>
        </div>
    </div>

    <div class="row m-t-20 m-b-30">
        <div class="col">
            <input type="submit" name="draft" class="btn btn-secondary" value="Save as Draft">
            <input type="submit" name="publish" class="btn btn-primary" value="Update Post">
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

    let input = document.querySelector('input[type=file]');
    let preview = document.querySelector('.preview');
    input.addEventListener('change', previewImage);

    function previewImage() {

        while(preview.firstChild) {
            preview.removeChild(preview.firstChild);
        }

        let imgFile = input.files;
        if(imgFile.length != 0) {
            let image = document.createElement('img');
            image.src = window.URL.createObjectURL(imgFile[0]);
            image.style.cssText = 'height: 240px';
            image.className = 'm-t-10'
            preview.appendChild(image);
            console.log(image.src)
        } else {
            preview.innerHTML = `<p>No file selected for upload.</p>`;
        }
    }
</script>
@endsection
