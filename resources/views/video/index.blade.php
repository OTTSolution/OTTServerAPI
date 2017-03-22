@extends('layouts.app')

@section('title', 'Video')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/video">点播列表</a></div>

                <div class="panel-body">
                    <a href="/video/create"><button class="btn">创建新的点播</button></a><br><br>
                    <table class="table table-striped">
                    @foreach($videos as $video)
                    <tr><td>
                    <img src="{{$video->photo_url}}" class="img-thumbnail" style="width:120px;"/>
                    </td><td>
                    <p>影片编号:{{$video->video_id}}</p>
                    <a href="/video/{{$video->video_id }}">详情</a><br>
                    </td>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
