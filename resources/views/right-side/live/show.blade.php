
<p>类型:{{$live->type}}</p>
<p>频道号:{{$live->num}}</p>
<p>频道名称:{{$live->name}}</p>
<p>url:<a href="#" url="{{$live->url}}">{{$live->url}}</a></p>
<a href="#" url="/live/{{$live->id}}/edit"><button type='button' class='btn btn-info'>编辑</button></a><br><br>
<form id="delete" action='/live/{{$live->id}}' method='post'> 
    {!! csrf_field() !!}
    <input type='hidden' name='_method' value='delete'/>
    <input type='submit' class='btn btn-danger' value='删除'/>
</form>
