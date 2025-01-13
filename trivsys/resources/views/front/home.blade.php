@extends('layout.index')
@extends('front.nav')

@section('home')
    {{--  Cuntomer Form   --}}
    <div class="w-[95%] h-auto mx-auto mt-5 p-3 border-2 border-solid rounded">
        <form action="{{ route('storeCustomerDetail') }}" method="POST" autocomplete="off">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <h2 class="text-center font-bold text-xl mb-2">Enter Customer Details</h2>
            @csrf
            <table class="min-w-full table-auto border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-2 border border-gray-300">CUSTOMER NAME</th>
                        <th class="px-4 py-2 border border-gray-300">CUSTOMER NUMBER</th>
                        <th class="px-4 py-2 border border-gray-300">CUSTOMER EMAIL</th>
                        <th class="px-4 py-2 border border-gray-300">PRICE</th>
                        <th class="px-4 py-2 border border-gray-300">REMARKS</th>
                        <th class="px-4 py-2 border border-gray-300">STATUS</th>
                        <th class="px-4 py-2 border border-gray-300">CUSTOMER REGISTRATION DATE</th>
                        {{-- <th class="px-4 py-2 border border-gray-300">AGENT NAME</th> --}}
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd:bg-gray-50 even:bg-white">
                        <td class="px-4 py-2 border border-gray-300">
                            <input type="text" name="customer_name" id="customer_name_1"
                                placeholder="Enter Customer Name" value="{{ old('customer_name') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('customer_name')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </td>
                        <td class="px-4 py-2 border border-gray-300">
                            <input type="text" name="customer_number" value="{{ old('customer_number') }}"
                                id="customer_number_1" placeholder="Enter Customer Number"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('customer_number')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </td>
                        <td class="px-4 py-2 border border-gray-300">
                            <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                                id="customer_email_1" placeholder="Enter Customer Email"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('customer_email')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </td>
                        <td class="px-4 py-2 border border-gray-300">
                            <input type="text" name="price" value="{{ old('price') }}" id="price"
                                placeholder="Enter Price"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('price')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </td>
                        <td class="px-4 py-2 border border-gray-300">
                            <textarea name="remarks" id="remarks_1" cols="15" rows="3" placeholder="Enter Remarks"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('remarks') }}</textarea>
                            @error('remarks')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </td>
                        <td class="px-4 py-2 border border-gray-300">
                            <select name="status" id="selectBox"
                                class="w-full py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="" selected>Select</option>
                                <option value="sale">Sale</option>
                                <option value="lead">Lead</option>
                                <option value="trial">Trial</option>
                                <option value="meeting">Meeting</option>
                            </select>
                            @error('status')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        <td class="px-4 py-2 border border-gray-300">
                            <input type="date" name="date" value="{{ old('date') }}" id="price"
                                placeholder="Enter Price"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('date')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </td>
                        </td>

                    </tr>
                </tbody>
            </table>

            <div class="mt-4 flex justify-end ">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">Submit</button>
            </div>
        </form>

    </div>
    {{--  Cuntomer Form   --}}


    {{-- search customer details --}}
    {{-- <div class="w- full h-[80px] flex justify-center place-items-center bg-[#1D4ED8] mt-5">
        <input type="text" name="" onkeyup="searchTable()" id="searchInput" placeholder="Search Customer"
            class="w-[50%] py-2 px-3 outline-none border-0 rounded">
    </div> --}}
    {{-- search customer details --}}




    {{-- Show Customer Details --}}

    {{-- <div class="w-full h-auto overflow-x-auto">
        <div class="w-full mx-auto mt-5 ">
            <table class="w-full min-w-[600px] table-auto border-collapse border border-gray-200 ">
                @if (session('update'))
                    <div class="alert alert-success" role="alert">
                        {{ session('update') }}
                    </div>
                @endif
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-2 border border-gray-300">S.NO</th>
                        <th class="px-4 py-2 border border-gray-300">CUSTOMER NAME</th>
                        <th class="px-4 py-2 border border-gray-300">CUSTOMER NUMBER</th>
                        <th class="px-4 py-2 border border-gray-300">CUSTOMER EMAIL</th>
                        <th class="px-4 py-2 border border-gray-300">PRICE</th>
                        <th class="px-4 py-2 border border-gray-300">REMARKS</th>
                        <th class="px-4 py-2 border border-gray-300">STATUS</th>
                        <th class="px-4 py-2 border border-gray-300">CUSTOMER REGISTRATION DATE</th>
                        <th class="px-4 py-2 border border-gray-300">AGENT NAME</th>
                        <th class="px-4 py-2 border border-gray-300">ACTION</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($customers as $index => $customer)
                        @if ($customer->status !== 'sale')
                            <tr class="odd:bg-gray-50 even:bg-white">
                                <td class="px-4 py-2 border border-gray-300 customer"> {{ $index + 1 }} </td>
                                <td class="px-4 py-2 border border-gray-300 customer"> {{ $customer->customer_name }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300 customer">{{ $customer->customer_number }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300 customer">{{ $customer->customer_email }}</td>
                                <td class="px-4 py-2 border border-gray-300 customer">${{ $customer->price }}</td>
                                <td class="px-4 py-2 border border-gray-300 customer hidden md:table-cell">
                                    {{ $customer->remarks }}</td>
                                <td class="px-4 py-2 border border-gray-300 customer">
                                    @if ($customer->status === 'lead')
                                        <span class="bg-warning py-1 px-2 rounded font-bold text-xl text-white">Lead</span>
                                    @elseif($customer->status === 'trial')
                                        <span class="bg-danger py-1 px-2 rounded font-bold text-xl text-white">Trial</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border border-gray-300 customer hidden sm:table-cell">
                                    @if ($customer->regitr_date)
                                        {{ \Carbon\Carbon::parse($customer->regitr_date)->format('d M, Y') }}
                                    @else
                                        No Registration Date
                                    @endif
                                </td>
                                <td class="px-4 py-2 border border-gray-300 customer hidden md:table-cell">
                                    {{ $user->name }}</td>


                                @if ($customer->status === 'lead')
                                    <form action="{{ route('customerStatus', $customer->id) }}" method="POST">
                                        @csrf
                                        <td class="flex gap-1 mt-4">
                                            <input type="hidden" name="status" id="input">
                                            <button class="btn btn-success" id="statusBtn">sale</button>
                                            <button class="btn btn-danger" id="statusBtn">trial</button>
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
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> --}}


    {{-- Show Customer Details --}}


    <script>
        function searchTable() {
            const searchInput = document.getElementById("searchInput").value.toLowerCase();
            const tableBody = document.getElementById("tableBody");
            const rows = tableBody.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                let customerName = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
                let customerNumber = rows[i].getElementsByTagName("td")[2].textContent.toLowerCase();
                if (customerName.includes(searchInput) || customerNumber.includes(searchInput)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none"; // Hide rows that don't match
                }
            }
        }

        let statusInput = document.querySelectorAll('#input');
        let statusBtn = document.querySelectorAll('#statusBtn');

        statusBtn.forEach((btn) => {
            btn.addEventListener('click', function(e) {
                target = e.target;
                text = target.textContent;

                statusInput.forEach((input) => {
                    input.value = text;
                })

            });
        });
    </script>
@endsection
