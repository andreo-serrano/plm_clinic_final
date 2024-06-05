<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
.plus-button {
    position: absolute;
    top: 218px;
    right: 175px;
}
</style>

<div class="p-10 w-full min-h-screen" x-data="{ type: 'Medical' }">
    <div class="w-full h-fit bg-white rounded-xl p-10">
        <h1 class="text-3xl text-yellow-600 font-bold">VIEW APPOINTMENT</h1>

        {{--Adding new patient--}}
        <button onclick="showEditForm()" class="plus-button bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <span>
                ADD PATIENT
            </span>
            <i class="fas fa-plus"></i>  
        </button>

        <form class="flex flex-col items-center content-center gap-4" id="appreqForm" method="POST" action="{{ route('appointmentreqs.store') }}">
        @csrf
            <div id="editForm" class="hidden fixed inset-0 z-50 overflow-y-auto flex items-center justify-center">
                <div class="relative bg-white rounded-lg shadow-md p-6 border border-yellow-500">

                {{--Changes are all good--}}

                    <h1 class="text-3xl text-yellow-600 font-bold text-center">UHS FORM No. 13</h1>

                    <div x-data="{ type: 'Medical' }">
                        <h3 class="font-bold text-blue-800 mt-5">TYPE OF CONSULTATION:</h3>     
                            <div class="flex gap-3">  
                                <button x-on:click="type = 'Medical'" :class="{ 'bg-blue-800 text-white': type === 'Medical'}"  name="appreq_type" class="border border-blue-800 font-semibold rounded-lg text-blue-800 py-2 px-4 hover:bg-blue-800 hover:text-white">Medical</button>
                                <button x-on:click="type = 'Dental'" :class="{ 'bg-blue-800 text-white': type === 'Dental'}" name="appreq_type"  class="border border-blue-800 font-semibold rounded-lg text-blue-800 py-2 px-4 hover:bg-blue-800 hover:text-white">Dental</button>
                            </div>
                            
                    
                            <div class="mt-5">
                                <h3 class="font-bold text-blue-800">APPOINTMENT FORM:</h3>

                                {{-- Requestion of Appoinment Form --}}
                                <form class="flex flex-col items-center content-center gap-4" id="appreqForm" method="POST" action="{{ route('appointmentreqs.store') }}">
                                @csrf

                                    {{-- Include hidden input field for appreq_type --}}
                                    <input type="hidden" name="appreq_type" x-model="type">

                                    <div class="border-2 border-blue-800 grid grid-cols-2 gap-4 px-8 py-3 rounded-lg">
                                        <div class="col-span-1 space-y-2">
                                            <div class="flex flex-col">
                                                <label class="text-yellow-600 font-bold">PLM Number:</label>
                                                <input type="text" name="appreq_univnum" class="border border-blue-800 rounded-lg py-1 px-3 ms-5" placeholder="2021-0000">
                                            </div>

                                            <div class="flex flex-col" x-show="type === 'Medical'">
                                                <label class="text-yellow-600 font-bold">Request Type:</label>
                                                <select name="reqtype" id="reqtype" class="border border-blue-800 rounded-lg py-1 px-3 ms-5">
                                                    <option value="Monitoring of DOTS">Monitoring of DOTS</option>
                                                    <option value="Annual Physical Exam">Annual Physical Exam</option>
                                                    <option value="Medical Certificate Request">Medical Certificate Request</option>
                                                    <option value="Other">Other</option>
                                                    <!-- Add more options as needed -->
                                                </select>
                                            </div>
                                            
                                            <div class="flex flex-col">
                                                <label class="text-yellow-600 font-bold">Reason for consultation:</label>
                                                <textarea  cols="30" rows="10" name="appreq_reason" id="appreq_reason" class="border border-blue-800 rounded-lg p-2 ms-5" :disabled="type !== 'Dental'"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-span-1 space-y-2">
                                            <div class="flex flex-col">
                                                <label class="text-yellow-600 font-bold">Select Date:</label>
                                                <input type="date" name="appreq_date" class="border border-blue-800 rounded-lg py-1 px-3 ms-5">
                                            </div>

                                            <div class="flex flex-col">
                                                <label class="text-yellow-600 font-bold">Select Time:</label>
                                                <input type="time" name="appreq_time" class="border border-blue-800 rounded-lg py-1 px-3 ms-5">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 flex gap-3">
                                        <button onclick="hideEditForm()" class="font-semibold text-small bg-blue-800 text-white py-1 px-4 rounded-lg hover:bg-blue-900">
                                            Cancel
                                        </button>
                                        <input type="submit" value="Add patient" class="font-semibold text-small bg-blue-800 text-white py-1 px-4 rounded-lg hover:bg-blue-900" onclick="return validateForm()"></input>
                                    </div>
                                </form>
                                {{-- End Requestion of Appoinment Form --}}

                                {{-- Validation of Fields --}}
                                <script>
                                    function validateForm() {
                                        // Get values of required fields
                                        var plmnum = document.forms["appreqForm"]["appreq_univnum"].value;
                                        var date = document.forms["appreqForm"]["appreq_date"].value;
                                        var time = document.forms["appreqForm"]["appreq_time"].value;

                                        // Check if required fields are filled
                                        if (plmnum == "" || date == "" || time == "") {
                                            // Display error message
                                            alert("Please fill out all required fields.");
                                            return false; // Prevent form submission
                                        }

                                        // Get current date and time
                                        var today = new Date();
                                        var currentTime = today.getHours() * 60 + today.getMinutes(); // Current time in minutes

                                        // Convert date input string to Date object
                                        var selectedDate = new Date(date);

                                        // Check if the selected date is today or a future date
                                        if (selectedDate < today) {
                                            // Display error message
                                            alert("Please select a date at least 3 days prior.");
                                            return false; // Prevent form submission
                                        }

                                        // Check if the selected date is today and the selected time is in the past
                                        if (selectedDate.getTime() === today.getTime() && convertTimeToMinutes(time) <= currentTime) {
                                            // Display error message
                                            alert("Please select a time later than the current time.");
                                            return false; // Prevent form submission
                                        }

                                        // Check if the selected time is within the acceptable range
                                        if (convertTimeToMinutes(time) < 8 * 60 || convertTimeToMinutes(time) > 17 * 60) {
                                            // Display error message
                                            alert('Please select a time between 8:00 am and 5:00 pm.');
                                            return false; // Prevent form submission
                                        }



                                        // Display success message
                                        alert("Request submitted successfully!");
                                        return true; // Allow form submission
                                    }

                                    // Function to convert time to minutes
                                    function convertTimeToMinutes(time) {
                                        var parts = time.split(':');
                                        return parseInt(parts[0]) * 60 + parseInt(parts[1]);
                                    }

                                </script>
                                {{-- End of validation of Fields --}}

                            
                                {{-- Enabling of reason for consultation field --}}
                                <script>
                                    document.getElementById('reqtype').addEventListener('change', function() {
                                        var reasonTextarea = document.getElementById('appreq_reason');
                                        // Check if the selected option is 'Other'
                                        if (this.value === 'Other') {
                                            reasonTextarea.disabled = false; // Enable the textarea
                                        }
                                        else {
                                            reasonTextarea.disabled = true; // Disable the textarea
                                        }
                                    });
                                </script>
                                {{-- Enabling of reason for consultation field --}}

                            </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- Validation of Fields --}}
                    <script>

                        document.getElementById('appreqForm').addEventListener('submit', function(event) {
                            if (event.submitter && event.submitter.value !== 'ADD PATIENT') {
                                event.preventDefault(); // Prevent submission if not the "Add Patient" button
                            } else {
                                // Validate the form here
                                if (!validateForm()) { // Replace validateForm() with your actual validation logic
                                    event.preventDefault(); // Prevent submission if validation fails
                                }
                            }
                        });
                        
                        function validateForm() {
                            // Get values of required fields
                            var plmnum = document.forms["appreqForm"]["appreq_univnum"].value;
                            var date = document.forms["appreqForm"]["appreq_date"].value;
                            var time = document.forms["appreqForm"]["appreq_time"].value;

                            // Check if required fields are filled
                            if (plmnum == "" || date == "" || time == "") {
                                // Display error message
                                alert("Please fill out all required fields.");
                                return false; // Prevent form submission
                            }

                            // Get current date and time
                            var today = new Date();
                            var currentTime = today.getHours() * 60 + today.getMinutes(); // Current time in minutes

                            // Convert date input string to Date object
                            var selectedDate = new Date(date);

                            // Check if the selected date is today or a future date
                            if (selectedDate < today) {
                                // Display error message
                                alert("Please select a date at least 3 days prior.");
                                return false; // Prevent form submission
                            }

                            // Check if the selected date is today and the selected time is in the past
                            if (selectedDate.getTime() === today.getTime() && convertTimeToMinutes(time) <= currentTime) {
                                // Display error message
                                alert("Please select a time later than the current time.");
                                return false; // Prevent form submission
                            }

                            // Check if the selected time is within the acceptable range
                            if (convertTimeToMinutes(time) < 8 * 60 || convertTimeToMinutes(time) > 17 * 60) {
                                // Display error message
                                alert('Please select a time between 8:00 am and 5:00 pm.');
                                return false; // Prevent form submission
                            }



                            // Display success message
                            alert("Request submitted successfully!");
                            return true; // Allow form submission
                        }

                        // Function to convert time to minutes
                        function convertTimeToMinutes(time) {
                            var parts = time.split(':');
                            return parseInt(parts[0]) * 60 + parseInt(parts[1]);
                        }

                    </script>
                    {{-- End of validation of Fields --}}

                 
                    {{-- Enabling of reason for consultation field --}}
                    <script>
                        document.getElementById('reqtype').addEventListener('change', function() {
                            var reasonTextarea = document.getElementById('appreq_reason');
                            // Check if the selected option is 'Other'
                            if (this.value === 'Other') {
                                reasonTextarea.disabled = false; // Enable the textarea
                            }
                             else {
                                reasonTextarea.disabled = true; // Disable the textarea
                            }
                        });
                    </script>

        {{-- End of validation of Fields --}}

        {{--End of adding new patient--}}

        <div class="mt-5 px-4 mb-5">
            <div>
                <button x-on:click="type = 'Medical'" :class="{ 'bg-blue-800 text-white': type === 'Medical', 'bg-white text-blue-8': type !== 'Medical'}" class="bg-white text-2xl font-semibold text-blue-800 border border-blue-800 px-10 py-1 rounded-lg hover:bg-blue-800 hover:text-white">MEDICAL APPOINTMENT</button>
                <button x-on:click="type = 'Dental'" :class="{ 'bg-blue-800 text-white': type === 'Dental', 'bg-white text-blue-8': type !== 'Dental'}" class="bg-white text-2xl font-semibold text-blue-800 border border-blue-800 px-10 py-1 rounded-lg hover:bg-blue-800 hover:text-white">DENTAL REQUEST</button>
            </div>
            <div class="w-full border-t-4 border-blue-900 mt-2"></div>
        </div>

        {{-- For Medical --}}
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

                    {{--Fetching of usertype--}}
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

                    {{--Fetching of names--}}
                    @php
                       $studentDetails = DB::table('studentinfo')
                            ->select('studentID as univnum', 'lastname', 'firstname', 'midname')
                            ->whereIn('studentID', $univNums)
                            ->get();

                        $employeeDetails = DB::table('employeeinfo')
                            ->select('employeeID as univnum', 'lastname', 'firstname', 'midname')
                            ->whereIn('employeeID', $univNums)
                            ->get();

                        $facultyDetails = DB::table('facultyinfo')
                            ->select('facultyID as univnum', 'lastname', 'firstname', 'midname')
                            ->whereIn('facultyID', $univNums)
                            ->get();

                        // Create a combined lookup array for names
                        $nameLookup = $studentDetails
                            ->concat($employeeDetails)
                            ->concat($facultyDetails)
                            ->mapWithKeys(function ($item) {
                                return [(string) $item->univnum => [
                                    'lastname' => $item->lastname,
                                    'firstname' => $item->firstname,
                                    'midname' => $item->midname,
                                ]];
                            })
                            ->toArray();
                    @endphp


                    @foreach($appointments as $appointment)
                        @if($appointment->remarks === 'pending' || $appointment->remarks === 'Pending')
                            @if (!$hasAppointments)
                            <thead> 
                                <tr class="divide-x">
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-32">Appointment <br> ID</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-32">University <br> ID</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-1/4">Name</th> 
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-1/6">Patient <br> Type</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-1/6">Appointment <br> Date</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-1/6">Time Block</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-1/4">Patient Concern</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-1/6">Remarks</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-1/6">Approval</th>
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
                                <input type="hidden" name="univnum" value="{{ $appointment->univnum }}">

                                @if($appointment->request_type === 'Other')
                                    <input type="hidden" name="reqtype" value="{{ $appointment->reason }}">
                                @elseif($appointment->reason === 'N/A')
                                    <input type="hidden" name="reqtype" value="{{ $appointment->request_type }}">
                                @endif
                                        <td id="id" name="id" class="border-2 border-yellow-700">{{ $appointment->id }}</td>
                                        <td id="id" name="id" class="border-2 border-yellow-700">{{ $appointment->univnum }}</td>
                                        <td id="id" name="id" class="border-2 border-yellow-700 w-40">
                                            @if(isset($nameLookup[$appointment->univnum]))
                                                {{ $nameLookup[$appointment->univnum]['firstname'] }} 
                                                {{ $nameLookup[$appointment->univnum]['midname'] ? substr($nameLookup[$appointment->univnum]['midname'], 0, 1) . '.' : '' }} 
                                                {{ $nameLookup[$appointment->univnum]['lastname'] }}
                                            @else
                                                Unknown
                                            @endif
                                        </td>
                                        <td id="usertype" name="usertype" class="border-2 border-yellow-700">{{ $userTypeLookup[$appointment->univnum] ?? 'Unknown' }}</td>
                                        <td id="date" name="date" class="border-2 border-yellow-700">{{ $appointment->date }}</td>
                                        <td id="time" name="time" class="border-2 border-yellow-700">{{ $appointment->time }}</td>
                                        
                                        @if($appointment->request_type === 'Other')
                                        <td id="reqtype" name="reqtype" class="border-2 border-yellow-700">{{ $appointment->reason }}</td>
                                        @endif

                                        @if($appointment->reason === 'N/A')
                                        <td id="reqtype" name="reqtype" class="border-2 border-yellow-700">{{ $appointment->request_type }}</td>
                                        @endif


                                        <td class="border-2 border-yellow-700 py-2 px-4 w-64">
                                            <div class="flex items-center relative text-center">
                                                <input x-model="remarks"  name= "remarks" type="text" class="border-none placeholder-blue-800 w-full text-blue-800 focus:border-none border-transparent px-5">
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
        

        {{-- For Dental --}}
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

                     {{--Fetching of names--}}
                     @php
                       $studentDetails = DB::table('studentinfo')
                            ->select('studentID as univnum', 'lastname', 'firstname', 'midname')
                            ->whereIn('studentID', $univNums)
                            ->get();

                        $employeeDetails = DB::table('employeeinfo')
                            ->select('employeeID as univnum', 'lastname', 'firstname', 'midname')
                            ->whereIn('employeeID', $univNums)
                            ->get();

                        $facultyDetails = DB::table('facultyinfo')
                            ->select('facultyID as univnum', 'lastname', 'firstname', 'midname')
                            ->whereIn('facultyID', $univNums)
                            ->get();

                        // Create a combined lookup array for names
                        $nameLookup = $studentDetails
                            ->concat($employeeDetails)
                            ->concat($facultyDetails)
                            ->mapWithKeys(function ($item) {
                                return [(string) $item->univnum => [
                                    'lastname' => $item->lastname,
                                    'firstname' => $item->firstname,
                                    'midname' => $item->midname,
                                ]];
                            })
                            ->toArray();
                    @endphp

                    @foreach($appointments as $appointment)
                        @if($appointment->remarks === 'pending' || $appointment->remarks === 'Pending')
                            @if (!$hasAppointments)
                            <thead>
                                <tr class="divide-x">
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-32">Appointment <br> ID</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-32">University <br> ID</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-1/4">Name</th> 
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-1/6">Patient <br> Type</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-1/6">Appointment <br> Date</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-1/6">Time Block</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-1/4">Patient Concern</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-1/6">Remarks</th>
                                    <th class="text-white bg-blue-900 text-sm font-semibold py-2 px-4 w-1/6">Approval</th>
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
                                <input type="hidden" name="univnum" value="{{ $appointment->univnum }}">
                               
                            
                                        <td id="id" name="id" class="border-2 border-yellow-700">{{ $appointment->id }}</td>
                                        <td id="id" name="id" class="border-2 border-yellow-700">{{ $appointment->univnum }}</td>
                                        <td id="id" name="id" class="border-2 border-yellow-700 w-20">
                                            @if(isset($nameLookup[$appointment->univnum]))
                                                {{ $nameLookup[$appointment->univnum]['firstname'] }} 
                                                {{ $nameLookup[$appointment->univnum]['midname'] ? substr($nameLookup[$appointment->univnum]['midname'], 0, 1) . '.' : '' }} 
                                                {{ $nameLookup[$appointment->univnum]['lastname'] }}
                                            @else
                                                Unknown
                                            @endif
                                        </td>
                                        <td id="usertype" name="usertype" class="border-2 border-yellow-700">{{ $userTypeLookup[$appointment->univnum] ?? 'Unknown' }}</td>
                                        <td id="date" name="date" class="border-2 border-yellow-700">{{ $appointment->date }}</td>
                                        <td id="time" name="time" class="border-2 border-yellow-700">{{ $appointment->time }}</td>
                                        <td id="reqtype" name="reqtype" class="border-2 border-yellow-700">{{ $appointment->reason }}</td>
                                        <td class="border-2 border-yellow-700 py-2 px-4 w-64">
                                            <div class="flex items-center relative text-center">
                                                <input x-model="remarks"  name= "remarks" type="text" class="border-none placeholder-blue-800 w-full text-blue-800 focus:border-none border-transparent px-5">
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

    </div>
</div>

<script>
    // Function to show the edit form
    function showEditForm() {
        document.getElementById('editForm').classList.remove('hidden');
    }

    // Function to hide the edit form
    function hideEditForm() {
        document.getElementById('editForm').classList.add('hidden');
    }

    function appointmentActions() {
        return {
            cancelAppointment(el) {
                const input = el.closest('tr').querySelector('input[name="remarks"]');
                if (input) {
                    input.value = '';
                }
            }
        };
    }
</script>
