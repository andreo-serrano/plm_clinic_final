{{-- V1 --}}
{{-- <div class="p-10 w-full min-h-screen">
    <div class="bg-white rounded-xl p-10">
        <h1 class="text-3xl text-yellow-600 font-bold mb-5">MEDICAL LAB RESULT</h1>

        <div x-data="{ selected: 1 }">
            <ul class="flex gap-1">
                <li x-on:click="selected = 1" :class="{ 'bg-white text-blue-800': selected === 1, 'bg-blue-800 text-white': selected !== 1}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">LAB RESULT #1</li>
                <li x-on:click="selected = 2" :class="{ 'bg-white text-blue-800': selected === 2, 'bg-blue-800 text-white': selected !== 2}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">LAB RESULT #2</li>
                <li x-on:click="selected = 3" :class="{ 'bg-white text-blue-800': selected === 3, 'bg-blue-800 text-white': selected !== 3}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">LAB RESULT #3</li>
            </ul>

            <div class="w-full border-2 border-blue-800 rounded-br-lg rounded-tr-lg rounded-bl-lg">
                <div :class="{ 'hidden': selected !== 1 }" class="w-full h-screen">
                    <iframe src="https://docs.google.com/gview?url=http://ieee802.org/secmail/docIZSEwEqHFr.doc&embedded=true" class="w-full h-full"></iframe>
                </div>

                <div :class="{ 'hidden': selected !== 2 }" class="w-full h-screen">
                    <iframe src="https://docs.google.com/gview?url=http://ieee802.org/secmail/docIZSEwEqHFr.doc&embedded=true" class="w-full h-full"></iframe>
                </div>

                <div :class="{ 'hidden': selected !== 3 }" class="w-full h-screen">
                    <iframe src="https://docs.google.com/gview?url=http://ieee802.org/secmail/docIZSEwEqHFr.doc&embedded=true" class="w-full h-full"></iframe>
                </div>
            </div>
        </div>

        <div class="w-full flex justify-end mt-3 relative" x-data="{ isHidden: true }">
            <button x-on:click="isHidden = !isHidden" class="z-20 py-2 px-12 bg-white text-blue-800 font-semibold border border-blue-800 rounded-lg text-sm hover:bg-blue-800 hover:text-white">UPLOAD RESULT</button>

            <div :class="{ 'hidden': isHidden, 'flex': ! isHidden }" class="absolute w-[12.7rem] h-60 bg-blue-800 -top-56 rounded-t-lg z-10 flex-col items-center justify-center gap-3">
                <img width="64" height="64" src="https://img.icons8.com/external-line-adri-ansyah/64/FFFFFF/external-essentials-essentials-ui-line-adri-ansyah-10.png" alt="external-essentials-essentials-ui-line-adri-ansyah-10"/>
                
                <div class="text-white text-center leading-none">
                    <p>Drag and drop here</p>
                    <p>Or</p>
                </div>
                

                <button class="bg-white text-blue-800 px-2 py-1 rounded-lg">Select File</button>
            </div>
        </div>
    </div>
</div> --}}

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
            <ul class="flex gap-1">
                <li x-on:click="selected = 1" :class="{ 'bg-white text-blue-800': selected === 1, 'bg-blue-800 text-white': selected !== 1}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">LAB RESULT #1</li>
                <li x-on:click="selected = 2" :class="{ 'bg-white text-blue-800': selected === 2, 'bg-blue-800 text-white': selected !== 2}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">LAB RESULT #2</li>
                <li x-on:click="selected = 3" :class="{ 'bg-white text-blue-800': selected === 3, 'bg-blue-800 text-white': selected !== 3}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">LAB RESULT #3</li>
            </ul>

            <div class="w-full border-2 border-blue-800 rounded-br-lg rounded-tr-lg rounded-bl-lg">
                <div :class="{ 'hidden': selected !== 1 }" class="w-full h-screen">
                    <iframe src="https://www.robustdental.com/wp-content/uploads/2023/10/Robust-Lab-Sheet.jpg" class="w-full h-full"></iframe>
                </div>

                <div :class="{ 'hidden': selected !== 2 }" class="w-full h-screen">
                    <iframe src="https://img.lazcdn.com/g/p/419ab103cd160ecfa27b75d864e87540.jpg_720x720q80.jpg" class="w-full h-full"></iframe>
                </div>

                <div :class="{ 'hidden': selected !== 3 }" class="w-full h-screen">
                    <iframe src="https://www.pdffiller.com/preview/389/396/389396109.png" class="w-full h-full"></iframe>
                </div>
            </div>
        </div>

        {{-- For Medical --}}
        <div x-data="{ selected: 1 }" :class="{ 'hidden': typeOfResult === 'Dental', 'block': typeOfResult !== 'Dental' }">
        <ul class="flex gap-1">
                <li x-on:click="selected = 1" :class="{ 'bg-white text-blue-800': selected === 1, 'bg-blue-800 text-white': selected !== 1}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">LAB RESULT #1</li>
                <li x-on:click="selected = 2" :class="{ 'bg-white text-blue-800': selected === 2, 'bg-blue-800 text-white': selected !== 2}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">LAB RESULT #2</li>
                <li x-on:click="selected = 3" :class="{ 'bg-white text-blue-800': selected === 3, 'bg-blue-800 text-white': selected !== 3}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">LAB RESULT #3</li>
            </ul>

            <div class="w-full border-2 border-blue-800 rounded-br-lg rounded-tr-lg rounded-bl-lg">
                <div :class="{ 'hidden': selected !== 1 }" class="w-full h-screen">
                    <iframe src="https://i.pinimg.com/564x/f4/21/07/f421076667bdbeca994190cc024c4503.jpg" class="w-full h-full"></iframe>
                </div>

                <div :class="{ 'hidden': selected !== 2 }" class="w-full h-screen">
                    <iframe src="https://i.pinimg.com/564x/93/ee/c3/93eec3659a0d9a4400d681a6a21c8c37.jpg" class="w-full h-full"></iframe>
                </div>

                <div :class="{ 'hidden': selected !== 3 }" class="w-full h-screen">
                    <iframe src="https://i.pinimg.com/564x/21/b4/c3/21b4c3d7ddad50bbc4b6588180c261b0.jpg" class="w-full h-full"></iframe>
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
                    <input type="file" class="hidden" x-ref="fileInput" x-on:change="handleFileUpload">
                </div>
                

                <button x-on:click="$refs.fileInput.click()" class="bg-white text-blue-800 px-2 py-1 rounded-lg">Select File</button>
            </div>
        </div>
    </div>
</div>

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