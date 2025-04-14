@php

    $componentsPath = base_path('resources/views/admin/pages/dynamics/components.json');
    $compoentsString = file_get_contents($componentsPath);
    $componentsGroup = json_decode($compoentsString, true);

@endphp

<nav
    class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white dynamic-sidebar js-dynamic-sidebar">
    <a href="" class="position-absolute top-2 right-2 js-close-dynamic-sidebar">
        <i class="material-icons">close</i>
    </a>
    <div class="scrollbar-inner">
        <div class="navbar-inner">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <h1 class="mt-3 text-center">Componentes</h1>
                <ul class="navbar-nav">
                    @foreach ($componentsGroup as $group)
                        <li class="nav-item">
                            <a class="nav-link js-open-collapse">
                                <i class="material-icons">{{$group['icon']}}</i>
                                {{$group['title']}}
                                <i class="material-icons arrow">expand_more</i>
                            </a>
                            <div class="collapse" id="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        @foreach ($group['components'] as $component)
                                            <a class="nav-link js-select-component" data-component="{{ slugify($component['type']) }}" href="">
                                                <i class="material-icons">{{$component['icon']}}</i> {{$component['title']}}
                                            </a>
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</nav>

