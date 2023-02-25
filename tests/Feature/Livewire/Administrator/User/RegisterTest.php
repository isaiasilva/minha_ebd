<?php

namespace Tests\Feature\Livewire\Administrator\User;

use App\Http\Livewire\Administrator\User\Register;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Register::class);

        $component->assertStatus(200);
    }
}
