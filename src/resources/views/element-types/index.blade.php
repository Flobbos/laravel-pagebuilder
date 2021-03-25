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
                        <h3>Elemente</h3>
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($element_types as $element_type)
                        <tr>
                            <td>{{$element_type->sorting}}</td>
                            <td>{{$element_type->name}}</td>
                            <td>
                                <div class="btn-group float-right" role="group">
                                    <a class="btn btn-sm btn-primary" href="{{ route('pagebuilder::element-types.edit',$element_type->id) }}">
                                        <i class="glyphicon glyphicon-pencil"></i> @lang('pagebuilder::crud.edit')
                                    </a>
                                    <form class="btn-group"
                                        action="{{ route('pagebuilder::element-types.destroy',$element_type->id) }}"
                                        method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-sm btn-danger"
                                                type="submit"><i class="glyphicon glyphicon-trash"></i> @lang('pagebuilder::crud.delete')</button>
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
@stop
