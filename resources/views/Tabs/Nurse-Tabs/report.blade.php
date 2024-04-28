<div class="p-10 w-full min-h-screen">
    <div class="w-full h-fit bg-white rounded-xl p-10">
        <h1 class="text-yellow-600 font-bold text-3xl">REPORTS</h1>
        
        <div class="grid grid-cols-2 gap-3 mt-3">
            <div class="col-span-1 border-2 border-blue-800 p-3 rounded-lg">
                <div class="flex flex-row justify-between items-center">
                    <h2 class="text-blue-800 font-semibold">WEEKLY MONITORING OF PATIENTS</h2>

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
                
                <canvas id="bar-patients"></canvas>
            </div>

            <div class="col-span-1 border-2 border-blue-800 p-3 rounded-lg">
                <div class="flex flex-row justify-between items-center">
                    <h2 class="text-blue-800 font-semibold">PATIENTS FOR THE MONTH</h2>

                    <small class="text-blue-800">August 2021</small>
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

                            <tbody>
                                <tr class="text-xs">
                                    <td class="text-red-600">
                                        <span class="inline-block h-3 w-3 rounded-full bg-red-600"></span> Student
                                    </td>

                                    <td class="text-center">125</td>
                                </tr>

                                <tr class="text-xs">
                                    <td class="text-green-600">
                                        <span class="inline-block h-3 w-3 rounded-full bg-green-600"></span> Full Time Faculty
                                    </td>

                                    <td class="text-center">12</td>
                                </tr>

                                <tr class="text-xs">
                                    <td class="text-emerald-500">
                                        <span class="inline-block h-3 w-3 rounded-full bg-emerald-500"></span> Part Time Faculty
                                    </td>

                                    <td class="text-center">75</td>
                                </tr>

                                <tr class="text-xs">
                                    <td class="text-blue-500">
                                        <span class="inline-block h-3 w-3 rounded-full bg-blue-500"></span> Part Time Faculty
                                    </td>

                                    <td class="text-center">46</td>
                                </tr>

                                <tr class="text-xs">
                                    <td class="text-end">TOTAL:</td>
                                    <td class="text-center">397</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-span-1">
                        <canvas id="pie-patients"></canvas>
                    </div>
                </div>
                
            </div>

            <div class="col-span-2 border-2 border-blue-800 p-3 rounded-lg">
                <div class="flex flex-row justify-between items-center">
                    <h2 class="text-blue-800 font-semibold">PATIENTS FOR THE MONTH</h2>

                    <div class="flex flex-row items-center gap-1 text-blue-800">
                        <button data-dropdown-toggle="dropdown" class="flex flex-row gap-1 items-center text-sm text-blue-800">
                            <span>August 2021</span>
                            <img width="16" height="16" src="https://img.icons8.com/ios-glyphs/16/000000/expand-arrow--v1.png" alt="expand-arrow--v1"/>
                        </button>

                        <span class="text-sm px-2">to</span>

                        <button data-dropdown-toggle="dropdown" class="flex flex-row gap-1 items-center text-sm text-blue-800">
                            <span>December 2021</span>
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
                    
                </div>

                <canvas id="line-patients"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    //Bar Chart
    new Chart(document.getElementById('bar-patients'), {
        type: 'bar',
        data: {
            labels: ['S', 'M', 'T', 'W', 'TH', 'F', 'ST'],
            datasets: [{
                label: '# Patients',
                data: [12, 19, 3, 5, 2, 3, 8],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    //Pie Chart
    new Chart(document.getElementById('pie-patients'), {
        type: 'pie',
        data: {
            labels: [
                'Red',
                'Blue',
                'Yellow'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        },
        options: {
            scales: {
                y: {
                    display: false,
                    beginAtZero: true
                },
                x: {
                    display: false
                }
            },
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        color: 'rgb(255, 99, 132)'
                    }
                }
            }
        }
    });

    //Line Chart
    new Chart(document.getElementById('line-patients'), {
        type: 'line',
        data: {
            labels: Array.from({ length: 12 }, (_, i) => new Date(0, i).toLocaleString('en', { month: 'long' })),
            datasets: [{
                label: 'My First Dataset',
                data: [65, 59, 80, 81, 56, 55, 40, 23, 10, 54, 12, 40],
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