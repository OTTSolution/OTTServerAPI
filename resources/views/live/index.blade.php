@extends('layouts.app')

@section('title', 'Live')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/live">直播列表</a></div>

                <div class="panel-body">
                    <a href="/live/create"><button class="btn">创建新的直播</button></a><br><br>
                    <table class="table table-striped">
                    @foreach($lives as $live)
                    <tr><td>
                    <img src="{{$live->url}}" class="img-thumbnail" style="width:120px;"/>
                    </td><td>
                    <p>频道号:{{$live->num}}</p>
                    <p>频道名称:{{$live->name}}</p>
                    <a href="/live/{{ $live->id }}">详情</a><br>
                    </td>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
