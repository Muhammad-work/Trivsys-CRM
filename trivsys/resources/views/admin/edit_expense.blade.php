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
                            <h3 class="text-center">Update Agent Expense</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('updateExpenseData',$expese->id)  }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-6 mt-2">
                                        <label for="exampleInputEmail1">Expense</label>
                                        <textarea class="form-control" name="expense" placeholder="Enter Expense" id="floatingTextarea">{{  $expese->expense  }}</textarea>
                                        @error('expense')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6 mt-2">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="number" class="form-control" name="price" id="exampleInputEmail1"
                                            placeholder="Enter Price" value="{{ $expese->price }}">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-6 mt-2">
                                        <label for="exampleInputEmail1">Img</label>
                                        <input type="file" class="form-control" name="img" id="exampleInputEmail1"
                                            placeholder="Enter Customer Phone Number" value="{{ $expese->img  }}">
                                        <img src="{{ asset('upload/' . $expese->img)  }}" alt="" style="width: 40px">
                                        @error('img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6 mt-2">
                                        <label for="exampleInputEmail1">Date</label>
                                        <input type="date" class="form-control" name="date" id="exampleInputEmail1"
                                            placeholder="Enter Price" value="{{ $expese->date }}">
                                        @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="{{ route('expense') }}" class="btn btn-primary">Back</a>
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </section> --}}
@endsection
