@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <form action="{{ route('pagebuilder::element-types.store') }}" role="form" method="POST"  enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="card-header">
                        <h3>Elemente</h3>
                        @lang('pagebuilder::crud.create_headline')
                    </div>

                    <div class="card-body">
                        
                        @include('pagebuilder::notifications')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" value="{{old('name')}}" />
                        </div>
                        <div class="form-group">
                            <label for="name">Component</label>
                            <input class="form-control" type="text" name="component" value="{{old('component')}}" />
                        </div>
                        <div class="form-group">
                            <label for="name">Icon</label>
                            <input class="form-control" type="text" name="icon" value="{{old('icon')}}" />
                        </div>
                        <div class="form-group">
                            <label for="name">Sortierung</label>
                            <input class="form-control" type="text" name="sorting" value="{{old('sorting')}}" />
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
