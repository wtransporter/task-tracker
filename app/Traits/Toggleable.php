<?php

namespace App\Traits;

trait Toggleable
{
    public function toggleActive()
    {
        $this->active = !$this->active;
        $this->resetPage();
    }
}