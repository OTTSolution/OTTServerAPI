@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{$back}}">返回</a></div>

                <div class="panel-body">
                    {{$msg}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
