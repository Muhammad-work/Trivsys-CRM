@extends('layout.index')
@extends('front.nav')
@extends('front.search')

@section('home')

    {{-- Show Customer Details --}}

<div class="w-full mx-auto mt-5 mb-5 overflow-x-auto">
        <table class="min-w-[600px] table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="px-4 py-2 border border-gray-300">S.NO</th>
                    <th class="px-4 py-2 border border-gray-300">CUSTOMER NAME</th>
                    <th class="px-4 py-2 border border-gray-300">CUSTOMER NUMBER</th>
                    <th class="px-4 py-2 border border-gray-300">CUSTOMER EMAIL</th>
                    <th class="px-4 py-2 border border-gray-300">PRICE</th>
                    <th class="px-4 py-2 border border-gray-300 hidden sm:table-cell">REMARKS</th>
                    <th class="px-4 py-2 border border-gray-300">STATUS</th>
                    <th class="px-4 py-2 border border-gray-300 hidden sm:table-cell">CUSTOMER REGISTRATION DATE</th>
                    <th class="px-4 py-2 border border-gray-300 hidden md:table-cell">AGENT NAME</th>
                    <th class="px-4 py-2 border border-gray-300">Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach ($customers as $index => $customer)
                    <tr class="odd:bg-gray-50 even:bg-white">
                        <td class="px-4 py-2 border border-gray-300 customer">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border border-gray-300 customer">{{ $customer->customer_name }}</td>
                        <td class="px-4 py-2 border border-gray-300 customer">{{ $customer->customer_number }}</td>
                        <td class="px-4 py-2 border border-gray-300 customer">{{ $customer->customer_email }}</td>
                        <td class="px-4 py-2 border border-gray-300 customer">${{ $customer->price }}</td>
                        <td class="px-4 py-2 border border-gray-300 customer hidden sm:table-cell">{{ $customer->remarks }}</td>
                        <td class="px-4 py-2 border border-gray-300 customer">
                            <span class="bg-dark py-1 px-2 rounded font-bold text-xl text-white">{{ $customer->status }}</span>
                        </td>
                        <td class="px-4 py-2 border border-gray-300 customer hidden sm:table-cell">
                            @if ($customer->regitr_date)
                                {{ \Carbon\Carbon::parse($customer->regitr_date)->format('d M, Y') }}
                            @else
                                No Registration Date
                            @endif
                        </td>
                        <td class="px-4 py-2 border border-gray-300 customer hidden md:table-cell">{{ $customer['user']->name }}</td>
                        @if ($customer->status === 'denied')
                            <form action="{{ route('customerStatus', $customer->id) }}" method="POST">
                                @csrf
                                <td class="flex gap-1 mt-4">
                                    <input type="hidden" name="status" id="input">
                                    <button class="btn btn-success" id="statusBtn">sale</button>
                                    <button class="btn btn-warning" id="statusBtn">lead</button>
                                    <button class="btn btn-danger" id="statusBtn">trial</button>
                                    <button class="btn btn-info text-white" id="statusBtn">meeting</button>
                                </td>
                            </form>
                        @elseif($customer->status === 'trial')
                            <form action="{{ route('customerStatus', $customer->id) }}" method="POST">
                                @csrf
                                <td class="flex gap-1 mt-4">
                                    <input type="hidden" name="status" id="input">
                                    <button class="btn btn-warning" id="statusBtn">lead</button>
                                    <button class="btn btn-success" id="statusBtn">sale</button>
                                </td>
                            </form>
                        @else
                        @endif
                    </tr>
                @endforeach
                @if ($customers->isEmpty())
                    <tr>
                        <td colspan="11" class="text-center">No Denied Record Found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Show Customer Details --}}


@endsection
