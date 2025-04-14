@php
    if(!isset($input['parent'])){
        $name = $input['name'].(isset($input['lang']) ? '_'.$input['lang'] : '');
    }else{
        $name = $input['parent'].'['.$input['name'].(isset($input['lang']) ? '_'.$input['lang'] : '').']';
    }

    $name_replaced = str_replace(']','_',str_replace('[','_',$name));

    $size = $input['size'] ?? 12;
    $width = $input['width'] ?? 150;

    if(!isset($input['parent'])){
        $val = $value[$name] ?? '';
    }else{
        $val = $value[$input['name']] ?? '';
    }

    $ext = explode('.',$val);
    $ext = isset($ext[1]) ? $ext[1] : '';

    $video = in_array($ext,["mp4","mov"]);
    $alt = $input['alt'] ?? false;

    if($alt){
        if(!isset($input['parent'])){
            $name_alt = $input['name'].'_alt'.(isset($input['lang']) ? '_'.$input['lang'] : '');
        }else{
            $name_alt = $input['parent'].'['.$input['name'].'_alt'.(isset($input['lang']) ? '_'.$input['lang'] : '').']';
        }
        if(!isset($input['parent'])){
            $val_alt = $value[$name.'_alt'] ?? '';
        }else{
            $val_alt = $value[$input['parent']][$input['name'].'_alt'] ?? '';
        }
    }

@endphp

<div class="col-md-{{$size}}" {{ isset($input['lang']) ? 'data-lang='.$input['lang'] : ''}}>
    <label class="form-control-label">{{$input['label']}}</label>
    <div style="width: {{$width}}px;"  class="mb-3">
        <video class="video_{{$name_replaced}}" src="{{ $video ? asset('storage/'.$val) : '' }}"  width="{{$width}}" <?php echo !$video ? 'style="display: none;"' : '' ?>></video>
        <img class="image_{{$name_replaced}}"  src="{{ !$video ? resize(empty($val) ? 'default.png' : $val ,$width) : '' }}" width="{{$width}}"  <?php echo $video ? 'style="display: none;"' : '' ?> />
        <div class="row m-0 w-100">
            <div class="col p-0">
                <div class="form-group m-0">
                    <label class="w-100" for="{{$name}}">
                        <a class="btn btn-block btn-sm btn-success">
                            <i class="material-icons text-white" style="font-size: 15px;">cloud_upload</i>
                        </a>
                    </label>
                    <input type="hidden" name="{{$name}}" value="{{$val ?? ''}}" />
                    <input type="file" accept="*" style="display: none" id="{{$name}}" name="{{$name}}" value="{{old($name)}}"/>
                </div>
            </div>
            <div class="col p-0 @php echo empty($val) ? 'd-none' : ''; @endphp">
                <a href="{{ asset('storage/'.$val) }}" data-fancybox="gallery" class="btn btn-block btn-sm btn-secondary view_{{$name}}" href="#">
                    <i class="material-icons text-white" style="font-size: 15px;">visibility</i>
                </a>
            </div>
            <div class="col p-0">
                <a href="javascript:void(0);" class="btn btn-block btn-sm btn-danger remove_{{$name_replaced}}" href="#">
                    <i class="material-icons text-white" style="font-size: 15px;">delete</i>
                </a>
            </div>
        </div>
        @if ($alt)
        <div class="row">
            <div class="col-md-12">
                <input type="text" name="{{$name_alt}}" class="form-control form-control-sm alt_{{$name_replaced}}" placeholder="Alt"  value="{{old($name_alt, $val_alt ?? '')}}" />
            </div>
        </div>
        @endif
        @error($name)
            <span class="invalid-feedback d-block">{{$message}}</span>
        @enderror
    </div>
    @if(isset($input['hint']))
        <p class="small text-muted text-center">{{$input['hint']}}</p>
    @endif
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // Hide inputs that don't match current language
        $('[data-lang]').each(function() {
            if ($(this).data('lang') !== '{{ app()->getLocale() }}') {
                $(this).hide();
            }
        });

        $('input[name="{{$name}}"]').on('change', function(evt){
            const url = URL.createObjectURL(event.target.files[0]);
            const size = event.target.files[0].size;
            const name = event.target.files[0].name.split('.')[0]
            let ext = event.target.files[0].name.split('.');
            ext = ext[ext.length - 1];

            if (size > 5000 * 1024) {
                alert('Tamanho da imagem ou vídeo excede o permitido!(5MB)');
                return;
            }

            $('.alt_{{ $name }}').val(name);

            if(["mp4","mov"].indexOf(ext) < 0){
                $('.image_{{$name_replaced}}').show();
                $('.video_{{$name_replaced}}').hide();
                $('.image_{{$name_replaced}}').attr('src', url);
                $('a.view_{{$name_replaced}}').attr('href', url);
                $('a.view_{{$name_replaced}}').parent().removeClass('d-none');
            }else{
                $('.image_{{$name_replaced}}').hide();
                $('.video_{{$name_replaced}}').show();
                $('.video_{{$name_replaced}}').attr('src', url);
                $('a.view_{{$name_replaced}}').parent().addClass('d-none');
            }
        });
        $('.remove_{{$name_replaced}}').on('click', function(){
            $('.image_{{$name_replaced}}').attr('src','storage/default.png');
            $('input[name="{{$name}}"]').val(null);
            $('.alt_{{$name_replaced}}').val('');
        });
    });
</script>
