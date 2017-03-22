
<form action='/live' method='post' enctype='multipart/form-data'>
    {!! csrf_field() !!}
     <label>类别:</label><input type='text' name='type' /><br>
     <label>频道号:</label><input type='text' name='num' /><br>
     <label>频道名称:</label><input type='text' name='name' /><br>
    <label>url:</label><input type='text' name='url' /><br><hr>
    <input type='submit' class="btn btn-primary" id="submit" value="提交"/><br/>
</form>