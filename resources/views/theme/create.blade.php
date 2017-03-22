@extends('layouts.app')

@section('title', '创建Theme')

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
                <form action='/theme' method='post' enctype='multipart/form-data'>
                    {!! csrf_field() !!}
                    <label>主题名称:</label><input type='text' name='themeName' /><br>
                    <label>主题封面</label><input type='file' name='themeCover' /><br><hr>
                    <div style="clear: both">
                        <button type="button" class="btn btn-primary add-theme" id="addThemeInfo">增加应用主题</div>
                    </div>
                    <input type='submit' class="btn btn-primary" id="submit" value="提交"/><br/>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"></script>
@endsection

@section('script')
<script type="text/javascript" src="/static/js/check.js"></script>
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="/static/css/theme.css">
@endsection