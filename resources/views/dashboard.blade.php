<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 flex justify-center">
       <div class="card w-96 bg-neutral text-neutral-content">
              <div class="card-body items-center text-center">
                <h2 class="card-title">Search for shuttles!</h2>
                <label class="form-control w-full max-w-xs">
                      <div class="label">
                        <span class="label-text">From</span>
                      </div>
                      <select class="select select-bordered">
                        @foreach($locations as $location)
                            <option value="{{$location['location_id']}}">{{$location['location_name']}}</option>
                        @endforeach
                      </select>
                </label>
                <label class="form-control w-full max-w-xs">
                      <div class="label">
                        <span class="label-text">To</span>
                      </div>
                      <select class="select select-bordered">
                        @foreach($locations as $location)
                            <option value="{{$location['location_id']}}">{{$location['location_name']}}</option>
                        @endforeach
                      </select>
                </label>
                <label class="form-control w-full max-w-xs">
                      <div class="label">
                        <span class="label-text">Departure Time</span>
                      </div>
                      <select class="select select-bordered">
                        @foreach($timeSlots as $time_slot)
                            <option value="{{$location['time_slot_id']}}">{{$time_slot['start_time']}}</option>
                        @endforeach
                      </select>
                </label>
                <button class="mt-5 btn btn-primary w-full">Search</button>
              </div>
        </div>
    </div>
</x-app-layout>
