<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Languages') }}
        </h2>
    </x-slot>
    <div class="container xl mx-auto mt-5 py-5">
        <div class="flex flex-col relative bg-white rounded border border-gray-300">
            <div class="flex-auto p-5">
                <div class="grid grid-cols-2">
                    <div>
                        <h3 class="mb-3 text-xl">Sprachen</h3>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('pagebuilder::languages.create') }}" class="btn btn-primary btn-sm float-right">
                            <i class="glyphicon glyphicon-plus"></i> @lang('pagebuilder::crud.create_button')
                        </a>
                    </div>
                </div>

                <div class="flex-auto p-5">
                    @include('pagebuilder::notifications')
                    @if($languages->isEmpty())
                    @lang('pagebuilder::crud.no_entries')
                    @else
                    <table class="w-full mb-4 text-gray-900 shadow-sm">
                        <thead>
                            <tr class="bg-gray-200 border-t border-b">
                                <th class="text-left p-2 font-bold">#</th>
                                <th class="text-left p-2 font-bold">Name</th>
                                <th class="text-left p-2 font-bold">ISO</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($languages as $lang)
                            <tr class="border-b">
                                <td class="p-2">{{ $lang->id }}</td>
                                <td class="p-2">{{ $lang->name }}</td>
                                <td class="p-2">{{ $lang->locale }}</td>
                                <td class="p-2 text-right">
                                    <a class="bg-green-500 text-white hover:bg-green-400 rounded px-2 py-1 text-xs mx-0 outline-none focus:shadow-outline" href="{{ route('pagebuilder::languages.edit',$lang->id) }}">
                                        @lang('pagebuilder::crud.edit')
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
