<?php

namespace Tests\Feature\Livewire\Church;

use App\Http\Livewire\Church\Edit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EditTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Edit::class);

        $component->assertStatus(200);
    }
}
