@php
    $parent = $input['parent'] ?? '';
    $name = !empty($parent) ? $parent . '[' . $input['name'] . ']' : $input['name'];
    $replaced_name = str_replace(']', '_', str_replace('[', '_', $name));
    $type = $input['type'] ?? 'text';
    $size = $input['size'] ?? 12;
    $showIAGenerate = isset($input['generate']) ? $input['generate'] : $generate;
    $showIATranslate = isset($input['ai_translation']) ? $input['ai_translation'] : $ai_translation;

@endphp

<div class="col-md-{{ $size }}" {{ isset($input['lang']) ? 'data-lang=' . $input['lang'] : '' }}>
    <div class="form-group">
        <div class="form-group-label">
            <label class="form-control-label" for="{{ $replaced_name }}">{{ $input['label'] }}</label>

            <div class="ai-features">
                <p class="translate-ai-description js-translate-ai-description">Traduzir com IA</p>
                @if (isset($showIATranslate) && !empty($showIATranslate && $translate))
                    <button type="button" class="translate-ai-button js-translate-unique-ai">
                        <span class="material-icons">language</span>
                    </button>
                @endif
                @if (isset($showIAGenerate) && !empty($showIAGenerate))
                    <div class="input-ai-icon js-generate-text-icon"
                        data-reference="{{ $name . (isset($input['lang']) ? '[' . $input['lang'] . ']' : '') }}">
                        <i class="material-icons">smart_toy</i>
                    </div>
                @endif
            </div>
        </div>
        @if (isset($input['append']) || isset($input['prepend']))
            <div class="input-group">
                @if (isset($input['prepend']))
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            {{ $input['prepend'] }}
                        </span>
                    </div>
                @endif
        @endif
        <input type="{{ $type }}"
            class="form-control @error($replaced_name . (isset($input['lang']) ? '[' . $input['lang'] . ']' : '')) is-invalid @enderror"
            id="{{ $replaced_name }}" name="{{ $name . (isset($input['lang']) ? '[' . $input['lang'] . ']' : '') }}"
            value="{{ old(isset($input['lang']) ? $name . '[' . $input['lang'] . ']' : $name, isset($input['lang']) ? $value[$name][$input['lang']] ?? '' : $value[$input['name']] ?? '') }}" />
        @error($name . (isset($input['lang']) ? '[' . $input['lang'] . ']' : ''))
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
        @if (isset($input['hint']))
            <p class="small text-muted">{{ $input['hint'] }}</p>
        @endif
        @if (isset($input['append']) || isset($input['prepend']))
            @if (isset($input['append']))
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{ $input['append'] }}
                    </span>
                </div>
            @endif
    </div>
    @endif
</div>
</div>
