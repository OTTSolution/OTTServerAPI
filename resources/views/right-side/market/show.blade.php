<h3>名称:{{$market->appName}}</h3>
<p>图标:<a href="{{$market->icon_url}}" target="_blank">
    <img src = "{{$market->icon_url}}" class="img-thumbnail" style="width:100px;"/>
</a></p><hr>
<p>截图:
@foreach($market->photos as $photo)
<a href="{{$photo->photo_url}}" target="_blank">
    <img src = "{{$photo->photo_url}}" class="img-thumbnail" style="width:100px;"/>
</a>
@endforeach
</p><hr>
<p>类型: {{$market->type_name}}</p>
<p>版本: {{$market->version}}</p>
<p>简介: {{$market->desc}}</p>
<p>包名：{{$market->packageName}}</p>
<a href="#" url="/market/{{$market->id}}/edit"><button type='button' class='btn btn-info'>编辑</button></a><br><br>
<form id="delete" action='/market/{{$market->id}}' method='post'> 
    {!! csrf_field() !!}
    <input type='hidden' name='_method' value='delete'/>
    <input type='submit' class='btn btn-danger' value='删除'/>
</form>
