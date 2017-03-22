@extends('layouts.app')

@section('title', 'Theme信息')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/theme">主题列表</a></div>

                <div class="panel-body">
                    <h3>主题名称:{{$theme->themeName}}</h3>
                    <p>主题封面:<a href="{{$theme->themeCover}}"><img src = "{{$theme->themeCover}}" style="width:100px;"/></a></p>
                    <hr>
                    @foreach($theme->themeInfos as $info)
                        <p>主题ID:{{$info->themId}}<a href="{{$info->themeUrl}}"><img src = "{{$info->themeUrl}}" style="width:100px;"/></a></p>
                        <hr>
                    @endforeach
                    <p><a href='/theme/{{$theme->id}}/edit'>编辑</a><p>
                    <form action='/theme/{{$theme->id}}' method='post'> 
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
