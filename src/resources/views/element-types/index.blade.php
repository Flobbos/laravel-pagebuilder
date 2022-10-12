<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Element') }}
        </h2>
    </x-slot>
    <div class="container xl mx-auto mt-5 py-5">
        <div class="flex flex-col relative bg-white rounded border border-gray-300">
            <div class="flex-auto p-5">
                <div class="grid grid-cols-2">
                    <div>
                        <h3 class="mb-3 text-xl">Elemente</h3>
                    </div>
                    <div>
                        <a href="{{ route('pagebuilder::element-types.create') }}" class="bg-blue-500 hover:bg-blue-400 text-white hover:text-blue-100 text-normal px-3 py2 rounded">
                            @lang('pagebuilder::crud.create_button')
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex-auto p-5">
                @include('pagebuilder::notifications')
                @if($element_types->isEmpty())
                @lang('pagebuilder::crud.no_entries')
                @else
                <table class="w-full mb-4 text-gray-900 shadow-sm">
                    <thead>
                        <tr class="bg-gray-200 border-t border-b">
                            <th class="text-left p-2 font-bold">#</th>
                            <th class="text-left p-2 font-bold">Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($element_types as $element_type)
                        <tr class="border-b">
                            <td class="p-2">{{$element_type->sorting}}</td>
                            <td class="p-2">{{$element_type->name}}</td>
                            <td class="text-right p-2">
                                <div class="flex justify-end rounded-lg text-xs mb-1" role="group">
                                    <a class="bg-blue-500 text-white hover:bg-blue-400 rounded-l-lg px-2 py-1 text-xs mx-0 outline-none focus:shadow-outline" href="{{ route('pagebuilder::element-types.edit',$element_type->id) }}">
                                        @lang('pagebuilder::crud.edit')
                                    </a>
                                    <form
                                        action="{{ route('pagebuilder::element-types.destroy',$element_type->id) }}"
                                        method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="bg-red-500 text-white hover:bg-red-400 rounded-r-lg px-2 py-1 text-xs mx-0 outline-none focus:shadow-outline"
                                                type="submit">@lang('pagebuilder::crud.delete')</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
