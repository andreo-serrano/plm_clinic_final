<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>

<body>
    <div class="p-10 w-full min-h-screen">
        <div class="w-full h-fit bg-white rounded-xl p-10">
            <h1 class="text-yellow-600 font-bold text-3xl">VIEW PROFILE</h1>
            
            @if (DB::table('nurseinfo')->where('nurseID', Auth::user()->univ_num)->exists())
            
            @php
                $nurseInfo = DB::table('nurseinfo')->where('nurseID', Auth::user()->univ_num)->first();
            @endphp

            <div class="w-full flex flex-col text-sm px-32 gap-3 mt-5">
                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">LAST NAME:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $nurseInfo->lastname }}" disabled>
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">FIRST NAME:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $nurseInfo->firstname }}" disabled>
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">MIDDLE NAME:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $nurseInfo->midname }}" disabled>
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">BIRTHDAY:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $nurseInfo->birthdate }}" disabled>
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">GENDER:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $nurseInfo->gender }}" disabled>
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">SPECIALIZATION:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $nurseInfo->spec }}" disabled>
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">OFFICIAL PLM EMAIL:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $nurseInfo->plmemail }}" disabled>
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">PERSONAL EMAIL:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $nurseInfo->peremail }}" disabled>
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">MOBILE NUMBER:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $nurseInfo->mobnum }}" disabled>
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">EMERGENCY NUMBER:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $nurseInfo->ermobnum }}" disabled>
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
                                            <input type="email" name="peremail" id="peremail" class="border border-blue-800 rounded-xl w-full py-1" value="{{ $nurseInfo->peremail }}">
                                        </div>

                                        <div class="w-full text-start">
                                            <label class="text-yellow-700">Mobile Number:</label>
                                            <input type="text" name="mobnum" id="mobnum" class="border border-blue-800 rounded-xl w-full py-1" value="{{ $nurseInfo->mobnum }}">
                                        </div>

                                        <div class="w-full text-start">
                                            <label class="text-yellow-700">Emergency Number:</label>
                                            <input type="text" name="gnum" id="gnum" class="border border-blue-800 rounded-xl w-full py-1" value="{{ $nurseInfo->ermobnum }}">
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
    hideEditForm();

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
      window.location.reload(); // Reload the page to show updated profile
    });
  }

  // Function to validate form inputs
  function validateForm() {
    const peremailInput = document.getElementById('peremail');
    const mobnumInput = document.getElementById('mobnum');
    const gnumInput = document.getElementById('gnum');

    const errorMessages = {
      peremail: 'Personal Email is required',
      mobnum: 'Mobile Number is required',
      gnum: 'Emergency Number is required',
      peremailInvalid: 'Please enter a valid email address for Personal Email',
    };

    let isValid = true;

    // Check if any fields are empty
    for (const input of [peremailInput, mobnumInput, gnumInput]) {
      if (!input.value.trim()) {
        showError(input, errorMessages[input.id]);
        isValid = false;
      } else {
        clearError(input);
      }
    }

    // Validate email format (only if peremail is not empty)
    if (peremailInput.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(peremailInput.value)) {
      showError(peremailInput, errorMessages.peremailInvalid);
      isValid = false;
    }

    return isValid;
  }

  // Functions for error handling
  function showError(input, message) {
    input.classList.add('error');
    Swal.fire({ icon: 'error', title: 'Oops...', text: message });
  }

  function clearError(input) {
    input.classList.remove('error');
  }

  // Attach event listeners for real-time validation
  document.getElementById('peremail').removeEventListener('input', validateForm);
  document.getElementById('mobnum').removeEventListener('input', validateForm);
  document.getElementById('gnum').removeEventListener('input', validateForm);

  // Attach event listener to the submit button
  document.getElementById('submitButton').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default form submission

    if (validateForm()) {
      // Submit the form using AJAX
      var form = document.getElementById('updateForm');
      var formData = new FormData(form);

      fetch(form.action, {
        method: form.method,
        body: formData
      })
      .then(response => {
        if (response.ok) {
          showSuccessMessage();
        } else {
          throw new Error('Form submission failed.');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        // You can display an error message here if needed
      });
    }
  });
</script>