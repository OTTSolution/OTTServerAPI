
<form action='/app/{{$app->id}}' method='post' enctype='multipart/form-data'>
    {!! csrf_field() !!}
    <input type='hidden' name='_method' value='put'/>
    <label>AppID:</label><input type='text' name='appId' value='{{$app->appId}}' required/><br>
    <label>App名称:</label><input type='text' name='appName' value='{{$app->appName}}' required/><br>
    <label>App图标:</label><input type='file' name='appIcon' value=''/><br>
    <label>App路径:</label><input type='text' name='appPath' value='{{$app->appPath}}' required/><br>
    <input type='submit' value='提交'/>
</form>
