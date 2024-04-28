<div class="p-10 w-full min-h-screen" x-data="{ type: 'Medical' }">
    <div class="w-full h-fit bg-white rounded-xl p-10">
        <h1 class="text-3xl text-yellow-600 font-bold">VIEW APPOINTMENT</h1>

        <div class="mt-5 px-4 mb-5">
            <div>
                <button x-on:click="type = 'Medical'" :class="{ 'bg-blue-800 text-white': type === 'Medical', 'bg-white text-blue-8': type !== 'Medical'}" class="bg-white text-2xl font-semibold text-blue-800 border border-blue-800 px-10 py-1 rounded-lg hover:bg-blue-800 hover:text-white">MEDICAL APPOINTMENT</button>
                <button x-on:click="type = 'Dental'" :class="{ 'bg-blue-800 text-white': type === 'Dental', 'bg-white text-blue-8': type !== 'Dental'}" class="bg-white text-2xl font-semibold text-blue-800 border border-blue-800 px-10 py-1 rounded-lg hover:bg-blue-800 hover:text-white">DENTAL REQUEST</button>
            </div>
            <div class="w-full border-t-4 border-blue-900 mt-2"></div>
        </div>

        {{-- For UP --}}
        <div class="px-4" :class="{ '': type === 'Medical', 'hidden': type !== 'Medical' }">
            <table class="table-auto w-full h-full">
                <thead>
                    <tr class="divide-x">
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Appoinment <br> ID</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Patient Type</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Appoinment <br> Date</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Main Complaint</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Time Block</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Remarks</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Approval</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="text-center text-blue-800">
                        <td class="border-2 border-yellow-700">123456</td>
                        <td class="border-2 border-yellow-700">Student</td>
                        <td class="border-2 border-yellow-700">02/23/2024</td>
                        <td class="border-2 border-yellow-700">Complaint</td>
                        <td class="border-2 border-yellow-700">1:00 PM</td>
                        <td class="border-2 border-yellow-700">
                            <div class="flex items-center relative text-center">
                                <input type="text" placeholder="Add Remarks" class="border-none placeholder-blue-800 w-full text-blue-800 focus:border-none border-transparent px-5">
                                <i class='bx bx-pencil absolute right-3 text-blue-800'></i>
                            </div>
                        </td>

                        <td class="border-2 border-yellow-700 flex flex-row gap-2 justify-center items-center h-full">
                            <button class="px-3 border-2 border-yellow-700 font-semibold text-yellow-700 rounded-lg hover:bg-yellow-700 hover:text-white">Accept</button>
                            <button class="px-3 border-2 border-yellow-700 font-semibold text-yellow-700 rounded-lg hover:bg-yellow-700 hover:text-white">Cancel</button>
                        </td>

                        <td>
                            <button class="text-lg text-blue-800 p-2 hover:border hover:border-gray-200 rounded-lg">
                                <i class='bx bx-trash'></i>
                            </button>
                        </td>
                    </tr>

                    <tr class="text-center text-blue-800">
                        <td class="border-2 border-yellow-700">123456</td>
                        <td class="border-2 border-yellow-700">Student</td>
                        <td class="border-2 border-yellow-700">02/23/2024</td>
                        <td class="border-2 border-yellow-700">Complaint</td>
                        <td class="border-2 border-yellow-700">1:00 PM</td>
                        <td class="border-2 border-yellow-700">
                            <div class="flex items-center relative text-center">
                                <input type="text" placeholder="Add Remarks" class="border-none placeholder-blue-800 w-full text-blue-800 focus:border-none border-transparent px-5">
                                <i class='bx bx-pencil absolute right-3 text-blue-800'></i>
                            </div>
                        </td>

                        <td class="border-2 border-yellow-700 flex flex-row gap-2 justify-center items-center h-full">
                            <button class="px-3 border-2 border-yellow-700 font-semibold text-yellow-700 rounded-lg hover:bg-yellow-700 hover:text-white">Accept</button>
                            <button class="px-3 border-2 border-yellow-700 font-semibold text-yellow-700 rounded-lg hover:bg-yellow-700 hover:text-white">Cancel</button>
                        </td>

                        <td>
                            <button class="text-lg text-blue-800 p-2 hover:border hover:border-gray-200 rounded-lg">
                                <i class='bx bx-trash'></i>
                            </button>
                        </td>
                    </tr>

                    <tr class="text-center text-blue-800">
                        <td class="border-2 border-yellow-700">123456</td>
                        <td class="border-2 border-yellow-700">Student</td>
                        <td class="border-2 border-yellow-700">02/23/2024</td>
                        <td class="border-2 border-yellow-700">Complaint</td>
                        <td class="border-2 border-yellow-700">1:00 PM</td>
                        <td class="border-2 border-yellow-700">
                            <div class="flex items-center relative text-center">
                                <input type="text" placeholder="Add Remarks" class="border-none placeholder-blue-800 w-full text-blue-800 focus:border-none border-transparent px-5">
                                <i class='bx bx-pencil absolute right-3 text-blue-800'></i>
                            </div>
                        </td>

                        <td class="border-2 border-yellow-700 flex flex-row gap-2 justify-center items-center h-full">
                            <button class="px-3 border-2 border-yellow-700 font-semibold text-yellow-700 rounded-lg hover:bg-yellow-700 hover:text-white">Accept</button>
                            <button class="px-3 border-2 border-yellow-700 font-semibold text-yellow-700 rounded-lg hover:bg-yellow-700 hover:text-white">Cancel</button>
                        </td>

                        <td>
                            <button class="text-lg text-blue-800 p-2 hover:border hover:border-gray-200 rounded-lg">
                                <i class='bx bx-trash'></i>
                            </button>
                        </td>
                    </tr>

                    <tr class="text-center text-blue-800">
                        <td class="border-2 border-yellow-700">123456</td>
                        <td class="border-2 border-yellow-700">Student</td>
                        <td class="border-2 border-yellow-700">02/23/2024</td>
                        <td class="border-2 border-yellow-700">Complaint</td>
                        <td class="border-2 border-yellow-700">1:00 PM</td>
                        <td class="border-2 border-yellow-700">
                            <div class="flex items-center relative text-center">
                                <input type="text" placeholder="Add Remarks" class="border-none placeholder-blue-800 w-full text-blue-800 focus:border-none border-transparent px-5">
                                <i class='bx bx-pencil absolute right-3 text-blue-800'></i>
                            </div>
                        </td>

                        <td class="border-2 border-yellow-700 flex flex-row gap-2 justify-center items-center h-full">
                            <button class="px-3 border-2 border-yellow-700 font-semibold text-yellow-700 rounded-lg hover:bg-yellow-700 hover:text-white">Accept</button>
                            <button class="px-3 border-2 border-yellow-700 font-semibold text-yellow-700 rounded-lg hover:bg-yellow-700 hover:text-white">Cancel</button>
                        </td>

                        <td>
                            <button class="text-lg text-blue-800 p-2 hover:border hover:border-gray-200 rounded-lg">
                                <i class='bx bx-trash'></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="w-full text-center py-28 text-blue-950 font-bold">
                {{-- If empty --}}
                <h4 class="text-4xl">NO MEDICAL <br> APPOINTMENT</h4>
            </div>
        </div>

        {{-- For Dental --}}
        <div class="px-4" :class="{ '': type === 'Dental', 'hidden': type !== 'Dental' }">
            <table class="table-auto w-full h-full">
                <thead>
                    <tr class="divide-x">
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Appoinment <br> ID</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Patient Type</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Appoinment <br> Date</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Main Complaint</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Time Block</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Remarks</th>
                        <th class="text-white bg-blue-900 text-sm font-semibold leading-none py-1">Approval</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="text-center text-blue-800">
                        <td class="border-2 border-yellow-700">123456</td>
                        <td class="border-2 border-yellow-700">Student</td>
                        <td class="border-2 border-yellow-700">02/23/2024</td>
                        <td class="border-2 border-yellow-700">Complaint</td>
                        <td class="border-2 border-yellow-700">1:00 PM</td>
                        <td class="border-2 border-yellow-700">
                            <div class="flex items-center relative text-center">
                                <input type="text" placeholder="Add Remarks" class="border-none placeholder-blue-800 w-full text-blue-800 focus:border-none border-transparent px-5">
                                <i class='bx bx-pencil absolute right-3 text-blue-800'></i>
                            </div>
                        </td>

                        <td class="border-2 border-yellow-700 flex flex-row gap-2 justify-center items-center h-full">
                            <button class="px-3 border-2 border-yellow-700 font-semibold text-yellow-700 rounded-lg hover:bg-yellow-700 hover:text-white">Accept</button>
                            <button class="px-3 border-2 border-yellow-700 font-semibold text-yellow-700 rounded-lg hover:bg-yellow-700 hover:text-white">Cancel</button>
                        </td>

                        <td>
                            <button class="text-lg text-blue-800 p-2 hover:border hover:border-gray-200 rounded-lg">
                                <i class='bx bx-trash'></i>
                            </button>
                        </td>
                    </tr>

                    <tr class="text-center text-blue-800">
                        <td class="border-2 border-yellow-700">123456</td>
                        <td class="border-2 border-yellow-700">Student</td>
                        <td class="border-2 border-yellow-700">02/23/2024</td>
                        <td class="border-2 border-yellow-700">Complaint</td>
                        <td class="border-2 border-yellow-700">1:00 PM</td>
                        <td class="border-2 border-yellow-700">
                            <div class="flex items-center relative text-center">
                                <input type="text" placeholder="Add Remarks" class="border-none placeholder-blue-800 w-full text-blue-800 focus:border-none border-transparent px-5">
                                <i class='bx bx-pencil absolute right-3 text-blue-800'></i>
                            </div>
                        </td>

                        <td class="border-2 border-yellow-700 flex flex-row gap-2 justify-center items-center h-full">
                            <button class="px-3 border-2 border-yellow-700 font-semibold text-yellow-700 rounded-lg hover:bg-yellow-700 hover:text-white">Accept</button>
                            <button class="px-3 border-2 border-yellow-700 font-semibold text-yellow-700 rounded-lg hover:bg-yellow-700 hover:text-white">Cancel</button>
                        </td>

                        <td>
                            <button class="text-lg text-blue-800 p-2 hover:border hover:border-gray-200 rounded-lg">
                                <i class='bx bx-trash'></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="w-full text-center py-28 text-blue-950 font-bold">
                {{-- If empty --}}
                <h4 class="text-4xl">NO DENTAL <br> APPOINTMENT</h4>
            </div>
        </div>
    </div>
</div>