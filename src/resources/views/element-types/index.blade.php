@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row d-flex align-items-center">
                        <div class="col-sm-6">
                            <h5 class="card-title mb-0">@lang('pagebuilder::crud.element_types')</h5>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{ route('pagebuilder::element-types.create') }}" class="btn btn-primary btn-sm">
                                <i class="glyphicon glyphicon-plus"></i> @lang('pagebuilder::crud.create_button')
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('pagebuilder::notifications')
                    @if($element_types->isEmpty())
                    @lang('pagebuilder::crud.no_entries')
                    @else
                    <table class="table table-striped">
                        <thead>
                        <th>#</th>
                        <th>@lang('pagebuilder::crud.labels.name')</th>
                        <th></th>
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
                                            method="POST" v-on:submit.prevent="confirmDelete">
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
    </div>
</div>
<simplert ref="simplert"></simplert>
@stop
