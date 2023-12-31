<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shuttle Search Results') }}
        </h2>
    </x-slot>

    <div class="py-6 flex justify-center flex-wrap gap-5">
        @foreach ($schedules as $schedule)
            @php
                $shuttle = $schedule->shuttle;
                $driver = $shuttle->driver;
                $bookings = $schedule->bookings;
                $availableSlots = $shuttle->capacity - $bookings->count();
            @endphp
            <div class="card card-side bg-base-100 shadow-xl max-w-sm">
                <figure class="w-full max-w-40 min-w-40 bg-neutral"><img class="object-cover"
                        src="{{ $shuttle['image_url'] }}" alt="{{ "{$shuttle['model_name']} Avatar" }}" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">{{ strtoupper($shuttle['plate_number']) }}</h2>
                    <p>
                        <span class="whitespace-nowrap">{{ $availableSlots }} Slots Available</span>
                        <span class="whitespace-nowrap">{{ $shuttle['model_name'] }}</span><br>
                        <span class="whitespace-nowrap">{{ $driver['name'] }}</span>
                    </p>
                    @if ($bookings->contains(fn($booking) => $booking->user_id == $user->id) == false)
                        <div class="card-actions pt-2">
                            <form class="w-full"
                                action="{{ route('booking.confirmation', ['shuttleScheduleId' => $schedule['id']]) }}">
                                <button type="submit" class=" w-full btn btn-primary">Book</button>
                            </form>
                        </div>
                    @endif


                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
