@extends('layout.index')

@section('home')
    
<div class="flex justify-center items-center min-h-screen bg-gray-100 p-4 sm:p-8">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6 sm:p-8">
        <form action="{{ route('loginstore') }}" method="POST" class="space-y-6" autocomplete="off">
            @csrf
            <h2 class="text-2xl font-bold text-[#25C3C6] border border-[#25C3C6] inline-block px-4 py-2 mb-4">Login</h2>

            @if (session('email'))
                <div class="bg-blue-100 text-red-700 border-l-4 border-red-500 p-3 rounded mb-4" role="alert">
                    {{ session('email') }}
                </div>
            @endif

            <div>
                <label for="exampleInputEmail1" class="block text-gray-700 font-semibold">Email Address</label>
                <input type="email"
                    class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-[#25C3C6]"
                    name="email" id="exampleInputEmail1">
                @error('email')
                    <span class="text-red-400"> {{ $message }} </span>
                @enderror
            </div>

            <div>
                <label for="exampleInputPassword1" class="block text-gray-700 font-semibold">Password</label>
                <input type="password"
                    class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-[#25C3C6]"
                    name="password" id="exampleInputPassword1">
                @error('password')
                    <span class="text-red-400"> {{ $message }} </span>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-[#25C3C6] text-white font-semibold py-2 rounded-lg hover:bg-[#E2990F]transition duration-300">Login</button>
        </form>
    </div>
</div>


@endsection
