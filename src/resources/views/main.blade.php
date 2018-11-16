@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Pagebuilder</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            Elements: {{ $elements->count() }}
                        </div>
                        <div class="col-sm-6">
                            Languages: {{ $languages->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop