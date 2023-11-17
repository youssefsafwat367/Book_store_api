@extends('adminlte::page')
@section('title', 'Edit Branch')
@section('content')
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <style>
        /*
            *
            * ==========================================
            * CUSTOM UTIL CLASSES
            * ==========================================
            *
            */
        #upload {
            opacity: 0;
        }

        #upload-label {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
        }

        .image-area {
            border: 2px dashed rgba(255, 255, 255, 0.7);
            padding: 1rem;
            position: relative;
        }

        .image-area::before {
            content: 'Uploaded image result';
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 0.8rem;
            z-index: 1;
        }

        .image-area img {
            z-index: 2;
            position: relative;
        }
    </style>
    <div class="container bootstrap snippets bootdey">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="well profile">
                    <br>
                    <h3 class="name pull-left clearfix"> Branch Name : {{ $branch->short_address }}</h3>
                    <div class="clearfix"></div>
                    <ul class="nav nav-tabs">
                        <li class="">
                            <a href="#tab2" data-toggle="tab">
                                Overview
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab">
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="row">
                                <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="basic">
                                            <form class="form-horizontal" role="form"
                                                action="
                                                {{ route('admin.branches.update', ['id' => $branch->id]) }}"
                                                method="POST" >
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="inputfullname" class="col-lg-2 control-label">Short
                                                        address</label>
                                                    <div class="col-lg-15">
                                                        <input type="text" class="form-control" id="inputfullname"
                                                            placeholder="Short address" value="{{ $branch->short_address }}"
                                                            name="short_address">
                                                    </div>
                                                </div>
                                                @error('short_address')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="inputfullname" class="col-lg-2 control-label">Full
                                                        address</label>
                                                    <div class="col-lg-15">
                                                        <input type="text" class="form-control" id="inputfullname"
                                                            placeholder="Full address" value="{{ $branch->full_address }}"
                                                            name="full_address">
                                                    </div>
                                                </div>
                                                @error('full_address')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="inputfullname" class="col-lg-2 control-label">City
                                                    </label>
                                                    <div class="col-lg-15">
                                                        <input type="text" class="form-control" id="inputfullname"
                                                            placeholder="City" value="{{ $branch->city }}" name="city">
                                                    </div>
                                                </div>
                                                @error('city')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="inputfullname" class="col-lg-2 control-label">phone
                                                    </label>
                                                    <div class="col-lg-15">
                                                        <input type="number" class="form-control" id="inputfullname"
                                                            placeholder="phone" value="{{ $branch->phone }}" name="phone">
                                                    </div>
                                                </div>
                                                @error('phone')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                        </div>
                                        <div class="text-center">
                                            <br>
                                            <input type="submit" class="btn btn-primary" value="Update ">
                                        </div>

                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        /*  ==========================================
                                        SHOW UPLOADED IMAGE
                                    * ========================================== */
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imageResult')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function() {
            $('#upload').on('change', function() {
                readURL(input);
            });
        });
        /*  ==========================================
            SHOW UPLOADED IMAGE NAME
        * ========================================== */
        var input = document.getElementById('upload');
        var infoArea = document.getElementById('upload-label');

        input.addEventListener('change', showFileName);

        function showFileName(event) {
            var input = event.srcElement;
            var fileName = input.files[0].name;
            infoArea.textContent = 'File name: ' + fileName;
        }
    </script>
@endsection
