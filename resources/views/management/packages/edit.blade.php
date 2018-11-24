@extends ('layouts.management')
@section ('content')
<h2>Edit {{$package->title}}</h2>
<hr> @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{route('packages.update', $package->id)}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}{{method_field('PUT')}}
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$package->title}}" placeholder="Enter Package Title">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{$package->slug}}" aria-describedby="slugHelpText" placeholder="enter-slug-in-dashed-format">
                        <small id="slugHelpText" class="form-text text-muted">Type correctly; Slug cannot be edited.</small>
                    </div>

                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-3 pt-0">Features</legend>
                            <div class="col-sm-9">
                                @for ($i = 0; $i < count(json_decode($package->feature)); $i++)
                                    @php
                                        $item = json_decode($package->feature);
                                    @endphp
                                    <div>
                                        <input class="form-control" type="text" name="feature[]" id="feature{{$i+1}}" value="{{$item[$i]}}">
                                        <small><label for="feature{{$i+1}}">Feature {{$i+1}}</label></small>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <input type="submit" name="draft" class="btn btn-secondary m-r-5" value="Save as Draft">
                        <input type="submit" name="publish" class="btn btn-primary m-r-5" value="Create New Package">
                        <a class="btn btn-danger" href="{{route('packages.index')}}">Cancel</a>
                    </div>
                    <hr>
                    <p>
                        <strong>Status:</strong>
                        <span class="m-l-10">
                            @if ($package->status === 0)
                                Draft
                            @elseif ($package->status === 1)
                                Published
                            @endif
                        </span>
                    </p>
                    <hr>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" value="{{$package->price}}">
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <label for="featured_image">Image</label>
                            <input type="file" class="form-control-file" name="featured_image" accept="image/*">
                        </div>
                        <div class="preview m-t-15">
                            @if ($package->image)
                                <img src="/storage/featured_images/{{$package->image}}" alt="feature image of {{$package->title}}" width="100%">
                            @else
                                <P>No Image uploaded before.</P>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="description"><strong>Tour Page Content</strong></label>
                <textarea id="editor" class="form-control" id="content" name="content" placeholder="Enter Tour Description">{{$package->content}}</textarea>
            </div>
        </div>
    </div>
    <div class="row m-t-20 m-b-30">
        <div class="col">
            <input type="submit" name="draft" class="btn btn-secondary" value="Save as Draft">
            <input type="submit" name="publish" class="btn btn-primary" value="Create New Package">
            <a class="btn btn-danger" href="{{route('packages.index')}}">Cancel</a>
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
</script>
@endsection
