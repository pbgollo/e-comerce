
@php
    $parent = $input['parent'] ?? '';
    $name = !empty($parent) ? $parent.'['.$input['name'].']' : $input['name'];
    $replaced_name = str_replace(']','_',str_replace('[','_',$name));
    $size = $input['size'] ?? 12;
@endphp

<div class="col-md-{{$size}}">
    <div class="d-flex justify-content-between align-items-center js-show-miniatures border p-2 my-3" style="cursor: pointer">
        <h3 class="show-miniatures">Escolha a versão que deseja exibir no site</h3>
        <i class="material-icons js-arrow-down" style="transition: 0.3s all ease">expand_more</i>
    </div>
    <div class="row js-miniatures" style="display: none">
        @foreach($input['items'] as $i => $item)
            <div class="col-4 image-select">
                <input type="radio" id="{{$replaced_name}}_{{$i}}" name="{{$name}}" value="{{$item['attributes']}}"
                {{
                    (isset($value['attributes']) && $value['attributes'] == $item['attributes'])
                    ? 'checked'
                    : ((!isset($value['attributes']) && $i == 0) ? 'checked' : '')
                }}
                />
                <label for="{{$replaced_name}}_{{$i}}">
                    <img src="{{ Storage::url('miniatures/'.$item['thumb']) }}" width="100%" />
                </label>
            </div>
        @endforeach
    </div>
</div>

