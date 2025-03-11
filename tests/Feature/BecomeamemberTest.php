<?php

namespace Darvis\ModuleBecomeamember\Tests\Feature;

use Darvis\ModuleBecomeamember\Tests\TestCase;
use Darvis\ModuleBecomeamember\Models\Becomeamember;
use Livewire\Livewire;

class BecomeamemberTest extends TestCase
{
    /** @test */
    public function it_can_render_the_list_component()
    {
        Livewire::test('becomeamember-list')
            ->assertStatus(200)
            ->assertViewIs('module-becomeamember::livewire.becomeamember-list');
    }

    /** @test */
    public function it_can_render_the_create_component()
    {
        Livewire::test('becomeamember-create')
            ->assertStatus(200)
            ->assertViewIs('module-becomeamember::livewire.becomeamember-create');
    }

    /** @test */
    public function it_can_create_a_new_member()
    {
        Livewire::test('becomeamember-create')
            ->set('firstname', 'John')
            ->set('lastname', 'Doe')
            ->set('email', 'john@example.com')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('becomeamembers', [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john@example.com',
        ]);
    }
}
