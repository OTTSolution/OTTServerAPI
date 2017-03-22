
<a href="#" url="/app/create"><button class="btn">创建新的App</button></a><br><br>
<table class="table table-striped">
@foreach($apps as $app)
<tr><td>
<img src="{{$app->appIcon}}" class="img-thumbnail" style="width:120px;"/>
</td><td>
<p>AppID:{{$app->appId}}</p>
<p>App名称:{{$app->appName}}</p>
<a href="#" url="/app/{{$app->id}}">详情</a>
</td></tr>
@endforeach
</table>
