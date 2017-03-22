
<a href="#" url="/video/create?type=<?php echo $type;?>"><button class="btn">创建新的点播</button></a><br><br>
<table class="table table-striped">
@foreach($videos as $video)
<tr><td>
<img src="{{$video->photo_url}}" class="img-thumbnail" style="width:120px;"/>
</td><td>
<p>影片编号:{{$video->video_id}}</p>
<a href="#" url="/video/{{$video->video_id }}">详情</a><br>
</td>
@endforeach
