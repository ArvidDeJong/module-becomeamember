<flux:main container>
    <x-manta.breadcrumb :$breadcrumb />
    <flux:heading size="xl" class="mb-8">Instellingen</flux:heading>
    <form wire:submit="save">
        <div class="mb-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <flux:textarea wire:model="BECOMEAMEMBER_RECEIVERS" label="Ontvangers" /> <em>Ook versturen naar de
                        zender? Gebruik:
                        ##ZENDER##</em>
                </div>
                <div>
                    <ul class="list-disc pl-5">
                        @foreach (explode(PHP_EOL, $BECOMEAMEMBER_RECEIVERS) as $key => $value)
                            <li class="flex items-center">
                                {!! filter_var($value, FILTER_VALIDATE_EMAIL)
                                    ? '<i class="mr-2 text-green-600 fa-solid fa-check"></i>'
                                    : '<i class="mr-2 text-red-600 fa-solid fa-xmark"></i>' !!} {{ $value }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @include('manta::includes.form_error')
        <flux:button type="submit" variant="primary">Opslaan</flux:button>
        <div class="mt-6" wire:ignore>
            <label for="map" class="mb-2 block text-sm font-bold"></label>
            <div class="h-96 w-full">
                <div id="map" class="h-full w-full"></div>
            </div>
        </div>
    </form>
</flux:main>
