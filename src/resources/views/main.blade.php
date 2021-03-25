<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pagebuilder Dashboard') }}
        </h2>
    </x-slot>
    <div class="container xl mx-auto mt-5 py-5">
        <div class="flex flex-col relative bg-white rounded border border-gray-300">
            <div class="flex-auto p-5">
                <h3 class="mb-3 text-xl">Pagebuilder</h3>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    Elements: {{ $elements->count() }}
                </div>
                <div>
                    Languages: {{ $languages->count() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@stop