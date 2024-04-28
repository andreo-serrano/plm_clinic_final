<div class="p-10 w-full min-h-screen">
    <div class="w-full h-fit bg-white rounded-xl p-10">
        <h1 class="text-yellow-600 font-bold text-3xl">VIEW PROFILE</h1>

        @if (DB::table('doctorinfo')->where('doctorID', Auth::user()->univ_num)->exists())
        
        @php
            $doctorInfo = DB::table('doctorinfo')->where('doctorID', Auth::user()->univ_num)->first();
        @endphp
        
            <div class="w-full flex flex-col text-sm px-32 gap-3 mt-5">
                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">LAST NAME:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $doctorInfo->lastname }}">
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">FIRST NAME:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $doctorInfo->firstname }}">
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">MIDDLE NAME:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $doctorInfo->midname }}">
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">BIRTHDAY:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $doctorInfo->birthdate }}">
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">GENDER:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $doctorInfo->gender }}">
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">SPECIALIZATION:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $doctorInfo->spec }}">
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">OFFICIAL PLM EMAIL:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $doctorInfo->plmemail }}">
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">PERSONAL EMAIL:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $doctorInfo->peremail }}">
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">MOBILE NUMBER:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $doctorInfo->mobnum }}">
                </div>

                <div class="flex flex-row gap-3">
                    <h2 class="font-bold py-1 bg-blue-900 text-white w-full text-end px-5 rounded-lg">EMERGENCY NUMBER:</h2>
                    <input type="text" class="w-full border-2 border-yellow-700 rounded-lg py-1 px-3 placeholder-yellow-700/[.7] font-bold" placeholder="{{ $doctorInfo->ermobnum }}">
                </div>
            </div>

        @endif

    </div>
</div>