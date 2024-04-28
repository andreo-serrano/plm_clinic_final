<div class="p-10 min-h-screen">
    <div class="w-full bg-white rounded-xl p-10">
        <h1 class="text-3xl text-yellow-600 font-bold">Welcome, {{ explode(' ', explode(',', Auth::user()->name)[1])[1] }}!</h1>

        <div class="mt-5 px-4">
            <span class="text-2xl font-semibold text-blue-800">Announcement</span>
            <div class="w-full border-t-4 border-blue-900 mt-2"></div>
        </div>
        
        <div class="px-14 text-blue-800 mt-5">
            <ul class="list-disc space-y-3">

                    @foreach(DB::table('announcements')->orderBy('created_at', 'desc')->get() as $announcement)
                        <li>
                            <b> {{ $announcement->title }} </b>
                            <br>
                            <br>
                            <span style="display: block; margin-left: 20px; text-align: justify;"> {{ $announcement->details }} </span>
                            <br>
                            <span style="display: block; margin-left: 20px;"> <b>Provider:</b> {{ $announcement->provider }} </span>
                        </li>
                    @endforeach

            </ul>
        </div>
    </div>
</div>