@extends ('layouts.management')
@section ('content')
<h2>Add New Tour Package</h2>
<hr> @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{route('packages.store')}}" method="POST">
    {{csrf_field()}}
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" placeholder="Enter Package Title">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug')}}" aria-describedby="slugHelpText" placeholder="enter-slug-in-dashed-format">
                        <small id="slugHelpText" class="form-text text-muted">Type correctly; Slug cannot be edited.</small>
                    </div>

                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Features</legend>
                            <div class="col-sm-10">
                                <div>
                                    <input class="form-control" type="text" name="feature1" id="feature1" value="{{old('feature1')}}">
                                    <small><label for="feature1">Feature 1</label></small>
                                </div>
                                <div>
                                    <input class="form-control" type="text" name="feature2" id="feature2" value="{{old('feature2')}}">
                                    <small><label  for="feature2">Feature 2</label></small>
                                </div>
                                <div>
                                    <input class="form-control" type="text" name="feature3" id="feature3" value="{{old('feature3')}}">
                                    <small><label for="feature3">Feature3</label></small>
                                </div>
                                <div>
                                    <input class="form-control" type="text" name="feature4" id="feature4" value="{{old('feature4')}}">
                                    <small><label for="feature4">Feature4</label></small>
                                </div>
                                <div>
                                    <input class="form-control" type="text" name="feature5" id="feature5" value="{{old('feature5')}}">
                                    <small><label for="feature5">Feature5</label></small>
                                </div>
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
                        <button type="submit" class="btn btn-secondary m-r-5">Save as Draft</button>
                        <button type="submit" class="btn btn-primary m-r-5">Publish Package</button>
                        <a class="btn btn-danger" href="{{route('packages.index')}}">Cancel</a>
                    </div>
                    <hr>
                    <strong>Status:</strong><span class="m-l-10">Pubished</span>
                    <hr>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" value="{{old('price')}}">
                    </div>
                    {{--
                    <div class="form-group">
                        <div>
                            <label for="image">Image</label>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div> --}} {{-- TODO: display image thumbnail here when admin uploads one --}} {{-- </div> --}}

                    <div id="image-upload">
                    </div>


                </div>
            </div>
        </div>
    </div>
    <hr>
    <div>
        <div class="col">
            <div class="form-group">
                <label for="description"><strong>Tour Page Content</strong></label>
                <textarea id="editor" class="form-control" id="content" name="content" value="{{old('content')}}" placeholder="Enter Tour Description"
                    rows="30"></textarea>
            </div>
        </div>
    </div>

    <div class="row m-t-20 m-b-30">
        <div class="col">
            <button type="submit" class="btn btn-primary">Create New Package</button>
            <a class="btn btn-secondary" href="{{route('packages.index')}}">Cancel</a>
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
            maxHeight: null,
            focus:true
        });
    });

    new Vue({
    el: '#image-upload',
    template: `
        <div class="form-group">
            <div>
                <label for="image">Image</label>
            </div>
            <div class="custom-file">
                <input type="file" id="image" class="custom-file-input" name="image" @change="previewImage" accept="image/*" value="{{old('image')}}">
                <label class="custom-file-label" for="image">Choose file</label>
            </div>
            <div v-if="imageData.length > 0">
                <p><em>Image Preview</em></p>
                <img class="preview" :src="imageData" height="200px">
            </div>
        </div>
    `,
    data: {
        imageData: ""  // we will store base64 format of image in this string
    },
    methods: {
        //source: https://jsfiddle.net/mani04/5zyozvx8/
        previewImage: function(event) {
            // Reference to the DOM input element
            var input = event.target;
            // Ensure that you have a file before attempting to read it
            if (input.files && input.files[0]) {
                // create a new FileReader to read this image and convert to base64 format
                var reader = new FileReader();
                // Define a callback function to run, when FileReader finishes its job
                reader.onload = (e) => {
                    // Read image as base64 and set to imageData
                    this.imageData = e.target.result;
                }
                // Start the reader job - read file as a data url (base64 format)
                reader.readAsDataURL(input.files[0]);
            }
        }
    }
});

</script>
@endsection
