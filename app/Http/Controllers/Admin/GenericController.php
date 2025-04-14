<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppearanceModel;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile as HttpUploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

abstract class GenericController extends Controller
{

    protected $chatGPT;

    protected $model;

    protected $title = 'Nomad';

    protected $vm = [];

    protected $appearance = [];

    protected $table = [];

    protected $form = [];

    protected $actions = [];

    protected $tabs = [];

    protected $view = [];

    protected $export = [];


    protected $delete = true;

    protected $add = true;

    protected $edit = true;


    protected $unique = false;

    protected $sortable = false;

    protected $order = false;

    protected $pagination = true;

    protected $search = false;

    protected $fk = false;

    protected $includes = false;

    protected $translate = false;

    protected $generate = true;

    protected $ai_translation = true;

    private $page_num = 10;

    public function __construct()
    {
        $appearance = AppearanceModel::first();
        $this->appearance = !is_null($appearance) ? $appearance->toArray() : $appearance;
        $this->chatGPT = app('ChatGPT');
    }

    /**
     * index
     * Monta a tela de listagem
     */
    public function index(Request $request)
    {
        if ($this->unique) {
            return redirect(route($request->route()->getName() . '.edit', ['id' => 1]));
        }

        if ($this->sortable) {
            $this->order = $this->sortable;
        }

        $this->vm['appearance'] = $this->appearance;
        $this->vm['title'] = $this->title;
        $this->vm['table'] = $this->table;
        $this->vm['sortable'] = $this->sortable;
        $this->vm['pagination'] = $this->pagination;
        $this->vm['search'] = $this->search;
        $this->vm['delete'] = $this->delete;
        $this->vm['edit'] = $this->edit;
        $this->vm['add'] = $this->add;
        $this->vm['view'] = $this->view;
        $this->vm['export'] = $this->export;

        // MODEL
        $items = (new $this->model);

        // INCLUDES
        if ($this->includes) {
            $includes = is_array($this->includes) ? $this->includes : [$this->includes];
            foreach ($includes as $include) {
                $items = $items->with($include);
            }
        }

        // FK
        if ($this->fk) {
            $items = $items->where($this->fk, $request->route('fk'));
        }

        // SEARCH
        if ($this->search) {
            $word = $request->query('search');
            if (!empty($word)) {
                $arr = $this->search;
                if (!is_array($arr)) {
                    $arr = [$arr];
                }
                $items = $items->where(function ($query) use ($arr, $word) {
                    foreach ($arr as $search) {
                        $query->orWhere($search, 'like', '%' . $word . '%');
                    }
                });
            }
        }

        // ORDER
        if ($this->order) {
            if (is_array($this->order)) {
                $items = $items->orderBy($this->order[0], $this->order[1]);
            } else {
                $items = $items->orderBy($this->order);
            }
        }

        // PAGINATION
        $total = $items->count();
        $page = $request->query('page') ?? 1;

        $this->vm['paginator'] = [
            'page' => $page,
            'pages' => 1,
            'total' => $total,
        ];

        if ($this->pagination && !$this->sortable) {
            $items = $items
                ->offset(($page * $this->page_num) - $this->page_num)
                ->take($this->page_num);

            $this->vm['paginator']['pages'] = ceil($total / $this->page_num);
        }

        // RETORNO
        $items = $items->get();
        $this->vm['items'] = $items->toArray();

        return view("admin.pages.generic.index", $this->vm);
    }


