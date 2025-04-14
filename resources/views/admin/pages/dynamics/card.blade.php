
<div class="border rounded p-4 mb-2 position-relative js-element-card element-card">
    <a href="" class="js-remove-card position-absolute top-2 right-2 "><i class="material-icons bg-red text-white text-sm p-1 rounded">close</i></a>
    <div class="d-flex align-items-center mb-3">
        <i class="material-icons handle" style="cursor: move">swap_vert</i>
        <div class="d-flex ml-1 align-items-center">
            <i class="material-icons">{{$component['icon'] ?? ''}}</i>
            <h3 class="title m-0 ml-1 p-0 ">{{$component['title'] ?? ''}}</h3>
        </div>
    </div>
    <div class="row">
        @if(isset($component['items']))
            @foreach($component['items'] as $key => $item)
                @php
                    $item['parent'] = 'content['.$index.']';
                    $item['index'] = $index;
                @endphp
                @include(
                    'admin.pages.generic.inputs.' . ($item['type'] ?? 'input'),
                    [
                        'input' => $item,
                        'size' => $item['size'] ?? '',
                        'value' => $value ?? []
                    ]
                )
            @endforeach
        @endif
        <input type="hidden" class="form-control" name="content[{{$index}}][type]" value="{{$component['type'] ?? ''}}"/>
        <input type="hidden" name="content[{{$index}}][remove]" value="0" class="js-remove-flag"/>
    </div>
</div>



