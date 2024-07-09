<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    @foreach ($items as $item)
        <li class="nav-item {{ $item->menu_open ? 'menu-open' : '' }}">
            <a href="{{ isset($item->url) ? route($item->url) : '#' }}" class="nav-link {{ $item->active ? 'active' : '' }}">
                <i class="nav-icon {{ $item->icon }}"></i>
                <p>
                    {{ $item->title }}
                    @if ($item->menuItems->isNotEmpty())
                        <i class="right fas fa-angle-left"></i>
                    @endif
                </p>
            </a>
            @if ($item->menuItems->isNotEmpty())
                <ul class="nav nav-treeview">
                    @foreach ($item->menuItems as $sub_item)
                        <li class="nav-item">
                            <a href="{{ isset($sub_item->url) ? route($sub_item->url) : '#' }}" class="nav-link {{ $sub_item->active ? 'active' : '' }}">
                                <i class="nav-icon {{$sub_item->icon}} "></i>
                                <p>{{ $sub_item->title }}</p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
