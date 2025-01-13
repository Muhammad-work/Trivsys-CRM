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
                            <h3 class="text-center">Distribute Customer Numbers To Agents</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('distributeNumberToAgent') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1">Old Agent Name</label>
                                        <select class="form-select" name="old_agent" aria-label="Default select example">
                                            <option selected>-- Aelect Agent Name --</option>
                                            @foreach ($allAgent as $agent)
                                                <option value="{{ $agent->agent }}"> {{ $agent['user']->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('old_agent')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1">Expiry Date</label>
                                        <input type="date" class="form-control" name="date" id="exampleInputEmail1"
                                            placeholder="Enter User Email" value="{{ old('data') }}">
                                        @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="exampleInputEmail1">New Agent Name</label>
                                        <select class="form-select" name="new_agent" aria-label="Default select example">
                                            <option selected>-- Aelect Agent Name --</option>
                                            @foreach ($allAgent as $agent)
                                                <option value="{{ $agent->agent }}"> {{ $agent['user']->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('new_agent')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="{{ route('viewCustomerNumber') }}" class="btn btn-primary">Back</a>
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
