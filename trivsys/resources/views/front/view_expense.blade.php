@extends('layout.index')
@extends('front.nav')
@extends('front.search')

@section('home')
    {{-- Show Customer Details --}}

    <div class="w-full mx-auto mt-5 mb-5 overflow-x-auto">
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="px-4 py-2 border border-gray-300">S.NO</th>
                    <th class="px-4 py-2 border border-gray-300">EXPENSE</th>
                    <th class="px-4 py-2 border border-gray-300">PRICE</th>
                    <th class="px-4 py-2 border border-gray-300">IMG</th>
                    <th class="px-4 py-2 border border-gray-300">DATE</th>
                    <th class="px-4 py-2 border border-gray-300">AGENT</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach ($expense as $index => $data)
                    <tr class="odd:bg-gray-50 even:bg-white">
                        <td class="px-4 py-2 border border-gray-300 customer">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border border-gray-300 customer">{{ $data->expense }}</td>
                        <td class="px-4 py-2 border border-gray-300 customer">Rs. {{ $data->price }}</td>
                        <td class="px-4 py-2 border border-gray-300 customer">
                            @if ($data->img != 'No Img')
                                <img src="{{ asset('upload/' . $data->img) }}" alt="" style="width: 40px">
                            @else
                                {{ $data->img }}
                            @endif
                        </td>
                        <td class="px-4 py-2 border border-gray-300 customer hidden sm:table-cell">
                            {{ \Carbon\Carbon::parse($data->date)->format('d M, Y') }}
                        </td>
                        <td class="px-4 py-2 border border-gray-300 customer">{{ $data['user']->name }}</td>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Show Customer Details --}}
@endsection
