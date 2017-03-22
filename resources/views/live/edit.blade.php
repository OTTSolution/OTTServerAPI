@extends('layouts.app')

@section('title', '编辑Theme')
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
                <form action='/live/{{$live->id}}' method='post' enctype='multipart/form-data'>
                    {!! csrf_field() !!}
                    <input type='hidden' name='_method' value='put'/>
                    <label>类别:</label><input type='text' name='type' value='{{$live->type}}' required/><br>
                    <label>频道号:</label><input type='text' name='num' value='{{$live->num}}' required/><br>
                    <label>频道名称:</label><input type='text' name='name' value='{{$live->name}}' required/><br>
                    <label>url:</label><input type='text' name='url' value='{{$live->url}}' /><br>
                    <input type='submit' value='提交'/>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
