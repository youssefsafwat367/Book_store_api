@extends('adminlte::page')
@section('title', 'Edit User')
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
                    <h3 class="name pull-left clearfix"> User Name : {{ $user->name }}</h3>
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
                                                {{ route('admin.users.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="inputfullname" class="col-lg-2 control-label">First
                                                        Name</label>
                                                    <div class="col-lg-15">
                                                        <input type="text" class="form-control" id="inputfullname"
                                                            placeholder="First Name" value="{{ $user->fname }}"
                                                            name="fname">
                                                    </div>
                                                </div>
                                                @error('fname')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="inputfullname" class="col-lg-2 control-label">Last
                                                        Name</label>
                                                    <div class="col-lg-15">
                                                        <input type="text" class="form-control" id="inputfullname"
                                                            placeholder="Last Name" value="{{ $user->lname }}"
                                                            name="lname">
                                                    </div>
                                                </div>
                                                @error('lname')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="inputfullname" class="col-lg-2 control-label">Full
                                                        Name</label>
                                                    <div class="col-lg-15">
                                                        <input type="text" class="form-control" id="inputfullname"
                                                            placeholder="Full Name" value="{{ $user->name }}"
                                                            name="name">
                                                    </div>
                                                </div>
                                                @error('name')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="inputfullname" class="col-lg-2 control-label">Email
                                                    </label>
                                                    <div class="col-lg-15">
                                                        <input type="email" class="form-control" id="inputfullname"
                                                            placeholder="Email" value="{{ $user->email }}" name="email">
                                                    </div>
                                                </div>
                                                @error('email')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="inputfullname" class="col-lg-2 control-label">Password
                                                    </label>
                                                    <div class="col-lg-15">
                                                        <input type="password" class="form-control" id="inputfullname"
                                                            placeholder="Password" value="" name="password">
                                                    </div>
                                                </div>
                                                @error('password')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <br>
                                                <label for="inputfullname" class="col-lg-2 control-label">User Image
                                                </label>
                                                <div class="container py-5">
                                                    <div class="row py-4">
                                                        <div class="col-lg-6 mx-auto">

                                                            <!-- Upload image input-->
                                                            <div
                                                                class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                                                <input id="upload" type="file"
                                                                    onchange="readURL(this);" class="form-control border-0"
                                                                    name="image">
                                                                <label id="upload-label" for="upload"
                                                                    class="font-weight-light text-muted">Choose
                                                                    file</label>
                                                                <div class="input-group-append">
                                                                    <label for="upload"
                                                                        class="btn btn-light m-0 rounded-pill px-4"> <i
                                                                            class="fa fa-cloud-upload mr-2 text-muted"></i><small
                                                                            class="text-uppercase font-weight-bold text-muted">Choose
                                                                            file</small></label>
                                                                </div>
                                                            </div>

                                                            <!-- Uploaded image area-->
                                                            <div class="image-area mt-4"><img id="imageResult"
                                                                    src="#" alt=""
                                                                    class="img-fluid rounded shadow-sm mx-auto d-block">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                @error('image')
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
