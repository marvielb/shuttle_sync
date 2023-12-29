@php
    $shuttle = $schedule['shuttle'];
    $timeSlot = $schedule['timeSlot'];
    $driver = $shuttle['driver'];
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Booking Confirmation') }}
        </h2>
    </x-slot>

    <div class="py-6 flex justify-center">
        <div class="card w-96 bg-neutral text-neutral-content">
            <div class="card-body items-center text-center">
                <h2 class="card-title">Are you sure?</h2>

                <div class="card-body w-full justify-center">
                    <figure class=" pl-5"><img class="object-cover" src="{{ $shuttle['image_url'] }}"
                            alt="{{ "{$shuttle['shuttle_model_name']} Avatar" }}" /></figure>
                    <div class="pt-2">
                        <span
                            class="whitespace-nowrap text-xl font-bold">{{ $timeSlot['formatted_start_time'] }}</span><br>
                        <span class="whitespace-nowrap">{{ $shuttle['shuttle_model_name'] }}</span><br>
                    </div>
                    <div class="card-actions pt-5">
                        <form class="w-full" method="post"
                            action="{{ route('booking.confirmation.result', ['shuttleScheduleId' => $schedule['shuttle_schedule_id']]) }}">
                            @csrf
                            <button type="submit" class=" w-full btn btn-primary">Book</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
