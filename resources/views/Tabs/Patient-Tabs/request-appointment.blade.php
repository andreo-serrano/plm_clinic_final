<div class="p-10 w-full min-h-screen">
    <div class="bg-white rounded-xl p-10">

    {{--Changes are all good--}}
    
        <h1 class="text-3xl text-yellow-600 font-bold text-center">REQUEST NEW APPOINTMENT</h1>

        <div x-data="{ type: 'Medical' }">
            <h3 class="font-bold text-blue-800">TYPE OF CONSULTATION:</h3>     
                <div class="flex gap-3">  
                    <button x-on:click="type = 'Medical'" :class="{ 'bg-blue-800 text-white': type === 'Medical'}"  name="appreq_type" class="border border-blue-800 font-semibold rounded-lg text-blue-800 py-2 px-4 hover:bg-blue-800 hover:text-white">Medical</button>
                    <button x-on:click="type = 'Dental'" :class="{ 'bg-blue-800 text-white': type === 'Dental'}" name="appreq_type" class="border border-blue-800 font-semibold rounded-lg text-blue-800 py-2 px-4 hover:bg-blue-800 hover:text-white">Dental</button>
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
                                
                                <div class="flex flex-col">
                                    <label class="text-yellow-600 font-bold">Reason for consultation:</label>
                                    <textarea cols="30" rows="10" name="appreq_reason" class="border border-blue-800 rounded-lg p-2 ms-5"></textarea>
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
                        
                        <div>
                            <input type="submit" value="SUBMIT APPOINTMENT" class="font-semibold text-small bg-blue-800 text-white py-1 px-4 rounded-lg hover:bg-blue-900" onclick="return validateForm()"></input>
                        </div>
                    </form>
                    {{-- End Requestion of Appoinment Form --}}

                    {{-- Validation of Fields --}}
                    <script>
                        function validateForm() {
                            // Get values of required fields
                            var plmnum = document.forms["appreqForm"]["appreq_univnum"].value;
                            var reason = document.forms["appreqForm"]["appreq_reason"].value;
                            var date = document.forms["appreqForm"]["appreq_date"].value;
                            var time = document.forms["appreqForm"]["appreq_time"].value;

                            // Check if required fields are filled
                            if (plmnum == "" || reason == "" || date == "" || time == "") {
                                // Display error message
                                alert("Please fill out all required fields.");
                                return false; // Prevent form submission
                            }

                            // Display success message
                            alert("Announcement submitted successfully!");
                            return true; // Allow form submission
                        }
                    </script>
                    {{-- End of validation of Fields --}}

                </div>
        </div>
    </div>
</div>