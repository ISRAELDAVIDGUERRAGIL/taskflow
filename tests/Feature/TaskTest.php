<?php

use App\Models\Project;
use App\Models\User;

it('requiere un titulo para crear una tarea', function () {
    $user = User::factory()->create();
    $proyecto = Project::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user)
        ->post("/projects/{$proyecto->id}/tasks", ['title' => ''])
        ->assertSessionHasErrors('title');
});
