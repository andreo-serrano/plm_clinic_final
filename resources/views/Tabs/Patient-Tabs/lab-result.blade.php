<head>
    <style>
        .lab-container {
            display: flex; /* Enable flexbox for side-by-side layout */
        }

        #lab {
            flex-direction: column; /* Make list items stack vertically */
            width: 200px; /* Adjust width as needed for the lab results list */
            margin-right: 10px; /* Add some space between the list and the image */
        }
         /* Button Styles */
         .upload-button {
                                    background-color: #007bff; /* Blue background */
                                    color: white;
                                    padding: 10px 20px;
                                    border: none;
                                    border-radius: 5px;
                                    cursor: pointer;
                                    font-size: 16px;
                                    transition: background-color 0.3s ease; /* Smooth transition */
                                }

                                .upload-button:hover {
                                    background-color: #0056b3; /* Darker blue on hover */
                                }

                                .upload-button i {
                                    margin-right: 5px;
                                }

                                /* Overlay Styles */
                                .upload-overlay {
                                    position: fixed; /* Stay in place */
                                    top: 50%;
                                    left: 50%;
                                    transform: translate(-50%, -50%);
                                    background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
                                    padding: 20px;
                                    border-radius: 10px;
                                    text-align: center;
                                }

                                .overlay-content {
                                    background-color: #fff;
                                    padding: 30px;
                                    border-radius: 8px;
                                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                                }

                                .overlay-content i {
                                    font-size: 48px;
                                    color: #007bff;
                                    margin-bottom: 10px;
                                }

                                .overlay-content p {
                                    font-size: 18px;
                                    margin-bottom: 20px;
                                }

                                /* File Name Display */
                                .file-name-display {
                                    margin-top: 10px;
                                    font-size: 14px;
                                    color: #333;
                                }
    </style>
</head>

