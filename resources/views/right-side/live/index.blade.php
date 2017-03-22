
<a href="#" url="/live/create"><button class="btn">创建新的直播</button></a><br><br>
<table class="table table-striped">
@foreach($lives as $live)
<tr><td>
<img src="{{$live->url}}" class="img-thumbnail" style="width:120px;"/>
</td><td>
<p>频道号:{{$live->num}}</p>
<p>频道名称:{{$live->name}}</p>
<a href="#" url="/live/{{ $live->id }}">详情</a><br>
</td>
@endforeach
</table>
