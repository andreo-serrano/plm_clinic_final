<a href="{{ route('doctor-home') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('doctor-home') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
    HOME
</a>

<a href="{{ route('doctor-profile') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('doctor-profile') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
    VIEW PROFILE
</a>

<a href="{{ route('doctor-appointment') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('doctor-appointment') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
    APPOINTMENT
</a>

<a href="{{ route('doctor-patient-records') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('doctor-patient-records') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
    PATIENT RECORDS
</a>

<a href="{{ route('doctor-schedule') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('doctor-schedule') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
    SCHEDULE
</a>