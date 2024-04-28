<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doctor Dashboard</title>
    @vite('resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
</head>

<body>
    <x-layout.navbar/>

    <div class="object-fill bg-no-repeat bg-cover bg-fixed" style="background-image: url('{{asset('assets/imgs/bg.png')}}');"> 
        <div class="container mx-auto flex">
            <x-layout.sidebar/>

            @if(request()->routeIS('doctor-home'))
                @include('Tabs.Doctor-Tabs.home')
            @elseif(request()->routeIS('doctor-profile'))
                @include('Tabs.Doctor-Tabs.profile')
            @elseif(request()->routeIS('doctor-appointment'))
                @include('Tabs.Doctor-Tabs.appointment')
            @elseif(request()->routeIS('doctor-patient-records'))
                {{-- @include('Tabs.Doctor-Tabs.patient-records') --}}
                <div class="p-10 w-full">
                    <div class="w-full bg-white rounded-xl p-10" x-data="{typeOfRecord: 'Medical'}">
                        <h1 class="text-yellow-600 font-bold text-3xl">VIEW PROFILE</h1>

                        <div class="flex flex-row justify-between gap-3 mt-3">
                            <div class="flex items-center relative w-full">
                                <input type="text" class="font-semibold w-full rounded-lg py-1 px-4 border-2 text-sm border-blue-800 text-blue-800 placeholder-blue-800" placeholder="Search the Patient Name">
                                <i class='bx bx-search absolute right-5'></i>
                            </div> 

                            <div class="flex flex-row items-center gap-2 w-90">
                                <h2 class="text-nowrap text-blue-800 font-semibold">TYPE OF RECORD:</h2>

                                <button x-on:click="typeOfRecord = 'Medical'" :class="{ 'bg-blue-800 text-white': typeOfRecord === 'Medical',  'bg-white text-blue-800': typeOfRecord !== 'Medical' }" class="px-5 py-1 border border-blue-800 rounded-lg hover:bg-blue-800 hover:text-white">Medical</button>
                                <button x-on:click="typeOfRecord = 'Dental'" :class="{ 'bg-blue-800 text-white': typeOfRecord === 'Dental',  'bg-white text-blue-800': typeOfRecord !== 'Dental' }" class="px-5 py-1 border border-blue-800 rounded-lg hover:bg-blue-800 hover:text-white">Dental</button>
                            </div>
                        </div>
                        
                        {{-- For Medical --}}
                        <div x-data="{ selected: 1 }" :class="{ 'hidden': typeOfRecord === 'Dental'}" class="mt-3 h-full">
                            <ul class="flex gap-1">
                                <li x-on:click="selected = 1" :class="{ 'bg-white text-blue-800': selected === 1, 'bg-blue-800 text-white': selected !== 1}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">RECORD #1</li>
                                <li x-on:click="selected = 2" :class="{ 'bg-white text-blue-800': selected === 2, 'bg-blue-800 text-white': selected !== 2}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">RECORD #2</li>
                                <li x-on:click="selected = 3" :class="{ 'bg-white text-blue-800': selected === 3, 'bg-blue-800 text-white': selected !== 3}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">RECORD #3</li>
                            </ul>
                
                            <div class="w-full h-auto border-2 border-blue-800 rounded-br-lg rounded-tr-lg rounded-bl-lg">
                                <div :class="{ 'hidden': selected !== 1 }" class="w-full h-fit grid grid-cols-2 p-3 gap-4">
                                    <div class="col-span-1 space-y-2">
                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">FULL NAME:</label>
                                            <input type="text" class="text-blue-800 border border-blue-800 placeholder-blue-800 px-2 py-1 w-full" placeholder="Last Name, First Name MI.">
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">CURRENT CONDITION:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">DIAGNOSIS / ILLNESS:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">TREATMENT PLAN:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-1">
                                        <h1 class="font-semibold text-blue-800">MEDICAL RECORD:</h1>

                                        <iframe src="https://docs.google.com/gview?url=http://ieee802.org/secmail/docIZSEwEqHFr.doc&embedded=true" class="w-full h-[540px]"></iframe>
                                    </div>
                                </div>
                
                                <div :class="{ 'hidden': selected !== 2 }" class="w-full h-fit grid grid-cols-2 p-3 gap-4">
                                    <div class="col-span-1 space-y-2">
                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">FULL NAME:</label>
                                            <input type="text" class="text-blue-800 border border-blue-800 placeholder-blue-800 px-2 py-1 w-full" placeholder="Last Name, First Name MI.">
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">CURRENT CONDITION:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">DIAGNOSIS / ILLNESS:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">TREATMENT PLAN:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-1">
                                        <h1 class="font-semibold text-blue-800">MEDICAL RECORD:</h1>

                                        <iframe src="https://docs.google.com/gview?url=http://ieee802.org/secmail/docIZSEwEqHFr.doc&embedded=true" class="w-full h-[540px]"></iframe>
                                    </div>
                                </div>

                                <div :class="{ 'hidden': selected !== 3 }" class="w-full h-fit grid grid-cols-2 p-3 gap-4">
                                    <div class="col-span-1 space-y-2">
                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">FULL NAME:</label>
                                            <input type="text" class="text-blue-800 border border-blue-800 placeholder-blue-800 px-2 py-1 w-full" placeholder="Last Name, First Name MI.">
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">CURRENT CONDITION:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">DIAGNOSIS / ILLNESS:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">TREATMENT PLAN:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-1">
                                        <h1 class="font-semibold text-blue-800">MEDICAL RECORD:</h1>

                                        <iframe src="https://docs.google.com/gview?url=http://ieee802.org/secmail/docIZSEwEqHFr.doc&embedded=true" class="w-full h-[540px]"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- For Dental --}}
                        <div x-data="{ selected: 1 }" :class="{ 'hidden': typeOfRecord === 'Medical'}" class="mt-3 h-full">
                            <ul class="flex gap-1">
                                <li x-on:click="selected = 1" :class="{ 'bg-white text-blue-800': selected === 1, 'bg-blue-800 text-white': selected !== 1}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">RECORD #1</li>
                                <li x-on:click="selected = 2" :class="{ 'bg-white text-blue-800': selected === 2, 'bg-blue-800 text-white': selected !== 2}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">RECORD #2</li>
                                <li x-on:click="selected = 3" :class="{ 'bg-white text-blue-800': selected === 3, 'bg-blue-800 text-white': selected !== 3}" class="cursor-pointer border-t-2 border-x-2 border-blue-800 rounded-tr-lg rounded-tl-lg px-2 py-2">RECORD #3</li>
                            </ul>
                
                            <div class="w-full h-auto border-2 border-blue-800 rounded-br-lg rounded-tr-lg rounded-bl-lg">
                                <div :class="{ 'hidden': selected !== 1 }" class="w-full h-fit grid grid-cols-2 p-3 gap-4">
                                    <div class="col-span-1 space-y-2">
                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">FULL NAME:</label>
                                            <input type="text" class="text-blue-800 border border-blue-800 placeholder-blue-800 px-2 py-1 w-full" placeholder="Last Name, First Name MI.">
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">CURRENT CONDITION:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">DIAGNOSIS / ILLNESS:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">TREATMENT PLAN:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-1">
                                        <h1 class="font-semibold text-blue-800">MEDICAL RECORD:</h1>

                                        <iframe src="https://docs.google.com/gview?url=http://ieee802.org/secmail/docIZSEwEqHFr.doc&embedded=true" class="w-full h-[540px]"></iframe>
                                    </div>
                                </div>
                
                                <div :class="{ 'hidden': selected !== 2 }" class="w-full h-fit grid grid-cols-2 p-3 gap-4">
                                    <div class="col-span-1 space-y-2">
                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">FULL NAME:</label>
                                            <input type="text" class="text-blue-800 border border-blue-800 placeholder-blue-800 px-2 py-1 w-full" placeholder="Last Name, First Name MI.">
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">CURRENT CONDITION:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">DIAGNOSIS / ILLNESS:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">TREATMENT PLAN:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-1">
                                        <h1 class="font-semibold text-blue-800">MEDICAL RECORD:</h1>

                                        <iframe src="https://docs.google.com/gview?url=http://ieee802.org/secmail/docIZSEwEqHFr.doc&embedded=true" class="w-full h-[540px]"></iframe>
                                    </div>
                                </div>

                                <div :class="{ 'hidden': selected !== 3 }" class="w-full h-fit grid grid-cols-2 p-3 gap-4">
                                    <div class="col-span-1 space-y-2">
                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">FULL NAME:</label>
                                            <input type="text" class="text-blue-800 border border-blue-800 placeholder-blue-800 px-2 py-1 w-full" placeholder="Last Name, First Name MI.">
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">CURRENT CONDITION:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">DIAGNOSIS / ILLNESS:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-blue-800 font-semibold">TREATMENT PLAN:</label>
                                            <textarea cols="30" rows="5" class="border-1 border-blue-800"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-1">
                                        <h1 class="font-semibold text-blue-800">MEDICAL RECORD:</h1>

                                        <iframe src="https://docs.google.com/gview?url=http://ieee802.org/secmail/docIZSEwEqHFr.doc&embedded=true" class="w-full h-[540px]"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(request()->routeIS('doctor-schedule'))
                @include('Tabs.Doctor-Tabs.schedule')
            @endif

        </div>
    </div>
</body>

</html>