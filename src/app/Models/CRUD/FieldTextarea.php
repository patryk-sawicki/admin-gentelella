<?php
namespace LiteCode\AdminGentelella;

class FieldTextarea
{
    public function __construct()
    {

    }

    public function list($value){
        echo $value;
    }

    public function edit($fieldName = null , $value = null, $fieldData = null){
        echo view('admin::fields.edit.textarea',['fieldName' => $fieldName, 'value' => $value, 'fieldData' => $fieldData]);
    }
}