<div class="p-10 w-full min-h-screen">
    <div class="w-full h-fit bg-white rounded-xl p-10">
        <h1 class="text-yellow-600 font-bold text-3xl">REPORTS</h1>
        
        <div class="grid grid-cols-2 gap-3 mt-3">
            <div class="col-span-1 border-2 border-blue-800 p-3 rounded-lg">
                <div class="flex flex-row justify-between items-center">
                    <h2 class="text-blue-800 font-semibold">WEEKLY MONITORING OF PATIENTS</h2>
                </div>

                @php
                    $startOfWeek = now()->startOfWeek();
                    $endOfWeek = now()->endOfWeek();

                    $dailyCounts = DB::table('appmedicalreqs')
                        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                        ->whereIn('status', ['Approved', 'Resolved'])
                        ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                        ->groupBy(DB::raw('DATE(created_at)')) 
                        ->unionAll(
                            DB::table('appdentalreqs')
                                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                                ->whereIn('status', ['Approved', 'Resolved'])
                                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                                ->groupBy(DB::raw('DATE(created_at)')) 
                        )
                        ->get();

                    $weeklyCounts = [];
                    foreach ($dailyCounts as $count) {
                        $date = $count->date;
                        $weeklyCounts[$date] = ($weeklyCounts[$date] ?? 0) + $count->count;
                    }

                    for ($day = 0; $day < 7; $day++) {
                        $date = $startOfWeek->copy()->addDays($day)->format('Y-m-d');
                        if (!isset($weeklyCounts[$date])) {
                            $weeklyCounts[$date] = 0;
                        }
                    }

                    $sortedWeeklyCounts = array_replace(array_flip(array_map(function($day) use ($startOfWeek) {
                        return $startOfWeek->copy()->addDays($day)->format('Y-m-d');
                    }, range(0, 6))), $weeklyCounts);
                @endphp

                <div id="chart-data" data-patient-counts="{{ json_encode($sortedWeeklyCounts) }}"></div>
                <canvas id="bar-patients"></canvas>
            </div>

            <div class="col-span-1 border-2 border-blue-800 p-3 rounded-lg">
                <div class="flex flex-row justify-between items-center">
                    <h2 class="text-blue-800 font-semibold">PATIENTS FOR THE MONTH</h2>

                    @php
                    $currentMonth = now()->format('F');
                    $currentYear = now()->year;
                    @endphp

                    <small class="text-blue-800">{{$currentMonth}} {{ $currentYear}}</small>
                </div>

                <div class="grid grid-cols-2">
                    <div class="col-span-1">
                        <table class="table-auto w-full h-full mt-2">
                            <thead>
                                <tr class="text-sm text-blue-800 font-semibold">
                                    <td>CATEGORY:</td>
                                    <td class="text-center">NUMBER OF <br> PATIENTS:</td>
                                </tr>
                            </thead>

                            @php
                                $currentMonthNum = now()->month;
                                $studentCounts = DB::table('appmedicalreqs')->whereIn('status', ['Approved', 'Resolved'])->where('type', 'Student')->whereMonth('created_at', $currentMonthNum)->count() + DB::table('appdentalreqs')->whereIn('status', ['Approved', 'Resolved'])->where('type', 'Student')->whereMonth('created_at', $currentMonthNum)->count();
                                $employeeCounts = DB::table('appmedicalreqs')->whereIn('status', ['Approved', 'Resolved'])->where('type', 'Employee')->whereMonth('created_at', $currentMonthNum)->count() + DB::table('appdentalreqs')->whereIn('status', ['Approved', 'Resolved'])->where('type', 'Employee')->whereMonth('created_at', $currentMonthNum)->count();
                                $fullTimeFacultyCounts = DB::table('appmedicalreqs')->whereIn('status', ['Approved', 'Resolved'])->where('type', 'Full Time Faculty')->whereMonth('created_at', $currentMonthNum)->count() + DB::table('appdentalreqs')->whereIn('status', ['Approved', 'Resolved'])->where('type', 'Full Time Faculty')->whereMonth('created_at', $currentMonthNum)->count();
                                $partTimeFacultyCounts = DB::table('appmedicalreqs')->whereIn('status', ['Approved', 'Resolved'])->where('type', 'Part Time Faculty')->whereMonth('created_at', $currentMonthNum)->count() + DB::table('appdentalreqs')->whereIn('status', ['Approved', 'Resolved'])->where('type', 'Part Time Faculty')->whereMonth('created_at', $currentMonthNum)->count();
                            @endphp

                            <tbody>
                                <tr class="text-xs">
                                    <td class="text-red-600">
                                        <span class="inline-block h-3 w-3 rounded-full bg-red-600"></span> Student
                                    </td>

                                    <td class="text-center">{{ $studentCounts }}</td>
                                </tr>

                                <tr class="text-xs">
                                    <td class="text-green-600">
                                        <span class="inline-block h-3 w-3 rounded-full bg-blue-600"></span> Employee
                                    </td>

                                    <td class="text-center">{{ $employeeCounts }}</td>
                                </tr>

                                <tr class="text-xs">
                                    <td class="text-emerald-500">
                                        <span class="inline-block h-3 w-3 rounded-full bg-green-500"></span> Full Time Faculty
                                    </td>

                                    <td class="text-center">{{ $fullTimeFacultyCounts }}</td>
                                </tr>

                                <tr class="text-xs">
                                    <td class="text-blue-500">
                                        <span class="inline-block h-3 w-3 rounded-full bg-purple-500"></span> Part Time Faculty
                                    </td>

                                    <td class="text-center">{{ $partTimeFacultyCounts }}</td>
                                </tr>

                                @php
                                    $totalPatients = $studentCounts + $employeeCounts + $fullTimeFacultyCounts + $partTimeFacultyCounts;
                                @endphp

                                <tr class="text-xs">
                                    <td class="text-end">TOTAL:</td>
                                    <td class="text-center">{{ $totalPatients }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-span-1">
                        <canvas id="pie-patients"></canvas>
                    </div>
                </div>
                
            </div>

            <div id="linechart" class="col-span-2 border-2 border-blue-800 p-3 rounded-lg">
                <div class="flex flex-row justify-between items-center">
                    <h2 class="text-blue-800 font-semibold">PATIENTS FOR THE WHOLE YEAR</h2>

                    {{--           DATES VALIDATION FOR YEAR            --}}
                    @php  
                        $targetMonthNum = 1;        
                        $currentYear = now()->year; // Get the current year

                        $studentCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $employeeCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $fullTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $partTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();
    
                        $totalpatients1 = $studentCount + $employeeCount + $fullTimeFacultyCount + $partTimeFacultyCount;
                    @endphp

                    @php  
                        $targetMonthNum = 2;        
                        $currentYear = now()->year; // Get the current year

                        $studentCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $employeeCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $fullTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $partTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();
    
                        $totalpatients2 = $studentCount + $employeeCount + $fullTimeFacultyCount + $partTimeFacultyCount;
                    @endphp

                    @php  
                        $targetMonthNum = 3;        
                        $currentYear = now()->year; // Get the current year

                        $studentCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $employeeCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $fullTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $partTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();
    
                        $totalpatients3 = $studentCount + $employeeCount + $fullTimeFacultyCount + $partTimeFacultyCount;
                    @endphp


                    @php  
                        $targetMonthNum = 4;        
                        $currentYear = now()->year; // Get the current year

                        $studentCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $employeeCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $fullTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $partTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();
    
                        $totalpatients4 = $studentCount + $employeeCount + $fullTimeFacultyCount + $partTimeFacultyCount;
                    @endphp

                    @php  
                        $targetMonthNum = 5;        
                        $currentYear = now()->year; // Get the current year

                        $studentCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $employeeCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $fullTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $partTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();
    
                        $totalpatients5 = $studentCount + $employeeCount + $fullTimeFacultyCount + $partTimeFacultyCount;
                    @endphp

                    @php  
                        $targetMonthNum = 6;        
                        $currentYear = now()->year; // Get the current year

                        $studentCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $employeeCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $fullTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $partTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();
    
                        $totalpatients6 = $studentCount + $employeeCount + $fullTimeFacultyCount + $partTimeFacultyCount;
                    @endphp

                    @php  
                        $targetMonthNum = 7;        
                        $currentYear = now()->year; // Get the current year

                        $studentCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $employeeCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $fullTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $partTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();
    
                        $totalpatients7 = $studentCount + $employeeCount + $fullTimeFacultyCount + $partTimeFacultyCount;
                    @endphp

                    @php  
                        $targetMonthNum = 7;        
                        $currentYear = now()->year; // Get the current year

                        $studentCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $employeeCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $fullTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $partTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();
    
                        $totalpatients7 = $studentCount + $employeeCount + $fullTimeFacultyCount + $partTimeFacultyCount;
                    @endphp

                    @php  
                        $targetMonthNum = 8;        
                        $currentYear = now()->year; // Get the current year

                        $studentCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $employeeCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $fullTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $partTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();
    
                        $totalpatients8 = $studentCount + $employeeCount + $fullTimeFacultyCount + $partTimeFacultyCount;
                    @endphp

                    @php  
                        $targetMonthNum = 9;        
                        $currentYear = now()->year; // Get the current year

                        $studentCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $employeeCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $fullTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $partTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();
    
                        $totalpatients9 = $studentCount + $employeeCount + $fullTimeFacultyCount + $partTimeFacultyCount;
                    @endphp     

                    @php  
                        $targetMonthNum = 10;        
                        $currentYear = now()->year; // Get the current year

                        $studentCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $employeeCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $fullTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $partTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();
    
                        $totalpatients10 = $studentCount + $employeeCount + $fullTimeFacultyCount + $partTimeFacultyCount;
                    @endphp

                    @php  
                        $targetMonthNum = 11;        
                        $currentYear = now()->year; // Get the current year

                        $studentCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $employeeCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $fullTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $partTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();
    
                        $totalpatients11 = $studentCount + $employeeCount + $fullTimeFacultyCount + $partTimeFacultyCount;
                    @endphp

                    @php  
                        $targetMonthNum = 12;        
                        $currentYear = now()->year; // Get the current year

                        $studentCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Student')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $employeeCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Employee')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $fullTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();

                        $partTimeFacultyCount = DB::table('appmedicalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count() + 
                            DB::table('appdentalreqs')
                            ->whereIn('status', ['Approved', 'Resolved'])
                            ->where('type', 'Faculty')
                            ->whereMonth('created_at', $targetMonthNum)
                            ->whereYear('created_at', $currentYear)  // Filter by the current year
                            ->count();
    
                        $totalpatients12 = $studentCount + $employeeCount + $fullTimeFacultyCount + $partTimeFacultyCount;
                    @endphp

                    <div class="flex flex-row items-center gap-1 text-blue-800">
                        <button data-dropdown-toggle="dropdown" class="flex flex-row gap-1 items-center text-sm text-blue-800">
                            <span>As of {{ $currentYear }}</span>
                        </button>
                    </div>
                    
                </div>
                <div class="col-span-1"></div>
                <canvas id="line-patients"></canvas>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Bar Chart
    const chartDataElement = document.getElementById('chart-data');
    const weeklyCounts = JSON.parse(chartDataElement.dataset.patientCounts);

    // Sort dates (keys) in ascending order
    const sortedDates = Object.keys(weeklyCounts).sort();

    // Create data arrays for sorted labels and counts
    const labels = [];
    const data = [];
    for (const date of sortedDates) {
        labels.push(date);
        data.push(weeklyCounts[date]);
    }

    new Chart(document.getElementById('bar-patients'), {
        type: 'bar',
        data: {
            labels: labels,  // Use sorted labels
            datasets: [{
                label: '# Patients',
                data: data,   // Use corresponding sorted data
                borderWidth: 1,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
            }]
        },
        options: {
            scales: {
                x: {  // Customize x-axis to ensure date order
                    type: 'category',
                    labels: labels,  
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Pass PHP variables to JavaScript variables
    var studentCounts = "{{ $studentCounts }}";
    var employeeCounts = "{{ $employeeCounts }}";
    var fullTimeFacultyCounts = "{{ $fullTimeFacultyCounts }}";
    var partTimeFacultyCounts = "{{ $partTimeFacultyCounts }}";

    // Convert string variables to integers
    studentCounts = parseInt(studentCounts);
    employeeCounts = parseInt(employeeCounts);
    fullTimeFacultyCounts = parseInt(fullTimeFacultyCounts);
    partTimeFacultyCounts = parseInt(partTimeFacultyCounts);

    // Pie Chart
    new Chart(document.getElementById('pie-patients'), {
        type: 'pie',
        data: {
            labels: [
                'Student',
                'Employee',
                'Full Time Faculty',
                'Part Time Faculty'
            ],
            datasets: [{
                label: 'Patient Number of Records',
                data: [
                    studentCounts,
                    employeeCounts,
                    fullTimeFacultyCounts,
                    partTimeFacultyCounts
                ],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)'
                ],
                hoverOffset: 4
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                }
            }
        }
    });

    
    //Line Chart
    var monthlyCounting1 = "{{ $totalpatients1 }}";
    var monthlyCounting2 = "{{ $totalpatients2 }}";
    var monthlyCounting3 = "{{ $totalpatients3 }}";
    var monthlyCounting4 = "{{ $totalpatients4 }}";
    var monthlyCounting5 = "{{ $totalpatients5 }}";
    var monthlyCounting6 = "{{ $totalpatients6 }}";
    var monthlyCounting7 = "{{ $totalpatients7 }}";
    var monthlyCounting8 = "{{ $totalpatients8 }}";
    var monthlyCounting9 = "{{ $totalpatients9 }}";
    var monthlyCounting10 = "{{ $totalpatients10 }}";
    var monthlyCounting11 = "{{ $totalpatients11 }}";
    var monthlyCounting12 = "{{ $totalpatients12 }}";

    monthlyCounting1 = parseInt(monthlyCounting1);
    monthlyCounting2 = parseInt(monthlyCounting2);
    monthlyCounting3 = parseInt(monthlyCounting3);
    monthlyCounting4 = parseInt(monthlyCounting4);
    monthlyCounting5 = parseInt(monthlyCounting5);
    monthlyCounting6 = parseInt(monthlyCounting6);
    monthlyCounting7 = parseInt(monthlyCounting7);
    monthlyCounting8 = parseInt(monthlyCounting8);
    monthlyCounting9 = parseInt(monthlyCounting9);
    monthlyCounting10 = parseInt(monthlyCounting10);
    monthlyCounting11 = parseInt(monthlyCounting11);
    monthlyCounting12 = parseInt(monthlyCounting12);

    new Chart(document.getElementById('line-patients'), {
        type: 'line',
        data: {
            labels: Array.from({ length: 12 }, (_, i) => new Date(0, i).toLocaleString('en', { month: 'long' })),
            datasets: [{
                label: 'No. of Patients: ',
                data: [monthlyCounting1, monthlyCounting2, monthlyCounting3, monthlyCounting4, monthlyCounting5, monthlyCounting6, monthlyCounting7, monthlyCounting8, monthlyCounting9, monthlyCounting10, monthlyCounting11, monthlyCounting12],
                fill: false,
                borderColor: 'rgb(202, 138, 4)',
                tension: 0.5
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

</script>
