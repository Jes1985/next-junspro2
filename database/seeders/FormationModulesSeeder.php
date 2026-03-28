<?php

namespace Database\Seeders;

use App\Services\Junspro\FormationService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormationModulesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('formation_modules')->update([
            'is_active' => false,
            'updated_at' => now(),
        ]);

        foreach (FormationService::MODULES_SEED as $module) {
            DB::table('formation_modules')->updateOrInsert(
                ['track' => $module['track'], 'slug' => $module['slug']],
                [
                    'slug'        => $module['slug'],
                    'title'       => $module['title'],
                    'week_label'  => $module['week_label'],
                    'track'       => $module['track'],
                    'order'       => $module['order'],
                    'part'        => $module['part'] ?? null,
                    'is_active'   => true,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]
            );
        }

        $this->command->info('[FormationModulesSeeder] '.count(FormationService::MODULES_SEED).' modules insérés/mis à jour.');
    }
}
