@extends('layouts.app')

@section('title', '直播信息')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/live">直播列表</a></div>

                <div class="panel-body">
                    <p>类型:{{$live->type}}</p>
                    <p>频道号:{{$live->num}}</p>
                    <p>频道名称:{{$live->name}}</p>
                    <p>url:<a href="{{$live->url}}">{{$live->url}}</a></p>
                    <p><a href='/live/{{$live->id}}/edit'>编辑</a><p>
                    <form action='/live/{{$live->id}}' method='post'> 
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
