@extends('layouts.app')

@section('title', '编辑Theme')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/theme">主题列表</a></div>

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
                <form action='/theme/{{$theme->id}}' method='post' enctype='multipart/form-data'>
                    {!! csrf_field() !!}
                    <input type='hidden' name='_method' value='put'/>
                    <label>主题名称:</label><input type='text' name='themeName' value='{{$theme->themeName}}' required/><br>
                    <label>主题封面:</label><input type='file' name='themeCover' required/><br>
                    <label>主题ID:</label><input type='text' name='themeId[]' required/><br>
                    <label>主题图片:</label><input type='file' name='themeInfo[]' required/><br>
                    <label>主题ID:</label><input type='text' name='themeId[]' required/><br>
                    <label>主题图片:</label><input type='file' name='themeInfo[]' required/><br>
                    <input type='submit' value='提交'/>
                </form>
                <button id="addThemeInfo">add</button><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
