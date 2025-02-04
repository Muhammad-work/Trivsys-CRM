@extends('layout.index')
@extends('front.nav')

@section('home')
    <div class="container">
        <div class="row mt-7">
            <div class="col-6 mx-auto">
                @if (session('success'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('storeExpenseData') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-xl font-bold text-center mb-2">Expense Form</h2>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Expense</label>
                        <textarea class="form-control" name="expense" placeholder="Enetr expense" id="floatingTextarea"></textarea>
                        @error('expense')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Enter price"
                            id="exampleInputPassword1">
                        @error('price')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Img</label>
                        <input type="file" class="form-control" name="img" placeholder="Enter Customer Number"
                            id="exampleInputPassword1">
                        @error('img')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" placeholder="Enter Customer Email"
                            id="exampleInputPassword1">
                        @error('date')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