<body>
{{-- V2 --}}
<div class="p-10 w-full min-h-screen" x-data="{typeOfResult: 'Medical'}">
    <div class="bg-white rounded-xl p-10">
        <h1 class="text-3xl text-yellow-600 font-bold mb-5">MEDICAL LAB RESULT</h1>

        <div class="w-full flex items-center pb-6 gap-3">
            <h2 class="text-xl font-semibold text-blue-800">TYPE OF RESULT:</h2>
            <div class="flex gap-2">
                <button x-on:click="typeOfResult = 'Medical'" :class="{ 'bg-blue-800 text-white': typeOfResult === 'Medical',  'bg-white text-blue-800': typeOfResult !== 'Medical' }" class="text-xl border border-blue-800 px-10 py-1 rounded-lg hover:bg-blue-800 hover:text-white">Medical</button>
                <button x-on:click="typeOfResult = 'Dental'" :class="{ 'bg-blue-800 text-white': typeOfResult === 'Dental',  'bg-white text-blue-800': typeOfResult !== 'Dental' }" class="text-xl border border-blue-800 px-10 py-1 rounded-lg hover:bg-blue-800 hover:text-white">Dental</button>
            </div>
        </div>

        {{-- For Dental --}}
        <div x-data="{ selected: 1 }" :class="{ 'hidden': typeOfResult === 'Medical', 'block': typeOfResult !== 'Medical' }">
            <div class="lab-container">
                <ul id="lab" class="flex gap-1">
                @php
                $medicalrecords = DB::table('appointmentreqs')
                    ->where('univnum', Auth::user()->univ_num)
                    ->where('remarks', 'Approved')
                    ->where('type', 'Dental')
                    ->orderBy('created_at', 'desc')
                    ->get()
                @endphp

                @foreach($medicalrecords as $index => $record)
                    <li x-on:click="selected = {{ $index + 1 }}" :class="{ 'bg-white text-blue-800': selected === {{ $index + 1 }}, 'bg-blue-800 text-white': selected !== {{ $index + 1 }}}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">{{ $record->id }}</li>
                @endforeach
                </ul>

                {{-- Fetching of usertype --}}
                @php
                    $univNums = $medicalrecords->pluck('univnum')->filter()->toArray();
                    $students = DB::table('studentinfo')
                        ->select('studentID as univnum', DB::raw("'Student' as userType"))
                        ->whereIn('studentID', $univNums)
                        ->get();
                    $employees = DB::table('employeeinfo')
                        ->select('employeeID as univnum', DB::raw("'Employee' as userType"))
                        ->whereIn('employeeID', $univNums)
                        ->get();
                    $faculty = DB::table('facultyinfo')
                        ->select('facultyID as univnum', DB::raw("'Faculty' as userType"))
                        ->whereIn('facultyID', $univNums)
                        ->get();
                    $userTypeLookup = $students
                        ->concat($employees)
                        ->concat($faculty)
                        ->map(function ($item) {
                            $item->univnum = (string) $item->univnum;
                            return $item;
                        })
                        ->keyBy('univnum')
                        ->map->userType
                        ->toArray();
                @endphp

                {{-- Fetching of names --}}
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

                <div class="w-full h-auto border-2 border-blue-800 rounded-br-lg rounded-tr-lg rounded-bl-lg">
                    <div id="dental-records" data-records='@json($medicalrecords)'></div>

                    @foreach($medicalrecords as $index => $record)

                    @php
                        // Fetch the most recent lab result for the current record
                        $docu = DB::table('labresults')
                            ->where('appid', $record->id)
                            ->orderBy('created_at', 'desc')
                            ->first();
                    @endphp

                    <div :class="{ 'hidden': selected !== {{ $index + 1 }} }" class="w-full h-fit grid grid-cols-2 p-3 gap-4">
                        <div class="col-span-1 space-y-2">
                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">PATIENT NAME:</label>
                                    <span id="patient_name" class="text-blue-800 border border-blue-800 placeholder-blue-800 px-2 py-1 w-full">
                                        @if(isset($nameLookup[$record->univnum]))
                                            {{ $nameLookup[$record->univnum]['firstname'] }} 
                                            {{ $nameLookup[$record->univnum]['midname'] ? substr($nameLookup[$record->univnum]['midname'], 0, 1) . '.' : '' }} 
                                            {{ $nameLookup[$record->univnum]['lastname'] }}
                                        @else
                                            Unknown
                                        @endif
                                    </span>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">YOUR CURRENT CONDITION/REQUEST:</label>
                                    @if($record->request_type === 'Other')
                                        <textarea cols="30" rows="5" class="text-blue-800 border-1 border-blue-800 placeholder-blue-800 px-2 py-1 w-full">{{ $record->reason }}</textarea>
                                    @endif

                                    @if($record->request_type === 'N/A')
                                        <textarea cols="30" rows="5" class="text-blue-800 border-1 border-blue-800 placeholder-blue-800 px-2 py-1 w-full">{{ $record->reason }}</textarea>
                                    @endif

                                    @if($record->reason === 'N/A')
                                        <textarea cols="30" rows="5" class="text-blue-800 border-1 border-blue-800 placeholder-blue-800 px-2 py-1 w-full">{{ $record->request_type }}</textarea>
                                    @endif
                            </div>

                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">DIAGNOSIS / ILLNESS:</label>
                                <textarea cols="30" rows="5" class="text-blue-800 border-1 border-blue-800 placeholder-blue-800 px-2 py-1 w-full" disabled>{{$docu->diagnosis ?? 'N/A'}}</textarea>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">TREATMENT PLAN:</label>
                                <textarea cols="30" rows="5" class="text-blue-800 border-1 border-blue-800 placeholder-blue-800 px-2 py-1 w-full" disabled>{{$docu->treatment_plan ?? 'N/A'}}</textarea>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">REMARKS:</label>
                                <textarea cols="30" rows="5" class="text-blue-800 border-1 border-blue-800 placeholder-blue-800 px-2 py-1 w-full" disabled>{{$docu->remarks ?? 'N/A'}}</textarea>
                            </div>
                        </div>

                        <div class="col-span-1">
                            <h1 class="font-semibold text-blue-800">LABORATORIES:</h1>

                            {{--<iframe src="https://docs.google.com/gview?url=http://ieee802.org/secmail/docIZSEwEqHFr.doc&embedded=true" class="w-full h-[540px]"></iframe>--}}
                            
                                @php
                                    $recordId = $record->id;
                                    $docu = DB::table('labresults')
                                        ->where('appid', $recordId)
                                        ->orderBy('created_at', 'desc')
                                        ->first();
                                @endphp

                                @if($docu)
                                    @php
                                        // Construct the file path
                                        $filePath = storage_path('app/public/' . $docu->lab_results_file);
                                        // Construct the public URL for the iframe
                                        $publicPath = asset('storage/' . $docu->lab_results_file);
                                    @endphp

                                    @if(file_exists($filePath))
                                        <iframe src="{{ $publicPath }}" class="w-full h-[540px]"></iframe>
                                        {{--<a href="{{ asset('storage/laboratory_results/' . $docu->lab_results_file) }}" download>Download Lab Results</a>--}}
                                    @else
                                        <p>No document found.</p>
                                    @endif
                                @else
                                    <p>No document found.</p>
                                @endif

                            <div class="w-full flex justify-end mt-3 p-3" x-data="{ isHidden: true }">
                                <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateFormDental('{{ $index }}');">
                                    @csrf
                                    <button type="button" id="uploadButtonDental{{ $index }}" class="z-20 py-2 px-12 bg-white text-blue-800 font-semibold border border-blue-800 rounded-lg text-sm hover:bg-blue-800 hover:text-white">
                                        <i class="fas fa-cloud-upload-alt"></i> Upload Result
                                    </button>

                                    <input type="hidden" name="app_id" id="app_id" value="{{ $record->id }}">
                                    <input type="hidden" name="univnum" id="univnum" value="{{ $record->univnum }}">

                                    @if($record->request_type === 'Other')
                                        <input type="hidden" name="curr" id="curr" value="{{ $record->reason }}">
                                    @endif

                                    @if($record->request_type === 'N/A')
                                        <input type="hidden" name="curr" id="curr" value="{{ $record->reason }}">
                                    @endif

                                    @if($record->reason === 'N/A')
                                        <input type="hidden" name="curr" id="curr" value="{{ $record->request_type }}">
                                    @endif

                                    @php
                                    $recordId = $record->id;
                                    $docu = DB::table('labresults')
                                        ->where('appid', $recordId)
                                        ->orderBy('created_at', 'desc')
                                        ->first();
                                    @endphp

                                    <input type="hidden" name="diagnosis" id="diagnosis" value="{{ $docu->diagnosis ?? 'N/A'}}">
                                    <input type="hidden" name="treatplan" id="treatplan" value="{{ $docu->treatment_plan ?? 'N/A'}}">
                                    <input type="hidden" name="remarks" id="remarks" value="{{ $docu->remarks ?? 'N/A'}}">


                                    <div id="uploadOverlayDental{{ $index }}" class="hidden upload-overlay">
                                        <div class="overlay-content">
                                            <i class="fas fa-file-upload"></i>
                                            <p>Drag & Drop or Click to Upload</p>
                                            <input type="file" name="file" accept="application/pdf" id="fileInputDental{{ $index }}">
                                        </div>
                                        <div id="fileNameDisplayDental{{ $index }}" class="file-name-display"></div>

                                        <button type="submit" class="z-20 py-2 px-12 bg-white text-blue-800 font-semibold border border-blue-800 rounded-lg text-sm hover:bg-blue-800 hover:text-white">
                                            <i class="fas fa-cloud-upload-alt"></i> Submit Result
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{--End For Dental --}}

       {{-- For Medical --}}
        <div x-data="{ selected: 1 }" :class="{ 'hidden': typeOfResult === 'Dental', 'block': typeOfResult !== 'Dental' }">
            <div class="lab-container">
                <ul id="lab" class="flex gap-1">
                @php
                $medicalrecord = DB::table('appointmentreqs')
                    ->where('univnum', Auth::user()->univ_num)
                    ->where('remarks', 'Approved')
                    ->where('type', 'Medical')
                    ->orderBy('created_at', 'desc')
                    ->get()
                @endphp

                @foreach($medicalrecord as $index => $record)
                    <li x-on:click="selected = {{ $index + 1 }}" :class="{ 'bg-white text-blue-800': selected === {{ $index + 1 }}, 'bg-blue-800 text-white': selected !== {{ $index + 1 }}}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">{{ $record->id }}</li>
                @endforeach
                </ul>

                {{-- Fetching of usertype --}}
                @php
                    $univNums = $medicalrecord->pluck('univnum')->filter()->toArray();
                    $students = DB::table('studentinfo')
                        ->select('studentID as univnum', DB::raw("'Student' as userType"))
                        ->whereIn('studentID', $univNums)
                        ->get();
                    $employees = DB::table('employeeinfo')
                        ->select('employeeID as univnum', DB::raw("'Employee' as userType"))
                        ->whereIn('employeeID', $univNums)
                        ->get();
                    $faculty = DB::table('facultyinfo')
                        ->select('facultyID as univnum', DB::raw("'Faculty' as userType"))
                        ->whereIn('facultyID', $univNums)
                        ->get();
                    $userTypeLookup = $students
                        ->concat($employees)
                        ->concat($faculty)
                        ->map(function ($item) {
                            $item->univnum = (string) $item->univnum;
                            return $item;
                        })
                        ->keyBy('univnum')
                        ->map->userType
                        ->toArray();
                @endphp

                {{-- Fetching of names --}}
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

                <div class="w-full h-auto border-2 border-blue-800 rounded-br-lg rounded-tr-lg rounded-bl-lg">
                    <div id="medical-records" data-records='@json($medicalrecord)'></div>

                    @foreach($medicalrecord as $index => $record)

                    @php
                        // Fetch the most recent lab result for the current record
                        $docu = DB::table('labresults')
                            ->where('appid', $record->id)
                            ->orderBy('created_at', 'desc')
                            ->first();
                    @endphp

                    <div :class="{ 'hidden': selected !== {{ $index + 1 }} }" class="w-full h-fit grid grid-cols-2 p-3 gap-4">
                        <div class="col-span-1 space-y-2">
                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">PATIENT NAME:</label>
                                    <span id="patient_name" class="text-blue-800 border border-blue-800 placeholder-blue-800 px-2 py-1 w-full">
                                        @if(isset($nameLookup[$record->univnum]))
                                            {{ $nameLookup[$record->univnum]['firstname'] }} 
                                            {{ $nameLookup[$record->univnum]['midname'] ? substr($nameLookup[$record->univnum]['midname'], 0, 1) . '.' : '' }} 
                                            {{ $nameLookup[$record->univnum]['lastname'] }}
                                        @else
                                            Unknown
                                        @endif
                                    </span>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">YOUR CURRENT CONDITION/REQUEST:</label>
                                    @if($record->request_type === 'Other')
                                        <textarea cols="30" rows="5" class="text-blue-800 border-1 border-blue-800 placeholder-blue-800 px-2 py-1 w-full">{{ $record->reason }}</textarea>
                                    @endif

                                    @if($record->request_type === 'N/A')
                                        <textarea cols="30" rows="5" class="text-blue-800 border-1 border-blue-800 placeholder-blue-800 px-2 py-1 w-full">{{ $record->reason }}</textarea>
                                    @endif

                                    @if($record->reason === 'N/A')
                                        <textarea cols="30" rows="5" class="text-blue-800 border-1 border-blue-800 placeholder-blue-800 px-2 py-1 w-full">{{ $record->request_type }}</textarea>
                                    @endif
                            </div>

                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">DIAGNOSIS / ILLNESS:</label>
                                <textarea cols="30" rows="5" class="text-blue-800 border-1 border-blue-800 placeholder-blue-800 px-2 py-1 w-full" disabled>{{$docu->diagnosis ?? 'N/A'}}</textarea>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">TREATMENT PLAN:</label>
                                <textarea cols="30" rows="5" class="text-blue-800 border-1 border-blue-800 placeholder-blue-800 px-2 py-1 w-full" disabled>{{$docu->treatment_plan ?? 'N/A'}}</textarea>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">REMARKS:</label>
                                <textarea cols="30" rows="5" class="text-blue-800 border-1 border-blue-800 placeholder-blue-800 px-2 py-1 w-full" disabled>{{$docu->remarks ?? 'N/A'}}</textarea>
                            </div>
                        </div>

                        <div class="col-span-1">
                            <h1 class="font-semibold text-blue-800">LABORATORIES:</h1>

                            {{--<iframe src="https://docs.google.com/gview?url=http://ieee802.org/secmail/docIZSEwEqHFr.doc&embedded=true" class="w-full h-[540px]"></iframe>--}}

                                @php
                                    $recordId = $record->id;
                                    $docu = DB::table('labresults')
                                        ->where('appid', $recordId)
                                        ->orderBy('created_at', 'desc')
                                        ->first();
                                @endphp

                                @if($docu)
                                    @php
                                        // Construct the file path
                                        $filePath = storage_path('app/public/' . $docu->lab_results_file);
                                        // Construct the public URL for the iframe
                                        $publicPath = asset('storage/' . $docu->lab_results_file);
                                    @endphp

                                    @if(file_exists($filePath))
                                        <iframe src="{{ $publicPath }}" class="w-full h-[540px]"></iframe>
                                        {{--<a href="{{ asset('storage/laboratory_results/' . $docu->lab_results_file) }}" download>Download Lab Results</a>--}}
                                    @else
                                        <p>No document found.</p>
                                    @endif
                                @else
                                    <p>No document found.</p>
                                @endif
                                
                           

                            <div class="w-full flex justify-end mt-3 p-3" x-data="{ isHidden: true }">
                                <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm('{{ $index }}');">
                                    @csrf
                                    <button type="button" id="uploadButtonMedical{{ $index }}" class="z-20 py-2 px-12 bg-white text-blue-800 font-semibold border border-blue-800 rounded-lg text-sm hover:bg-blue-800 hover:text-white">
                                        <i class="fas fa-cloud-upload-alt"></i> Upload Result
                                    </button>

                                    <input type="hidden" name="app_id" id="app_id" value="{{ $record->id }}">
                                    <input type="hidden" name="univnum" id="univnum" value="{{ $record->univnum }}">

                                    @if($record->request_type === 'Other')
                                        <input type="hidden" name="curr" id="curr" value="{{ $record->reason }}">
                                    @endif

                                    @if($record->request_type === 'N/A')
                                        <input type="hidden" name="curr" id="curr" value="{{ $record->reason }}">
                                    @endif

                                    @if($record->reason === 'N/A')
                                        <input type="hidden" name="curr" id="curr" value="{{ $record->request_type }}">
                                    @endif

                                    @php
                                    $recordId = $record->id;
                                    $docu = DB::table('labresults')
                                        ->where('appid', $recordId)
                                        ->orderBy('created_at', 'desc')
                                        ->first();
                                    @endphp

                                    <input type="hidden" name="diagnosis" id="diagnosis" value="{{ $docu->diagnosis ?? 'N/A'}}">
                                    <input type="hidden" name="treatplan" id="treatplan" value="{{ $docu->treatment_plan ?? 'N/A'}}">
                                    <input type="hidden" name="remarks" id="remarks" value="{{ $docu->remarks ?? 'N/A'}}">


                                    <div id="uploadOverlayMedical{{ $index }}" class="hidden upload-overlay">
                                        <div class="overlay-content">
                                            <i class="fas fa-file-upload"></i>
                                            <p>Drag & Drop or Click to Upload</p>
                                            <input type="file" name="file" accept="application/pdf" id="fileInputMedical{{ $index }}">
                                        </div>
                                        <div id="fileNameDisplayMedical{{ $index }}" class="file-name-display"></div>

                                        <button type="submit" class="z-20 py-2 px-12 bg-white text-blue-800 font-semibold border border-blue-800 rounded-lg text-sm hover:bg-blue-800 hover:text-white">
                                            <i class="fas fa-cloud-upload-alt"></i> Submit Result
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    {{-- End For Medical --}}

    </div>
