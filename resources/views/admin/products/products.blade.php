@extends('adminlte::page')
@section('title', 'Products')
@section('content')
    @include('layouts.admin.header')
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Products</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addProductModal" class="btn btn-success" data-toggle="modal"><i
                                    class="material-icons">&#xE147;</i> <span>Add New Product</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>

                            <th>Name </th>
                            <th>Status </th>
                            <th>Description </th>
                            <th>Author </th>
                            <th>Category Name</th>
                            <th>Bestseller</th>
                            <th>Stock </th>
                            <th>Price </th>
                            <th>Discount </th>
                            <th>Number_of_pages </th>
                            <th>Code</th>
                            <th>Image </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->status }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->author }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->bestseller }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->discount}}%</td>
                                <td>{{ $product->number_of_pages }}</td>
                                <td>{{ $product->code }}</td>
                                <td>
                                    <img src="{{ asset('assets/uploads/products') }}/{{$product->image}}" alt="hello"
                                        style="width: 100px;">
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}" class="edit"><i
                                            class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    <x-delete-button
                                        action="{{ route('admin.products.delete', ['id' => $product->id]) }}"></x-delete-button>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="addProductModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.products.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Product</h4>
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
                         <div class="form-group">
                            <label>Status</label>
                            <select class="selectpicker" name="status">
                                <option value="appear" selected >appear</option>
                                <option value="disappear">disappear</option>
                              </select>
                        </div>
                        @error('status')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label>Description</label>
                            <div class="form-outline">
                                <textarea class="form-control" id="textAreaExample" rows="4" name="description">{{ old('description') }}</textarea>
                              </div>
                        </div>
                        @error('description')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label>Author</label>
                            <input type="text" class="form-control" required name="author" value="{{ old('author') }}">
                        </div>
                        @error('author')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                          <div class="form-group">
                            <label>Category</label>
                            <select class="selectpicker" name="category">
                                @forelse ($categories as  $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @empty
                                @endforelse
                              </select>
                        </div>
                        @error('category')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label>Bestseller</label>
                            <input type="text" class="form-control" required name="bestseller" value="{{ old('bestseller') }}">
                        </div>
                        @error('bestseller')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" class="form-control" required name="stock" value="{{ old('stock') }}">
                        </div>
                        @error('stock')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" class="form-control" required name="price" value="{{ old('price') }}">
                        </div>
                        @error('price')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label>Discount</label>
                            <input type="number" class="form-control" required name="discount" value="{{ old('discount') }}">
                        </div>
                        @error('discount')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label>Code</label>
                            <input type="number" class="form-control" required name="code" value="{{ old('code') }}">
                        </div>
                        @error('code')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label>Number of pages </label>
                            <input type="number" class="form-control" required name="number_of_pages" value="{{ old('number_of_pages') }}">
                        </div>
                        @error('number_of_pages')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <br>
                        <label for="inputfullname" class="col-lg-2 control-label">product Image
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
