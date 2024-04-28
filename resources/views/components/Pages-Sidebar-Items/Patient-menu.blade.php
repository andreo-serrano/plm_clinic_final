<a href="{{ route('patient-dashboard') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('patient-dashboard') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
    HOME
</a>

<a href="{{ route('patient-profile') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('patient-profile') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
    VIEW PROFILE
</a>

<a href="{{ route('patient-view-appointment') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('patient-view-appointment') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
    VIEW APPOINTMENT
</a>

<a href="{{ route('patient-request-appointment') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('patient-request-appointment') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
    REQUEST <br> APPOINTMENT
</a>

<a href="{{ route('patient-lab-results') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('patient-lab-results') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
    MEDICAL LAB RESULT
</a>

<a href="{{ route('patient-about') }}" class="text-center w-full border border-white rounded-full py-3 font-semibold {{ request()->routeIS('patient-about') ? 'bg-white text-blue-950' : 'text-white'}} leading-none hover:bg-white hover:text-blue-950 active:bg-blue-100">
    ABOUT PLM CLINIC
</a>