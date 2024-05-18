{{-- V1 --}}
{{-- <div class="p-10 w-full min-h-screen">
    <div class="w-full h-fit bg-white rounded-xl p-10">
        <h1 class="text-3xl text-yellow-600 font-bold">VIEW APPOINTMENT</h1>

        <div class="mt-5 px-4 mb-5">
            <span class="text-2xl font-semibold text-blue-800">UPCOMING APPOINTMENT</span>
            <div class="w-full border-t-4 border-blue-900 mt-2"></div>
        </div>

        <div class="px-4">
            <table class="table-auto w-full h-full">
                <thead>
                    <tr class="divide-x">
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Appoinment <br> No</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Consultation <br> Date</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Clinic Service</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Doctor</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Main <br> Complaint</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Time Block</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Remarks</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Appointment <br> Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="text-center">
                        <td class="border-2 border-yellow-700">123456</td>
                        <td class="border-2 border-yellow-700">06/24/2023</td>
                        <td class="border-2 border-yellow-700">Medical</td>
                        <td class="border-2 border-yellow-700">Doctor 1</td>
                        <td class="border-2 border-yellow-700">Complaint</td>
                        <td class="border-2 border-yellow-700">1:00 PM</td>
                        <td class="border-2 border-yellow-700">Notes</td>
                        <td class="border-2 border-yellow-700"><span class="inline-block h-3 w-3 rounded-full bg-red-600"></span> Rescheduled</td>
                    </tr>

                    <tr class="text-center">
                        <td class="border-2 border-yellow-700">123456</td>
                        <td class="border-2 border-yellow-700">06/24/2023</td>
                        <td class="border-2 border-yellow-700">Medical</td>
                        <td class="border-2 border-yellow-700">Doctor 1</td>
                        <td class="border-2 border-yellow-700">Complaint</td>
                        <td class="border-2 border-yellow-700">1:00 PM</td>
                        <td class="border-2 border-yellow-700">Notes</td>
                        <td class="border-2 border-yellow-700"><span class="inline-block h-3 w-3 rounded-full bg-teal-400"></span> Confirmed</td>
                    </tr>

                    <tr class="text-center">
                        <td class="border-2 border-yellow-700">123456</td>
                        <td class="border-2 border-yellow-700">06/24/2023</td>
                        <td class="border-2 border-yellow-700">Medical</td>
                        <td class="border-2 border-yellow-700">Doctor 1</td>
                        <td class="border-2 border-yellow-700">Complaint</td>
                        <td class="border-2 border-yellow-700">1:00 PM</td>
                        <td class="border-2 border-yellow-700">Notes</td>
                        <td class="border-2 border-yellow-700"><span class="inline-block h-3 w-3 rounded-full bg-yellow-400"></span> Checked In</td>
                    </tr>

                    <tr class="text-center">
                        <td class="border-2 border-yellow-700">123456</td>
                        <td class="border-2 border-yellow-700">06/24/2023</td>
                        <td class="border-2 border-yellow-700">Medical</td>
                        <td class="border-2 border-yellow-700">Doctor 1</td>
                        <td class="border-2 border-yellow-700">Complaint</td>
                        <td class="border-2 border-yellow-700">1:00 PM</td>
                        <td class="border-2 border-yellow-700">Notes</td>
                        <td class="border-2 border-yellow-700"><span class="inline-block h-3 w-3 rounded-full bg-blue-400"></span> In Progress</td>
                    </tr>

                    <tr class="text-center">
                        <td class="border-2 border-yellow-700">123456</td>
                        <td class="border-2 border-yellow-700">06/24/2023</td>
                        <td class="border-2 border-yellow-700">Medical</td>
                        <td class="border-2 border-yellow-700">Doctor 1</td>
                        <td class="border-2 border-yellow-700">Complaint</td>
                        <td class="border-2 border-yellow-700">1:00 PM</td>
                        <td class="border-2 border-yellow-700">Notes</td>
                        <td class="border-2 border-yellow-700"><span class="inline-block h-3 w-3 rounded-full bg-green-600"></span> Completed</td>
                    </tr>

                    <tr class="text-center">
                        <td class="border-2 border-yellow-700">123456</td>
                        <td class="border-2 border-yellow-700">06/24/2023</td>
                        <td class="border-2 border-yellow-700">Medical</td>
                        <td class="border-2 border-yellow-700">Doctor 1</td>
                        <td class="border-2 border-yellow-700">Complaint</td>
                        <td class="border-2 border-yellow-700">1:00 PM</td>
                        <td class="border-2 border-yellow-700">Notes</td>
                        <td class="border-2 border-yellow-700"><span class="inline-block h-3 w-3 rounded-full bg-red-800"></span> No-show</td>
                    </tr>
                </tbody>
            </table>

            <div class="w-full text-center py-28 text-blue-950 font-bold">
                <h4 class="text-4xl">NO UPCOMING <br> APPOINTMENT</h4>
            </div>
        </div>
        
    </div>
</div> --}}

