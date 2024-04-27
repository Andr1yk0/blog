<?php

namespace Tests;

use App\Models\User;

trait AuthUser
{
    protected ?User $user = null;

    public function setUser(?User $user = null): static
    {
        $this->user = $user ?? User::factory()->create();
        $this->actingAs($this->user);

        return $this;
    }
}
