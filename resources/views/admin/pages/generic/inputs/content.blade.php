@php
    $val = json_decode($value['content'], true);

    $componentsPath = base_path('resources/views/admin/pages/dynamics/components.json');
    $componentsString = file_get_contents($componentsPath);
    $componentsGroup = json_decode($componentsString, true);
    $components = array_map(function($current){
        return $current['components'];
    },$componentsGroup);

    $components = array_reduce($components, 'array_merge', []);

@endphp

<div class="col-md-12">
    <div class="js-form-inputs">
        @if (is_array($val) && count($val) > 0)
            @foreach ($val as $i => $value)
                @php
                    $filteredComponents = array_filter($components, function($current) use($value) {
                        return isset($current['type']) && isset($value['type']) && $current['type'] == $value['type'];
                    });
                    $component = !empty($filteredComponents) ? array_values($filteredComponents)[0] : null;
                @endphp

                @include('admin.pages.dynamics.card', [
                    'value' => $value,
                    'index' => $i,
                    'component' => $component
                ])
            @endforeach
        @endif

        <div class="m-auto text-center js-no-components" style="display: none">
            <i class="material-icons">description</i>
            <p>Adicione aqui seus componentes</p>
        </div>
    </div>
    <div class="my-3 mr-2">
        <a href="javascript:void(0);" class="btn btn-sm btn-success js-open-dynamic-sidebar">
            <span>+ ADICIONAR NOVO BLOCO</span>
        </a>
    </div>
</div>

@foreach ($components as $key => $component)
    <template id="{{$component['type']}}Template">
        @include("admin.pages.dynamics.card", [
            'index' => '{index}',
            'component' => $component,
            'value' => [
                'type' => $component['type']
            ]
        ])
    </template>
@endforeach

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click",".js-show-miniatures", function(){
            $(this).parent().find(".js-miniatures").slideToggle();
            $(this).find(".js-arrow-down").toggleClass("rotate");
        })
    })
</script>

<script type="text/javascript">
    $(function(){
        $('.js-form-inputs').sortable({
            handle: '.handle'
        });
    });
</script>



