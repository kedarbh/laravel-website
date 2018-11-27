@extends('layouts.management')
@section('content')
<h1>Create New Post</h1>
<hr>
<form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div id="demo">
                <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" v-model="title" value="{{old('title')}}" placeholder="Enter Post Title" required>
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" :value="generatedSlug" aria-describedby="slugHelpText" required>
                        <small id="slugHelpText" class="form-text text-muted">Type correctly; Slug cannot be edited.</small>
                    </div>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <label for="post_image">Image</label>
                <input type="file" class="form-control-file" id="post_image" name="post_image" accept="image/*">
            </div>
            <div class="preview m-t-5">
                <p>No files selected for upload.</p>
            </div>
        </div>
        <div class="form-group">
            <label for="body"><strong>Page Content</strong></label>
            <textarea id="editor" class="form-control" id="body" name="body">{!! old('body') !!}</textarea>
        </div>
        <div class="row m-t-20 m-b-30">
            <div class="col">
                <input type="submit" name="draft" class="btn btn-secondary" value="Save as Draft">
                <input type="submit" name="publish" class="btn btn-primary" value="Create New Page">
                <a class="btn btn-danger" href="{{route('posts.index')}}">Cancel</a>
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

        var app = new Vue({
        el: '#demo',
        data: function(){
            return{
                title:'',
                slug: ''
            };
        },
        computed: {
            generatedSlug: function() {
                this.newTitle = this.title.replace(/([^\w\s]|_)/gi, '');
                return this.newTitle.toLowerCase().split(' ').join('-');
            }
        }
    });
</script>
@endsection

