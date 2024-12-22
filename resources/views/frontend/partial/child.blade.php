<ul class="nested">
    @foreach($parent->child as $child)
    @if(count($child->child)>0)
    <li>
        {{$child->category_name}} <span class="caret"></span>
        @include('frontend.partial.child',['parent'=>$child])
    </li>
    @else
    <li>
        {{$child->category_name}} <span class="caret"></span>
    </li>
    @endif
    @endforeach
</ul>