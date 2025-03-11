<?php

namespace Darvis\ModuleBecomeamember\Livewire;

use DragonCode\Contracts\Http\Builder;

use \Darvis\ModuleBecomeamember\Models\Becomeamember;
use Livewire\Attributes\Locked;
use Darvis\Manta\Services\Openai;

trait BecomeamemberTrait
{
    public function __construct()
    {
        $this->route_name = 'becomeamember';
        $this->route_list = route($this->route_name . '.list');
        $this->config = module_config('Becomeamember');
        $this->fields = $this->config['fields'];
        $this->tab_title = isset($this->config['tab_title']) ? $this->config['tab_title'] : null;
        $this->moduleClass = 'Manta\Models\Becomeamember';
    }



    // * Model items
    public ?Becomeamember $item = null;
    public ?Becomeamember $itemOrg = null;



    #[Locked]
    public ?string $company_id = null;

    #[Locked]
    public ?string $host = null;

    public ?string $locale = null;
    public ?string $pid = null;

    public ?string $company = null;
    public ?string $title = null;
    public ?string $sex = null;
    public ?string $firstname = null;
    public ?string $lastname = null;
    public ?string $email = null;
    public ?string $phone = null;
    public ?string $address = null;
    public ?string $address_nr = null;
    public ?string $zipcode = null;
    public ?string $city = null;
    public ?string $country = null;
    public ?string $iban = null;
    public ?string $birthdate = null;
    public ?string $newsletters = '1';
    public ?string $subject = null;
    public ?string $comment = null;
    public ?string $internal_contact = null;
    public ?string $ip = null;

    protected function applySearch($query)
    {
        return $this->search === ''
            ? $query
            : $query->where(function (Builder $querysub) {
                $querysub->where('title', 'LIKE', "%{$this->search}%")
                    ->orWhere('firstname', 'LIKE', "%{$this->search}%")
                    ->orWhere('lastname', 'LIKE', "%{$this->search}%")
                    ->orWhere('email', 'LIKE', "%{$this->search}%")
                    ->orWhere('phone', 'LIKE', "%{$this->search}%")
                    ->orWhere('address', 'LIKE', "%{$this->search}%")
                    ->orWhere('zipcode', 'LIKE', "%{$this->search}%");
            });
    }

    public function rules()
    {
        $return = [];
        if ($this->fields['firstname']) $return['firstname'] = 'required';
        // if ($this->fields['excerpt']) $return['excerpt'] = 'required';
        return $return;
    }

    public function messages()
    {
        $return = [];
        $return['title.required'] = 'De titel is verplicht';
        $return['excerpt.required'] = 'De inleiding is verplicht';
        return $return;
    }
}
