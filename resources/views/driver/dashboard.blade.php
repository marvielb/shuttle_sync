<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Driver Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 flex justify-center flex-col items-center gap-5">
        @foreach ($schedules as $schedule)
            <div class="card w-96 bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">{{ $schedule->timeSlot->formatted_start_time }}</h2>
                    <div class="flex justify-around">
                        <p>{{ $schedule->fromLocation->abbreviation }} - {{ $schedule->toLocation->abbreviation }}</p>
                        <p>{{ $schedule->bookings_count }} passengers</p>
                    </div>
                    <div class="card-actions justify-end w-full pt-5">
                        <button class="btn btn-primary w-full">Arrive</button>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</x-app-layout>
