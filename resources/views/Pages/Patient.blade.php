<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Patient Dashboard</title>
    @vite('resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</head>

<body>
    <x-layout.navbar/>

    <div class="object-fill bg-no-repeat bg-cover bg-fixed" style="background-image: url('{{asset('assets/imgs/bg.png')}}');"> 
        <div class="container mx-auto flex">
            <x-layout.sidebar/>

            @if(request()->routeIS('patient-dashboard'))
                @include('Tabs.Patient-Tabs.dashboard')
            @elseif(request()->routeIS('patient-profile'))
                @include('Tabs.Patient-Tabs.profile')
            @elseif(request()->routeIS('patient-view-appointment'))
                @include('Tabs.Patient-Tabs.view-appointment')
            @elseif(request()->routeIS('patient-request-appointment'))
                @include('Tabs.Patient-Tabs.request-appointment')
            @elseif(request()->routeIS('patient-lab-results'))
                @include('Tabs.Patient-Tabs.lab-result')
            @elseif(request()->routeIS('patient-about'))
                @include('Tabs.General-Tabs.about')
            @endif

        </div>
    </div>
</body>

</html>