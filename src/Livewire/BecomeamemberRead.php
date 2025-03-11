<?php

namespace Darvis\ModuleBecomeamember\Livewire;

use Livewire\Component;
use \Darvis\ModuleBecomeamember\Models\Becomeamember;
use Illuminate\Http\Request;
use Darvis\Manta\Traits\MantaTrait;

class BecomeamemberRead extends Component
{
    use MantaTrait;
    use BecomeamemberTrait;

    public function mount(Request $request, Becomeamember $becomeamember)
    {
        $this->item = $becomeamember;
        $this->itemOrg = $becomeamember;
        $this->locale = $becomeamember->locale;
        if ($request->input('locale') && $request->input('locale') != getLocaleManta()) {
            $this->pid = $becomeamember->id;
            $this->locale = $request->input('locale');
            $item_translate = Becomeamember::where(['pid' => $becomeamember->id, 'locale' => $request->input('locale')])->first();
            $this->item = $item_translate;
        }

        if ($becomeamember) {
            $this->id = $becomeamember->id;
        }
        $this->getLocaleInfo();
        $this->getTablist();
        $this->getBreadcrumb('read');
    }

    public function render()
    {
        return view('manta::default.manta-default-read')->title($this->config['module_name']['single'] . ' bekijken');
    }
}
