<ul class="nested">
    @foreach($parent->child as $child)
    <li>
        @if ($child->child->isNotEmpty())
            {{ $child->category_name }} <span class="caret"></span>
            @include('frontend.partial.child', ['parent' => $child])
        @else
            <a href="">
                {{ $child->category_name }}
            </a>
        @endif
    </li>
    @endforeach
</ul>
