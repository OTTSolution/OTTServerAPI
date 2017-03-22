@extends('layouts.app')

@section('title', '创建Video')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/video">点播列表</a></div>
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
                <form action='/video' method='post' enctype='multipart/form-data'>
                    {!! csrf_field() !!}
                    <label>语言:</label>
                    <select class="combobox" name='lang_id'>
                    @foreach($langs as $lang)
                        <option value=<?php echo $lang->id;?>><?php echo $lang->lang_name;?></option>
                    @endforeach
                    </select><br/>
                    <label>影片编号:</label><input type='text' name='video_id' /><br>
                    <label>影片名称:</label><input type='text' name='name' /><br>
                    <label style='vertical-align:top;'>简介:</label>
                    <textarea style='vertical-align:top;' name='introduce' cols=100 rows=4>
                    </textarea><br><br>
                    <label style='vertical-align:top;'>详情:</label>
                    <textarea style='vertical-align:top;' name='detail' cols=100 rows=4>
                    </textarea><br>
                    <label>图片url</label><input type='file' name='photo_url' /><br>
                    <label>类型:</label>
                    <select class="combobox" name='type'>
                    @foreach($types as $type)
                        <option value=<?php echo $type->id;?>><?php echo $type->type_name;?></option>
                    @endforeach
                    </select><br>
                    <label>url</label><input type='text' name='url' /><br>
                    <label>高清url</label><input type='text' name='url_hd' /><br>
                    <label>超清url</label><input type='text' name='url_ud' /><br>
                    <label>权重:</label><input type='text' name='weight' /><br>
                    <label>价格:</label><input type='text' name='price' /><br>
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