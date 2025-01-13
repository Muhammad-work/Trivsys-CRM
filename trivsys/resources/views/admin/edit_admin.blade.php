@extends('layout.app')
@extends('admin.nav')
@extends('admin.saidebar')



@section('content')
    {{-- <section class="content"> --}}
    <div class="content-wrapper">
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-12   mt-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="text-center">Update Admin Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('storeUpdateAdmin', $user->id) }}" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" name="user_name" id="exampleInputEmail1"
                                            placeholder="Enter User Name" value="{{ $user->name }}">
                                        @error('user_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="text" class="form-control" name="user_email" id="exampleInputEmail1"
                                            placeholder="Enter User Email" value="{{ $user->email }}">
                                        @error('user_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1"> Phone</label>
                                        <input type="Number" class="form-control" name="user_phone" id="exampleInputEmail1"
                                            placeholder="Enter User Phone Number" value="{{ $user->phone }}">
                                        @error('user_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1"> Address</label>
                                        <input type="text" class="form-control" name="user_address"
                                            id="exampleInputEmail1" placeholder="Enter User Address"
                                            value="{{ $user->address }}">
                                        @error('user_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1">Role</label>
                                        <select class="form-select" name="role" aria-label="Default select example">
                                            <option value="{{ $user->role }}" selected>
                                                @if ($user->role == 'admin')
                                                    Main Admin
                                                @else
                                                    Admin
                                                @endif
                                            </option>
                                            <option value="sub_admin">admin</option>
                                            <option value="admin">Main Admin</option>
                                        </select>
                                        @error('role')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1">Enter Ip Address</label>
                                        <select class="form-select"  name="ip" aria-label="Default select example">
                                            @if ($user->ip_address === '1')
                                                <option selected value="{{ $user->ip_address }}">Active</option>
                                            @endif
                                            <option value="0">Deactivate</option>
                                            <option value="1">Active</option>
                                        </select>
                                        @error('ip')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="{{ route('viewAdminTable') }}" class="btn btn-primary">Back</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </section> --}}
@endsection
