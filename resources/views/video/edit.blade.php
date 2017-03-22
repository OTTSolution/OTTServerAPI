@extends('layouts.app')

@section('title', '编辑Video')
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
                <form action='/video/{{$video[0]->video_id}}' method='post' enctype='multipart/form-data'>
                    {!! csrf_field() !!}
                    <input type='hidden' name='_method' value='put'/>
                    <label>语言:</label>
                    <select class="combobox" name='lang_id'>
                    @foreach($langs as $lang)
                        @if($lang->lang_name==$la)
                            <option selected="selected" value=<?php echo $lang->id;?>><?php echo $lang->lang_name;?></option>
                        @else
                            <option value=<?php echo $lang->id;?>><?php echo $lang->lang_name;?></option>
                        @endif
                    @endforeach
                    </select><br/>
                    <label>影片编号:</label><input type='text' name='video_id' value=<?php echo $video[0]->video_id;?> /><br>
                    <label>影片名称:</label><input type='text' name='name' value=<?php echo $video_desc[0]->name;?> /><br>
                    <label style='vertical-align:top;'>简介:</label>
                    <textarea style='vertical-align:top;' name='introduce' cols=100 rows=4>
                    <?php echo $video_desc[0]->introduce;?>
                    </textarea><br><br>
                    <label style='vertical-align:top;'>详情:</label>
                    <textarea style='vertical-align:top;' name='detail' cols=100 rows=4>
                    <?php echo $video_desc[0]->detail;?>
                    </textarea><br>
                    <label>图片url</label><input type='file' name='photo_url'/><br>
                    <label>类型:</label>
                    <select class="combobox" name='type'>
                    @foreach($types as $type)
                        @if($type->type_name==$ty)
                            <option selected="selected" value=<?php echo $type->id;?>><?php echo $type->type_name;?></option>
                        @else
                            <option value=<?php echo $type->id;?>><?php echo $type->type_name;?></option>
                        @endif
                    @endforeach
                    </select><br>
                    <label>url</label><input type='text' name='url' value=<?php echo $video[0]->url;?> /><br>
                    <label>高清url</label><input type='text' name='url_hd' value=<?php echo $video[0]->url_hd;?> /><br>
                    <label>超清url</label><input type='text' name='url_ud' value=<?php echo $video[0]->url_ud;?> /><br>
                    <label>权重:</label><input type='text' name='weight' value=<?php echo $video[0]->weight;?> /><br>
                    <label>价格:</label><input type='text' name='price' value=<?php echo $video[0]->price;?> /><br>
                    <input type='submit' value='提交'/>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