</div>
</body>

<script>
    function handleFileUpload(event) {
        // Function to handle file upload
        const files = event.dataTransfer ? event.dataTransfer.files : event.target.files;
        const file = files[0];
        const url = URL.createObjectURL(file);
        app.uploadedFile = url;
        if (!app.isHidden) {
            // Only create a new tab if the upload button is clicked
            window.open(url, '_blank');
        }
    }
</script>

{{--DENTAL SCRIPT--}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Retrieve the JSON data from the data attribute
        const recordsElement = document.getElementById('dental-records');
        const dentalRecords = JSON.parse(recordsElement.getAttribute('data-records'));

        dentalRecords.forEach((record, index) => {
            const uploadButtonDental = document.getElementById(`uploadButtonDental${index}`);
            const uploadOverlayDental = document.getElementById(`uploadOverlayDental${index}`);
            const fileInputDental = document.getElementById(`fileInputDental${index}`);
            const fileNameDisplayDental = document.getElementById(`fileNameDisplayDental${index}`);

            if (uploadButtonDental) {
                uploadButtonDental.addEventListener('click', () => {
                    if (uploadOverlayDental) {
                        uploadOverlayDental.classList.toggle('hidden');
                    }
                });
            }

            if (uploadOverlayDental) {
                uploadOverlayDental.addEventListener('dragover', (event) => {
                    event.preventDefault();
                    uploadOverlayDental.classList.remove('hidden');
                });

                uploadOverlayDental.addEventListener('dragleave', (event) => {
                    event.preventDefault();
                    uploadOverlayDental.classList.add('hidden');
                });

                uploadOverlayDental.addEventListener('drop', (event) => {
                    event.preventDefault();
                    handleFileUpload(event, index);
                });
            }

            if (fileInputDental) {
                fileInputDental.addEventListener('change', () => {
                    const fileName = fileInputDental.files[0]?.name;
                    if (fileNameDisplayDental) {
                        fileNameDisplayDental.textContent = fileName || '';
                    }
                });
            }
        });
    });

    function handleFileUpload(event, index) {
        const uploadOverlayDental = document.getElementById(`uploadOverlayDental${index}`);
        if (uploadOverlayDental) {
            uploadOverlayDental.classList.add('hidden');
        }
    }

    function validateFormDental(index) {
        const fileInputdental = document.getElementById(`fileInputDental${index}`);
        if (!fileInputdental.files.length) {
            alert('Please select a file before uploading.');
            return false;
        }
        return true;
    }
