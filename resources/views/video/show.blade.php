@extends('layouts.app')

@section('title', '点播信息')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/video">点播列表</a></div>

                <div class="panel-body">
                    <p>语言:{{$lang}}</p>
                    <p>影片编号:{{$video[0]->video_id}}</p>
                    <p>影片名称:{{$video_desc[0]->name}}</p>
                    <p>简介:{{$video_desc[0]->introduce}}</p>
                    <p>详情:{{$video_desc[0]->detail}}</p>
                    <p>图片url:<a href="{{$video[0]->photo_url}}">{{$video[0]->photo_url}}</a></p>
                    <p>类型:{{$type}}</p>
                    <p>url:<a href="{{$video[0]->url}}">{{$video[0]->url}}</a></p>
                    <p>高清url:<a href="{{$video[0]->url_hd}}">{{$video[0]->url_hd}}</a></p>
                    <p>超清url:<a href="{{$video[0]->url_ud}}">{{$video[0]->url_ud}}</a></p>
                    <p>权重:{{$video[0]->weight}}</p>
                    <p>价格:{{$video[0]->price}}</p>
                    <p><a href='/video/{{$video[0]->video_id}}/edit'>编辑</a><p>
                    <form action='/video/{{$video[0]->video_id}}' method='post'> 
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
