
<h3>主题名称:{{$theme->themeName}}</h3>
<p>主题封面:
    <a href="{{$theme->themeCover}}" target="_blank"><img src = "{{$theme->themeCover}}" style="width:100px;"/></a>
</p>
<hr>
@foreach($theme->themeInfos as $info)
<p>主题ID:{{$info->themId}}
    <a href="{{$info->themeUrl}}" target="_blank"><img src = "{{$info->themeUrl}}" style="width:100px;"/></a>
</p>
<hr>
@endforeach
<a href="#" url="/theme/{{$theme->id}}/edit"><button type='button' class='btn btn-info'>编辑</button></a><br><br>
<form id="delete" action='/theme/{{$theme->id}}' method='post'> 
    {!! csrf_field() !!}
    <input type='hidden' name='_method' value='delete'/>
    <input type='submit' class='btn btn-danger' value='删除'/>
</form>
