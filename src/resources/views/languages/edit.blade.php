<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Language') }}
        </h2>
    </x-slot>
    <div class="container xl mx-auto mt-5 py-5">
        <form action="{{ route('pagebuilder::languages.update',$language->id) }}" role="form" method="POST"  enctype="multipart/form-data">
        {{ csrf_field() }}
        {{method_field('PUT')}}
        <div class="flex flex-col relative bg-white rounded border border-gray-300">
            <div class="flex-auto p-5">
                <h3 class="mb-3 text-xl">Languages</h3>
            </div>
            <div class="flex-auto p-5">
                @include('pagebuilder::notifications')
                <div class="mb-4 grid grid-cols-2">
                    <div>
                        <label for="name" class="control-label">Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $language->name) }}">
                    </div>
                    <div>
                        <label for="locale" class="control-label">ISO</label>
                        <input id="locale" type="text" class="form-control" name="locale" value="{{ old('locale', $language->locale) }}">
                    </div>
                </div>

                <div class="bg-gray-100 rounded-b p-5">

                    <div class="grid grid-cols-2">

                        <div>
                            <a href="{{ route('pagebuilder::languages.index') }}" class="bg-red-500 hover:bg-red-400 text-white hover:text-red-100 text-normal px-3 py2 rounded">{{ trans('pagebuilder::crud.cancel') }}</a>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="bg-green-500 hover:bg-green-400 text-white hover:text-green-100 text-normal px-3 py2 rounded">{{ trans('pagebuilder::crud.save') }}</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        </form>
    </div>
</x-app-layout>
