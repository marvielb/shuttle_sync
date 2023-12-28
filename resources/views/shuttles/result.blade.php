<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shuttle Search Results') }}
        </h2>
    </x-slot>

    <div class="py-6 flex justify-center">
           @foreach ($schedules as $schedule)
            <div>
                {{$schedule['shuttle']['shuttle_plate_number']}}
            </div>
           @endforeach
    </div>
</x-app-layout>
