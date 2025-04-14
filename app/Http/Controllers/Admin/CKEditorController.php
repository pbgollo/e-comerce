<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class CKEditorController extends GenericController
{
public function __construct()
{
}

public function ckUpload(Request $request)
    {   
        $file = $request->upload;
        $fileName = $file->getClientOriginalName();
        $new_name = time().$fileName;
        $dir = "storage/ckeditor/";
        $file->move($dir, $new_name);
        $url = asset("storage/ckeditor/".$new_name);
        $CkeditorFuncNum = $request->input('CKEditorFuncNum');
        $status = "<script>window.parent.CKEDITOR.tools.callFunction('$CkeditorFuncNum','$url', 'Imagem carregada com sucesso!')</script>";
        echo $status;
    }
}