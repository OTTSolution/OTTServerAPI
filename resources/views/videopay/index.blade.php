<table class="table table-striped">
<tr>
<td>设备名</td>
<td>影片编号</td>
<td>付款时间</td>
</tr>
@foreach($video_pays as $video_pay)
<tr>
<td><?php echo $video_pay->user_id?></td>
<td><?php echo $video_pay->video_id?></td>
<td><?php echo $video_pay->pay_time?></td>
</tr>
@endforeach
</table>