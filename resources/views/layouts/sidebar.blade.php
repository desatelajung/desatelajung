<aside class="sidebar" id="sidebar">
    <ul class="list-unstyled components">
        @foreach ($menus as $menu)
            <li>
                @if ($menu->submenus->isNotEmpty())
                    <a href="#{{ $menu->name }}Submenu" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">{{ $menu->name }}</a>
                    <ul class="collapse list-unstyled" id="{{ $menu->name }}Submenu">
                        @foreach ($menu->submenus as $submenu)
                            <li>
                                <a href="{{ $submenu->link }}">{{ $submenu->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <a href="{{ $menu->link }}">{{ $menu->name }}</a>
                @endif
            </li>
        @endforeach
    </ul>
</aside>
