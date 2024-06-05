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
                @include('Tabs.Doctor-Tabs.patient-records') 
            @elseif(request()->routeIS('doctor-schedule'))
                @include('Tabs.Doctor-Tabs.schedule')
            @endif

        </div>
    </div>
</body>


{{--Seacrh backend script--}}

</html>
