<?php

namespace Darvis\ModuleBecomeamember\Livewire;

use Flux\Flux;
use Livewire\Component;
use Darvis\ModuleBecomeamember\Models\Becomeamember;
use Illuminate\Http\Request;
use Darvis\Manta\Traits\MantaTrait;

class BecomeamemberUpdate extends Component
{
    use MantaTrait;
    use BecomeamemberTrait;

    public function mount(Becomeamember $becomeamember)
    {
        $this->item = $becomeamember;
        $this->itemOrg = translate($becomeamember, 'nl')['org'];
        $this->id = $becomeamember->id;
        $this->locale = $becomeamember->locale;

        $this->fill(
            $becomeamember->only(
                'locale',
                'company',
                'title',
                'sex',
                'firstname',
                'lastname',
                'email',
                'phone',
                'address',
                'zipcode',
                'city',
                'country',
                'iban',
                'birthdate',
                'newsletters',
                'subject',
                'comment',
                'internal_contact',
                'ip',
            ),
        );


        $this->getLocaleInfo();
        $this->getTablist();
        $this->getBreadcrumb('update');
    }

    public function render()
    {
        return view('manta::default.manta-default-update')->title($this->config['module_name']['single'] . ' aanpassen');
    }

    public function save()
    {
        $this->validate();

        $row = $this->only(
            'locale',
            'company',
            'title',
            'sex',
            'firstname',
            'lastname',
            'email',
            'phone',
            'address',
            'zipcode',
            'city',
            'country',
            'iban',
            'birthdate',
            'newsletters',
            'subject',
            'comment',
            'internal_contact',
            'ip',
        );
        $row['updated_by'] = auth('staff')->user()->name;
        Becomeamember::where('id', $this->id)->update($row);

        // return redirect()->to(route($this->route_name . '.list'));
        Flux::toast('Opgeslagen', duration: 1000, variant: 'success');
    }
}
