<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shuttle Search') }}
        </h2>
    </x-slot>

    <div class="py-6 flex justify-center">
        <div class="card w-96 bg-neutral text-neutral-content">
            <div class="card-body items-center text-center">
                <h2 class="card-title">Search for shuttles!</h2>
                <form class="w-full" method="post" action="{{ route('shuttles.search.results') }}">
                    @csrf
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">From</span>
                        </div>
                        <select class="select select-bordered" name="from_location_id">
                            @foreach ($locations as $location)
                                <option value="{{ $location['location_id'] }}">{{ $location['location_name'] }}</option>
                            @endforeach
                        </select>
                        @error('from_location_id')
                            <div class="text-error">{{ $message }}</div>
                        @enderror
                    </label>
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">To</span>
                        </div>
                        <select class="select select-bordered" name="to_location_id">
                            @foreach ($locations as $location)
                                <option value="{{ $location['location_id'] }}">{{ $location['location_name'] }}</option>
                            @endforeach
                        </select>
                        @error('to_location_id')
                            <div class="text-error">{{ $message }}</div>
                        @enderror

                    </label>
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Departure Time</span>
                        </div>
                        <select class="select select-bordered" name="time_slot_id">
                            @foreach ($timeSlots as $time_slot)
                                <option value="{{ $time_slot['time_slot_id'] }}">
                                    {{ $time_slot['formatted_start_time'] }}</option>
                            @endforeach
                        </select>
                        @error('time_slot_id')
                            <div class="text-error">{{ $message }}</div>
                        @enderror
                    </label>
                    <button type="submit" class="mt-5 btn btn-primary w-full">Search</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
