<?php

use App\Models\Project;
use App\Models\User;

it('bloquea el acceso a proyectos ajenos', function () {
    $otroUsuario = User::factory()->create();
    $proyectoAjeno = Project::factory()->create(['user_id' => $otroUsuario->id]);

    $this->actingAs(User::factory()->create())
        ->get("/projects/{$proyectoAjeno->id}")
        ->assertStatus(403);
});
