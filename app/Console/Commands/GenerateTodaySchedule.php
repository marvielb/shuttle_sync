<?php

namespace App\Console\Commands;

use App\Models\Booking;
use App\Models\Location;
use App\Models\Shuttle;
use App\Models\ShuttleSchedule;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;

class GenerateTodaySchedule extends Command
{
    use WithFaker;

    public function __construct()
    {
        parent::__construct();
        $this->setUpFaker();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gen-sched';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will generate today\'s schedule.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $shuttles = Shuttle::all();
        $locations = Location::all();
        $locationIds = $locations->map(fn ($location) => $location['id']);
        $possibleRoutes = collect(Arr::crossJoin($locationIds, $locationIds))
            ->filter(fn ($route) => $route[0] != $route[1])
            ->values();
        $users = User::all();
        $timeslots = TimeSlot::all();
        $shuttles->each(function ($shuttle, $index) use ($possibleRoutes, $timeslots, $users) {
            $timeslots->each(function ($timeslot, $timeslotIndex) use ($index, $shuttle, $possibleRoutes, $users) {
                $routeIndex = $index % count($possibleRoutes);
                $directionIndex = $timeslotIndex % 2;
                $directionIndex2 = ($timeslotIndex + 1) % 2;
                $schedule = ShuttleSchedule::factory()->create([
                    'shuttle_id' => $shuttle['id'],
                    'time_slot_id' => $timeslot['id'],
                    'from_location_id' => $possibleRoutes[$routeIndex][$directionIndex],
                    'to_location_id' => $possibleRoutes[$routeIndex][$directionIndex2],
                ]);
                $randomBookings = $this->faker->randomElement(range(0, $shuttle['capacity']));
                $randomUser = $this->faker->randomElement($users);
                Booking::factory()->count($randomBookings)->create([
                    'shuttle_schedule_id' => $schedule['id'],
                    'user_id' => $randomUser['id'],
                ]);
            });
        });
    }
}
