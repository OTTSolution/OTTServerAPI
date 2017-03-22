@extends('layouts.app')

@section('title', 'Theme')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/theme">主题列表</a></div>

                <div class="panel-body">
                    <a href="/theme/create"><button class="btn">创建新的主题</button></a><br><br>
                    <table class="table table-striped">
                    @foreach($themes as $theme)
                    <tr><td>
                    <img src="{{$theme->themeCover}}" class="img-thumbnail" style="width:120px;"/>
                    </td><td>
                    <p>主题ID:{{$theme->id}}</p>
                    <p>主题名称:{{$theme->themeName}}</p>
                    <a href="/theme/{{ $theme->id }}">详情</a><br>
                    </td>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
