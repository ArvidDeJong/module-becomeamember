<?php

namespace Darvis\ModuleBecomeamember\Livewire;

use Livewire\Component;
use \Darvis\ModuleBecomeamember\Livewire\BecomeamemberTrait;
use Darvis\Manta\Traits\TableRowTrait;

class BecomeamemberListRow extends Component
{
    use BecomeamemberTrait;
    use TableRowTrait;

    public function render()
    {
        return view('module-becomeamember::livewire.becomeamember-list-row');
    }
}
