<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">

        {{-- @dd($appearance) --}}

        <div class="sidenav-header align-items-center">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                @if (isset($appearance['menu_logo']) && !empty($appearance['menu_logo']))
                    <img src="{{ resize($appearance['menu_logo'], 500) }}" class="navbar-brand-img" alt="...">
                @endif
            </a>
            <a class="mobile-close  d-xl-none" href="javascript:void(0);">
                X
            </a>
        </div>

        <div class="navbar-inner">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item mb-3">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="material-icons">dashboard</i> Dashboard
                        </a>
                    </li>

                    @php
                        use App\Models\ModulesModel;
                        use App\Models\UserModel;

                        $modules = ModulesModel::where('active', 1)
                            ->whereNull('parent')
                            ->where('action', 0)
                            ->with('children')
                            ->orderBy('position')
                            ->get()
                            ->toArray();

                        $user = UserModel::where('id', session('user')['id'])
                            ->first()
                            ->toArray();
                        $permissions = json_decode($user['permissions'], true) ?? [];
                    @endphp

                    @foreach ($modules as $module)

                        @php
                            if (count($module['children']) > 0) {
                                foreach ($module['children'] as $index => $child) {
                                    if (!in_array($child['id'], $permissions)) {
                                        unset($module['children'][$index]);
                                    }
                                }
                            }
                        @endphp

                        @if (in_array($module['id'], $permissions) || count($module['children']) > 0)
                            @if (!count($module['children']) && $module['crud'])
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.' . $module['url']) }}">
                                        <i class="material-icons">{{ $module['icon'] }}</i> {{ $module['name'] }}
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link js-open-collapse">
                                        <i class="material-icons">{{ $module['icon'] }}</i>
                                        {{ $module['name'] }}
                                        <i class="material-icons arrow">expand_more</i>
                                    </a>
                                    <div class="collapse" id="navbar-examples">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                @foreach ($module['children'] as $child)
                                                    <a class="nav-link" href="{{ route('admin.' . $child['url']) }}">
                                                        <i class="material-icons">{{ $child['icon'] }}</i>
                                                        {{ $child['name'] }}
                                                    </a>
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            @endif
                        @endif
                    @endforeach

                    <li class="nav-item mt-3">
                        <a class="nav-link" href="{{ route('admin.login.logout') }}">
                            <i class="material-icons">exit_to_app</i> Sair
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="nav-ai-form js-nav-ai-form">
        <i class="material-icons close js-ai-close">close</i>
        <form class="nav-ai-form__form js-ai-form" id="aiPromptForm">
            @csrf
            <div class="nav-ai-form__group">
                <label for="prompt" class="nav-ai-form__label">Digite o prompt:</label>
                <textarea id="prompt" name="prompt" class="nav-ai-form__textarea js-ai-prompt" rows="4"
                    placeholder="Digite sua pergunta ou comando..." required></textarea>
            </div>
            <button type="submit" class="nav-ai-form__button">Enviar</button>
        </form>

        <div class="nav-ai-form__response" id="aiResponse">
        </div>
    </div>

    <div class="nav-ai-form-feedback js-nav-ai-form-feedback">
        <p class="js-nav-ai-form-feedback-text">Mensagem de feedback</p>
    </div>

</nav>
