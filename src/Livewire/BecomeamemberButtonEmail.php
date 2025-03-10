<?php

namespace Darvis\ModuleBecomeamember\Livewire;

use App\Mail\MailBecomeamemberCreate;
use App\Mail\MailCultureleBecomemember;
use Manta\Models\Becomeamember;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Darvis\Manta\Models\Option;

class BecomeamemberButtonEmail extends Component
{
    public ?Becomeamember $becomeamember = null;

    public bool $send = false;

    public function render()
    {
        return view('livewire.manta.becomeamember.becomeamember-button-email');
    }

    public function save()
    {
        $this->send = false;

        // Mail::to($this->becomeamember->email)->send(new MailBecomeamemberCreate($this->becomeamember));
        //  Mail::to(env('MAIL_TO_ADDRESS'))->send(new MailBecomeamemberCreate($this->becomeamember));

        $RECEIVERS = Option::get('BECOMEAMEMBER_RECEIVERS', Becomeamember::class, app()->getLocale());

        // Decode the JSON string to an array
        $receiversArray = json_decode($RECEIVERS, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $receiversArray[] = env('MAIL_TO_ADDRESS');
            // Handle JSON decode error
            // throw new \Exception('Error decoding RECEIVERS JSON: ' . json_last_error_msg());
        }

        // Ensure $receiversArray is an array
        if (!is_array($receiversArray)) {
            $receiversArray[] = env('MAIL_TO_ADDRESS');
            // throw new \Exception('RECEIVERS must be a JSON array.');
        }
        // Process each receiver
        foreach ($receiversArray as $receiver) {
            if ($receiver == "##ZENDER##" && filter_var($this->becomeamember->email, FILTER_VALIDATE_EMAIL)) {
                Mail::to($this->becomeamember->email)->send(new MailCultureleBecomemember($this->becomeamember));
            } else if (filter_var($receiver, FILTER_VALIDATE_EMAIL)) {
                Mail::to($receiver)->send(new MailCultureleBecomemember($this->becomeamember));
            }
        }
    }
}
