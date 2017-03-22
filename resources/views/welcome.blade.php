@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">欢迎！</div>

                <div class="panel-body">
                     @foreach($modules as $module)
                    <a href="<?php echo $module[0]->url?>"><button class="btn"><h5><?php echo $module[0]->name?></h5></button></a>&nbsp;&nbsp;
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
