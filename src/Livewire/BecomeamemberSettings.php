<?php

namespace Darvis\ModuleBecomeamember\Livewire;

use Flux\Flux;
use \Darvis\ModuleBecomeamember\Models\Becomeamember;
use \Darvis\Manta\Models\Option;
use Livewire\Component;
use Darvis\Manta\Traits\MantaTrait;

class BecomeamemberSettings extends Component
{

    use MantaTrait;
    use BecomeamemberTrait;

    public ?string $BECOMEAMEMBER_RECEIVERS = null;

    public function mount()
    {
        $BECOMEAMEMBER_RECEIVERS = Option::get('BECOMEAMEMBER_RECEIVERS', Becomeamember::class, app()->getLocale());
        if (empty($BECOMEAMEMBER_RECEIVERS)) {
            Option::set('BECOMEAMEMBER_RECEIVERS', json_encode(explode(PHP_EOL, env("MAIL_TO_ADDRESS"))), Becomeamember::class, app()->getLocale());
        }
        $BECOMEAMEMBER_RECEIVERS = Option::get('BECOMEAMEMBER_RECEIVERS', Becomeamember::class, app()->getLocale());
        if ($BECOMEAMEMBER_RECEIVERS) {
            $this->BECOMEAMEMBER_RECEIVERS = implode("\n", json_decode($BECOMEAMEMBER_RECEIVERS, true));
        }
        $this->getBreadcrumb();
    }

    public function render()
    {
        return view('livewire.manta.becomeamember.becomeamember-settings')->title('Nieuwe leden instellingen');
    }

    public function save()
    {
        $this->validate([
            'BECOMEAMEMBER_RECEIVERS' => 'required',
        ], [
            'BECOMEAMEMBER_RECEIVERS.required' => 'De ontvangers zijn verplicht',
        ]);

        Option::set('BECOMEAMEMBER_RECEIVERS', json_encode(explode(PHP_EOL, $this->BECOMEAMEMBER_RECEIVERS)), Becomeamember::class, app()->getLocale());

        Flux::toast(
            'Instellingen opgeslagen',
            duration: 3000, // Show indefinitely...
        );
    }
}
