@extends('layout.index')
@extends('front.nav')
@extends('front.search')
@section('home')

    {{-- Show Customer Details --}}

    <div class="w-[100%] mx-auto mt-5 mb-5">
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="px-4 py-2 border border-gray-300">S.NO</th>
                    <th class="px-4 py-2 border border-gray-300">CUSTOMER NAME</th>
                    <th class="px-4 py-2 border border-gray-300">CUSTOMER NUMBER</th>
                    <th class="px-4 py-2 border border-gray-300">CUSTOMER EMAIL</th>
                    <th class="px-4 py-2 border border-gray-300">MAC ADDRESS</th>
                    <th class="px-4 py-2 border border-gray-300">STATUS</th>
                    <th class="px-4 py-2 border border-gray-300">HELP REASON</th>
                    <th class="px-4 py-2 border border-gray-300">AGENT NAME</th>
                    <th class="px-4 py-2 border border-gray-300">DATE</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach ($helpRequestDetail as $index => $data)
                    <tr class="odd:bg-gray-50 even:bg-white">
                        <td class="px-4 py-2 border border-gray-300 customer"> {{ $index + 1 }} </td>
                        <td class="px-4 py-2 border border-gray-300 customer"> {{ $data->c_name }} </td>
                        <td class="px-4 py-2 border border-gray-300 customer">{{ $data->c_number }}</td>
                        <td class="px-4 py-2 border border-gray-300 customer">{{ $data->c_email }}</td>
                        <td class="px-4 py-2 border border-gray-300 customer">{{ $data->make_address }}</td>
                        <td class="px-4 py-2 border border-gray-300 customer">
                            @if ($data->status === 'pending')
                                <span class="bg-warning py-1 px-2 rounded text-white">Pending</span>
                            @elseif($data->status === 'down')
                                <span class="bg-success py-1 px-2 rounded text-white">Resolved</span>
                            @else
                                <span class="bg-danger py-1 px-2 rounded text-white">Refund</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border border-gray-300 customer">{{ $data->help_reason }}</td>
                        <td class="px-4 py-2 border border-gray-300 customer">{{ $data->user_name }}</td>
                        <td class="px-4 py-2 border border-gray-300 customer">
                            {{ \Carbon\Carbon::parse($data->created_at)->format('d M, Y') }}</td>
                    </tr>
                @endforeach
                @if ($helpRequestDetail->isEmpty())
                    <tr>
                        <td colspan="9" class="text-center">No Help Record Found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Show Customer Details --}}

@endsection
