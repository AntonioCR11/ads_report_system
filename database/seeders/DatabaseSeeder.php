<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Report;
use App\Models\Reporter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Fixed Categories
        DB::table('categories')->insert([
            [
                'name' => "Infrastruktur",
                'slug' => "infrastruktur",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Lingkungan",
                'slug' => "lingkungan",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Layanan Publik",
                'slug' => "layanan-publik",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Keamanan",
                'slug' => "keamanan",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Kesehatan",
                'slug' => "kesehatan",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Lain-lain",
                'slug' => "lain-lain",
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        \App\Models\User::factory(10)->create();
        \App\Models\Reporter::factory(10)->create();

        // Report Seeding
        $reporter_ids = Reporter::all()->pluck('id')->toArray();
        $category_ids = Category::all()->pluck('id')->toArray();

        $dateNow = date('Ymd');
        $reports = Report::where(
            function ($q) use ($dateNow) {
                $q
                    ->where('ticket_id', 'like', "%$dateNow%");
            }
        )->get();
        for ($i = 0; $i < 10; $i++) {
            $ticket_id = $dateNow . (intval(count($reports)) + ($i + 1));
            $status = fake()->randomElement(['Pending', 'Proses Administratif', 'Proses Penanganan', 'Selesai Ditangani', 'Laporan Ditolak']);
            $category_id = $status == 'Pending' ? null : fake()->randomElement($category_ids);
            \App\Models\Report::factory()->create([
                'reporter_id' => fake()->randomElement($reporter_ids),
                'category_id' => $category_id,
                'ticket_id' => $ticket_id,
                'title' => fake()->sentence(6, true),
                'description' => fake()->paragraph(5, true),
                'status' => 'Pending',
            ]);
        }

        // \App\Models\ReportTracker::factory(10)->create();
    }
}
