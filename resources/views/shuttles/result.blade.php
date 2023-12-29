<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shuttle Search Results') }}
        </h2>
    </x-slot>

    <div class="py-6 flex justify-center">
        @foreach ($schedules as $schedule)
            <div class="card card-side bg-base-100 shadow-xl max-w-sm">
                <figure class="w-full max-w-40 pl-5"><img src="{{ $schedule['shuttle_image_url'] }}"
                        alt="{{ "{$schedule['shuttle_model_name']} Avatar" }}" /></figure>
                <div class="card-body">
                    <h2 class="card-title">{{ strtoupper($schedule['shuttle_plate_number']) }}</h2>
                    <p>
                        <span>{{ $schedule['shuttle_model_name'] }}</span><br>
                        <span>{{ $schedule['driver_name'] }}</span>
                        <span>Available: {{ $schedule['available_slots'] }}</span>
                    </p>
                    <div class="card-actions pt-2">
                        <button class=" w-full btn btn-primary">Book</button>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
