@php
    $size = $input['size'] ?? 12;
@endphp

<div class="col-md-{{$size}}">
    <div class="form-group">
        <label class="form-control-label">{{$input['label']}}</label>
        <input type="text" readonly class="form-control-plaintext" value="{{$input['data']}}" style="outline: none">
    </div>
</div>
