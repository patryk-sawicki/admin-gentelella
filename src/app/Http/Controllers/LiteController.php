<?php
namespace LiteCode\AdminGentelella;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LiteCode\AdminGentelella\CRUD;

class LiteController extends Controller
{
    use CRUD;
    public $model;
    public $fields = [];

    public function index(Request $request)
    {
        $data = $this->getInstance($request);
//        dump($data);
        return view('admin::index', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = $this->editInstanceSelect($id);
//        dump($data);
        return view('admin::edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->updateInstance($id, $request);
        //dump($request->all());
        return redirect(url('/admin/'.$this->slug));
    }

    public function destroy($id)
    {
        //
    }
}
