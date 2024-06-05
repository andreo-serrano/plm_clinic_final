<div class="p-10 w-full">
    <div class="w-full bg-white rounded-xl p-10" >
        <h1 class="text-yellow-600 font-bold text-3xl">VIEW PATIENT RECORDS</h1>

        @if(DB::table('doctorinfo')->where('doctorID', Auth::user()->univ_num)->exists())

            @php
                    $doctorinfo = DB::table('doctorinfo')->where('doctorID', Auth::user()->univ_num)->first();
            @endphp

                @if($doctorinfo->spec === 'Medical Doctor')
                    <div class="flex flex-row justify-between gap-3 mt-3">
                        {{--search backend--}}
                        <div class="flex items-center relative w-full">
                            <input type="text" id="univsearch" name="univsearch" class="font-semibold w-full rounded-lg py-1 px-4 border-2 text-sm border-blue-800 text-blue-800 placeholder-blue-800" placeholder="Search the Patient University Number">
                            <button type="button" id="searchButton" class="absolute right-5 flex items-center justify-center h-full">
                                <i class='bx bx-search'></i>
                            </button>
                        </div>
                        
                        <div id="search-results"></div> 
                        {{--search backend--}}

                        <div class="flex flex-row items-center gap-2 w-90">
                            <h2 class="text-nowrap text-blue-800 font-semibold">TYPE OF RECORD:</h2>

                            <button x-on:click="typeOfRecord = 'Medical'" :class="{ 'bg-blue-800 text-white': typeOfRecord === 'Medical',  'bg-white text-blue-800': typeOfRecord !== 'Medical' }" class="px-5 py-1 border border-blue-800 rounded-lg hover:bg-blue-800 hover:text-white" disabled>Medical</button>
                            {{--<button x-on:click="typeOfRecord = 'Dental'" :class="{ 'bg-blue-800 text-white': typeOfRecord === 'Dental',  'bg-white text-blue-800': typeOfRecord !== 'Dental' }" class="px-5 py-1 border border-blue-800 rounded-lg hover:bg-blue-800 hover:text-white">Dental</button>--}}
                        </div>
                    </div>
            
                    {{-- For Medical --}}
                    <div class="col-span-1 space-y-2">
                        <div id="search-result-container">
                            <!-- "NO CURRENT SEARCHES" message will be displayed here if no results -->
                            <div class="flex flex-col items-center justify-center h-screen"> 
                                <h4 id="no-search-message" class="text-4xl text-blue-950 font-bold">NO CURRENT RECORD</h4>
                            </div>
                            <!-- Search results will be injected here -->
                        </div>
                    </div>
                           
                    
                @else

                {{--DENTAL--}}
                <div class="flex flex-row justify-between gap-3 mt-3">
                        {{--search backend--}}
                        <div class="flex items-center relative w-full">
                            <input type="text" id="univsearch" name="univsearch" class="font-semibold w-full rounded-lg py-1 px-4 border-2 text-sm border-blue-800 text-blue-800 placeholder-blue-800" placeholder="Search the Patient University Number">
                            <button type="button" id="searchButton" class="absolute right-5 flex items-center justify-center h-full">
                                <i class='bx bx-search'></i>
                            </button>
                        </div>
                        {{--search backend--}}

                        <div class="flex flex-row items-center gap-2 w-90">
                            <h2 class="text-nowrap text-blue-800 font-semibold">TYPE OF RECORD:</h2>
                            <button x-on:click="typeOfRecord = 'Medical'" :class="{ 'bg-blue-800 text-white': typeOfRecord === 'Medical',  'bg-white text-blue-800': typeOfRecord !== 'Medical' }" class="px-5 py-1 border border-blue-800 rounded-lg hover:bg-blue-800 hover:text-white" disabled>Dental</button>
                        </div>
                    </div>
            
                    {{-- For Dental --}}
                    <div class="col-span-1 space-y-2">
                        <div id="search-result-container">
                            <!-- "NO CURRENT SEARCHES" message will be displayed here if no results -->
                            <div class="flex flex-col items-center justify-center h-screen"> 
                                <h4 id="no-search-message" class="text-4xl text-blue-950 font-bold">NO CURRENT RECORD</h4>
                            </div>
                            <!-- Search results will be injected here -->
                        </div>
                    </div>

                @endif
            </div>     
        @endif
    </div>
</div>

