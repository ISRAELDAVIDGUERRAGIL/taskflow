<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@taskflow.test',
        ]);

        Project::factory()
            ->count(3)
            ->for($user)
            ->has(Task::factory()->count(15)->pending(), 'tasks')
            ->create();

        $user2 = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@taskflow.test',
        ]);

        Project::factory()
            ->count(2)
            ->for($user2)
            ->has(Task::factory()->count(10)->inProgress(), 'tasks')
            ->create();

        Project::factory()
            ->for($user2)
            ->has(Task::factory()->count(20)->completed(), 'tasks')
            ->has(Task::factory()->count(5)->pending(), 'tasks')
            ->create();
    }
}
