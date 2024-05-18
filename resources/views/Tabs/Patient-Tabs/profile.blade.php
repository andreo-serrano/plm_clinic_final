<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>

<body>
<div class="p-10 w-full min-h-screen">
    <div class="w-full h-fit bg-white rounded-xl p-10">
        <h1 class="text-yellow-600 font-bold text-3xl">VIEW PROFILE (UHS FORM 13)</h1>  
            @if (DB::table('studentinfo')->where('studentID', Auth::user()->univ_num)->exists())
                @php
                    $studentInfo = DB::table('studentinfo')->where('studentID', Auth::user()->univ_num)->first();
                @endphp
            
                <div class="w-full flex flex-col text-sm px-32 gap-3 mt-5">
                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">LAST NAME:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->lastname }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">FIRST NAME:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->firstname }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">MIDDLE NAME:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->midname }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">BIRTHDAY:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->birthdate }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">GENDER:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->gender }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">COLLEGE:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->college }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">DEGREE PROGRAM:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->program }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">YEAR LEVEL:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->yearlev }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">OFFICIAL PLM EMAIL:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->plmemail }}" disabled>
                    </div>
                
                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">PERSONAL EMAIL:</h2>
                        <input type="text" name="peremail" id="peremail" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->peremail }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">MOBILE NUMBER:</h2>
                        <input type="text" name="mobnum" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->mobnum }}"disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">GUARDIAN:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->guardian }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">GUARDIAN MOBILE NUMBER:</h2>
                        <input type="text" name="gnum" id="gnum" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->guardmobnum }}" disabled>
                    </div>

                    <div class="text-center mt-5">
                        <button onclick="showEditForm()" class="font-bold bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4  rounded-lg" style="width: 150px; height: 40px;">
                            EDIT
                        </button>
                    </div>
                </div>

                <form id="updateForm" action="{{ route('update.profile') }}" method="POST">
                @csrf
                <!-- Edit Profile Form Popup -->
                <div id="editForm" class="hidden fixed inset-0 z-50 overflow-y-auto flex items-center justify-center">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Form content -->
                        <div class="relative bg-white rounded-lg shadow border-2 border-yellow-700">
                            <!-- Form body -->
                            <div class="p-3 space-y-4 text-center">
                                <h2 class="text-yellow-700 font-semibold text-xl">EDIT PROFILE</h2>

                                <div class="flex flex-col gap-3">
                                    <div class="w-full text-start">
                                        <label class="text-yellow-700">Personal Email:</label>
                                        <input type="email" name="peremail" id="peremail" class="border border-blue-800 rounded-xl w-full py-1"  value="{{ $studentInfo->peremail }}">
                                    </div>

                                    <div class="w-full text-start">
                                        <label class="text-yellow-700">Mobile Number:</label>
                                        <input type="text" name="mobnum" id="mobnum" class="border border-blue-800 rounded-xl w-full py-1"  value="{{ $studentInfo->mobnum }}">
                                    </div>

                                    <div class="w-full text-start">
                                        <label class="text-yellow-700">Guardian Mobile Number:</label>
                                        <input type="text" name="gnum" id="gnum" class="border border-blue-800 rounded-xl w-full py-1"  value="{{ $studentInfo->guardmobnum }}">
                                    </div>
                                </div>
                                
                            </div>
                            <!-- Form footer -->
                            <div class="flex items-center justify-center p-3 gap-3">
                                <button onclick="hideEditForm()" class="text-base px-5 py-1 bg-yellow-700 text-white rounded-lg hover:bg-yellow-900">
                                    Cancel
                                </button>
                                <button id="submitButton" type="button" class="text-base px-5 py-1 bg-yellow-700 text-white rounded-lg hover:bg-yellow-900">
                                    Update
                                </button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>
            @endif

            {{-- Reserved for another condition if the patient is Employee --}}
            @if (DB::table('employeeinfo')->where('employeeID', Auth::user()->univ_num)->exists()) 
                @php
                    $employeeInfo = DB::table('employeeinfo')->where('employeeID', Auth::user()->univ_num)->first();
                @endphp

                <div class="w-full flex flex-col text-sm px-32 gap-3 mt-5">
                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">LAST NAME:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $employeeInfo->lastname }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">FIRST NAME:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $employeeInfo->firstname }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">MIDDLE NAME:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $employeeInfo->midname }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">BIRTHDAY:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $employeeInfo->birthdate }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">GENDER:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $employeeInfo->gender }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">JOB POSITION:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $employeeInfo->job_position }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">OFFICIAL PLM EMAIL:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $employeeInfo->plmemail }}" disabled>
                    </div>
                
                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">PERSONAL EMAIL:</h2>
                        <input type="text" name="peremail" id="peremail" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $employeeInfo->peremail }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">MOBILE NUMBER:</h2>
                        <input type="text" name="mobnum" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $employeeInfo->mobnum }}"disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">EMERGENCY NUMBER:</h2>
                        <input type="text" name="gnum" id="gnum" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $employeeInfo->emergencymobnum }}" disabled>
                    </div>

                    <div class="text-center mt-5">
                        <button onclick="showEditForm()" class="font-bold bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4  rounded-lg" style="width: 150px; height: 40px;">
                            EDIT
                        </button>
                    </div>
                </div>

                <form id="updateForm" action="{{ route('update.profile') }}" method="POST">
                @csrf
                <!-- Edit Profile Form Popup -->
                <div id="editForm" class="hidden fixed inset-0 z-50 overflow-y-auto flex items-center justify-center">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Form content -->
                        <div class="relative bg-white rounded-lg shadow border-2 border-yellow-700">
                            <!-- Form body -->
                            <div class="p-3 space-y-4 text-center">
                                <h2 class="text-yellow-700 font-semibold text-xl">EDIT PROFILE</h2>

                                <div class="flex flex-col gap-3">
                                    <div class="w-full text-start">
                                        <label class="text-yellow-700">Personal Email:</label>
                                        <input type="email" name="peremail" id="peremail" class="border border-blue-800 rounded-xl w-full py-1"  value="{{ $employeeInfo->peremail }}">
                                    </div>

                                    <div class="w-full text-start">
                                        <label class="text-yellow-700">Mobile Number:</label>
                                        <input type="text" name="mobnum" id="mobnum" class="border border-blue-800 rounded-xl w-full py-1"  value="{{ $employeeInfo->mobnum }}">
                                    </div>

                                    <div class="w-full text-start">
                                        <label class="text-yellow-700">Emergency Number:</label>
                                        <input type="text" name="gnum" id="gnum" class="border border-blue-800 rounded-xl w-full py-1"  value="{{ $employeeInfo->emergencymobnum }}">
                                    </div>
                                </div>
                                
                            </div>
                            <!-- Form footer -->
                            <div class="flex items-center justify-center p-3 gap-3">
                                <button onclick="hideEditForm()" class="text-base px-5 py-1 bg-yellow-700 text-white rounded-lg hover:bg-yellow-900">
                                    Cancel
                                </button>
                                <button id="submitButton" type="button" class="text-base px-5 py-1 bg-yellow-700 text-white rounded-lg hover:bg-yellow-900">
                                    Update
                                </button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>
                
            @endif
           


            {{-- Reserved for another condition if the patient is Faculty--}}
            @if (DB::table('facultyinfo')->where('facultyID', Auth::user()->univ_num)->exists()) 
                @php
                    $facultyInfo = DB::table('facultyinfo')->where('facultyID', Auth::user()->univ_num)->first();
                @endphp

                <div class="w-full flex flex-col text-sm px-32 gap-3 mt-5">
                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">LAST NAME:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $facultyInfo->lastname }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">FIRST NAME:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $facultyInfo->firstname }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">MIDDLE NAME:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $facultyInfo->midname }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">BIRTHDAY:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $facultyInfo->birthdate }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">GENDER:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $facultyInfo->gender }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">JOB POSITION:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $facultyInfo->job_position }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">TYPE OF EMPLOYMENT:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $facultyInfo->employment_type }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">OFFICIAL PLM EMAIL:</h2>
                        <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $facultyInfo->plmemail }}" disabled>
                    </div>
                
                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">PERSONAL EMAIL:</h2>
                        <input type="text" name="peremail" id="peremail" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $facultyInfo->peremail }}" disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">MOBILE NUMBER:</h2>
                        <input type="text" name="mobnum" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $facultyInfo->mobnum }}"disabled>
                    </div>

                    <div class="flex flex-row gap-3">
                        <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">EMERGENCY NUMBER:</h2>
                        <input type="text" name="gnum" id="gnum" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $facultyInfo->emergencymobnum }}" disabled>
                    </div>

                    <div class="text-center mt-5">
                        <button onclick="showEditForm()" class="font-bold bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4  rounded-lg" style="width: 150px; height: 40px;">
                            EDIT
                        </button>
                    </div>
                </div>

                <form id="updateForm" action="{{ route('update.profile') }}" method="POST">
                @csrf
                <!-- Edit Profile Form Popup -->
                <div id="editForm" class="hidden fixed inset-0 z-50 overflow-y-auto flex items-center justify-center">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Form content -->
                        <div class="relative bg-white rounded-lg shadow border-2 border-yellow-700">
                            <!-- Form body -->
                            <div class="p-3 space-y-4 text-center">
                                <h2 class="text-yellow-700 font-semibold text-xl">EDIT PROFILE</h2>

                                <div class="flex flex-col gap-3">
                                    <div class="w-full text-start">
                                        <label class="text-yellow-700">Personal Email:</label>
                                        <input type="email" name="peremail" id="peremail" class="border border-blue-800 rounded-xl w-full py-1"  value="{{ $facultyInfo->peremail }}">
                                    </div>

                                    <div class="w-full text-start">
                                        <label class="text-yellow-700">Mobile Number:</label>
                                        <input type="text" name="mobnum" id="mobnum" class="border border-blue-800 rounded-xl w-full py-1"  value="{{ $facultyInfo->mobnum }}">
                                    </div>

                                    <div class="w-full text-start">
                                        <label class="text-yellow-700">Emergency Number:</label>
                                        <input type="text" name="gnum" id="gnum" class="border border-blue-800 rounded-xl w-full py-1"  value="{{ $facultyInfo->emergencymobnum }}">
                                    </div>
                                </div>
                                
                            </div>
                            <!-- Form footer -->
                            <div class="flex items-center justify-center p-3 gap-3">
                                <button onclick="hideEditForm()" class="text-base px-5 py-1 bg-yellow-700 text-white rounded-lg hover:bg-yellow-900">
                                    Cancel
                                </button>
                                <button id="submitButton"  type="button" class="text-base px-5 py-1 bg-yellow-700 text-white rounded-lg hover:bg-yellow-900">
                                    Update
                                </button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>
            @endif

    </div>
