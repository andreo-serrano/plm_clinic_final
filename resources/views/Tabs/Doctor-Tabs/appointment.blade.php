<div class="p-10 w-full min-h-screen">
    <div class="w-full h-fit bg-white rounded-xl p-10">
        <h1 class="text-3xl text-yellow-600 font-bold text-center">APPOINTMENTS</h1>

        @if(DB::table('doctorinfo')->where('doctorID', Auth::user()->univ_num)->exists())

            @php
                $doctorinfo = DB::table('doctorinfo')->where('doctorID', Auth::user()->univ_num)->first();
            @endphp

            @if($doctorinfo->spec === 'Medical Doctor')   
                {{-- For Medical Appointments --}}
                <div class="mt-5 px-4 mb-5">
                    <button class="text-2xl font-semibold bg-blue-800 text-white border border-blue-800 px-10 py-1 rounded-lg hover:bg-blue-800 hover:text-white">MEDICAL APPOINTMENTS</button>
                    <div class="w-full border-t-4 border-blue-900 mt-5"></div>
                </div>

                <div class="px-4" :class="{ '': type === 'Medical', 'hidden': type !== 'Medical' }" x-data="appointmentActions()">
                    <table id="medicalAppointmentTable" class="table-auto w-full h-full">
                    <tbody>
                            @php
                            $appointments = DB::table('appointmentreqs')
                                ->where('type', 'Medical')
                                ->orderBy('created_at', 'desc')
                                ->get();
                            $hasAppointments = false; // Flag to check if there are any upcoming appointments
                            @endphp

                            @php
                            $univNums = $appointments->pluck('univnum')->filter()->toArray(); // Filter out nulls

                                // Query for students
                                $students = DB::table('studentinfo')
                                    ->select('studentID as univnum', DB::raw("'Student' as userType"))
                                    ->whereIn('studentID', $univNums)
                                    ->get();

                                // Query for employees
                                $employees = DB::table('employeeinfo')
                                    ->select('employeeID as univnum', DB::raw("'Employee' as userType"))
                                    ->whereIn('employeeID', $univNums)
                                    ->get();

                                // Query for faculty
                                $faculty = DB::table('facultyinfo')
                                    ->select('facultyID as univnum', DB::raw("'Faculty' as userType"))
                                    ->whereIn('facultyID', $univNums)
                                    ->get();

                                // Merge results and create a lookup array for faster access
                                $userTypeLookup = $students
                                    ->concat($employees)
                                    ->concat($faculty)
                                    ->map(function ($item) {
                                        $item->univnum = (string) $item->univnum; // Convert to string if necessary
                                        return $item;
                                    })
                                    ->keyBy('univnum')
                                    ->map->userType
                                    ->toArray();
                            @endphp


                            @foreach($appointments as $appointment)
                                @if($appointment->remarks === 'pending' || $appointment->remarks === 'Pending')
                                    @if (!$hasAppointments)
                                    <thead> 
                                        <tr class="divide-x">
                                            <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Appointment <br> ID</th>
                                            <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Patient <br> Type</th>
                                            <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Appointment <br> Date</th>
                                            <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Time Block</th>
                                            <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Patient Concern</th>
                                            <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Remarks</th>
                                            <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Approval</th>
                                        </tr>
                                    </thead>
                                    @php
                                    $hasAppointments = true;
                                    @endphp
                                    @endif
                                        <tr class="text-center text-blue-800">
                                        <form id="approvalform-{{ $appointment->id }}" method="POST" action="{{ route('approval.store') }}">
                                        @csrf

                                        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                                        <input type="hidden" name="usertype" value="{{ $userTypeLookup[$appointment->univnum] ?? 'Unknown' }}">
                                        <input type="hidden" name="date" value="{{ $appointment->date }}">
                                        <input type="hidden" name="time" value="{{ $appointment->time }}">

                                        @if($appointment->request_type === 'Other')
                                            <input type="hidden" name="reqtype" value="{{ $appointment->reason }}">
                                        @elseif($appointment->reason === 'N/A')
                                            <input type="hidden" name="reqtype" value="{{ $appointment->request_type }}">
                                        @endif
                                                <td id="id" name="id" class="border-2 border-yellow-700">{{ $appointment->id }}</td>
                                                <td id="usertype" name="usertype" class="border-2 border-yellow-700">{{ $userTypeLookup[$appointment->univnum] ?? 'Unknown' }}</td>
                                                <td id="date" name="date" class="border-2 border-yellow-700">{{ $appointment->date }}</td>
                                                <td id="time" name="time" class="border-2 border-yellow-700">{{ $appointment->time }}</td>
                                                
                                                @if($appointment->request_type === 'Other')
                                                <td id="reqtype" name="reqtype" class="border-2 border-yellow-700">{{ $appointment->reason }}</td>
                                                @endif

                                                @if($appointment->reason === 'N/A')
                                                <td id="reqtype" name="reqtype" class="border-2 border-yellow-700">{{ $appointment->request_type }}</td>
                                                @endif


                                                <td class="border-2 border-yellow-700">
                                                    <div class="flex items-center relative text-center">
                                                        <input x-model="remarks"  name= "remarks" type="text" placeholder="Add Remarks" class="border-none placeholder-blue-800 w-full text-blue-800 focus:border-none border-transparent px-5">
                                                        <i class='bx bx-pencil absolute right-3 text-blue-800'></i>
                                                    </div>
                                                </td>

                                                <td class="border-2 border-yellow-700 flex flex-row gap-2 justify-center items-center h-full">
                                                    <button type="submit" name="action" value="accept" class="px-3 border-2 border-yellow-700 font-semibold text-yellow-700 rounded-lg hover:bg-yellow-700 hover:text-white">Accept</button>
                                                    <button type="submit" name="action" value="cancel" class="px-3 border-2 border-yellow-700 font-semibold text-yellow-700 rounded-lg hover:bg-yellow-700 hover:text-white">Reschedule</button>   
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
                                            <h4 class="text-4xl">NO MEDICAL APPOINTMENT REQUEST</h4>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            @else
                {{-- For Dental --}}
                <div class="mt-5 px-4 mb-5">
                    <button class="text-2xl font-semibold bg-blue-800 text-white border border-blue-800 px-10 py-1 rounded-lg hover:bg-blue-800 hover:text-white">DENTAL APPOINTMENTS</button>
                    <div class="w-full border-t-4 border-blue-900 mt-5"></div>
                </div>

                <div class="px-4" :class="{ '': type === 'Dental', 'hidden': type !== 'Dental' }" x-data="appointmentActions()">
                    <table class="table-auto w-full h-full">
                    <tbody>
                            @php
                            $appointments = DB::table('appointmentreqs')
                                ->where('type', 'Dental')
                                ->orderBy('created_at', 'desc')
                                ->get();
                            $hasAppointments = false; // Flag to check if there are any upcoming appointments
                            @endphp

                            @php
                            $univNums = $appointments->pluck('univnum')->filter()->toArray(); // Filter out nulls

                                // Query for students
                                $students = DB::table('studentinfo')
                                    ->select('studentID as univnum', DB::raw("'Student' as userType"))
                                    ->whereIn('studentID', $univNums)
                                    ->get();

                                // Query for employees
                                $employees = DB::table('employeeinfo')
                                    ->select('employeeID as univnum', DB::raw("'Employee' as userType"))
                                    ->whereIn('employeeID', $univNums)
                                    ->get();

                                // Query for faculty
                                $faculty = DB::table('facultyinfo')
                                    ->select('facultyID as univnum', DB::raw("'Faculty' as userType"))
                                    ->whereIn('facultyID', $univNums)
                                    ->get();

                                // Merge results and create a lookup array for faster access
                                $userTypeLookup = $students
                                    ->concat($employees)
                                    ->concat($faculty)
                                    ->map(function ($item) {
                                        $item->univnum = (string) $item->univnum; // Convert to string if necessary
                                        return $item;
                                    })
                                    ->keyBy('univnum')
                                    ->map->userType
                                    ->toArray();
                            @endphp


                            @foreach($appointments as $appointment)
                                @if($appointment->remarks === 'pending' || $appointment->remarks === 'Pending')
                                    @if (!$hasAppointments)
                                    <thead>
                                        <tr class="divide-x">
                                            <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Appointment <br> ID</th>
                                            <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Patient Type</th>
                                            <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Appointment <br> Date</th>
                                            <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Time Block</th>
                                            <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Patient Concern</th>
                                            <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Remarks</th>
                                            <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4">Approval</th>
                                        </tr>
                                    </thead>
                                    @php
                                    $hasAppointments = true;
                                    @endphp
                                    @endif
                                    <tr class="text-center text-blue-800">
                                    <form id="approvalform-{{ $appointment->id }}" method="POST" action="{{ route('approval1.store') }}">
                                        @csrf

                                        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                                        <input type="hidden" name="usertype" value="{{ $userTypeLookup[$appointment->univnum] ?? 'Unknown' }}">
                                        <input type="hidden" name="date" value="{{ $appointment->date }}">
                                        <input type="hidden" name="time" value="{{ $appointment->time }}">
                                        <input type="hidden" name="reqtype" value="{{ $appointment->reason }}">
                                    
                                    
                                                <td id="id" name="id" class="border-2 border-yellow-700">{{ $appointment->id }}</td>
                                                <td id="usertype" name="usertype" class="border-2 border-yellow-700">{{ $userTypeLookup[$appointment->univnum] ?? 'Unknown' }}</td>
                                                <td id="date" name="date" class="border-2 border-yellow-700">{{ $appointment->date }}</td>
                                                <td id="time" name="time" class="border-2 border-yellow-700">{{ $appointment->time }}</td>
                                                <td id="reqtype" name="reqtype" class="border-2 border-yellow-700">{{ $appointment->reason }}</td>
                                                <td class="border-2 border-yellow-700">
                                                    <div class="flex items-center relative text-center">
                                                        <input x-model="remarks" name= "remarks" type="text" placeholder="Add Remarks" class="border-none placeholder-blue-800 w-full text-blue-800 focus:border-none border-transparent px-5">
                                                        <i class='bx bx-pencil absolute right-3 text-blue-800'></i>
                                                    </div>
                                                </td>

                                                <td class="border-2 border-yellow-700 flex flex-row gap-2 justify-center items-center h-full">
                                                    <button type="submit" name="action" value="accept" class="px-3 border-2 border-yellow-700 font-semibold text-yellow-700 rounded-lg hover:bg-yellow-700 hover:text-white">Accept</button>
                                                    <button type="submit" name="action" value="cancel" class="px-3 border-2 border-yellow-700 font-semibold text-yellow-700 rounded-lg hover:bg-yellow-700 hover:text-white">Reschedule</button>
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
                                            <h4 class="text-4xl">NO DENTAL APPOINTMENT REQUEST</h4>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            @endif         
        @endif
        
    </div>
</div>