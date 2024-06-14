<div class="min-h-screen flex flex-col gap-4 sm:justify-center items-center bg-gradient-to-r from-cyan-500 to-blue-500">
    <div class="flex w-[70%] flex-col items-center border rounded-md bg-slate-300 bg-opacity-40 shadow-xl p-5">
        <h2 class="text-center text-2xl pb-3 text-indigo-500 font-bold font-mono">Petunjuk Login untuk Siswa Rumbel Ms. Flora</h2>
        <div class="mb-6 w-full">
            <div class="">
                <h3 class="text-lg font-semibold text-gray-800">Email:</h3>
            <p class="text-slate-600">Format email kamu adalah nama lengkap tanpa spasi, diikuti dengan <code class="bg-gray-100 text-gray-800 px-2 py-1 rounded">@students.rms</code>.</p>
            </div>
            <p class="text-slate-600 mt-2">Contoh: Jika nama lengkap kamu adalah <span class="font-semibold">Mirekel Nainggolan</span>, maka email kamu adalah <code class="bg-gray-100 text-gray-800 px-2 py-1 rounded">mirekelnainggolan@students.rms</code>.</p>
        </div>
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Password:</h3>
            <p class="text-slate-600">Format password kamu adalah nama depan diikuti dengan tanggal lahir dalam format <code class="bg-gray-100 text-gray-800 px-2 py-1 rounded">ddmmyyyy</code> (tanpa spasi atau tanda baca).</p>
            <p class="text-slate-600 mt-2">Contoh: Jika nama lengkap kamu adalah <span class="font-semibold">Mirekel Nainggolan</span> dan tanggal lahir kamu adalah <span class="font-semibold">14 September 2004</span>, maka password kamu adalah <code class="bg-gray-100 text-gray-800 px-2 py-1 rounded">Mirekel14092004</code>.</p>
        </div>
    </div>
    <div class="w-[70%] h-max px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
