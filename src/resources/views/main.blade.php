@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>Pagebuilder</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            @lang('pagebuilder::crud.element_types'): {{ $elements->count() }}
                        </div>
                        <div class="col-sm-6">
                            @lang('pagebuilder::crud.languages'): {{ $languages->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
