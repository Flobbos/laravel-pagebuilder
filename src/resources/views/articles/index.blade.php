@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="panel-title">Projekte</h3>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('pagebuilder::articles.create') }}" class="btn btn-default btn-small pull-right">
                                <i class="glyphicon glyphicon-plus"></i> @lang('pagebuilder::crud.create_button')
                            </a>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    @include('pagebuilder::notifications')
                    @if($articles->isEmpty())
                    @lang('pagebuilder::crud.no_entries')
                    @else
                    <table class="table table-striped">
                        <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th></th>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                            <tr>
                                <td>{{$article->id}}</td>
                                <td>{{$article->name}}</td>
                                <td>
                                    <div class="btn-group pull-right" role="group">
                                        <a class="btn btn-sm btn-primary" href="{{ route('pagebuilder::articles.edit',$article->id) }}">
                                            <i class="glyphicon glyphicon-pencil"></i> @lang('pagebuilder::crud.edit')
                                        </a>
                                        <form class="btn-group"
                                            action="{{ route('pagebuilder::articles.destroy',$article->id) }}"
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