@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <form action="{{ route('pagebuilder::articles.update',$article->id) }}" role="form" method="POST"  enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PUT')}}
        <pagebuilder-component class="pagebuilder-component" ref="pagebuilder" :element-types="{{$element_types}}" :old-element="{{ $article->toJson() }}" storage-path="photos"  :languages="{{$languages}}">
            <div class="panel-heading panel-default" slot="header">
                <h3 class="panel-title">Articles</h3>
                @lang('pagebuilder::crud.edit_headline')

                @include('pagebuilder::notifications')
            </div>
            <div class="panel-footer" slot="footer">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{ route('pagebuilder::articles.index') }}" class="btn btn-danger">{{ trans('pagebuilder::crud.cancel') }}</a>
                    </div>
                    <div class="col-sm-6 text-right">
                        <button type="submit" class="btn btn-success" @click.prevent="$store.dispatch('updateElement')">{{ trans('pagebuilder::crud.save') }}</button>
                    </div>
                </div>
            </div>
        </pagebuilder-component>
    </form>
</div>
@stop
