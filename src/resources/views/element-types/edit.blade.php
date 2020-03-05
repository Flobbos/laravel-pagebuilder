@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <form action="{{ route('pagebuilder::element-types.update',$element_type->id) }}" role="form" method="POST"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}

                    <div class="card-header">
                        <h5 class="card-title">@lang('pagebuilder::crud.element_types')</h5>
                        @lang('pagebuilder::crud.create_headline')
                    </div>

                    <div class="card-body">
                        
                        @include('pagebuilder::notifications')
                        <div class="form-group">
                            <label for="name">@lang('pagebuilder::crud.labels.name')</label>
                            <input class="form-control" type="text" name="name" value="{{old('name',$element_type->name)}}" />
                        </div>
                        <div class="form-group">
                            <label for="name">@lang('pagebuilder::crud.labels.component')</label>
                            <input class="form-control" type="text" name="component" value="{{old('component',$element_type->component)}}" />
                        </div>
                        <div class="form-group">
                            <label for="name">@lang('pagebuilder::crud.labels.icon')</label>
                            <input class="form-control" type="text" name="icon" value="{{old('icon',$element_type->icon)}}" />
                        </div>
                        <div class="form-group">
                            <label for="name">@lang('pagebuilder::crud.labels.sorting')</label>
                            <input class="form-control" type="text" name="sorting" value="{{old('sorting',$element_type->sorting)}}" />
                        </div>
                            
                    </div>

                    <div class="card-footer">

                        <div class="row">

                            <div class="col-sm-6">
                                <a href="{{ route('pagebuilder::element-types.index') }}" class="btn btn-danger">{{ trans('pagebuilder::crud.cancel') }}</a>
                            </div>

                            <div class="col-sm-6 text-right">
                                <button type="submit" class="btn btn-success">{{ trans('pagebuilder::crud.save') }}</button>
                            </div>

                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
@stop
