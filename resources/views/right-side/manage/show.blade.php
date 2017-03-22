<h4>权限设置</h4><br>
<form action="/user_priv/{{$id}}" method="post">
<input type="hidden" name="_method" value="put">
@foreach($items as $item)
<input type="checkbox" name="priv[]" value="{{$item->id}}" @if($item->check) checked="checked" @endif />{{$item->name}}<br>
@endforeach
<br><input type="submit" class="btn btn-primary" value="保存">
</form>