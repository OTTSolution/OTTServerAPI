
<form action='/app' method='post' enctype='multipart/form-data'>
    {!! csrf_field() !!}
    <label>AppID:</label><input type='text' name='appId' placeholder='AppID' required/><br>
    <label>App名称:</label><input type='text' name='appName' placeholder='App名称' required/><br>
    <label>App图标</label><input type='file' name='appIcon' required/><br>
    <label>App路径：</label><input type='text' name='appPath' placeholder='App路径' required/><br>
    <input type='submit' class="btn btn-primary" id="submit" value="提交"/><br/>
</form>
