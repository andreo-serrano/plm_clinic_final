<div class="p-10 w-full min-h-screen">
    <div class="w-full h-fit bg-white rounded-xl p-10">
        <h1 class="text-yellow-600 font-bold text-3xl">VIEW TASK</h1>
        
        <div class="w-full h-full grid grid-cols-1 grid-rows-2 gap-3 mt-3">
            <div class="col-span-1 row-span-2 border-2 border-blue-800 rounded-lg p-4">
                <div class="flex mb-2 flex-row items-center justify-between">
                    <div class="flex flex-row">
                        <img width="34" height="34" src="https://img.icons8.com/sf-black-filled/64/1d4ed8/document.png" class="object-fit" alt="document"/>
                        <h1 class="text-xl font-semibold text-blue-800">TO DO LIST</h1>
                    </div>
                    
                    <button data-dropdown-toggle="dropdown" class="flex flex-row gap-2 items-center">
                        <span>Today</span>
                        <img width="16" height="16" src="https://img.icons8.com/ios-glyphs/16/000000/expand-arrow--v1.png" alt="expand-arrow--v1"/>
                    </button>

                {{--<div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
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
                    </div>--}} 
                </div>

                <div class="overflow-auto space-y-2 h-[550px]">

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

                    {{--To do list container--}}
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

            {{--<div class="col-span-1 row-span-1 border-2 border-blue-800 rounded-lg p-4">
                <ul class="list-disc px-5">
                    <li class="text-blue-800 text-xl font-semibold">CALENDAR</li>
                </ul>

                <p class="mb-2">Equitable medical education with efforts toward real change</p>

                <img src="{{asset('assets/imgs/rectangle.png')}}" alt="">
            </div>

            <div class="col-span-1 row-span-1 border-2 border-blue-800 rounded-lg p-4">
                <ul class="list-disc px-5">
                    <li class="text-blue-800 text-xl font-semibold">DAILY READ</li>
                </ul>

                <p class="mb-2">Equitable medical education with efforts toward real change</p>

                <img src="{{asset('assets/imgs/rectangle.png')}}" alt="">
            </div>--}}
        </div>
    </div>
</div>
