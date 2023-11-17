@extends('adminlte::page')
@section('title', 'Branches')
@section('content')
    @include('layouts.admin.header')
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Branches</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addUserModal" class="btn btn-success" data-toggle="modal"><i
                                    class="material-icons">&#xE147;</i> <span>Add New Branch</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id </th>
                            <th>Short Address </th>
                            <th>Full Address </th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($branches as $branch)
                            <tr>
                                <td>{{ $branch->id }}</td>
                                <td>{{ $branch->short_address }}</td>
                                <td>{{ $branch->full_address }}</td>
                                <td>{{ $branch->city }}</td>
                                <td>{{ $branch->phone }}</td>
                                <td>
                                    <a href="{{ route('admin.branches.edit', ['id' => $branch->id]) }}" class="edit"><i
                                            class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    <x-delete-button
                                        action="{{ route('admin.branches.delete', ['id' => $branch->id]) }}"></x-delete-button>
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
                <form action="{{ route('admin.branches.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Branch</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Short Adress</label>
                            <input type="text" class="form-control" required name="short_address" value="{{ old('short_address') }}">
                        </div>
                        @error('short_address')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label>Full Adress</label>
                            <input type="text" class="form-control" required name="full_address" value="{{ old('full_address') }}">
                        </div>
                        @error('full_address')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" required name="city" value="{{ old('city') }}">
                        </div>
                        @error('city')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" class="form-control" required name="phone" value="{{ old('phone') }}">
                        </div>
                        @error('phone')
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
    </body>
    </html>
@endsection