<script>
    function searchPatientRecords() {
        var univsearch = document.getElementById('univsearch').value;

        fetch("{{ route('search.patient.records') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ univsearch: univsearch })
        })
        .then(response => response.json())
        .then(data => {
            var resultContainer = document.getElementById('search-result-container');
            const records = data.records;
            const nameLookup = data.nameLookup;
            window.updateRecordRoute = "{{ route('update.record') }}";
            var noSearchMessage = document.getElementById('no-search-message');

            if (records && records.length > 0) {
                let tabs = '';
                let recordDetails = '';
                // Keep track of processed appids
                let processedAppIds = new Set();

                records.forEach((record, index) => {
                    const publicPath = record.publicPath;
                    const patient = nameLookup[record.univnum] || {};
                    const name = `${patient.firstname || ''} ${patient.midname || ''} ${patient.lastname || ''}`.trim() || 'Unknown';

                    // Check if appid has been processed
                    if (processedAppIds.has(record.appid)) {
                        return; // Skip this record
                    }

                    // Add appid to processed set
                    processedAppIds.add(record.appid);

                    // Rest of the tabs and recordDetails code remains the same...
                    tabs += `
                        <li x-on:click="selected = ${index + 1}" :class="{ 'bg-white text-blue-800': selected === ${index + 1}, 'bg-blue-800 text-white': selected !== ${index + 1}}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">${record.appid}</li>
                    `;

                    recordDetails += `
                    <form id="updateForm${index + 1}" action="{{ route('update.record') }}" method="POST" enctype="multipart/form-data"">
                    @csrf
                        <div :class="{ 'hidden': selected !== ${index + 1} }" class="w-full h-fit grid grid-cols-2 p-3 gap-4">
                            <div class="col-span-1 space-y-2">
                                <div class="flex flex-col">
                                    <label class="text-blue-800 font-semibold">PATIENT NAME:</label>
                                    <span class="text-blue-800 border border-blue-800 placeholder-blue-800 px-2 py-1 w-full">${name}</span>
                                </div>
                                <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">YOUR CURRENT CONDITION/REQUEST:</label>
                                <textarea name="curr" cols="30" rows="5" id="curr${index + 1}" class="text-blue-800 border border-blue-800 placeholder-blue-800 px-2 py-1 w-full" disabled>${record.current_condition || ''}</textarea>
                                </div>
                                <div class="flex flex-col">
                                    <label class="text-blue-800 font-semibold">DIAGNOSIS / ILLNESS:</label>
                                    <textarea name="diag" cols="30" rows="5" id="diag${index + 1}" class="text-blue-800 border border-blue-800 placeholder-blue-800 px-2 py-1 w-full">${record.diagnosis || ''}</textarea>
                                </div>
                                <div class="flex flex-col">
                                    <label class="text-blue-800 font-semibold">TREATMENT PLAN:</label>
                                    <textarea name="treat" cols="30" rows="5" id="treat${index + 1}" class="text-blue-800 border border-blue-800 placeholder-blue-800 px-2 py-1 w-full">${record.treatment_plan || ''}</textarea>
                                </div>
                                <div class="flex flex-col">
                                    <label class="text-blue-800 font-semibold">REMARKS:</label>
                                    <textarea name="rem" cols="30" rows="5" id="rem${index + 1}" class="text-blue-800 border border-blue-800 placeholder-blue-800 px-2 py-1 w-full">${record.remarks || ''}</textarea>
                                </div>
                            </div>

                            <div class="col-span-1">
                                <h1 class="font-semibold text-blue-800">LABORATORIES:</h1>
                                <iframe src="${publicPath}" class="w-full h-[540px]"></iframe>
                            </div>

                           <div class="w-full flex justify-center mt-3 p-3" x-data="{ isHidden: true }"> 
                                <input type="hidden" name="appid" id="appid${index + 1}" value="${record.appid}">

                                <button type="submit" id="submit${index + 1}" class="py-2 px-12 bg-white text-blue-800 font-semibold border border-blue-800 rounded-lg text-sm hover:bg-blue-800 hover:text-white">
                                    <i class="fas fa-cloud-upload-alt"></i> Submit Record
                                </button>
                            </div>
                        </div>
                    </form>
                    `;
                    
                }); // End of forEach

                resultContainer.innerHTML = `
                <div x-data="{ selected: 1 }" class="mt-3 h-full">
                    <div class="lab-container">
                        <ul id="lab" class="flex gap-1">
                            ${tabs}
                        </ul>
                        <div class="w-full h-auto border-2 border-blue-800 rounded-br-lg rounded-tr-lg rounded-bl-lg">
                            ${recordDetails}
                        </div>
                    </div>
                </div>
                `;
                noSearchMessage.style.display = 'none';
            } else {
                //resultContainer.innerHTML = '<p class="text-red-600">No records found.</p>';
                //noSearchMessage.style.display = 'none';
                noSearchMessage.style.display = 'block';
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // ... rest of your event listeners ...
    document.getElementById('searchButton').addEventListener('click', function() {
        searchPatientRecords();
    });

    document.getElementById('univsearch').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            searchPatientRecords();
        }
    });

</script>

