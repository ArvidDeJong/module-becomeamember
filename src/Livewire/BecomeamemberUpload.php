<?php

namespace Darvis\ModuleBecomeamember\Livewire;

use App\Livewire\Manta\Becomeamember\BecomeamemberTrait;
use Manta\Models\Becomeamember;
use Livewire\Component;
use Darvis\Manta\Traits\MantaTrait;

class BecomeamemberUpload extends Component
{
    use MantaTrait;
    use BecomeamemberTrait;

    public function mount(Becomeamember $becomeamember)
    {
        $this->item = $becomeamember;
        $this->itemOrg = $becomeamember;
        $this->id = $becomeamember->id;

        $this->getLocaleInfo();
        $this->getBreadcrumb('upload');
        $this->getTablist();
    }

    public function render()
    {
        return view('manta::default.manta-default-upload')->title($this->config['module_name']['single'] . ' bestanden');
    }
}
