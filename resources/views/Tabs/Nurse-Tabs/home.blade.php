<div class="p-10 w-full min-h-screen">
    <div class="w-full h-fit bg-white rounded-xl p-10">
        <h1 class="text-yellow-600 font-bold text-3xl">Welcome, {{ explode(' ', explode(',', Auth::user()->name)[1])[1] }}!</h1>
        
        <div class="grid grid-cols-2 grid-rows-4 w-full h-full gap-3 mt-3">
            <div class="col-span-1 row-span-2 border-2 border-blue-700 rounded-lg p-3">
                <div class="flex mb-2 flex-row items-center">
                    <img width="34" height="34" src="https://img.icons8.com/sf-black-filled/64/1d4ed8/document.png" class="object-fit" alt="document"/>
                    <h1 class="text-xl font-semibold text-blue-800">MEDICAL RECORDS</h1>
                </div>
                
                <div class="col-span-2 flex items-center relative">
                    <input data-dropdown-toggle="dropdown-search" type="text" class="font-semibold w-full rounded-lg py-1 px-4 border-2 text-sm border-blue-800 text-blue-800 placeholder-blue-800" placeholder="Search the Patient Name">
                    <i class='bx bx-search absolute right-5'></i>
                </div>

                <div id="dropdown-search" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-96 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li class="flex flex-row items-center justify-between gap-5 px-5 py-2 hover:bg-gray-200">
                            <div class="flex flex-row items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-red-200 flex items-center justify-center border border-red-500">SM</div>
                                <h3 class="font-semibold">Stacy Mitchell</h3>
                            </div>
                            
                            <small class="text-red-500">Student</small>
                        </li>

                      <li class="flex flex-row items-center justify-between gap-5 px-5 py-2 hover:bg-gray-200">
                        <div class="flex flex-row items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-blue-200 flex items-center justify-center border border-blue-500">SM</div>
                            <h3 class="font-semibold">Stacy Mitchell</h3>
                        </div>

                        <small class="text-blue-500">Employee</small>
                      </li>
                    </ul>
                </div>
            </div>

            <div class="col-span-1 row-span-4 border-2 border-blue-700 rounded-lg p-3">
                <div class="space-y-2">
                    <h1 class="text-blue-800 font-bold text-xl">ANNOUNCEMENT FORM</h1>

                    {{-- Code for storing to database --}}
                    <form id="announcementForm" method="POST" action="{{ route('announcements.store') }}">
                    @csrf

                        <div>
                            <label class="text-blue-800 font-semibold">Announcement Title:</label>
                            <input type="text" name="announcement_title" class="font-semibold w-full py-1 px-4 border-1 text-sm border-blue-800 text-blue-800 placeholder-blue-800" placeholder="">
                        </div>

                        <div>
                            <label class="text-blue-800 font-semibold">Announcement Date:</label>
                            <input type="date" name="announcement_date" class="font-semibold w-full py-1 px-4 border-1 text-sm border-blue-800 text-blue-800 placeholder-blue-800" placeholder="">
                        </div>

                        <div class="flex flex-col">
                            <label class="text-blue-800 font-semibold">Announcement Details:</label>
                            <textarea cols="30" rows="10" name="announcement_details" class="border-1 border-blue-800"></textarea>
                        </div>

                        <div class="flex flex-col">
                            <label class="text-blue-800 font-semibold">Provider (Optional):</label>
                            <textarea cols="30" rows="7" name="announcement_provider" class="border-1 border-blue-800"></textarea>
                        </div>

                        <div>
                            <label class="text-blue-800 font-semibold">Expiration Date:</label>
                            <input type="date" name="expiration_date" class="font-semibold w-full py-1 px-4 border-1 text-sm border-blue-800 text-blue-800 placeholder-blue-800" placeholder="">
                        </div>

                        <div>
                            <label class="text-blue-800 font-semibold">Expiration Time:</label>
                            <input type="time" name="expiration_time" class="font-semibold w-full py-1 px-4 border-1 text-sm border-blue-800 text-blue-800 placeholder-blue-800" placeholder="">
                        </div>

                        <div class="flex justify-center my-3">
                            <input type="submit" value="Submit Announcement" class="bg-blue-800 text-white font-semibold px-10 py-1 rounded-lg shadow" onclick="return validateForm()">
                        </div>

                    </form>
                    {{-- End of code for storing to database --}}

                    {{-- Validation of Fields --}}
                    <script>
                        function validateForm() {
                            // Get values of required fields
                            var title = document.forms["announcementForm"]["announcement_title"].value;
                            var date = document.forms["announcementForm"]["announcement_date"].value;
                            var details = document.forms["announcementForm"]["announcement_details"].value;
                            var exdate = document.forms["announcementForm"]["expiration_date"].value;
                            var extime = document.forms["announcementForm"]["expiration_time"].value;

                            // Check if required fields are filled
                            if (title == "" || date == "" || details == "" || exdate == "" || extime == "") {
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
                
                {{-- Insert dito yung doc --}}
                {{-- <div class="h-full w-full">
                    <iframe src="https://docs.google.com/gview?url=http://ieee802.org/secmail/docIZSEwEqHFr.doc&embedded=true" class="w-full h-full"></iframe>
                </div> --}}
            </div>

            <div class="col-span-1 row-span-2 border-2 border-blue-700 rounded-lg p-3">
                <div class="flex mb-2 flex-row items-center justify-between">
                    <div class="flex flex-row">
                        <img width="34" height="34" src="https://img.icons8.com/sf-black-filled/64/1d4ed8/document.png" class="object-fit" alt="document"/>
                        <h1 class="text-xl font-semibold text-blue-800">TO DO LIST</h1>
                    </div>
                    
                    <button data-dropdown-toggle="dropdown" class="flex flex-row gap-2 items-center">
                        <span>Today</span>
                        <img width="16" height="16" src="https://img.icons8.com/ios-glyphs/16/000000/expand-arrow--v1.png" alt="expand-arrow--v1"/>
                    </button>

                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                          <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                          </li>
                          <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                          </li>
                          <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Weekly</a>
                          </li>
                          <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Monthly</a>
                          </li>
                        </ul>
                    </div>
                </div>

                <div class="overflow-auto space-y-2 h-72">

                {{-- For Pending Requests Count --}}
                @php
                $pendingreqs = DB::table('appointmentreqs')
                    ->where('remarks', 'pending') 
                    ->orderBy('created_at', 'desc')
                    ->get();

                $pendingreqsCount = $pendingreqs->count();
                @endphp

                {{-- For Approved Requests Count--}}
                @php
                $approvedreqs = DB::table('appointmentreqs')
                    ->where('remarks', 'Approved') 
                    ->orderBy('created_at', 'desc')
                    ->get();

                $appprovedreqsCount = $approvedreqs->count();
                @endphp

                    <div class="w-full p-2 text-white flex flex-row items-center bg-blue-800 rounded-lg shadow-md">
                        <img width="34" height="34" src="https://img.icons8.com/sf-black-filled/64/FFFFFF/document.png" class="object-fit" alt="document"/>

                        <span>Number of requests that needs approval: {{ $pendingreqsCount }}</span>
                    </div>

                    <div class="w-full p-2 text-yellow-700 border-2 border-yellow-700 flex flex-row items-center rounded-lg shadow-md">
                        <img width="34" height="34" src="https://img.icons8.com/sf-black-filled/64/a16207/document.png" class="object-fit" alt="document"/>

                        <span>Number of approved patients to cater: {{  $appprovedreqsCount }}</span>
                    </div>

                    @php
                    $scheduleNotes = DB::table('schedulenotes')
                                    ->where('univnum', Auth::user()->univ_num)
                                    ->orderBy('created_at', 'desc')
                                    ->get();
                    @endphp

                    @foreach ($scheduleNotes as $index => $note) 
                        @php
                            $todoDate = \Carbon\Carbon::parse($note->todo_date);
                            $startTime = \Carbon\Carbon::parse($note->todo_startTime);
                            $endTime = \Carbon\Carbon::parse($note->todo_endTime); 
                        @endphp

                        @if ($todoDate->isToday() || $todoDate->isFuture())  
                            <div class="w-full p-2 flex flex-row items-center rounded-lg shadow-md 
                                        {{ $index % 2 == 0 ? 'bg-blue-800 text-white' : 'border-2 border-yellow-700 text-yellow-700' }}"
                                data-start-time="{{ $startTime->format('H:i') }}" data-end-time="{{ $endTime->format('H:i') }}"> 
                                <img width="34" height="34" 
                                    src="{{ $index % 2 == 0 ? 'https://img.icons8.com/sf-black-filled/64/FFFFFF/document.png' : 'https://img.icons8.com/sf-black-filled/64/a16207/document.png' }}" 
                                    class="object-fit" alt="document"/>
                                <span>{{ $note->todo_title }} on {{ $todoDate->format('l, F j, Y') }} 
                                    from {{ $startTime->format('h:i A') }} to {{ $endTime->format('h:i A') }}</span> 
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>