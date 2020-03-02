<?php
namespace app\controllers;
use yii\web\Controller;
// use yii\base\DynamicModel;

class AjaxController extends Controller
{
    public function getBooks()
    {
      $books =  [
                ['id'=>1,'title'=>'Pemograman PHP','author'=>'Hafid','year'=>'2015'],
                ['id'=>2,'title'=>'Pemograman JS','author'=>'Juned','year'=>'2014'],
                ['id'=>3,'title'=>'Pemograman MySql','author'=>'Lily','year'=>'2013']
              ];
      return $books;
    }

    public function actionBook()
    {
      $model= new \yii\base\DynamicModel([
        'title','author','year'
      ]);

      $model->addRule(['title'],'string');
      $model->addRule(['description'],'string');
      $model->addRule(['year'],'integer');

      return $this->render('book',[
        'model'=>$model,'books'=>$this->getBooks()
      ]);
    }

    public function actionGetBook($id)
    {
      $books= $this->getBooks();
      $bookSelected= [];
      foreach ($books as $key ) {
        if ($key['id']==$id) {
          $bookSelected = $key;
        }
      }


      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return ['book'=>$bookSelected];
    } 

}
