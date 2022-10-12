<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Element') }}
        </h2>
    </x-slot>
    <div class="container xl mx-auto mt-5 py-5">
        <form action="{{ route('pagebuilder::element-types.store') }}" role="form" method="POST"  enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="flex flex-col relative bg-white rounded border border-gray-300">
            <div class="flex-auto p-5">
                <h3 class="mb-3 text-xl">Elemente</h3>
                @lang('pagebuilder::crud.create_headline')
            </div>
            <div class="flex-auto p-5">
                @include('pagebuilder::notifications')
                <div class="mb-4">
                    <label class="inline-block mb-2" for="name">Name</label>
                    <input class="form-control" type="text" name="name" value="{{old('name')}}" />
                </div>
                <div class="mb-4">
                    <label class="inline-block mb-2" for="name">Component</label>
                    <input class="form-control" type="text" name="component" value="{{old('component')}}" />
                </div>
                <div class="mb-4">
                    <label class="inline-block mb-2" for="name">Icon</label>
                    <input class="form-control" type="text" name="icon" value="{{old('icon')}}" />
                </div>
                <div class="mb-4">
                    <label class="inline-block mb-2" for="name">Sortierung</label>
                    <input class="form-control" type="text" name="sorting" value="{{old('sorting')}}" />
                </div>
            </div>
            <div class="bg-gray-100 rounded-b p-5">
                <div class="grid grid-cols-2">
                    <div>
                        <a href="{{ route('pagebuilder::element-types.index') }}" class="bg-red-500 hover:bg-red-400 text-white hover:text-red-100 text-normal px-3 py2 rounded">{{ trans('pagebuilder::crud.cancel') }}</a>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="bg-green-500 hover:bg-green-400 text-white hover:text-green-100 text-normal px-3 py2 rounded">{{ trans('pagebuilder::crud.save') }}</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</x-app-layout>