    /**
     * form
     * Monta a tela de edição / inserção
     */
    public function form(Request $request)
    {

        $id = $request->route('id');
        $fk = $request->route('fk');

        if ($id && !$this->edit) {
            return redirect(route(str_replace(['.edit'], '', $request->route()->getName()), ['fk' => $fk]));
        }

        if (!$id && !$this->add) {
            return redirect(route(str_replace(['.create'], '', $request->route()->getName()), ['fk' => $fk]));
        }
        $this->vm['appearance'] = $this->appearance;
        $this->vm['title'] = $this->title;
        $this->vm['actions'] = $this->actions;
        $this->vm['form'] = $this->form;
        $this->vm['tabs'] = $this->tabs;
        $this->vm['translate'] = $this->translate;
        $this->vm['unique'] = $this->unique;
        $this->vm['generate'] = $this->generate;
        $this->vm['ai_translation'] = $this->ai_translation;
        $this->vm['value'] = [];

        if ($request->isMethod('post')) {
            $nid = $this->save($request, $id, $fk);

            if ($this->unique) {
                $redirect = redirect(route($request->route()->getName(), ['id' => 1]));
            } else {
                $redirect = redirect(route(str_replace(['.edit', '.create'], '', $request->route()->getName()), ['fk' => $fk]));
            }

            if ($request->post('redirect')) {

                if ($id) {
                    $url = request()->getRequestUri();
                } else {
                    $url = route(str_replace('.create', '.edit', $request->route()->getName()), ['id' => $nid]);
                }

                if (!session('last') || !is_array(session('last'))) {
                    session(['last' => []]);
                }

                if (count(session('last')) == 0 || session('last')[count(session('last')) - 1] != $url) {
                    $last = session('last');
                    $last[] = $url;
                    session(['last' => $last]);
                }

                $redirect = redirect(route($request->post('redirect'), ['fk' => $nid]));
            }

            return $redirect->with('success', ($id ? 'Alterado' : 'Criado') . ' com sucesso!');
        } else {
            if ($id) {
                $this->vm['value'] = $this->load($id);
            }
        }

        return view("admin.pages.generic.edit", $this->vm);
    }


    /**
     * delete
     * Deleta o registro
     */
    public function delete(Request $request)
    {
        if (!$this->delete) return;
        $this->model::find($request->route('id'))->delete();
        return redirect(route(str_replace('.delete', '', $request->route()->getName()), ['fk' => $request->route('fk')]))
            ->with('success', 'Removido com sucesso!');
    }


    /**
     * sort
     * Salva o retorno do sortable
     */
    public function sort(Request $request)
    {
        $order = $request->input('order');
        foreach ($order as $position => $id) {
            $model = $this->model::find($id);
            $model->fill([$this->sortable => $position]);
            $model->save();
        }
        return response(['success' => true])->header('Content-Type', 'application/json');
    }

    /**
     * export
     * Gera a tela de visualização de dados
     */
    public function view(Request $request)
    {
        $id = $request->route('id');
        $this->vm['appearance'] = $this->appearance;
        $this->vm['title'] = $this->title;
        $this->vm['view'] = $this->view;
        $this->vm['value'] = $this->load($id);

        return view("admin.pages.generic.view", $this->vm);
    }

    /**
     * export
     * Exporta para CSV
     */
    public function export(Request $request)
    {
        $result = '';
        foreach ($this->export as $fields) {
            $result .= $fields['label'] . ';';
        }
        $result .= chr(13) . chr(10);

        // MODEL
        $items = (new $this->model);

        // INCLUDES
        if ($this->includes) {
            $includes = is_array($this->includes) ? $this->includes : [$this->includes];
            foreach ($includes as $include) {
                $items = $items->with($include);
            }
        }

        // FK
        if ($this->fk) {
            $items = $items->where($this->fk, $request->route('fk'));
        }

        // SEARCH
        if ($this->search) {
            $word = $request->query('search');
            if (!empty($word)) {
                $arr = $this->search;
                if (!is_array($arr)) {
                    $arr = [$arr];
                }
                $items = $items->where(function ($query) use ($arr, $word) {
                    foreach ($arr as $search) {
                        $query->orWhere($search, 'like', '%' . $word . '%');
                    }
                });
            }
        }

        // ORDER
        if ($this->order) {
            if (is_array($this->order)) {
                $items = $items->orderBy($this->order[0], $this->order[1]);
            } else {
                $items = $items->orderBy($this->order);
            }
        }

        $data = $items->get()->toArray();

        foreach ($data as $item) {
            foreach ($this->export as $fields) {
                $result .= $item[$fields['name']] . ';';
            }
            $result .= chr(13) . chr(10);
        }

        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=export.csv',
            'Expires'             => '0',
            'Pragma'              => 'public',
        ];

