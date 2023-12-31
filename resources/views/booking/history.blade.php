<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Booking History') }}
        </h2>
    </x-slot>

    <div class="py-6 flex justify-center flex-col items-center gap-5">
        @foreach ($bookings as $booking)
            @php
                $schedule = $booking->shuttleSchedule;
                $shuttle = $schedule->shuttle;
                $timeSlot = $schedule->timeSlot;
            @endphp
            <div class="card card-side bg-base-100 shadow-xl max-w-sm w-full">
                <figure class="w-full max-w-40 min-w-40 bg-neutral"><img class="object-cover"
                        src="{{ $shuttle['image_url'] }}" alt="{{ "{$shuttle['model_name']} Avatar" }}" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">{{ strtoupper($shuttle['model_name']) }}</h2>
                    <p>
                        <span class="whitespace-nowrap">{{ $schedule['formatted_date'] }}</span>
                        <br>
                        <span class="whitespace-nowrap">{{ $timeSlot['formatted_start_time'] }}</span>
                        <br>
                        <span class="whitespace-nowrap">Success!</span>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
