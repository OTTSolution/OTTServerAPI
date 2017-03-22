@extends('layouts.app')

@section('title', 'App')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/app">App列表</a></div>

                <div class="panel-body">
                    <a href="/app/create"><button class="btn">创建新的App</button></a><br><br>
                    <table class="table table-striped">
                    @foreach($apps as $app)
                    <tr><td>
                    <img src="{{$app->appIcon}}" class="img-thumbnail" style="width:120px;"/>
                    </td><td>
                    <p>AppID:{{$app->appId}}</p>
                    <p>App名称:{{$app->appName}}</p>
                    <a href="/app/{{$app->id}}">详情</a>
                    </td></tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
