<div class="wrapper js-carousel col overflow-hidden">
    <div class="js-carousel-items-container d-flex overflow-auto js-form-inputs">
        @if (isset($value['items']) && count($value['items']))
            @foreach ($value['items'] as $key => $iv)
                <div class="js-carousel-item col-4 border p-3 mr-2 js-element-card position-relative">
                    <i class="material-icons handle" style="cursor: move">swap_horiz</i>
                    <a href="" class="js-remove-card position-absolute top-2 right-2 block" style="z-index:10"><i
                            class="material-icons bg-red text-white text-sm p-1 rounded">close</i></a>

                    <input type="hidden" name="{{ $input['parent'] . '[items][' . $key . ']' }}[remove]" value="0"
                        class="js-remove-flag" />
                    @foreach ($input['components'] as $ic)
                        @php
                            $ic['parent'] = $input['parent'] . '[items][' . $key . ']';
                            $ic['index'] = $key;
                        @endphp
                        @include('admin.pages.generic.inputs.' . ($ic['type'] ?? 'input'), [
                            'input' => $ic,
                            'size' => $ic['size'] ?? '',
                            'value' => $iv ?? [],
                        ])
                    @endforeach

                </div>
            @endforeach
        @endif
    </div>

    <div class="my-3">
        <a href="javascript:void(0);" class="btn btn-sm btn-success js-add-items">
            <span>+ ADICIONAR NOVO BLOCO</span>
        </a>
    </div>

</div>

<template id="carousel-itensTemplate">
    @if (isset($input['components']))
        <div class="js-carousel-item col-4 border p-3 mr-2">
            <a href="" class="js-remove-card position-absolute top-2 right-2 " style="z-index:10"><i
                    class="material-icons bg-red text-white text-sm p-1 rounded" >close</i></a>
                    <i class="material-icons handle" style="cursor: move">swap_horiz</i>
            @foreach ($input['components'] as $key => $ic)
                @php
                    $ic['parent'] = $input['parent'] . '[items][{itemindex}]';
                    $ic['index'] = $key;
                @endphp
                @include('admin.pages.generic.inputs.' . ($ic['type'] ?? 'input'), [
                    'input' => $ic,
                    'size' => $ic['size'] ?? '',
                    'value' => [],
                ])
            @endforeach
        </div>
    @endif

</template>
