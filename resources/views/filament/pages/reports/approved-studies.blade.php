<x-filament-panels::page>
    <div>
        <x-filament::card>
            {{ $this->form }}
            <x-filament::button wire:click="submit" class="mt-3">
                تنفيذ
            </x-filament::button>
        </x-filament::card>
    </div>

</x-filament-panels::page>
