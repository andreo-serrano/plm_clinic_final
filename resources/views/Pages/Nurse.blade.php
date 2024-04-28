<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nurse Dashboard</title>
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

            @if(request()->routeIS('nurse-home'))
                @include('Tabs.Nurse-Tabs.home')
            @elseif(request()->routeIS('nurse-profile'))
                @include('Tabs.Nurse-Tabs.profile')
            @elseif(request()->routeIS('nurse-appointment-request'))
                @include('Tabs.Nurse-Tabs.appointment-request')
            @elseif(request()->routeIS('nurse-confirmed-appointment'))
                @include('Tabs.Nurse-Tabs.confirmed-appointment')
            @elseif(request()->routeIS('nurse-schedule'))
                @include('Tabs.Nurse-Tabs.schedule')
            @elseif(request()->routeIS('nurse-report'))
                @include('Tabs.Nurse-Tabs.report')
            @endif

        </div>
    </div>
</body>

</html>