<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Report;
use App\Models\Reporter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $reporter_ids = Reporter::all()->pluck('id')->toArray();
        $category_ids = Category::all()->pluck('id')->toArray();

        $dateNow = date('Ymd');
        $reports = Report::where(
            function ($q) use ($dateNow) {
                $q
                    ->where('ticket_id', 'like', "%$dateNow%");
            }
        )->get();
        $ticket_id = $dateNow . '' . (intval(count($reports)) + 1);
        return [
            'reporter_id' => fake()->randomElement($reporter_ids),
            'category_id' => fake()->randomElement($category_ids),
            'ticket_id' => $ticket_id,
            'title' => fake()->sentence(6, true),
            'description' => fake()->sentence(20, true),
            'status' => fake()->randomElement(['Pending', 'Proses Administratif', 'Proses Penanganan', 'Selesai Ditangani', 'Laporan Ditolak']),
        ];

    }
}
