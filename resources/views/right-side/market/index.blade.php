
<a href="#" url="/market/create?type=<?php echo $type;?>"><button class="btn">创建新的App</button></a><br><br>
<table class="table table-striped">
@foreach($market as $app)
<tr><td>
<img src="{{$app->icon_url}}" class="img-thumbnail" style="width:120px;"/>
</td><td>
<p>App名称:{{$app->appName}}</p>
<a href="#" url="/market/{{$app->id}}">详情</a>
<form action="post" method=""></form>
</td></tr>
@endforeach
</table>
{!! $market->links() !!}
