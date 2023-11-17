@extends('adminlte::page')
@section('title', 'categories')
@section('content')
    @include('layouts.admin.header')
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Categories</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addUserModal" class="btn btn-success" data-toggle="modal"><i
                                    class="material-icons">&#xE147;</i> <span>Add New Category</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id </th>
                            <th>Name </th>
                            <th>Image </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <img src="{{ asset('assets/uploads/categories') }}/{{$category->image}}" alt="hello"
                                        style="width: 100px;">
                                </td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}" class="edit"><i
                                            class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    <x-delete-button
                                        action="{{ route('admin.categories.delete', ['id' => $category->id]) }}"></x-delete-button>


                                    {{-- <x-delete-button
                                        action = " }}"/> --}}
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="addUserModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.categories.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" required name="name" value="{{ old('name') }}">
                        </div>
                        @error('name')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <br>
                        <label for="inputfullname" class="col-lg-2 control-label">Category Image
                        </label>
                        <div class="container py-5">
                            <div class="row py-4">
                                <div class="col-lg-6 mx-auto">

                                    <!-- Upload image input-->
                                    <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                        <input id="upload" type="file" onchange="readURL(this);"
                                            class="form-control border-0" name="image">
                                        <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose
                                            file</label>
                                        <div class="input-group-append">
                                            <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i
                                                    class="fa fa-cloud-upload mr-2 text-muted"></i><small
                                                    class="text-uppercase font-weight-bold text-muted">Choose
                                                    file</small></label>
                                        </div>
                                    </div>

                                    <!-- Uploaded image area-->
                                    <div class="image-area mt-4"><img id="imageResult" src="#" alt=""
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
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
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

        function displaySelectedImage(event, elementId) {
            const selectedImage = document.getElementById(elementId);
            const fileInput = event.target;

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    selectedImage.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
    </body>
    </html>
@endsection
