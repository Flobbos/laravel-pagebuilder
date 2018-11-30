@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6">
                            Sprachen
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('pagebuilder::languages.create') }}" class="btn btn-default btn-sm pull-right">
                                <i class="glyphicon glyphicon-plus"></i> @lang('pagebuilder::crud.create_button')
                            </a>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    @include('pagebuilder::notifications')
                    @if($languages->isEmpty())
                    @lang('crud.no_entries')
                    @else
                    <table class="table table-striped">
                        <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>ISO</th>
                        <th></th>
                        </thead>
                        <tbody>
                            @foreach($languages as $lang)
                            <tr>
                                <td>{{ $lang->id }}</td>
                                <td>{{ $lang->name }}</td>
                                <td>{{ $lang->locale }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary pull-right" href="{{ route('languages.edit',$lang->id) }}">
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
</div>
<simplert ref="simplert"></simplert>
@stop
