<x-app-layout>
            <div class="shadow-lg p-8 mt-10 bg-white bg-opacity-50 rounded-lg transition-transform transform hover:scale-[1.01]">
                <h1 class="text-center text-xl font-semibold text-indigo-700 border-b-2 pb-2 border-indigo-200"> Daftar Pengajar Rumah Belajar Miss Flora </h1>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 p-5">
                    @foreach ($pengajar as $pengajar)
                        <div
                            class="p-6 shadow-md border rounded-lg bg-white relative cursor-pointer hover:border-indigo-300 transition ease-in-out 300ms transform hover:scale-[1.01]">
                            <div class="rounded-lg h-64 overflow-hidden mb-4">
                                <img alt="content" class="object-cover object-center h-full w-full"
                                    src="{{ $pengajar->pengajarUser->profile_photo_url }}">
                            </div>
                            <div class="flex flex-col">
                                <div class="flex flex-col mt-5">
                                    <a class="text-xl font-medium title-font">{{ $pengajar->fullname }}</a>
                                <div class="flex gap-5 mt-2 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                      </svg>
                                    <div class="flex items-center gap-3 text-gray-600">
                                    <p> {{ $pengajar->pengajarUser->email }}</p>
                                    </div>
                                </div>
                                <div class="flex gap-5 mt-2 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                      </svg>
                                    <div class="flex items-center gap-3 text-gray-600">
                                    <p> {{ $pengajar->noHp }}</p>
                                    </div>
                                </div>
                                <div class="flex gap-5 mt-2 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                      </svg>
                                    <div class="flex items-center gap-3 text-gray-600">
                                    <p> {{ $pengajar->alamat }}</p>
                                    </div>
                                </div>
                                <div class="flex gap-5 mt-2 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                      </svg>
                                    <div class="flex items-center gap-3 text-gray-600">
                                    <p> {{ $pengajar->pendidikan }}</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                    @endforeach
                </div>
            </div>
</x-app-layout>
