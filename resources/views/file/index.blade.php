@extends('layouts.app')

@section('content')
    <style>

        .file-upload input[type='file'] {
            display: none;
        }

        body {
            background: #00B4DB;
            background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);
            background: linear-gradient(to right, #0083B0, #00B4DB);
            height: 100vh;
        }

        .rounded-lg {
            border-radius: 1rem;
        }

        .custom-file-label.rounded-pill {
            border-radius: 50rem;
        }

        .custom-file-label.rounded-pill::after {
            border-radius: 0 50rem 50rem 0;
        }

        body {
            font-family: sans-serif;
            background-color: #eeeeee;
        }

        .file-upload {
            background-color: #ffffff;
            width: 600px;
            margin-top: 50px;
            padding: 20px;
        }

        .file-upload-btn {
            width: 100%;
            margin: 0;
            color: #fff;
            background: #00B4DB;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #00B4DB;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .file-upload-btn:hover {
            background: #00B4DB;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .file-upload-btn:active {
            border: 0;
            transition: all .2s ease;
        }

        .file-upload-content {
            display: none;
            text-align: center;
        }

        .file-upload-input {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
            cursor: pointer;
        }

        .image-upload-wrap {
            margin-top: 20px;
            border: 4px dashed #00B4DB;
            position: relative;
        }

        .image-dropping,
        .image-upload-wrap:hover {
            background-color: #00B4DB;
            border: 4px dashed #ffffff;
        }

        .image-title-wrap {
            padding: 0 15px 15px 15px;
            color: #222;
        }

        .drag-text {
            text-align: center;
        }

        .drag-text h3 {
            font-weight: 100;
            text-transform: uppercase;
            color: gray;
            padding: 60px 0;
        }

        .file-upload-image {
            max-height: 200px;
            max-width: 200px;
            margin: auto;
            padding: 20px;
        }

        .remove-file {
            width: 200px;
            margin: 0;
            color: #fff;
            background: #cd4535;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #b02818;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .remove-file:hover {
            background: #c13b2a;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .remove-file:active {
            border: 0;
            transition: all .2s ease;
        }

        .upload-file {
            width: 200px;
            height: 60px;
            margin: 0;
            color: #fff;
            background: #4ad295;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #43c58c;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .upload-file:hover {
            background: #43c58c;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .upload-file:active {
            border: 0;
            transition: all .2s ease;
        }

    </style>
    <section>
        <div class="container p-5">
            <!-- For demo purpose -->
            <div class="row mb-5 text-center text-white">
                <div class="col-lg-10 mx-auto">
                </div>
            </div>
            <!-- End -->


            <form action="{{ route('plugins.upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="p-5 bg-white shadow rounded-lg"><img src="https://res.cloudinary.com/mhmd/image/upload/v1557366994/img_epm3iz.png" alt="" width="200" class="d-block mx-auto mb-4 rounded-pill">

                            <!-- Default bootstrap file upload-->

                            <div class="image-upload-wrap">
                                <input class="file-upload-input" name="pluginFile" type="file" id="pluginFile" onchange="readURL(this);" />
                                <div class="drag-text">
                                    <h3>Drag and drop a file or select add Image</h3>
                                </div>
                            </div>
                            <div class="file-upload-content">
                                <div class="image-title-wrap">
                                    <div class="row" style="padding-left: 21%; padding-bottom: 10%">
                                        <div>
                                            <button type="button" onclick="removeUpload()" class="remove-file">Remove <span class="image-title">Uploaded Image</span></button>
                                        </div>
                                    </div>
                                    <div class="row"  style="padding-left: 21%">
                                        <div>
                                            <button class="upload-file" type="submit">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End -->

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.image-upload-wrap').hide();

                        $('.file-upload-image').attr('src', e.target.result);
                        $('.file-upload-content').show();

                        $('.image-title').html(input.files[0].name);
                    };

                    reader.readAsDataURL(input.files[0]);

                } else {
                    removeUpload();
                }
            }

            function removeUpload() {
                $('.file-upload-input').replaceWith($('.file-upload-input').clone());
                $('.file-upload-content').hide();
                $('.image-upload-wrap').show();
            }
            $('.image-upload-wrap').bind('dragover', function () {
                $('.image-upload-wrap').addClass('image-dropping');
            });
            $('.image-upload-wrap').bind('dragleave', function () {
                $('.image-upload-wrap').removeClass('image-dropping');
            });

        </script>
    </section>

@endsection
