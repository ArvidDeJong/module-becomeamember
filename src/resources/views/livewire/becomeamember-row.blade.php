<?php

namespace App\Livewire\Manta\Becomeamember;

use Manta\Models\Becomeamember;
use Darvis\Manta\Traits\MantaPagerowTrait;

new class extends \Livewire\Volt\Component {
    public Becomeamember $item;

    use MantaPagerowTrait;
};
?>
<flux:table.row data-id="{{ $item->id }}">
    <flux:table.cell>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}</flux:table.cell>
    <flux:table.cell>{{ $item->firstname }}</flux:table.cell>
    <flux:table.cell>{{ $item->lastname }}</flux:table.cell>
    <flux:table.cell>{{ $item->email }}</flux:table.cell>
    <flux:table.cell><livewire:manta.becomeamember.becomeamember-button-email :becomeamember="$item"></flux:table.cell>
    <x-manta::flux.manta-flux-delete :$item :$route_name :$moduleClass uploads :$fields />
</flux:table.row>
