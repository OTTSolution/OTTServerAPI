
<p>语言:{{$lang}}</p>
<p>影片编号:{{$video[0]->video_id}}</p>
<p>影片名称:{{$video_desc[0]->name}}</p>
<p>简介:{{$video_desc[0]->introduce}}</p>
<p>详情:{{$video_desc[0]->detail}}</p>
<p>图片url:<a href="#" url="{{$video[0]->photo_url}}">{{$video[0]->photo_url}}</a></p>
<p>类型:{{$type}}</p>
<p>url:<a href="#" url="{{$video[0]->url}}">{{$video[0]->url}}</a></p>
<p>高清url:<a href="#" url="{{$video[0]->url_hd}}">{{$video[0]->url_hd}}</a></p>
<p>超清url:<a href="#" url="{{$video[0]->url_ud}}">{{$video[0]->url_ud}}</a></p>
<p>权重:{{$video[0]->weight}}</p>
<p>价格:{{$video[0]->price}}</p>
<a href="#" url="/video/{{$video[0]->video_id}}/edit"><button type='button' class='btn btn-info'>编辑</button></a><br><br>
<form id="delete" action='/video/{{$video[0]->video_id}}' method='post'> 
    {!! csrf_field() !!}
    <input type='hidden' name='_method' value='delete'/>
    <input type='submit' class='btn btn-danger' value='删除'/>
</form>
