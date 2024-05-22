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
                    <li x-on:click="selected = 1" :class="{ 'bg-white text-blue-800': selected === 1, 'bg-blue-800 text-white': selected !== 1}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">RECORD #1</li>
                   {{-- <li x-on:click="selected = 2" :class="{ 'bg-white text-blue-800': selected === 2, 'bg-blue-800 text-white': selected !== 2}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">RECORD #2</li>
                    <li x-on:click="selected = 3" :class="{ 'bg-white text-blue-800': selected === 3, 'bg-blue-800 text-white': selected !== 3}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">RECORD #3</li> --}}
                </ul>
    
                <div class="w-full h-auto border-2 border-blue-800 rounded-br-lg rounded-tr-lg rounded-bl-lg">
                    <div :class="{ 'hidden': selected !== 1 }" class="w-full h-fit grid grid-cols-2 p-3 gap-4">
                        <div class="col-span-1 space-y-2">
                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">PATIENT NAME:</label>
                                <input type="text" class="text-blue-800 border border-blue-800 placeholder-blue-800 px-2 py-1 w-full" placeholder="Last Name, First Name MI." disabled>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">YOUR CURRENT CONDITION:</label>
                                <textarea cols="30" rows="5" class="border-1 border-blue-800" disabled></textarea>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">DIAGNOSIS / ILLNESS:</label>
                                <textarea cols="30" rows="5" class="border-1 border-blue-800" disabled></textarea>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">TREATMENT PLAN:</label>
                                <textarea cols="30" rows="5" class="border-1 border-blue-800" disabled></textarea>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">REMARKS:</label>
                                <textarea cols="30" rows="5" class="border-1 border-blue-800" disabled></textarea>
                            </div>
                        </div>

                        <div class="col-span-1">
                            <h1 class="font-semibold text-blue-800">LABORATORIES:</h1>

                            <iframe src="https://docs.google.com/gview?url=http://ieee802.org/secmail/docIZSEwEqHFr.doc&embedded=true" class="w-full h-[540px]"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- For Medical --}}
        <div x-data="{ selected: 1 }" :class="{ 'hidden': typeOfResult === 'Dental', 'block': typeOfResult !== 'Dental' }">
            <div class="lab-container">
                <ul id="lab" class="flex gap-1">
                    <li x-on:click="selected = 1" :class="{ 'bg-white text-blue-800': selected === 1, 'bg-blue-800 text-white': selected !== 1}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">RECORD #1</li>
                </ul>
    
                <div class="w-full h-auto border-2 border-blue-800 rounded-br-lg rounded-tr-lg rounded-bl-lg">
                    <div :class="{ 'hidden': selected !== 1 }" class="w-full h-fit grid grid-cols-2 p-3 gap-4">
                        <div class="col-span-1 space-y-2">
                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">PATIENT NAME:</label>
                                <input type="text" class="text-blue-800 border border-blue-800 placeholder-blue-800 px-2 py-1 w-full" placeholder="Last Name, First Name MI." disabled>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">YOUR CURRENT CONDITION:</label>
                                <textarea cols="30" rows="5" class="border-1 border-blue-800" disabled></textarea>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">DIAGNOSIS / ILLNESS:</label>
                                <textarea cols="30" rows="5" class="border-1 border-blue-800" disabled></textarea>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">TREATMENT PLAN:</label>
                                <textarea cols="30" rows="5" class="border-1 border-blue-800" disabled></textarea>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-blue-800 font-semibold">REMARKS:</label>
                                <textarea cols="30" rows="5" class="border-1 border-blue-800" disabled></textarea>
                            </div>
                        </div>

                        <div class="col-span-1">
                            <h1 class="font-semibold text-blue-800">LABORATORIES:</h1>

                            <iframe src="https://docs.google.com/gview?url=http://ieee802.org/secmail/docIZSEwEqHFr.doc&embedded=true" class="w-full h-[540px]"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full flex justify-end mt-3 relative" x-data="{ isHidden: true }">
            <button x-on:click="isHidden = !isHidden" class="z-20 py-2 px-12 bg-white text-blue-800 font-semibold border border-blue-800 rounded-lg text-sm hover:bg-blue-800 hover:text-white">UPLOAD RESULT</button>

            <div :class="{ 'hidden': isHidden, 'flex': ! isHidden }" class="absolute w-[12.7rem] h-60 bg-blue-800 -top-56 rounded-t-lg z-10 flex-col items-center justify-center gap-3" x-on:dragover.prevent="isHidden = false" x-on:dragleave.prevent="isHidden = true" x-on:drop.prevent="handleFileUpload">
                <img width="64" height="64" src="https://img.icons8.com/external-line-adri-ansyah/64/FFFFFF/external-essentials-essentials-ui-line-adri-ansyah-10.png" alt="external-essentials-essentials-ui-line-adri-ansyah-10"/>
                
                <div class="text-white text-center leading-none">
                    <p>Drag and drop here</p>
                    <p>Or</p>
                    <input id="lab" type="file" class="hidden" x-ref="fileInput" x-on:change="handleFileUpload" multiple>
                </div>
                

                <button x-on:click="$refs.fileInput.click()" class="bg-white text-blue-800 px-2 py-1 rounded-lg">Select File</button>
            </div>
        </div>
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