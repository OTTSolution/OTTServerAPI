
<a href="#" url="/theme/create"><button class="btn">创建新的主题</button></a><br><br>
<table class="table table-striped">
@foreach($themes as $theme)
<tr><td>
<img src="{{$theme->themeCover}}" class="img-thumbnail" style="width:120px;"/>
</td><td>
<p>主题ID:{{$theme->id}}</p>
<p>主题名称:{{$theme->themeName}}</p>
<a href="#" url="/theme/{{ $theme->id }}">详情</a><br>
</td>
@endforeach
