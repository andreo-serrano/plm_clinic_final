<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>View Schedule</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <style>
        .todo-item {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
        }
        /* OPTION 1: Overflow visible - Content spills out */
        .todo-item.option-1  {
            overflow: visible; 
        }
        /* OPTION 2: Overflow with scrollbars */
        .todo-item.option-2  { 
            overflow: auto; 
            max-height: 80px; /* Adjust the max height as needed */
        }
        /* OPTION 3: Text truncation (add more CSS if you want a fancy ellipsis) */
        .todo-item.option-3 {
            white-space: nowrap; 
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .past-event .fc-event-time {  /* Target event time within past events */
            color: #999; /* Gray text color */
            text-decoration: line-through;
        }

        /* The other CSS rules remain the same */
        .past-event {
            background-color: #f0f0f0; 
            color: #999;
        }

        .past-event .fc-event-title {
            text-decoration: none;
        }

        .past-event .fc-event-dot {
            background-color: red;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="p-10 w-full min-h-screen">
        <div class="w-full h-fit bg-white rounded-xl p-10">
            <h1 class="text-yellow-600 font-bold text-3xl">VIEW SCHEDULE</h1>
            <br>
            <form id="todo-form" action="{{ route('schedulenotes.store') }}" method="POST"> 
                @csrf
                <input type="date" id="todo-date" name="todo_date">
                <input type="text" id="todo-title" name="todo_title" placeholder="Event note">
                <input type="time" id="todo-start-time" name="todo_startTime"> 
                <input type="time" id="todo-end-time" name="todo_endTime"> 
                <button type="submitButton" id="add-todo" class="font-bold bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Add To-Do</button>
            </form>

            <div id="calendar" class="mt-5 h-[600px]"></div>
        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script>
       document.addEventListener('DOMContentLoaded', function() {
        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: function (fetchInfo, successCallback, failureCallback) {
            const univNum = getUnivNum();

            $.ajax({
                url: "{{ route('schedulenotes.index') }}",
                type: "GET",
                data: { univ_num: univNum },
                dataType: 'json',
                success: function (data) {
                    const events = data.map(item => {
                        const eventDate = new Date(item.todo_date);
                        const endTime = new Date(item.todo_endTime);
                        const today = new Date();

                        // Combined Date and Time Comparison
                        const isPastEvent = new Date(eventDate.toDateString() + ' ' + endTime.toTimeString()) < today;

                        return {
                            title: item.todo_title,
                            start: item.todo_startTime,
                            end: item.todo_endTime,
                            className: isPastEvent ? 'past-event' : '', // Simplified condition
                        };
                    });
                    successCallback(events);
                },
                error: function (xhr, status, error) {
                console.error('Error fetching events:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to fetch schedule data.'
                });
                }
            });
            }
        });

        calendar.render();

        $('#add-todo').on('click', function(e) {
            e.preventDefault();

            const formData = {
            todo_date: $('#todo-date').val(),
            todo_title: $('#todo-title').val(),
            todo_startTime: $('#todo-date').val() + 'T' + $('#todo-start-time').val() + ':00',
            todo_endTime: $('#todo-date').val() + 'T' + $('#todo-end-time').val() + ':00',
            univ_num: getUnivNum() // Include univ_num
            };

            // Validation
            if (!formData.todo_date || !formData.todo_title || !formData.todo_startTime || !formData.todo_endTime) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Incomplete Fields',
                        text: 'Please fill in all the fields.'
                    });
                    return;
            }

            $.ajax({
                url: "{{ route('schedulenotes.store') }}",
                type: "POST",
                data: formData,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function(response) {
                Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'To-do item added successfully.'
                }).then(function() {
                location.reload(); // Refresh the page after the SweetAlert closes
                });
                calendar.refetchEvents();
                $('#todo-form')[0].reset();
            },
            error: function(xhr, status, error) {
                Swal.fire({
                icon: 'error',
                title: 'Error',
                text: xhr.responseJSON && xhr.responseJSON.message ? 
                        xhr.responseJSON.message : 'An error occurred.'
                });
            }
            });
        });

        function getUnivNum() {
            return "{{ Auth::user()->univ_num }}";
        }
        });
    </script>
</body>