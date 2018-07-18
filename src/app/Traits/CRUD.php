<?php
namespace LiteCode\AdminGentelella;

use Illuminate\Support\Facades\DB;

trait CRUD{
    public function setModel($model = null, $title = ''){
        $this->model = $model;
        return $this;
    }
    public function setField($name = null, $data = []){
        $this->fields[$name] = $data;
        return $this;
    }
    public function getInstance($request = null){
        $query = $this->model::select();
        foreach ($request->all() as $requestField => $requestValue)
        {
            if($this->fields[$requestField]['filter']['active']??false){
                $qs = $this->fields[$requestField]['filter']['query'][1];
                $q = $this->fields[$requestField]['filter']['query'][0];
                if(($qs??'')=='like'){$requestValue = '%'.$requestValue.'%';}
//                dump("{$q}($requestField,$qs,$requestValue)");
                $query->{$q}($requestField,$qs,$requestValue);

            }
        }
        $instance = $query->paginate(10);
//        dump($instance);
//        dump($this->model);
//        dump($this->fields);
        return ['items' => $instance];
    }
}