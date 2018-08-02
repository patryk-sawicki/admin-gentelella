<?php
namespace LiteCode\AdminGentelella;

use Illuminate\Support\Facades\DB;

trait CRUD{
    public function newInstanceCreate(){
        $instance = new $this->model;
        return $instance;
    }
    public function newInstanceSelect(){
        $query = new $this->model;
        return $query->select();
    }
    public function editInstanceSelect($id){
        $item = $this->model::findOrFail($id);
        return ['slug' => $this->slug, 'item' => $item, 'fields' => $this->fieldsObj()];
    }
    public function setModel($model = null, $slug = null){
        $this->model = $model;
        $this->slug = $slug;
        return $this;
    }
    public function setField($name = null, $data = []){
        $this->fields[$name] = $data;
        return $this;
    }
    public function getInstance($request = null){
        $query = self::newInstanceSelect();
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
        $query->orderBy('name', 'DESC');
        $instance = $query->paginate(10);

        return ['items' => $instance, 'fields' => $this->fieldsObj()];
    }

    public function updateInstance($id, $request){
        $instance = $this->model::findOrFail($id);
        //dump($this->fieldsObj());

        foreach ($this->fieldsObj() as $fieldName => $fieldData)
        {
            if(!($fieldData->fake??false) && !($fieldData->relation??false)){
                $instance->$fieldName = $request->$fieldName ?? null;
                //$instance->$fieldName = $request->$fieldName;
            }
            //dump($request->$fieldName);
        }
        $instance->save();
        return $instance->id;
    }

    public function fieldsObj()
    {
        $fields = $this->array_to_object($this->fields);
        foreach($fields as $fieldName => $fieldData){
            $type = $fieldData->type;
            if(!class_exists($type)){
                $type = '\LiteCode\AdminGentelella\Field' . ucfirst($fieldData->type);
            }
            $fields->{$fieldName}->type = new $type ;
        }
        return $fields;
    }

    public function array_to_object($array) {
        $obj = new \stdClass();
        foreach($array as $k => $v) {
            if(strlen($k)) {
                if(is_array($v)) {
                    $obj->{$k} = $this->array_to_object($v); //RECURSION
                } else {
                    $obj->{$k} = $v;
                }
            }
        }
        return $obj;
    }
}