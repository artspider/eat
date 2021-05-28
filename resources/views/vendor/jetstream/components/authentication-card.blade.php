<div class="min-h-screen w-full flex flex-col justify-center sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 xl:flex-row xl:justify-evenly">
    <div class="">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-lg xl:max-w-xl 2xl:max-w-2xl">
        {{ $slot }}
    </div>
</div>
