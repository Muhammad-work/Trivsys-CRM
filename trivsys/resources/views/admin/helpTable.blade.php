@extends('layout.app')
@extends('admin.nav')
@extends('admin.saidebar')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 d-inline">All Agent Help Request</h1>
                    </div><!-- /.col -->
                    {{-- <div class="col-sm-4">
                        <h1 class="m-0 d-inline"><a href="{{ route('addUser') }}" class="btn btn-primary">Add New</a></h1>
                    </div><!-- /.col --> --}}
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">DashBord</a></li>
                            <li class="breadcrumb-item active">All Agent Help Request</li>
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
                                    <th>CUSTOMER NAME</th>
                                    <th>CUSTOMER EMAIL</th>
                                    <th>CUSTOMER PHONE</th>
                                    <th>MAC ADDRESS</th>
                                    <th>HELP REASON</th>
                                    <th>STATUS</th>
                                    <th>AGENT NAME</th>
                                    <th>DATE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($helpRequest as $index => $data)
                                    @if (Auth::user()->role === 'sub_admin' && $data->status === 'pending')
                                        <tr>
                                            <td> {{ $index + 1 }} </td>
                                            <td> {{ $data->c_name }} </td>
                                            <td>{{ $data->c_email }}</td>
                                            <td>{{ $data->c_number }}</td>
                                            <td>{{ $data->make_address }}</td>
                                            <td>{{ $data->help_reason }}</td>
                                            <td>
                                                @if ($data->status === 'pending')
                                                    <span
                                                        class="bg-warning py-1 px-2 rounded text-white cursor-pointer">Pending</span>
                                                @endif
                                            </td>
                                            <td> {{ $data->user_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d M, Y') }}</td>
                                            <td>
                                                <a href="{{ route('downHelpRequestStatus', $data->id) }}"
                                                    class="btn btn-success staus">Resolve</a>
                                                <a href="{{ route('cancelHelpRequestStatus', $data->id) }}"
                                                    class="btn btn-danger staus">Refund</a>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (Auth::user()->role === 'admin')
                                        <tr>
                                            <td> {{ $index + 1 }} </td>
                                            <td> {{ $data->c_name }} </td>
                                            <td>{{ $data->c_email }}</td>
                                            <td>{{ $data->c_number }}</td>
                                            <td>{{ $data->make_address }}</td>
                                            <td>{{ $data->help_reason }}</td>
                                            <td>
                                                @if ($data->status === 'pending')
                                                    <span class="bg-warning py-1 px-2 rounded text-white">Pending</span>
                                                @elseif($data->status === 'down')
                                                    <span class="bg-success py-1 px-2 rounded text-white">Resolve</span>
                                                @else
                                                    <span class="bg-danger py-1 px-2 rounded text-white">Refund</span>
                                                @endif
                                            </td>
                                            <td> {{ $data->user_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d M, Y') }}</td>
                                            <td>
                                                @if ($data->status === 'pending')
                                                    <a href="{{ route('downHelpRequestStatus', $data->id) }}"
                                                        class="btn btn-success staus">Resolve</a>
                                                    <a href="{{ route('cancelHelpRequestStatus', $data->id) }}"
                                                        class="btn btn-danger staus">Refund</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                </div>
            </div>
        @endsection
