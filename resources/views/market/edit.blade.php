@extends('layouts.app')

@section('title', '编辑App')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/market">应用商店</a></div>

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
                <form action='/market/{{$market->id}}' method='post' enctype='multipart/form-data'>
                    {!! csrf_field() !!}
                    <input type='hidden' name='_method' value='put'/>
                    <label>App名称:</label><input type='text' name='appName' value='{{$market->appName}}' /><br>
                    <label>图标:</label><input type='file' name='icon_url'/><br>
                    <label>photo:</label><input type='file' name='photo_url[]'/><br>
                    <label>photo:</label><input type='file' name='photo_url[]'/><br>
                    <label>类型:</label><select name="type">
                    @foreach ($types as $type)
                        <option value="{{$type->id}}">{{$type->type_name}}</option>
                    @endforeach
                    </select><br>
                    <label>版本:</label><input type='text' name='version' value="{{$market->version}}" /><br>
                    <label>包名:</label><input type='text' name='packageName' value="{{$market->packageName}}" /><br>
                    <label>文件:</label><input type='file' name='file' /><br>
                    <label>简介:</label><input type='text' name='desc' value='{{$market->desc}}'/><br>
                    <input type='submit' value='提交'/>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