{{-- V2 --}}
<div class="p-10 w-full min-h-screen" x-data="{ type: 'Upcoming' }">
    <div class="w-full h-fit bg-white rounded-xl p-10">
        <h1 class="text-3xl text-yellow-600 font-bold">VIEW APPOINTMENT</h1>

        <div class="mt-5 px-4 mb-5">
            <div>
                <button x-on:click="type = 'Upcoming'" :class="{ 'bg-blue-800 text-white': type === 'Upcoming', 'bg-white text-blue-8': type !== 'Upcoming'}" class="bg-white text-2xl font-semibold text-blue-800 border border-blue-800 px-10 py-1 rounded-lg hover:bg-blue-800 hover:text-white">UPCOMING APPOINTMENT</button>
                <button x-on:click="type = 'Appointment'" :class="{ 'bg-blue-800 text-white': type === 'Appointment', 'bg-white text-blue-8': type !== 'Appointment'}" class="bg-white text-2xl font-semibold text-blue-800 border border-blue-800 px-10 py-1 rounded-lg hover:bg-blue-800 hover:text-white">APPOINTMENT REQUEST</button>
            </div>
            <div class="w-full border-t-4 border-blue-900 mt-2"></div>
        </div>

        {{-- For UP --}}
        <div class="px-4" :class="{ '': type === 'Upcoming', 'hidden': type !== 'Upcoming' }">
            <table class="table-auto w-full h-full">
                <tbody>
                    @php
                    $appointments = DB::table('appointmentreqs')
                        ->where('univnum', Auth::user()->univ_num)
                        ->orderBy('created_at', 'desc')
                        ->get();
                    $hasAppointments = false; // Flag to check if there are any upcoming appointments
                    @endphp
                    
                    @foreach($appointments as $appointment)
                        @if($appointment->remarks === 'Approved' || $appointment->remarks === 'Reschedule' || $appointment->remarks === 'Follow Up' || $appointment->remarks === 'No show')
                            @if (!$hasAppointments)
                            <thead>
                                <tr class="divide-x">
                                    <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Appointment <br> ID</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Appointment <br> Date</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Clinic Service</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Request Type</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Complaint</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Time Block</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Appointment <br> Status</th>
                                </tr>
                            </thead>
                            @php
                            $hasAppointments = true;
                            @endphp
                            @endif
                            <tr class="text-center">
                                <td class="border-2 border-yellow-700">{{ $appointment->id }}</td>
                                <td class="border-2 border-yellow-700">{{ $appointment->date }}</td>
                                <td class="border-2 border-yellow-700">{{ $appointment->type }}</td>
                                <td class="border-2 border-yellow-700">{{ $appointment->request_type }}</td>
                                <td class="border-2 border-yellow-700">{{ $appointment->reason }}</td>
                                <td class="border-2 border-yellow-700">{{ $appointment->time }}</td>
                                <td class="border-2 border-yellow-700">
                                    <span class="inline-block h-3 w-3 rounded-full 
                                        {{ $appointment->remarks === 'Approved' ? 'bg-green-400' : 
                                        ($appointment->remarks === 'Not Approved' ? 'bg-red-400' : 
                                            ($appointment->remarks === 'Reschedule' ? 'bg-blue-400' :
                                                ($appointment->remarks === 'Follow Up' ? 'bg-pink-400' : 'bg-yellow-400'))) }}">
                                    </span> 
                                    {{ ucfirst($appointment->remarks) }}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    
                    {{-- If empty --}}
                    @if(!$hasAppointments)
                        <tr>
                            <td colspan="6" class="text-center py-10 text-blue-950 font-bold">
                                <h4 class="text-4xl">NO UPCOMING APPOINTMENTS</h4>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>


        {{-- For AP --}}
        <div class="px-4" :class="{ '': type === 'Appointment', 'hidden': type !== 'Appointment' }">
            {{-- Check if there are pending appointment requests --}}
            @php
            $appointments = DB::table('appointmentreqs')
                ->where('univnum', Auth::user()->univ_num)
                ->where('remarks', 'pending') // Filter only pending appointments
                ->orderBy('created_at', 'desc')
                ->get();
            $hasPendingRequests = $appointments->isNotEmpty(); // Check if there are pending requests
            @endphp

            {{-- Display the table only if there are pending requests --}}
            @if($hasPendingRequests)
            <table class="table-auto w-full h-full">
                <thead>
                    <tr class="divide-x">
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Appointment <br>Request ID</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Complaint</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Date of Complaint</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Appointment <br> Status</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- Display appointment requests --}}
                    @foreach($appointments as $appointment)
                    <tr class="text-center">
                        <td class="border-2 border-yellow-700">{{ $appointment->id }}</td>
                        <td class="border-2 border-yellow-700">{{ $appointment->type }}</td>
                        <td class="border-2 border-yellow-700">{{ $appointment->date }}</td>
                        {{-- For Resched --}}
                        <td class="border-2 border-yellow-700" 
                            @if($appointment->remarks === 'approved') 
                                data-modal-target="delete-modal" 
                                data-modal-toggle="delete-modal" 
                            @elseif($appointment->remarks === 'not approved') 
                                data-modal-target="delete-modal" 
                                data-modal-toggle="delete-modal" 
                        {{-- @elseif($appointment->remarks === 'pending') 
                                data-modal-target="resched-confirmation-modal" 
                                data-modal-toggle="resched-confirmation-modal"--}}
                            @endif>
                            <span class="inline-block h-3 w-3 rounded-full {{ $appointment->remarks === 'approved' ? 'bg-green-400' : ($appointment->remarks === 'not approved' ? 'bg-red-400' : 'bg-yellow-400') }}"></span> 
                            {{ ucfirst($appointment->remarks) }}
                        </td>                         
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            {{-- If empty or no pending requests --}}
            @if($appointments->isEmpty() || !$hasPendingRequests)            
            <div class="w-full text-center py-28 text-blue-950 font-bold">
                <h4 class="text-4xl">NO PENDING APPOINTMENT REQUEST</h4>
            </div>
            @endif
        </div>
        
    </div>
