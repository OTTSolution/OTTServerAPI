
<p>AppId:{{$app->appId}}</p>
<h3>App名称:{{$app->appName}}</h3>
<p>App图标:<a href="{{$app->appIcon}}" target="_blank"><img src = "{{$app->appIcon}}" style="width:100px;"/></a></p>
<a href="#" url="/app/{{$app->id}}/edit"><button type='button' class='btn btn-info'>编辑</button></a><br><br>
<form id="delete" action='/app/{{$app->id}}' method='post'> 
    {!! csrf_field() !!}
    <input type='hidden' name='_method' value='delete'/>
    <input type='submit' class='btn btn-danger' value='删除'/>
</form>
