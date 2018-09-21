@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">

                <form action="{{ route('admin.languages.store') }}" role="form" method="POST"  enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="panel-heading panel-default">
                        @lang('crud.create_headline')
                    </div>

                    <div class="panel-body">
                        @include('admin.notifications')

                        <div class="form-group">
                            <div class="row">
                                
                                <div class="col-md-8">
                                    <label for="name" class="control-label">Name</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                                
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                
                                <div class="col-md-8">
                                    <label for="locale" class="control-label">ISO</label>
                                    <input id="locale" type="text" class="form-control" name="locale" value="{{ old('locale') }}">
                                </div>
                                
                            </div>
                            
                        </div>
                        
                        
                    </div>

                    <div class="panel-footer">

                        <div class="row">

                            <div class="col-sm-6">
                                <a href="{{ route('admin.languages.index') }}" class="btn btn-danger">{{ trans('crud.cancel') }}</a>
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