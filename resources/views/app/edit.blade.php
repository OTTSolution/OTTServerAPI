@extends('layouts.app')

@section('title', '编辑App')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/app">App列表</a></div>

                <div class="panel-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action='/app/{{$app->id}}' method='post' enctype='multipart/form-data'>
                    {!! csrf_field() !!}
                    <input type='hidden' name='_method' value='put'/>
                    <label>AppID:</label><input type='text' name='appId' value='{{$app->appId}}' required/><br>
                    <label>App名称:</label><input type='text' name='appName' value='{{$app->appName}}' required/><br>
                    <label>App图标:</label><input type='file' name='appIcon' value=''/><br>
                    <label>App路径:</label><input type='text' name='appPath' value='{{$app->appPath}}' required/><br>
                    <input type='submit' value='提交'/>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
