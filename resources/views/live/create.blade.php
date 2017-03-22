@extends('layouts.app')

@section('title', '创建Live')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/live">直播列表</a></div>

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
                <form action='/live' method='post' enctype='multipart/form-data'>
                    {!! csrf_field() !!}
                     <label>类别:</label><input type='text' name='type' /><br>
                     <label>频道号:</label><input type='text' name='num' /><br>
                     <label>频道名称:</label><input type='text' name='name' /><br>
                    <label>url:</label><input type='text' name='url' /><br><hr>
                    <input type='submit' class="btn btn-primary" id="submit" value="提交"/><br/>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/static/js/check.js"></script>
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="/static/css/theme.css">
@endsection