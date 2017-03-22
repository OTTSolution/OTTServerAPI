@extends('layouts.app')

@section('title', '创建App')
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
                <form action='/market' method='post' enctype='multipart/form-data'>
                    {!! csrf_field() !!}
                    <label>App名称:</label><input type='text' name='appName' placeholder='App名称' required/><br>
                    <label>图标:</label><input type='file' name='icon_url' required/><br>
                    <label>photo:</label><input type='file' name='photo_url[]' required/><br>
                    <label>photo:</label><input type='file' name='photo_url[]' required/><br>
                    <label>photo:</label><input type='file' name='photo_url[]' required/><br>
                    <label>类型:</label><select name="type">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{$type->type_name}}</option>
                    @endforeach
                    </select><br>
                    <label>简介:</label><textarea name="desc" rows="5" cols="30" maxlength="255"></textarea><br>
                    <label>版本:</label><input type="text" name="version" required/><br>
                    <label>文件:</label><input type="file" name="file" required/><br>
                    <label>包名:</label><input type="text" name="packageName" required/><br>
                    <input type='submit' value="提交" />
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
