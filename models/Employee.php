<?php
namespace app\models;
use yii\db\ActiveRecord;
use yii\validators\BooleanValidator;

class Employee extends ActiveRecord
{
  public function rules()
  {
    return
    [
      // ['selected','boolean'],
      ['gender','boolean', 'trueValue'=>'male', 'falseValue' => 'female', 'strict'=>true]
      // ,['tureValue'=>'male','falseValue'=>'female','strict'=>true]
    ];

  }
  public static function tableName()
  {
    return 'employee';
  }
}
