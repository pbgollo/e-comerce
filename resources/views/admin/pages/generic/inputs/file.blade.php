@php
    $name = $input['name'];
    $size = $input['size'] ?? 12;
    $width = $input['width'] ?? 250;
    $hasAlt = $input['alt'] ?? false;
    $type = $input['type'] ?? '*';
    $accept = $type === 'image' ? 'image/*' : ($type === 'file' ? '.pdf,.doc,.docx,.txt,.xls,.xlsx' : '*');
    $isTranslatable = isset($input['lang']);

    if(!isset($input['parent'])){
        $val = $value[$name] ?? null;
    }else{
        $val = $value[$input['name']] ?? null;
    }

    // Handle both string and array values
    $currentVal = '';
    $currentAlt = '';
    if (is_array($val)) {
        if ($isTranslatable) {
            $currentVal = $val[$input['lang']] ?? '';
            $currentAlt = $hasAlt ? ($val[$input['lang'].'_alt'] ?? '') : '';
        } else {
            $currentVal = $val['file'] ?? $val;
            $currentAlt = $hasAlt ? ($val['alt'] ?? '') : '';
        }
    } else {
        $currentVal = $val ?? '';
        $currentAlt = '';
    }

    // Check if file is an image
    $isImage = false;
    if (!empty($currentVal)) {
        $extension = strtolower(pathinfo($currentVal, PATHINFO_EXTENSION));
        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
    }
@endphp

<div class="col-md-{{$size}}" {{ $isTranslatable ? 'data-lang='.$input['lang'] : ''}}>
    <label class="form-control-label">{{$input['label']}}</label>
    <div style="width: {{$width}}px;" class="mb-3">
        @if(!empty($currentVal))
            <div class="preview-container mb-2" data-input="{{ $name }}">
                <div class="file-preview">
                    @if($isImage)
                        <img src="{{ asset('storage/'.$currentVal) }}" alt="{{ $currentAlt }}" style="max-width: 100%; max-height: 200px; object-fit: contain;">
                    @else
                        <i class="material-icons" style="font-size: 48px;">insert_drive_file</i>
                    @endif
                    <p class="file-name">{{ basename($currentVal) }}</p>
                </div>
                @if($hasAlt)
                <div class="form-group mt-2">
                    <input type="text"
                        class="form-control"
                        placeholder="Texto alternativo"
                        name="{{ $name.($isTranslatable ? '['.$input['lang'].'_alt]' : '_alt') }}"
                        value="{{ $currentAlt }}">
                </div>
                @endif
            </div>
        @endif
        <div class="row m-0">
            <div class="col p-0">
                <div class="form-group m-0">
                    <label class="w-100" for="{{$name.($isTranslatable ? '_'.$input['lang'] : '' )}}">
                        <a class="btn btn-block btn-sm btn-success">
                            <i class="material-icons text-white" style="font-size: 15px;">cloud_upload</i>
                        </a>
                    </label>
                    <input type="file" style="display: none"
                        id="{{$name.($isTranslatable ? '_'.$input['lang'] : '' )}}"
                        name="{{ $name.($isTranslatable ? '['.$input['lang'].']' : '') }}"
                        accept="{{ $accept }}"
                        value="{{old($isTranslatable ? $name.'['.$input['lang'].']' : $name, $currentVal)}}"/>
                    <input type="hidden"
                        name="{{ $name.($isTranslatable ? '['.$input['lang'].'_remove]' : '_remove') }}"
                        value="0"
                        class="remove-flag">
                </div>
            </div>
            <div class="col p-0 action-buttons" style="{{ !empty($currentVal) ? '' : 'display: none;' }}">
                <a href="{{ !empty($currentVal) ? asset('storage/'.$currentVal) : '#' }}" target="_blank" class="btn btn-block btn-sm btn-secondary view-file">
                    <i class="material-icons text-white" style="font-size: 15px;">visibility</i>
                </a>
            </div>
            <div class="col p-0 action-buttons" style="{{ !empty($currentVal) ? '' : 'display: none;' }}">
                <a href="javascript:void(0);" class="btn btn-block btn-sm btn-danger remove-file">
                    <i class="material-icons text-white" style="font-size: 15px;">delete</i>
                </a>
            </div>
        </div>

        @error($name)
            <span class="invalid-feedback d-block">{{$message}}</span>
        @enderror
        @if(isset($input['hint']))
            <p class="small text-muted">{{$input['hint']}}</p>
        @endif
    </div>