</div>
</body>


<script>
    // Function to show the edit form
    function showEditForm() {
        document.getElementById('editForm').classList.remove('hidden');
    }

    // Function to hide the edit form
    function hideEditForm() {
        document.getElementById('editForm').classList.add('hidden');
    }

    // Function to display the success message
    function showSuccessMessage() {
        // Hide the edit form
        hideEditForm();

        // Display success message using SweetAlert2
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Profile updated successfully.',
            showClass: {
                popup: 'animate__animated animate__bounceIn'
            },
            hideClass: {
                popup: 'animate__animated animate__bounceOut'
            }
        }).then(() => {
        // Reload the page
        window.location.reload();
    });
    }

    // Function to validate form inputs
    function validateForm() {
        // Get form inputs
        var peremailInput = document.getElementById('peremail');
        var mobnumInput = document.getElementById('mobnum');
        var gnumInput = document.getElementById('gnum');

        // Check if any of the required fields are empty
        if (!peremailInput.value || !mobnumInput.value || !gnumInput.value) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in all required fields.',
            });
            return false;
        }

        // Check if any of the fields contain null data
        if (peremailInput.value.trim() === "" || mobnumInput.value.trim() === "" || gnumInput.value.trim() === "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please make sure all fields are filled in.',
            });
            return false;
        }

        // Validate email format for personal email
        var peremailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!peremailPattern.test(peremailInput.value)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Email',
                text: 'Please enter a valid email address for Personal Email.',
            });
            return false;
        }

        // If all validations pass, return true
        return true;
    }

    // Attach event listener to the submit button
    document.getElementById('submitButton').addEventListener('click', function() {
        // Submit the form using AJAX
        var form = document.getElementById('updateForm');
        var formData = new FormData(form);

        // Send form data using fetch API
        fetch(form.action, {
            method: form.method,
            body: formData
        })
        .then(response => {
            if (response.ok) {
                // If form submission is successful, show success message
                showSuccessMessage();
            } else {
                // If form submission fails, handle the error
                throw new Error('Form submission failed.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // You can display an error message here if needed
        });
    });
</script>