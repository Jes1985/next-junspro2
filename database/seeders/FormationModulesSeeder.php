<?php

namespace Database\Seeders;

use App\Services\Junspro\FormationService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormationModulesSeeder extends Seeder
{
    public function run(): void
    {
        foreach (FormationService::MODULES_SEED as $module) {
            DB::table('formation_modules')->updateOrInsert(
                ['slug' => $module['slug']],
                [
                    'slug'        => $module['slug'],
                    'title'       => $module['title'],
                    'week_label'  => $module['week_label'],
                    'order'       => $module['order'],
                    'description' => null,
                    'activities'  => json_encode([]),
                    'is_active'   => true,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]
            );
        }

        $this->command->info('[FormationModulesSeeder] 6 modules insérés/mis à jour.');
    }
}
