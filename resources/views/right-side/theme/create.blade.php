
<form action='/theme' method='post' enctype='multipart/form-data'>
    {!! csrf_field() !!}
    <label>主题名称:</label><input type='text' name='themeName' required /><br>
    <label>主题封面</label><input type='file' name='themeCover' required /><br><hr>
    <button type="button" class="btn btn-primary add-theme" id="addThemeInfo">增加应用主题</button>
    <div style="clear: both; width: 100%;"></div><hr>
    <input type='submit' class="btn btn-primary" id="submit" value="提交"/><br/>
</form>
<script type="text/javascript" src="/static/js/check.js"></script>
<link rel="stylesheet" type="text/css" href="/static/css/theme.css">