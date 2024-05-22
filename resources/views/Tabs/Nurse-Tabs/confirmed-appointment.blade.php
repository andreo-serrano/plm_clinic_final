<div class="p-10 w-full min-h-screen" x-data="{ type: 'Medical' }">
    <div class="w-full h-fit bg-white rounded-xl p-10">
        <h1 class="text-3xl text-yellow-600 font-bold">CONFIRMED APPOINTMENT</h1>

        <div class="mt-5 px-4 mb-5">
            <div>
                <button x-on:click="type = 'Medical'" :class="{ 'bg-blue-800 text-white': type === 'Medical', 'bg-white text-blue-8': type !== 'Medical'}" class="bg-white text-2xl font-semibold text-blue-800 border border-blue-800 px-10 py-1 rounded-lg hover:bg-blue-800 hover:text-white">MEDICAL APPOINTMENT</button>
                <button x-on:click="type = 'Dental'" :class="{ 'bg-blue-800 text-white': type === 'Dental', 'bg-white text-blue-8': type !== 'Dental'}" class="bg-white text-2xl font-semibold text-blue-800 border border-blue-800 px-10 py-1 rounded-lg hover:bg-blue-800 hover:text-white">DENTAL REQUEST</button>
            </div>
            <div class="w-full border-t-4 border-blue-900 mt-2"></div>
        </div>

        {{-- For Medical --}}
        <div class="px-4" :class="{ '': type === 'Medical', 'hidden': type !== 'Medical' }">
            <table class="table-auto w-full h-full">
                <tbody>
                    @php
                    $appointments = DB::table('appointmentreqs')
                        ->where('type', 'Medical')
                        ->orderBy('created_at', 'desc')
                        ->get();
                    $hasAppointments = false; // Flag to check if there are any upcoming appointments
                    @endphp

                    @php
                    $approvedmeds = DB::table('appmedicalreqs')
                        ->orderBy('created_at', 'desc')
                        ->get();
                    @endphp

                    @foreach($approvedmeds as $approvedmed)
                        @if($approvedmed->status === 'Approved' || $approvedmed->status === 'Not Approved')
                            @if (!$hasAppointments)
                                <thead>
                                    <tr class="divide-x">
                                        <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Appointment <br> ID</th>
                                        <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Patient Type</th>
                                        <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Appointment <br> Date</th>
                                        <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Time Block</th>
                                        <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Patient Concern</th>
                                        <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Remarks</th>
                                        <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>

                            @php
                            $hasAppointments = true;
                            @endphp
                            @endif

                            <tr class="text-center text-blue-800">
                                <form method="POST" action="{{ route('approval.store') }}">
                                @csrf
                                    <input type="hidden" name="appointment_id" value="{{ $approvedmed->appid }}">
                                    <input type="hidden" name="usertype" value="{{ $approvedmed->type }}">
                                    <input type="hidden" name="date" value="{{ $approvedmed->date }}">
                                    <input type="hidden" name="time" value="{{ $approvedmed->time }}">
                                    <input type="hidden" name="reqtype" value="{{ $approvedmed->patient_concern }}">
                                    <input type="hidden" name="remarks" value="{{ $approvedmed->remarks }}">

                                    <td class="border-2 border-yellow-700">{{ $approvedmed->appid }}</td>
                                    <td class="border-2 border-yellow-700">{{ $approvedmed->type }}</td>
                                    <td class="border-2 border-yellow-700">{{ $approvedmed->date }}</td>
                                    <td class="border-2 border-yellow-700">{{ $approvedmed->time }}</td>
                                    <td class="border-2 border-yellow-700">{{ $approvedmed->patient_concern }}</td>
                                    <td class="border-2 border-yellow-700">{{ $approvedmed->remarks }}</td>
                                    <td class="border-2 border-yellow-700">
                                        <span class="inline-block h-3 w-3 rounded-full
                                            @if($approvedmed->status === 'Approved') bg-green-400
                                            @elseif($approvedmed->status === 'Not Approved') bg-red-400
                                            @elseif($approvedmed->status === 'Reschedule') bg-blue-400
                                            @elseif($approvedmed->status === 'Follow Up') bg-pink-400
                                            @else bg-yellow-400
                                            @endif">
                                        </span>
                                        {{ ucfirst($approvedmed->status) }}
                                    </td>

                                    <td>
                                        <button type="submit" name="action" value="resolved" class="text-lg text-blue-800 p-2 hover:border hover:border-gray-200 rounded-lg">
                                            <i class='bx bx-check-circle'></i>
                                        </button>
                                    </td>
                                </form>
                            </tr>

                        @endif
                    @endforeach
                    
                    {{-- If empty --}}
                    @if(!$hasAppointments)
                        <tr>
                            <td colspan="8">
                                <div class="w-full text-center py-28 text-blue-950 font-bold">
                                    <h4 class="text-4xl">NO MEDICAL APPOINTMENTS</h4>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>






        {{-- For Dental --}}
        <div class="px-4" :class="{ '': type === 'Dental', 'hidden': type !== 'Dental' }">
            <table class="table-auto w-full h-full">
            <tbody>
                    @php
                    $appointments = DB::table('appointmentreqs')
                        ->where('type', 'Medical')
                        ->orderBy('created_at', 'desc')
                        ->get();
                    $hasAppointments = false; // Flag to check if there are any upcoming appointments
                    @endphp

                    @php
                    $approvedmeds = DB::table('appdentalreqs')
                        ->orderBy('created_at', 'desc')
                        ->get();
                    @endphp

                    @foreach($approvedmeds as $approvedmed)
                        @if($approvedmed->status === 'Approved' || $approvedmed->status === 'Not Approved')
                            @if (!$hasAppointments)
                                <thead>
                                    <tr class="divide-x">
                                        <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Appointment <br> ID</th>
                                        <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Patient Type</th>
                                        <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Appointment <br> Date</th>
                                        <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Time Block</th>
                                        <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Patient Concern</th>
                                        <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Remarks</th>
                                        <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>

                            @php
                            $hasAppointments = true;
                            @endphp
                            @endif

                            <tr class="text-center text-blue-800">
                                <form  method="POST" action="{{ route('approval1.store') }}">
                                @csrf

                                    <input type="hidden" name="appointment_id" value="{{ $approvedmed->appid }}">
                                    <input type="hidden" name="usertype" value="{{ $approvedmed->type }}">
                                    <input type="hidden" name="date" value="{{ $approvedmed->date }}">
                                    <input type="hidden" name="time" value="{{ $approvedmed->time }}">
                                    <input type="hidden" name="reqtype" value="{{ $approvedmed->patient_concern }}">
                                    <input type="hidden" name="remarks" value="{{ $approvedmed->remarks }}">

                                    <td class="border-2 border-yellow-700">{{ $approvedmed->appid }}</td>
                                    <td class="border-2 border-yellow-700">{{ $approvedmed->type }}</td>
                                    <td class="border-2 border-yellow-700">{{ $approvedmed->date }}</td>
                                    <td class="border-2 border-yellow-700">{{ $approvedmed->time }}</td>
                                    <td class="border-2 border-yellow-700">{{ $approvedmed->patient_concern }}</td>
                                    <td class="border-2 border-yellow-700">{{ $approvedmed->remarks }}</td>
                                    <td class="border-2 border-yellow-700">
                                        <span class="inline-block h-3 w-3 rounded-full
                                            @if($approvedmed->status === 'Approved') bg-green-400
                                            @elseif($approvedmed->status === 'Not Approved') bg-red-400
                                            @elseif($approvedmed->status === 'Reschedule') bg-blue-400
                                            @elseif($approvedmed->status === 'Follow Up') bg-pink-400
                                            @else bg-yellow-400
                                            @endif">
                                        </span>
                                        {{ ucfirst($approvedmed->status) }}
                                    </td>

                                    <td>
                                        <button  type="submit" name="action" value="resolved" class="text-lg text-blue-800 p-2 hover:border hover:border-gray-200 rounded-lg">
                                            <i class='bx bx-check-circle'></i>
                                        </button>
                                    </td>
                                </form>
                            </tr>

                        @endif
                    @endforeach
                    
                    {{-- If empty --}}
                    @if(!$hasAppointments)
                        <tr>
                            <td colspan="8">
                                <div class="w-full text-center py-28 text-blue-950 font-bold">
                                    <h4 class="text-4xl">NO DENTAL APPOINTMENTS</h4>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>