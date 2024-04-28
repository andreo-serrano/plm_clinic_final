<div class="w-80 min-w-80 max-w-80 bg-blue-900 flex flex-col items-center px-7 pt-7 border-e-8 border-white">
    {{-- Nurse Model --}}
    @if(request()->routeIS('patient-dashboard')
            || request()->routeIS('patient-profile')
            || request()->routeIS('patient-view-appointment')
            || request()->routeIS('patient-request-appointment')
            || request()->routeIS('patient-lab-results')
            || request()->routeIS('patient-about')
        )
           <img width="80" height="80" src="https://img.icons8.com/ios-glyphs/80/FFFFFF/stethoscope.png" alt="stethoscope"/>

           <div class="flex flex-col text-center text-white mt-5">
               <h3 class="font-semibold italic">{{ strtoupper(Auth::user()->name) }}</h3>
               <small>PATIENT</small>
           </div> 
    @endif
    
    {{-- Patient Model --}}
    @if(request()->routeIS('nurse-home')
            || request()->routeIS('nurse-profile')
            || request()->routeIS('nurse-appointment-request')
            || request()->routeIS('nurse-confirmed-appointment')
            || request()->routeIS('nurse-schedule')
            || request()->routeIS('nurse-report')
        )
           <img width="80" height="80" src="https://img.icons8.com/ios-filled/80/FFFFFF/nurse-female.png" alt="nurse-female"/>

           <div class="flex flex-col text-center text-white mt-5">
               <h3 class="font-semibold italic">{{ strtoupper(Auth::user()->name) }}</h3>
               <small>NURSE</small>
           </div> 
    @endif

    {{-- Doctor Model --}}
    @if(request()->routeIS('doctor-home')
            || request()->routeIS('doctor-profile')
            || request()->routeIS('doctor-appointment')
            || request()->routeIS('doctor-patient-records')
            || request()->routeIS('doctor-schedule')
        )
           <img width="80" height="80" src="https://img.icons8.com/ios-filled/80/FFFFFF/caduceus.png" alt="caduceus"/>

           <div class="flex flex-col text-center text-white mt-5">
               <h3 class="font-semibold italic">{{ strtoupper(Auth::user()->name) }}</h3>
               <small>DOCTOR</small>
           </div> 
    @endif

    <div class="flex flex-col w-full gap-3 mt-8 mb-12">
        {{-- Patient Items --}}
        @if(request()->routeIS('patient-dashboard')
            || request()->routeIS('patient-profile')
            || request()->routeIS('patient-view-appointment')
            || request()->routeIS('patient-request-appointment')
            || request()->routeIS('patient-lab-results')
            || request()->routeIS('patient-about')
        )
            <x-Pages-Sidebar-Items.Patient-menu/>
        @endif

        {{-- Nurse Items --}}
        @if(request()->routeIS('nurse-home')
            || request()->routeIS('nurse-profile')
            || request()->routeIS('nurse-appointment-request')
            || request()->routeIS('nurse-confirmed-appointment')
            || request()->routeIS('nurse-schedule')
            || request()->routeIS('nurse-report')
        )
            <x-Pages-Sidebar-Items.Nurse-menu/>
        @endif

        {{-- Doctor Items --}}
        @if(request()->routeIS('doctor-home')
        || request()->routeIS('doctor-profile')
        || request()->routeIS('doctor-appointment')
        || request()->routeIS('doctor-patient-records')
        || request()->routeIS('doctor-schedule')
        )
            <x-Pages-Sidebar-Items.Doctor-menu/>
        @endif
    </div>

    <button class="flex flex-row gap-2 justify-center text-white font-semibold items-center hover:border hover:border-blue-50/[.2] w-full rounded-full py-2">
        <img width="38" height="38" src="https://img.icons8.com/fluency-systems-filled/38/FFFFFF/exit.png" alt="exit"/>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
                    <x-responsive-nav-link class="text-white font-semibold items-center" :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('LOG OUT') }}
                    </x-responsive-nav-link>
            </form>
    </button>

</div>