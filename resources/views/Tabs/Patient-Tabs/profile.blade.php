<head>
    <!-- Other meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="p-10 w-full min-h-screen">
        <div class="w-full h-fit bg-white rounded-xl p-10">
            <h1 class="text-yellow-600 font-bold text-3xl">VIEW PROFILE (UHS FORM 13)</h1>
            
            @if (DB::table('studentinfo')->where('studentID', Auth::user()->univ_num)->exists())
            
            @php
                $studentInfo = DB::table('studentinfo')->where('studentID', Auth::user()->univ_num)->first();
            @endphp
        
            <div class="w-full flex flex-col text-sm px-32 gap-3 mt-5" id="profileFields">
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
            
                <div class="field-group flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">PERSONAL EMAIL:</h2>
                    <input type="text" name="peremail" id="peremail" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->peremail }}" disabled>
                </div>

                <div class="field-group flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">MOBILE NUMBER:</h2>
                    <input type="text" name="mobnum" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->mobnum }}" disabled>
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">GUARDIAN:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->guardian }}" disabled>
                </div>

                <div class="field-group flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">GUARDIAN MOBILE NUMBER:</h2>
                    <input type="text" name="gnum" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $studentInfo->guardmobnum }}" disabled>
                </div>

                <script>
                    // Function to add edit buttons dynamically and enable Enter keypress event
                    function addEditButtons() {
                        document.querySelectorAll('.field-group').forEach(field => {
                            const inputField = field.querySelector('input');
                            const editBtn = document.createElement('button');
                            editBtn.innerText = 'Edit';
                            editBtn.classList.add('edit-btn', 'hidden');
                            editBtn.addEventListener('click', () => {
                                inputField.disabled = false;
                                inputField.focus();
                            });
                            field.appendChild(editBtn);

                            // Show edit button on hover
                            field.addEventListener('mouseenter', () => {
                                editBtn.classList.remove('hidden');
                            });
                            field.addEventListener('mouseleave', () => {
                                editBtn.classList.add('hidden');
                            });

                            // Listen for Enter key press on input fields
                            inputField.addEventListener('keypress', event => {
                                if (event.key === 'Enter') {
                                    event.preventDefault();
                                    updateDatabase(inputField);
                                }
                            });
                        });
                    }
                    
                    // Function to update database
                    function updateDatabase(inputField) {
                        const formData = new FormData();
                        formData.append(inputField.name, inputField.value);

                        // Fetch CSRF token from the meta tag
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


                        fetch('/update-profile', {
                            method: 'POST',
                            head: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: formData
                        }).then(response => {
                            if (response.ok) {
                                alert('Profile updated successfully!');
                            } else {
                                alert('Failed to update profile. Please try again later.');
                            }
                        }).catch(error => {
                            console.error('Error updating profile:', error);
                            alert('An error occurred while updating profile. Please try again later.');
                        });
                    }

                    // Call the function to add edit buttons when the page loads
                    document.addEventListener('DOMContentLoaded', addEditButtons);
                </script>

            </div>
            
            {{--
            <div class="w-full flex justify-end mt-3 relative gap-3" x-data="{ isHidden: true }">
                <button class="z-20 py-2 px-5 bg-white text-blue-800 font-semibold border border-blue-800 rounded-lg text-sm hover:bg-blue-800 hover:text-white">UPDATE PROFILE</button>
            </div>--}}
            @endif
        
        </div>

    </div>
</body>