</div>

<div id="resched-confirmation-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full flex justify-center items-center">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow border-2 border-yellow-700 w-52">
            <!-- Modal body -->
            <div class="p-3 space-y-4 text-center">
                <span class="text-yellow-700 font-semibold">Reschedule this Appointment?</span>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center justify-center p-3 gap-3">
                <button data-modal-hide="resched-confirmation-modal" data-modal-target="resched-modal" data-modal-toggle="resched-modal" type="button" class="text-white bg-yellow-700 px-3 py-1 rounded-lg hover:bg-yellow-900">Yes</button>
                <button data-modal-hide="resched-confirmation-modal" type="button" class="border border-yellow-700 bg-white text-yellow-700 px-3 py-1 rounded-lg hover:border-2">No</button>
            </div>
        </div>
    </div>
</div>

<div id="resched-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full flex justify-center items-center">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow border-2 border-yellow-700">
            <!-- Modal body -->
            <div class="p-3 space-y-4 text-center">
                <h2 class="text-yellow-700 font-semibold text-xl">RESCHEDULE APPOINTMENT</h2>

                <div class="flex flex-col gap-3">
                    <div class="w-full text-start">
                        <label class="text-yellow-700">Select Date:</label>
                        <input type="date" class="border border-blue-800 rounded-xl w-full py-1">
                    </div>

                    <div class="w-full text-start">
                        <label class="text-yellow-700">Select Time:</label>
                        <input type="time" class="border border-blue-800 rounded-xl w-full py-1">
                    </div>
                </div>
                
            </div>
            <!-- Modal footer -->
            <div class="flex items-center justify-center p-3 gap-3">
                <input data-modal-hide="resched-modal" type="submit" value="SUBMIT" class="text-base px-5 py-1 bg-yellow-700 text-white rounded-lg hover:bg-yellow-900">
            </div>
        </div>
    </div>
</div>

<div id="delete-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full flex justify-center items-center">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow border-2 border-yellow-700 w-52">
            <!-- Modal body -->
            <div class="p-3 space-y-4 text-center">
                <span class="text-yellow-700 font-semibold">Delete the Appointment Request?</span>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center justify-center p-3 gap-3">
                <button data-modal-hide="delete-modal" type="button" class="text-white bg-yellow-700 px-3 py-1 rounded-lg hover:bg-yellow-900">Yes</button>
                <button data-modal-hide="delete-modal" type="button" class="border border-yellow-700 bg-white text-yellow-700 px-3 py-1 rounded-lg hover:border-2">No</button>
            </div>
        </div>
    </div>
</div>