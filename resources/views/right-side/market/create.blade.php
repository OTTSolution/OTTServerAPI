
<form action='/market' method='post' enctype='multipart/form-data'>
    {!! csrf_field() !!}
    <label>App名称:</label><input type='text' name='appName' placeholder='App名称' required/><br>
    <label>图标:</label><input type='file' name='icon_url' required/><br>
    <label>photo:</label><input type='file' name='photo_url[]' required/><br>
    <label>photo:</label><input type='file' name='photo_url[]' required/><br>
    <label>photo:</label><input type='file' name='photo_url[]' required/><br>
    <label>类型:</label><select name="type">
    @foreach ($types as $type)
        @if($type->id==$ty)
            <option value="{{ $type->id }}" selected="selected">{{$type->type_name}}</option>
        @else
            <option value="{{ $type->id }}">{{$type->type_name}}</option>
        @endif
    @endforeach
    </select><br>
    <label>简介:</label><textarea name="desc" rows="5" cols="30" maxlength="255"></textarea><br>
    <label>版本:</label><input type="text" name="version" required/><br>
    <label>文件:</label><input type="file" name="file" required/><br>
    <label>包名:</label><input type="text" name="packageName" required/><br>
    <input type='submit' value="提交" />
</form>