        return response()->stream(function () use ($result) {
            $fh = fopen('php://output', 'w');
            fwrite($fh, $result);
            fclose($fh);
        }, 200, $headers);
    }

    /***
     * PRIVATE FUNCTIONS -----------------------------------------------------------------------------------
     */

    private function load($id)
    {
        $items = (new $this->model);

        // INCLUDES
        if ($this->includes) {
            $includes = is_array($this->includes) ? $this->includes : [$this->includes];
            foreach ($includes as $include) {
                $items = $items->with($include);
            }
        }

        $data = $items->where('id', $id)->first();

        if ($data) {
            return $data->toArrayTranslation();
        } else {
            return [];
        }
    }

    private function validateDimensions($image)
    {
        $file = $image->getClientOriginalName();
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        if ($extension == "png" || $extension == "jpg" || $extension == "jpeg") {
            $imageWidth = getimagesize($image)[0];
            $imageHeight = getimagesize($image)[1];
            if ($imageWidth > 1920 || $imageHeight > 1920) {
                return false;
            }
        }
        return true;
    }

    private function save($request, $id, $fk)
    {
        foreach ($request->all() as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $innerKey => $file) {
                    if ($file instanceof \Illuminate\Http\UploadedFile) {
                        if (!$this->validateDimensions($file)) {
                            return redirect()->back()->with('fail', 'Dimensões da imagem muito grandes...');
                        }
                    }
                }
            }
        }

        $body = $request->all();

        if (isset($body['content'])) {
            foreach ($body['content'] as $index => &$content) {

                if (isset($content['image']) && $content['image'] instanceof HttpUploadedFile) {
                    $filePath = $content['image']->storeAs('dynamics-images', $this->generateFileName($content['image']), 'storage');
                    $content['image'] = $filePath;
                }


                if (isset($content['remove']) && $content['remove'] == '1') {
                    unset($body['content'][$index]);
                    continue;
                } else {
                    unset($content['remove']);
                }


                if (isset($content['items']) && is_array($content['items'])) {
                    foreach ($content['items'] as $itemIndex => &$item) {
                        if (isset($item['image']) && $item['image'] instanceof HttpUploadedFile) {
                            $itemFilePath = $item['image']->storeAs('dynamics-images', $this->generateFileName($item['image']), 'storage');
                            $item['image'] = $itemFilePath;
                        }

                        if (isset($item['remove']) && $item['remove'] == '1') {
                            unset($content['items'][$itemIndex]);
                        } else {
                            unset($item['remove']);
                        }
                    }

                    $content['items'] = array_values($content['items']);
                }
            }

            $body['content'] = array_values($body['content']);
            $body['content'] = json_encode($body['content']);
        }



        if ($id) {
            $model = $this->model::find($id);
            if ($this->unique && !$model) {
                $model = new $this->model();
            }
        } else {
            $model = new $this->model();
        }

        // dd($body);

        $model->fill($body);

        $validators = [];
        foreach ($this->form as $cards) {
            foreach ($cards['inputs'] as $input) {
                $this->validator($request, $validators, $model, $input);
            }
        }

        foreach ($this->vm['tabs'] as $tab) {
            foreach ($tab['form'] as $cards) {
                foreach ($cards['inputs'] as $input) {
                    $this->validator($request, $validators, $model, $input);
                }
            }
        }
        $request->validate($validators);

        if ($this->fk) {
            $model->fill([
                $this->fk => $fk
            ]);
        }

        $model->save();

        foreach ($this->form as $cards) {
            foreach ($cards['inputs'] as $input) {
                if (isset($input['input']) && $input['input'] == 'table') {
                    if (isset($body[$input['name']])) {
                        foreach ($body[$input['name']] as $line) {
                            if ($line['deleted']) {
                                if (!empty($line['id'])) {
                                    $input['model']::find($line['id'])->delete();
                                }
                            } else {
                                $m = new $input['model'];
                                if (!empty($line['id'])) {
                                    $m = $input['model']::find($line['id']);
                                }
                                $line[$input['fk']] = $model->id;
                                $m->fill($line);
                                $m->save();
                            }
                        }
                    }
                } else if (isset($input['input']) && $input['input'] == 'multiple') {
                    if (isset($body[$input['name']])) {
                        foreach ($body[$input['name']] as $line) {
                            if (isset($line['id']) && !isset($line['checked'])) {
                                $input['model']::find($line['id'])->delete();
                            } else if (!isset($line['id']) && isset($line['checked'])) {
                                $m = new $input['model'];
                                $line[$input['fk']] = $model->id;
                                $m->fill($line);
                                $m->save();
                            } else if (isset($line['id']) && isset($line['checked'])) {
                                $m = new $input['model'];
                                $m = $m->where('id', $line['id'])->first();
                                $line[$input['fk']] = $model->id;
                                $m->fill($line);
                                $m->save();
                            }
                        }
                    }
                } else if (isset($input['input']) && $input['input'] == 'gallery') {
                    if (isset($body[$input['name']])) {
                        foreach ($body[$input['name']] as $line) {
                            if ($line['deleted']) {
                                if (!empty($line['id'])) {
                                    $input['model']::find($line['id'])->delete();
                                }
                            } else {
                                $m = new $input['model'];
                                if (!empty($line['id'])) {
                                    $m = $input['model']::find($line['id']);
                                }

                                if (!empty($line[$input['image']])) {
                                    if (is_string($line[$input['image']])) {
                                        $name = $line[$input['image']];
                                    } else {
                                        $name = $line[$input['image']]->storeAs($input['folder'] ?? '', $this->generateFileName($line[$input['image']]), 'storage');
                                    }
                                    if (!empty($input['fk'])) {
                                        $m->fill([
                                            $input['fk'] => $model->id
                                        ]);
                                    }
                                    $m->fill([
                                        $input['image'] => $name,
                                        $input['sortable'] => $line['position']
                                    ]);
                                    $m->save();
                                }
                            }
                        }
                    }
                }
            }
        }

        return $model['id'];
    }

    private function validator($request, &$validators, &$model, $input)
    {
        // Debug
        if (isset($input['input']) && ($input['input'] == 'image' || $input['input'] == 'file')) {
            Log::info('File input data:', [
                'name' => $input['name'],
                'translate' => $input['translate'] ?? false,
                'request_data' => $request->all()
            ]);
        }

        $languages = config('app.locales', ['pt', 'en']);

        if (isset($input['validators'])) {
            if (isset($input['translate']) && $input['translate']) {
                foreach ($languages as $lang) {
                    $validators[$input['name']][$lang] = $input['validators'];
                }
            } else {
                $validators[$input['name']] = $input['validators'];
            }
        }

        if (isset($input['input']) && ($input['input'] == 'image' || $input['input'] == 'file')) {
            if (isset($input['translate']) && $input['translate']) {
                // Handle file removal for each language
                foreach ($languages as $lang) {
                    $removeFlag = $request->input($input['name'] . '.' . $lang . '_remove');
                    if ($removeFlag == '1') {
                        // Get current file path for this specific language
                        $currentFile = $model->getTranslation($input['name'], $lang);
                        if ($currentFile) {
                            // Delete file from storage
                            Storage::disk('storage')->delete($currentFile);
                            // Clear translation for this specific language only
                            $model->setTranslation($input['name'], $lang, null);
                        }
                    }
                }

                // Handle new file uploads
                $files = $request->file($input['name']);
                if (is_array($files)) {
                    foreach ($languages as $lang) {
                        if (isset($files[$lang])) {
                            $name = $files[$lang]->storeAs($input['folder'] ?? '', $this->generateFileName($files[$lang]), 'storage');
                            $model->setTranslation($input['name'], $lang, $name);
                        }
                    }
                }
            } else {
                // Check for remove flag
                $removeFlag = $request->input($input['name'] . '_remove');
                if ($removeFlag == '1') {
                    // Get current file path
                    $currentFile = $model->{$input['name']};
                    if ($currentFile) {
                        // Delete file from storage
                        Storage::disk('storage')->delete($currentFile);
                        // Clear field
                        $model->fill([
                            $input['name'] => null
                        ]);
                    }
                }

                // Handle new file upload
                $file = $request->file($input['name']);
                if ($file) {
                    $name = $file->storeAs($input['folder'] ?? '', $this->generateFileName($file), 'storage');
                    $model->fill([
                        $input['name'] => $name
                    ]);
                }
            }
        }
    }


    private function generateFileName($file)
    {
        $parts = explode('.', $file->getClientOriginalName());
        $ext = array_pop($parts);
        $name = slugify(implode('', $parts));
        return $name . '-' . substr(sha1(date('dmyHis') . rand(0, 1000)), 0, 8) . '.' . $ext;
    }
}
