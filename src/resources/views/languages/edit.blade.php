@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <form action="{{ route('pagebuilder::languages.update',$language->id) }}" role="form" method="POST"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}

                    <div class="card-header">
                        <h5 class="card-title">@lang('pagebuilder::crud.languages')</h5>
                        @lang('pagebuilder::crud.edit_headline')
                    </div>

                    <div class="card-body">
                        @include('pagebuilder::notifications')

                        <div class="form-group">
                            <div class="row">
                                
                                <div class="col-md-8">
                                    <label for="name" class="control-label">@lang('pagebuilder::crud.labels.name')</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name',$language->name) }}">
                                </div>
                                
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                
                                <div class="col-md-8">
                                    <label for="locale" class="control-label">@lang('pagebuilder::crud.labels.iso')</label>
                                    <input id="locale" type="text" class="form-control" name="locale" value="{{ old('locale',$language->locale) }}">
                                </div>
                                
                            </div>
                            
                        </div>
                        
                        
                    </div>

                    <div class="card-footer">

                        <div class="row">

                            <div class="col-sm-6">
                                <a href="{{ route('pagebuilder::languages.index') }}" class="btn btn-danger">{{ trans('pagebuilder::crud.cancel') }}</a>
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
