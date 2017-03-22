@extends('layouts.app')

@section('title', 'App信息')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/market">应用商店</a></div>

                <div class="panel-body">
                    <h3>名称:{{$market->appName}}</h3>
                    <p>图标:<a href="{{$market->icon_url}}">
                        <img src = "{{$market->icon_url}}" class="img-thumbnail" style="width:100px;"/>
                    </a></p><hr>
                    <p>截图:
                    @foreach($market->photos as $photo)
                    <a href="{{$photo->photo_url}}">
                        <img src = "{{$photo->photo_url}}" class="img-thumbnail" style="width:100px;"/>
                    </a>
                    @endforeach
                    </p><hr>
                    <p>类型: {{$market->type_name}}</p>
                    <p>版本: {{$market->version}}</p>
                    <p>简介: {{$market->desc}}</p>
                    <p>包名：{{$market->packageName}}</p>
                    <p><a href='/market/{{$market->id}}/edit'>编辑</a><p>
                    <form action='/market/{{$market->id}}' method='post'> 
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
