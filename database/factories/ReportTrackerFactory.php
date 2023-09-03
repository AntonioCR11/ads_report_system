<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReportTracker>
 */
class ReportTrackerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_ids = User::all()->pluck('id')->toArray();
        $report_ids = Report::all()->pluck('id')->toArray();

        return [
            'user_id' => fake()->randomElement($user_ids),
            'report_id' => fake()->randomElement($report_ids),
            'status' => fake()->randomElement(['Pending', 'Proses Administratif', 'Proses Penanganan', 'Selesai Ditangani', 'Laporan Ditolak']),
            'note' => fake()->sentence(6, true),
        ];
    }
}
