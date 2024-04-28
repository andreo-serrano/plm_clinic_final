<a href="{{ route('nurse-home') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('nurse-home') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
    HOME
</a>

<a href="{{ route('nurse-profile') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('nurse-profile') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
   VIEW PROFILE
</a>

<a href="{{ route('nurse-appointment-request') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('nurse-appointment-request') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
    APPOINTMENT <br> REQUEST
</a>

<a href="{{ route('nurse-confirmed-appointment') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('nurse-confirmed-appointment') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
    CONFIRMED <br> APPOINTMENT
</a>

<a href="{{ route('nurse-schedule') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('nurse-schedule') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
    SCHEDULE
</a>

<a href="{{ route('nurse-report') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('nurse-report') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
    REPORT
</a>

