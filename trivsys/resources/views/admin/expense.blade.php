@extends('layout.app')
@extends('admin.nav')
@extends('admin.saidebar')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 d-inline">All Agent Expense Report</h1>
                    </div><!-- /.col -->
                    {{-- <div class="col-sm-4">
                        <h1 class="m-0 d-inline"><a href="{{ route('addUser') }}" class="btn btn-primary">Add New</a></h1>
                    </div><!-- /.col --> --}}
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">DashBord</a></li>
                            <li class="breadcrumb-item active">All Agent Expense Report</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class='container-fluid'>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            @if (session('success'))
                                <div class="alert alert-success text-center" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>EXPENSE</th>
                                    <th>PRICE</th>
                                    <th>IMG</th>
                                    <th>EXPENSE DATE</th>
                                    <th>AGENT</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expese as $index => $data)
                                    <tr>
                                        <td> {{ $index + 1 }} </td>
                                        <td>{{ $data->expense }}</td>
                                        <td>Rs. {{ $data->price }}</td>
                                        <td>
                                            @if ($data->img != 'No Img')
                                                <img src="{{ asset('upload/' . $data->img) }}" alt=""
                                                    style="width: 40px">
                                            @else
                                                {{ $data->img }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($data->date)->format('d M, Y') }}
                                        </td>
                                        <td>{{ $data['user']->name }}</td>
                                        <td>
                                            <a href="{{  route('viewEditExpenseFrom',$data->id)  }}" class="btn btn-primary"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{  route('deleteExpense',$data->id)  }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                </div>
            </div>
        @endsection
