@foreach($data as $item)
<div class="left-item" url="/user_priv/{{$item->id}}" style="cursor:pointer;">{{$item->name}}</div>
@endforeach