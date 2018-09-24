@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('articles.update',$project->id) }}" role="form" method="POST"  enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PUT')}}
        <pagebuilder ref="pagebuilder" :element-types="{{$element_types}}" :old-element="{{ $project->toJson() }}" storage-path="{{$storage_path}}"  :languages="{{$languages}}">
            <div class="panel-heading panel-default" slot="header">
                <h3 class="panel-title">Projekte</h3>
                @lang('pagebuilder::crud.edit_headline')

                @include('pagebuilder::notifications')
            </div>
            <div class="panel-footer" slot="footer">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{ route('articles.index') }}" class="btn btn-danger">{{ trans('pagebuilder::crud.cancel') }}</a>
                    </div>
                    <div class="col-sm-6 text-right">
                        <button type="submit" class="btn btn-success" @click.prevent="$store.dispatch('updateElement')">{{ trans('pagebuilder::crud.save') }}</button>
                    </div>
                </div>
            </div>
        </pagebuilder>
    </form>
</div>
@stop
