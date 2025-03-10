<?php

namespace Darvis\ModuleBecomeamember\Livewire;

use Livewire\Component;
use Manta\Models\Becomeamember;
use Illuminate\Http\Request;
use Darvis\Manta\Traits\MantaTrait;
use Faker\Factory as Faker;

class BecomeamemberCreate extends Component
{
    use MantaTrait;
    use BecomeamemberTrait;

    public function mount(Request $request)
    {
        $this->locale = getLocaleManta();
        if ($request->input('locale') && $request->input('pid')) {
            $item = Becomeamember::find($request->input('pid'));
            $this->pid = $item->id;
            $this->locale = $request->input('locale');
            $this->itemOrg = $item;
        }


        if (class_exists(Faker::class) && env('APP_ENV') == 'local') {
            $faker = Faker::create('NL_nl');
            $this->company = $faker->company();
            $this->sex = $faker->randomElement(['man', 'vrouw']);
            $this->title = $faker->sentence(4);
            $this->firstname = $faker->firstName();
            $this->lastname = $faker->lastName();

            $this->email = $faker->email();
            $this->phone = $faker->phoneNumber();
            // $this->address = $faker->streetName();
            $this->address = $faker->streetAddress();
            $this->address_nr = $faker->numberBetween(10, 999);
            $this->zipcode = $faker->postcode();
            $this->city = $faker->city();
            $this->country = $faker->country();
            $this->iban = $faker->iban('NL');
            $this->birthdate = $faker->dateTimeBetween('1990-01-01', '2022-12-31')->format('Y-m-d');
            $this->subject = $faker->sentence(4);
            $this->comment = $faker->text(500);
            $this->internal_contact = $faker->name();
            $this->ip = $faker->ipv4;
        }

        $this->getLocaleInfo();
        $this->getTablist();
        $this->getBreadcrumb('create');
    }

    public function render()
    {
        return view('manta::default.manta-default-create')->title($this->config['module_name']['single'] . ' toevoegen');
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
        $row['created_by'] = auth('staff')->user()->name;
        Becomeamember::create($row);
        // $this->toastr('success', $this->config['module_name']['single'] . ' toegevoegd');

        return $this->redirect(BecomeamemberList::class);
    }
}
