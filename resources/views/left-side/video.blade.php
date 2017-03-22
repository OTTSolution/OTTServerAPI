@foreach($types as $type)
<div class="left-item" url="/video?type={{$type->id}}" style="cursor:pointer;">{{$type->type}}</div>
@endforeach