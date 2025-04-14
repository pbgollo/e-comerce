@php
    $parent = $input['parent'] ?? '';
    $name = $input['name'];
    $langSuffix = isset($input['lang']) ? '_'.$input['lang'] : '';

    if (!empty($parent)) {
        $name = $parent . '[' . $name . ']';
    }

    $name .= $langSuffix;

    $size = $input['size'] ?? 12;

    if(!isset($input['parent'])){
        $val = $value[$name] ?? $input['default'] ?? 1;
    } else {
        $val = $value[$input['name']] ?? $input['default'] ?? 1;
    }
@endphp


<div class="col-md-{{$size}}" {{ isset($input['lang']) ? 'data-lang='.$input['lang'] : ''}}>
    <div class="custom-control custom-control-alternative custom-checkbox" style="margin-top: 38px;">
        <input type="hidden" name="{{$name}}" value="0" />
        <input class="custom-control-input" name="{{$name}}" id="{{$name}}" value="1" {{ old($name, $val)  ? 'checked' : '' }} type="checkbox">
        <label class="custom-control-label" for="{{$name}}">
            <span class="text-muted">{{$input['label']}}</span>
        </label>
            @if(isset($input['hint']))
                <p class="small text-muted">{{$input['hint']}}</p>
            @endif
    </div>
</div>
