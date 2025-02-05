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
                            <h3 class="text-center">Add New Numbers</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('storeNumbers') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1">Number</label>
                                        <textarea class="form-control" name="customerNumber" rows="10" placeholder="Enter Customers Numbers" id="floatingTextarea"></textarea>
                                        @error('customerNumber')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="{{ route('viewNumbersTable') }}" class="btn btn-primary">Back</a>
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </section> --}}
@endsection
