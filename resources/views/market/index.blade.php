@extends('layouts.app')

@section('title', 'App')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default panel-inverse">
                <div class="panel-heading"><a href="/market">应用商店</a></div>

                <div class="panel-body">
                    <a href="/market/create?type=<?php echo $type;?>"><button class="btn">{{$type}}创建新的App</button></a><br><br>
                    <table class="table table-striped">
                    @foreach($market as $app)
                    <tr><td>
                    <img src="{{$app->icon_url}}" class="img-thumbnail" style="width:120px;"/>
                    </td><td>
                    <p>App名称:{{$app->appName}}</p>
                    <a href="/market/{{$app->id}}">详情</a>
                    <form action="post" method=""></form>
                    </td></tr>
                    @endforeach
                    </table>
                    {!! $market->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
