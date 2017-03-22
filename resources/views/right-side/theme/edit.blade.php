
<form action='/theme/{{$theme->id}}' method='post' enctype='multipart/form-data'>
    {!! csrf_field() !!}
    <input type='hidden' name='_method' value='put'/>
    <label>主题名称:</label><input type='text' name='themeName' value='{{$theme->themeName}}' required/><br>
    <label>主题封面:</label><input type='file' name='themeCover' /><hr>
    <button type="button" class="btn btn-primary add-theme" id="addThemeInfo">增加应用主题</button>
    <div style="clear: both; width: 100%;"></div><hr>
    <input type='submit' value='提交'/>
</form>
<script type="text/javascript" src="/static/js/check.js"></script>
<link rel="stylesheet" type="text/css" href="/static/css/theme.css">
