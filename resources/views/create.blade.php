@extends('layouts.app')
@section('content')


<div class="container">

    <div class="row justify-content-center">

        <div class="card" style="margin-top: 4%">




            <div class="card-header bg-secondary dark bgsize-darken-4 white card-header">

                <h4 class="text-white">POST ADD</h4>

            </div>

            <div class="card-body">

                @if ($message = Session::get('success'))




                    <div class="alert alert-success alert-block">




                        <button type="button" class="close" data-dismiss="alert">×</button>




                        <strong>{{ $message }}</strong>




                    </div>

                    <br>

                @endif

                <form id="file-upload-form" class="uploader" action="{{route('post.save')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">

                    @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Post title</label>
                    <input type="text" class="form-control" placeholder="name" name="name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Post text</label>
                    <input type="text" class="form-control" placeholder="price" name="price">
                </div>
                    <input type="file" id="file-input" onchange="loadPreview(this)" name="image"   multiple/>

                    <span class="text-danger">{{ $errors->first('image') }}</span>

                    <div id="thumb-output"></div>

                    <br>
                    <div class="form-group">
                        <select name="category[]" class="bg-gray-700 w-64 px-4 py-1"  id="" multiple>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>

                </form>

            </div>

        </div>

    </div>

</div>




<script>




    function loadPreview(input){

        var data = $(input)[0].files;



        $.each(data, function(index, file){

            if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){

                var fRead = new FileReader();

                fRead.onload = (function(file){

                    return function(e) {

                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result);

                        $('#thumb-output').append(img);

                    };

                })(file);

                fRead.readAsDataURL(file);

            }

        });

    }




</script>
@endsection
