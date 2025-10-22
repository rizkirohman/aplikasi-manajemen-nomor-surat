<x-filament-widgets::widget>
    <x-filament::section>
        @php
            $top = $this->getTopCreator();
        @endphp

        @if ($top)
            <div class="text-center">
                <h2 class="text-lg font-semibold text-gray-700">Pembuat Surat Terbanyak</h2>
                <p class="text-2xl font-bold text-primary-600">{{ $top['name'] }}</p>
                <p class="text-sm text-gray-500">Total surat: {{ $top['total'] }}</p>
            </div>
        @else
            <div class="text-center text-gray-500">
                Belum ada data surat.
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