</div>

<style>
.preview-container {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 10px;
    text-align: center;
    background: #f8f9fa;
}
.file-preview {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 10px;
}
.file-preview i {
    color: #6c757d;
}
.file-name {
    margin: 5px 0 0;
    font-size: 12px;
    word-break: break-all;
}
</style>

<script>
$(function(){
    const input = $('#{{$name.($isTranslatable ? '_'.$input['lang'] : '' )}}');
    const inputWrapper = input.closest('.col-md-{{$size}}');
    const removeButton = inputWrapper.find('.remove-file');
    const removeFlag = inputWrapper.find('.remove-flag');
    const viewButton = inputWrapper.find('.view-file');
    const actionButtons = inputWrapper.find('.action-buttons');

    // Function to show/hide action buttons
    function toggleActionButtons(show) {
        actionButtons.each(function() {
            if (show) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Function to get or create preview container
    function getPreviewContainer() {
        let container = inputWrapper.find('.preview-container');
        if (container.length === 0) {
            container = $('<div class="preview-container mb-2" data-input="{{ $name }}"></div>');
            inputWrapper.find('.mb-3').prepend(container);
        }
        return container;
    }

    // Function to update view button URL
    function updateViewButtonUrl(filePath, isTemp = false) {
        if (filePath) {
            if (isTemp) {
                viewButton.attr('href', filePath);
            } else {
                viewButton.attr('href', '{{ asset("storage/") }}/' + filePath);
            }
        } else {
            viewButton.attr('href', '#');
        }
    }

    // Function to check if file is image
    function isImageFile(file) {
        return file && file.type.startsWith('image/');
    }

    // Function to update preview content
    function updatePreviewContent(container, file, url) {
        let altInput = '';
        if ('{{ $hasAlt }}' === '1') {
            altInput = `
                <div class="form-group mt-2">
                    <input type="text"
                        class="form-control"
                        placeholder="Texto alternativo"
                        name="{{ $name.($isTranslatable ? '['.$input['lang'].'_alt]' : '_alt') }}"
                        value="">
                </div>
            `;
        }

        if (isImageFile(file)) {
            container.html(`
                <div class="file-preview">
                    <img src="${url}" alt="" style="max-width: 100%; max-height: 200px; object-fit: contain;">
                    <p class="file-name">${file.name}</p>
                </div>
                ${altInput}
            `);
        } else {
            container.html(`
                <div class="file-preview">
                    <i class="material-icons" style="font-size: 48px;">insert_drive_file</i>
                    <p class="file-name">${file.name}</p>
                </div>
                ${altInput}
            `);
        }
    }

    // Show buttons and set view URL if there's an existing file
    const hasExistingFile = '{{ !empty($currentVal) }}' === '1';
    if (hasExistingFile) {
        toggleActionButtons(true);
        updateViewButtonUrl('{{ $currentVal }}', false);
    }

    input.on('change', function(e){
        const file = e.target.files[0];
        if (file) {
            removeFlag.val('0');

            // Get or create preview container
            const container = getPreviewContainer();

            // Create temporary URL for preview
            const tempUrl = URL.createObjectURL(file);

            // Update preview content
            updatePreviewContent(container, file, tempUrl);

            // Update view button URL
            updateViewButtonUrl(tempUrl, true);

            // Show action buttons
            toggleActionButtons(true);

            // Force container to be visible
            container.show();
        }
    });

    removeButton.on('click', function(){
        input.val('');
        removeFlag.val('1');
        const container = inputWrapper.find('.preview-container');
        container.remove();
        // Hide action buttons
        toggleActionButtons(false);
        // Reset view button URL
        updateViewButtonUrl(null);
    });
});
</script>