</script>


{{--MEDICAL SCRIPT--}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Retrieve the JSON data from the data attribute
        const recordsElement = document.getElementById('medical-records');
        const medicalRecords = JSON.parse(recordsElement.getAttribute('data-records'));

        medicalRecords.forEach((record, index) => {
            const uploadButtonMedical = document.getElementById(`uploadButtonMedical${index}`);
            const uploadOverlayMedical = document.getElementById(`uploadOverlayMedical${index}`);
            const fileInputMedical = document.getElementById(`fileInputMedical${index}`);
            const fileNameDisplayMedical = document.getElementById(`fileNameDisplayMedical${index}`);

            if (uploadButtonMedical) {
                uploadButtonMedical.addEventListener('click', () => {
                    if (uploadOverlayMedical) {
                        uploadOverlayMedical.classList.toggle('hidden');
                    }
                });
            }

            if (uploadOverlayMedical) {
                uploadOverlayMedical.addEventListener('dragover', (event) => {
                    event.preventDefault();
                    uploadOverlayMedical.classList.remove('hidden');
                });

                uploadOverlayMedical.addEventListener('dragleave', (event) => {
                    event.preventDefault();
                    uploadOverlayMedical.classList.add('hidden');
                });

                uploadOverlayMedical.addEventListener('drop', (event) => {
                    event.preventDefault();
                    handleFileUpload(event, index);
                });
            }

            if (fileInputMedical) {
                fileInputMedical.addEventListener('change', () => {
                    const fileName = fileInputMedical.files[0]?.name;
                    if (fileNameDisplayMedical) {
                        fileNameDisplayMedical.textContent = fileName || '';
                    }
                });
            }
        });
    });

    function handleFileUpload(event, index) {
        const uploadOverlayMedical = document.getElementById(`uploadOverlayMedical${index}`);
        if (uploadOverlayMedical) {
            uploadOverlayMedical.classList.add('hidden');
        }
    }

    function validateForm(index) {
        const fileInput = document.getElementById(`fileInputMedical${index}`);
        if (!fileInput.files.length) {
            alert('Please select a file before uploading.');
            return false;
        }
        return true;
    }
</script>