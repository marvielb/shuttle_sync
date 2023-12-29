<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shuttle Search Results') }}
        </h2>
    </x-slot>

    <div class="py-6 flex justify-center">
        @foreach ($schedules as $schedule)
            <div class="card card-side bg-base-100 shadow-xl max-w-sm">
                <figure class="w-full max-w-40 bg-neutral"><img class="object-cover"
                        src="{{ $schedule['shuttle_image_url'] }}" alt="{{ "{$schedule['model_name']} Avatar" }}" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">{{ strtoupper($schedule['plate_number']) }}</h2>
                    <p>
                        <span class="whitespace-nowrap">{{ $schedule['available_slots'] }} Slots Available</span>
                        <span class="whitespace-nowrap">{{ $schedule['model_name'] }}</span><br>
                        <span class="whitespace-nowrap">{{ $schedule['driver_name'] }}</span>
                    </p>
                    <div class="card-actions pt-2">
                        <form class="w-full"
                            action="{{ route('booking.confirmation', ['shuttleScheduleId' => $schedule['id']]) }}">
                            <button type="submit" class=" w-full btn btn-primary">Book</button>
                        </form>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
