<div class="p-10 min-h-screen">
    <div class="w-full bg-white rounded-xl p-10">
        <h1 class="text-3xl text-yellow-600 font-bold">Welcome, {{ explode(' ', explode(',', Auth::user()->name)[1])[1] }}!</h1>

        <div class="mt-5 px-4">
            <span class="text-2xl font-semibold text-blue-800">Announcement</span>
            <div class="w-full border-t-4 border-blue-900 mt-2"></div>
        </div>
        
        <div class="px-14 text-blue-800 mt-5">
            <ul class="list-disc space-y-3">
                @php
                    $currentDateTime = \Carbon\Carbon::now();
                    $announcements = DB::table('announcements')
                        ->orderBy('created_at', 'desc')
                        ->get();
                    $hasFutureOrTodayAnnouncements = false;

                    foreach ($announcements as $announcement) {
                        $announcementDateTime = \Carbon\Carbon::parse($announcement->ex_date . ' ' . $announcement->ex_time);
                        if ($announcementDateTime->isFuture() || $announcementDateTime->isSameDay($currentDateTime)) {
                            $hasFutureOrTodayAnnouncements = true;
                            break; // Stop checking if we find one valid announcement
                        }
                    }
                @endphp

                @if ($hasFutureOrTodayAnnouncements)
                    @foreach ($announcements as $announcement)
                        @php
                            $announcementDateTime = \Carbon\Carbon::parse($announcement->ex_date . ' ' . $announcement->ex_time);
                        @endphp
                        @if ($announcementDateTime->isFuture() || $announcementDateTime->isSameDay($currentDateTime))
                            <li>
                                <b>{{ $announcement->title }}</b><br><br>
                                <span style="display: block; margin-left: 20px; text-align: justify;">{{ $announcement->details }}</span><br>
                                <span style="display: block; margin-left: 20px;"><b>Provider:</b> {{ $announcement->provider }}</span>
                            </li>
                        @endif
                    @endforeach
                @else
                    <div class="w-full text-center py-28 text-blue-950 font-bold">
                        <h4 class="text-4xl">NO ANNOUNCEMENTS</h4>
                    </div>
                @endif
            </ul>
        </div>

    </div>
</div>
