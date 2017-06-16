<?php
namespace backend\models;

use Yii;
use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['last_login_at'] = 'Lastest Login';
        return $labels;
    }

    // public function scenarios()
    // {
    //     $scenarios = parent::scenarios();
    //     // add field to scenarios
    //     $scenarios['create'][]   = 'dep_id';
    //     $scenarios['update'][]   = 'dep_id';
    //     $scenarios['register'][] = 'dep_id';
    //     return $scenarios;
    // }

    // public function rules()
    // {
    //     $rules = parent::rules();
    //     // add some rules
    //     $rules['fieldRequired'] = ['dep_id', 'required'];

    //     return $rules;
    // }
    
    // public function getDepartment()
    // {
    //     return $this->hasOne(Department::className(), ['dep_id' => 'dep_id']);
    // }
}
