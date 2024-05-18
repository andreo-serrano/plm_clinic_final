<nav class="w-full h-20 h-max-20 bg-white">
    <div class="container mx-auto h-full py-3 grid grid-cols-6 gap-3">
        {{-- Left Side --}}
        <div class="col-span-2 flex flex-row items-center justify-start h-14 gap-2">
            <img src="{{ asset('assets/imgs/school-logo.png') }}" class="object-contain h-full">

            <img src="{{ asset('assets/imgs/school-name.png') }}" class="object-contain h-full">
        </div>

        {{-- Middle --}}
        <div class="col-span-2 flex items-center relative">
            <input type="text" id="searchInput" class="font-semibold w-full rounded-full py-2 px-4 border-2 text-sm border-blue-800 text-blue-800 placeholder-blue-800" placeholder="SEARCH">
            <i class='bx bx-search absolute right-5'></i>
        </div>

        {{-- Right Side --}}
        <div class="col-span-2 text-end text-blue-950">
            <h4 class="text-lg font-medium">
                LOGGED IN AS {{ strtoupper(Auth::user()->usertype) }} {{ Auth::user()->univ_num }}
            </h4>

            <small id="real-time-date"></small>
        </div>

        <script>
            // Function to update the real-time date and time
            function updateRealTimeDate() {
                var currentDate = new Date();
                var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                var day = days[currentDate.getDay()];
                var month = months[currentDate.getMonth()];
                var date = currentDate.getDate();
                var year = currentDate.getFullYear();
                var timeString = currentDate.toLocaleTimeString();
                var dateString = "Today is " + day + ", " + month + " " + date + ", " + year + " " + timeString;
                
                // Update the content of the element with id "real-time-date"
                document.getElementById("real-time-date").textContent = dateString;
            }

            // Call the function initially to display the real-time date
            updateRealTimeDate();

            // Update the real-time date every second
            setInterval(updateRealTimeDate, 1000);
        </script>

    </div>
</nav>