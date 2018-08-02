<?php
namespace LiteCode\AdminGentelella;

class FieldText
{
    public function __construct()
    {

    }

    public function list($value = null){
        return view('admin::fields.list.text',['value' => $value]);
    }

    public function edit($fieldName = null , $value = null, $fieldData = null){
        echo view('admin::fields.edit.text',['fieldName' => $fieldName, 'value' => $value, 'fieldData' => $fieldData])->render();
    }
}