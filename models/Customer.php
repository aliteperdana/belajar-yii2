<?php
namespace app\models;
use yii\db\ActiveRecord;



class Customer extends ActiveRecord
{

  public function getOrders()
  {
    return $this->hasMany(Order::className(),['customer_id'=>'id']);
  }

  public static function tableName()
  {
    return 'customer';
  }
}
