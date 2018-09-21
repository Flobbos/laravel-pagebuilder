@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">

                <form action="{{ route('languages.update',$language->id) }}" role="form" method="POST"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}

                    <div class="panel-heading panel-default">
                        @lang('pagebuilder::crud.edit_headline')
                    </div>

                    <div class="panel-body">
                        @include('pagebuilder::notifications')

                        <div class="form-group">
                            <div class="row">
                                
                                <div class="col-md-8">
                                    <label for="name" class="control-label">Name</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name',$language->name) }}">
                                </div>
                                
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                
                                <div class="col-md-8">
                                    <label for="locale" class="control-label">ISO</label>
                                    <input id="locale" type="text" class="form-control" name="locale" value="{{ old('locale',$language->locale) }}">
                                </div>
                                
                            </div>
                            
                        </div>
                        
                        
                    </div>

                    <div class="panel-footer">

                        <div class="row">

                            <div class="col-sm-6">
                                <a href="{{ route('languages.index') }}" class="btn btn-danger">{{ trans('pagebuilder::crud.cancel') }}</a>
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