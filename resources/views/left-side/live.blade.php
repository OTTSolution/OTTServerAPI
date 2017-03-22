@foreach($types as $type)
<div class="left-item" url="/live?type={{$type->id}}" style="cursor:pointer;">{{$type->type}}</div>
@endforeach