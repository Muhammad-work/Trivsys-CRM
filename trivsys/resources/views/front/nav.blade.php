@section('front.nav')
    <nav class="w-full h-[80px] flex justify-between place-items-center px-5 bg-[#EA7427]">
        {{-- <div class="w-[19%]">
            <img class="w-[100%]" src="{{ asset('storage/img/logo-2.png') }}" alt="">
        </div> --}}
        <div class="me-12">
            <ul class="flex justify-center place-items-center gap-[1rem] ">
                <li class=""><a href="{{ route('viewHome') }}" class="text-white">Home</a></li>
                <li class=""><a href="{{ route('customerLeadTable') }}" class="text-white">Lead Page</a></li>
                <li class=""><a href="{{ route('viewMeetingPage') }}" class="text-white">Meeting Page</a></li>
                <li class=""><a href="{{ route('viewMeetingDonePage') }}" class="text-white">Meeting Done Page</a>
                <li class=""><a href="{{ route('customerTrialTable') }}" class="text-white">Trial Page</a></li>
                <li class=""><a href="{{ route('customerSalesTable') }}" class="text-white">Sale Page</a></li>
                </li>
                <li class=""><a href="{{ route('customerDeniedTable') }}" class="text-white">Denied Page</a></li>
                <li class=""><a href="{{ route('viewHelpTable') }}" class="text-white">Help </a></li>
                <li class=""><a href="{{ route('help') }}" class="text-white">Help Request</a></li>
            </ul>
        </div>
        <div class="flex place-items-center gap-6">
            <span class="font-bold text-white text-xl">{{ Auth::user()->name }} </span>
            <a href="{{ route('logout') }}" class="btn btn-light">Logout</a>
        </div>
    </nav>


@endsection
