
<form action='/live/{{$live->id}}' method='post' enctype='multipart/form-data'>
    {!! csrf_field() !!}
    <input type='hidden' name='_method' value='put'/>
    <label>类别:</label><input type='text' name='type' value='{{$live->type}}' required/><br>
    <label>频道号:</label><input type='text' name='num' value='{{$live->num}}' required/><br>
    <label>频道名称:</label><input type='text' name='name' value='{{$live->name}}' required/><br>
    <label>url:</label><input type='text' name='url' value='{{$live->url}}' /><br>
    <input type='submit' value='提交'/>
</form>
