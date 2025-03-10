<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cms', 'middleware' => ['auth:staff', 'web']], function () {

    $modules = collect(cms_config('manta')['modules']);

    $agendaModule = $modules->firstWhere("name", 'becomeamember');
    $name = isset($agendaModule['routename']) ? $agendaModule['routename'] : 'becomeamember';

    Route::get("/{$name}", \Darvis\ModuleBecomeamember\Livewire\BecomeamemberList::class)->name('becomeamember.list');
    Route::get("/{$name}/toevoegen", \Darvis\ModuleBecomeamember\Livewire\BecomeamemberCreate::class)->name('becomeamember.create');
    Route::get("/{$name}/aanpassen/{becomeamember}", \Darvis\ModuleBecomeamember\Livewire\BecomeamemberUpdate::class)->name('becomeamember.update');
    Route::get("/{$name}/lezen/{becomeamember}", \Darvis\ModuleBecomeamember\Livewire\BecomeamemberRead::class)->name('becomeamember.read');
    Route::get("/{$name}/instellingen", \Darvis\ModuleBecomeamember\Livewire\BecomeamemberSettings::class)->name('becomeamember.settings');
});
