@extends('layouts.app')

@section('title', '创建App')
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
                <form action='/app' method='post' enctype='multipart/form-data'>
                    {!! csrf_field() !!}
                    <label>AppID:</label><input type='text' name='appId' placeholder='AppID' required/><br>
                    <label>App名称:</label><input type='text' name='appName' placeholder='App名称' required/><br>
                    <label>App图标</label><input type='file' name='appIcon' required/><br>
                    <label>App路径：</label><input type='text' name='appPath' placeholder='App路径' required/><br>
                    <input type='submit' value="提交" />
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
