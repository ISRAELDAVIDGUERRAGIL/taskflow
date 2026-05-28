<?php

use App\Models\Task;
use Tests\TestCase;

uses(TestCase::class);

it('detecta si una tarea esta vencida', function () {
    $tarea = new Task([
        'due_date' => now()->subDay(),
        'status' => 'Pendiente',
    ]);

    expect($tarea->isOverdue())->toBeTrue();
});
