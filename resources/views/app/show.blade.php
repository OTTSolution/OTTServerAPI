@extends('layouts.app')

@section('title', 'App信息')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/app">App列表</a></div>

                <div class="panel-body">
                    <p>AppId:{{$app->appId}}</p>
                    <h3>App名称:{{$app->appName}}</h3>
                    <p>App图标:<a href="{{$app->appIcon}}"><img src = "{{$app->appIcon}}" style="width:100px;"/></a></p>
                    <p><a href='/app/{{$app->id}}/edit'>编辑</a><p>
                    <form action='/app/{{$app->id}}' method='post'> 
                        {!! csrf_field() !!}
                        <input type='hidden' name='_method' value='delete'/>
                        <input type='submit' value='删除'/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
