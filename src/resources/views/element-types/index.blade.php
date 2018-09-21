@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="panel-title">Elemente</h3>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('admin.element-types.create') }}" class="btn btn-default btn-small pull-right">
                                <i class="glyphicon glyphicon-plus"></i> @lang('crud.create_button')
                            </a>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    @include('admin.notifications')
                    @if($element_types->isEmpty())
                    @lang('crud.no_entries')
                    @else
                    <table class="table table-striped">
                        <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th></th>
                        </thead>
                        <tbody>
                            @foreach($element_types as $element_type)
                            <tr>
                                <td>{{$element_type->sorting}}</td>
                                <td>{{$element_type->name}}</td>
                                <td>
                                    <div class="btn-group pull-right" role="group">
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.element-types.edit',$element_type->id) }}">
                                            <i class="glyphicon glyphicon-pencil"></i> @lang('crud.edit')
                                        </a>
                                        <form class="btn-group"
                                            action="{{ route('admin.element-types.destroy',$element_type->id) }}"
                                            method="POST" v-on:submit.prevent="confirmDelete">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-sm btn-danger"
                                                    type="submit"><i class="glyphicon glyphicon-trash"></i> @lang('crud.delete')</button>
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