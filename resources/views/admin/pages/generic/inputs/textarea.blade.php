@php
    $name = $input['name'];
    $size = $input['size'] ?? 12;
    $heigth = $input['heigth'] ?? 100;
    $inline = isset($input['inline']) ? $input['inline'] : false;
    $richtext = isset($input['richtext']) ? $input['richtext'] : (!$inline ? true : false);
    $showIAFeatures = isset($input['generate']) ? $input['generate'] : $generate;

@endphp

<div class="col-md-{{ $size }}" {{ isset($input['lang']) ? 'data-lang=' . $input['lang'] : '' }}>
    <div class="form-group">
        <div class="form-group-label">
            <label class="form-control-label"
                for="{{ $name . (isset($input['lang']) ? '_' . $input['lang'] : '') }}">{{ $input['label'] }}</label>
            @if (isset($showIAFeatures) && !empty($showIAFeatures))
                <div class="ai-features">
                    <p class="translate-ai-description js-translate-ai-description">Traduzir com IA</p>
                    <button type="button" class="translate-ai-button js-translate-unique-ai">
                        <span class="material-icons">language</span>
                    </button>
                    <div class="input-ai-icon js-generate-text-icon"
                        data-reference="{{ $name . (isset($input['lang']) ? '[' . $input['lang'] . ']' : '') }}">
                        <i class="material-icons">smart_toy</i>
                    </div>
                </div>
            @endif
        </div>
        <textarea
            class="form-control {{ $richtext ? 'ckeditor_' . $name . (isset($input['lang']) ? '_' . $input['lang'] : '') : '' }} @error($name) is-invalid @enderror"
            style="height: {{ $heigth }}px;" id="{{ $name . (isset($input['lang']) ? '_' . $input['lang'] : '') }}"
            name="{{ $name . (isset($input['lang']) ? '[' . $input['lang'] . ']' : '') }}">{{ old(isset($input['lang']) ? $name . '[' . $input['lang'] . ']' : $name, isset($input['lang']) ? $value[$name][$input['lang']] ?? '' : $value[$name] ?? '') }}</textarea>
        @error($name)
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
        @if (isset($input['hint']))
            <p class="small text-muted">{{ $input['hint'] }}</p>
        @endif
    </div>
</div>

@if ($richtext)
    <script>
        CKEDITOR.replace('{{ $name . (isset($input['lang']) ? '_' . $input['lang'] : '') }}', {
            forcePasteAsPlainText: true,
            pasteFromWordPromptCleanup: true,
            pasteFromWordRemoveFontStyles: true,
            ignoreEmptyParagraph: true,
            removeFormatAttributes: true,
            filebrowserUploadUrl: "{{ route('ck.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: "form",
            removeDialogTabs: 'image:advanced;link:advanced',
            versionCheck: false
        });
    </script>
@endif

@if ($inline)
    <script>
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.inline('{{ $name . (isset($input['lang']) ? '_' . $input['lang'] : '') }}', {
            toolbar: [{
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', '-']
                },
                {
                    name: 'links',
                    items: ['Link']
                },
                {
                    name: 'paragraph',
                    groups: ['list'],
                    items: ['NumberedList', 'BulletedList']
                },
            ],
            forcePasteAsPlainText: true,
            pasteFromWordPromptCleanup: true,
            pasteFromWordRemoveFontStyles: true,
            ignoreEmptyParagraph: true,
            removeFormatAttributes: true,
            autoParagraph: false,
            enterMode: CKEDITOR.ENTER_BR,
            versionCheck: false
        });
    </script>
@endif
