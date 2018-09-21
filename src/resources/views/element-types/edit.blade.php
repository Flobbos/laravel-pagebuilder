@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">

                <form action="{{ route('admin.element-types.update',$element_type->id) }}" role="form" method="POST"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}

                    <div class="panel-heading panel-default">
                        @lang('crud.create_headline')
                    </div>

                    <div class="panel-body">
                        
                        @include('admin.notifications')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" value="{{old('name',$element_type->name)}}" />
                        </div>
                        <div class="form-group">
                            <label for="name">Component</label>
                            <input class="form-control" type="text" name="component" value="{{old('component',$element_type->component)}}" />
                        </div>
                        <div class="form-group">
                            <label for="name">Icon</label>
                            <input class="form-control" type="text" name="icon" value="{{old('icon',$element_type->icon)}}" />
                        </div>
                        <div class="form-group">
                            <label for="name">Sortierung</label>
                            <input class="form-control" type="text" name="sorting" value="{{old('sorting',$element_type->sorting)}}" />
                        </div>
                            
                    </div>

                    <div class="panel-footer">

                        <div class="row">

                            <div class="col-sm-6">
                                <a href="{{ route('admin.element-types.index') }}" class="btn btn-danger">{{ trans('crud.cancel') }}</a>
                            </div>

                            <div class="col-sm-6 text-right">
                                <button type="submit" class="btn btn-success">{{ trans('crud.save') }}</button>
                            </div>

                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
@stop