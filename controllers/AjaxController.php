<?php
namespace app\controllers;
use yii\web\Controller;
use Yii;
use yii\base\DynamicModel;
use app\models\Book;
use app\models\Komentar;

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
      $model= new DynamicModel([
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

    public function getProvince()
    {
      $db= Yii::$app->db;
      $command=$db->createCommand('SELECT * FROM province ORDER BY name ASC');
      $province= $command->queryAll();

      return $province;
    }

    public function actionDepdrop()
    {
      $model= new DynamicModel([
        'province_id','city_id',
      ]);

      $model->addRule(['province_id'],'integer');
      $model->addRule(['city_id'],'integer');

      return $this->render('depdrop',[
          'model'=>$model,
          'provinces'=>$this->getProvince(),
      ]);

    }


    public function actionGetCities($province_id)
    {
      $db= Yii::$app->db;
      $command=$db->createCommand('SELECT * FROM city 
        WHERE province_id ='.$province_id);
      $cities=$command->queryAll();

      \Yii::$app->response->format= \yii\web\Response::FORMAT_JSON;
      return [
        'cities'=>$cities,
      ];
    }


    public function actionAjaxForm()
    {
      return $this->render('ajaxform');
    }

    public function actionKomentar()
    {
      $model = new Komentar();

      if (Yii::$app->request->post() && $model->save() ) {
          return [
            'data' => [
              'success' => true,
              'model' => $model,
              'message' => 'Model has been saved.',
            ],
            'code' => 0,
          ];
            
      }else{
        // var_dump(Yii::$app->request->post());
        return $this->render('komentar',['model'=>$model]);
      }

    }

    public function actionAjaxComment()
    {
      $model = new Komentar();
      if (Yii::$app->request->isAjax) {
          Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

          if ($model->load(Yii::$app->request->post()) && $model->save()) {
              return [
                  'data' => [
                      'success' => true,
                      'model' => $model,
                      'message' => 'Model has been saved.',
                  ],
                  'code' => 0,
              ];
          } else {
              return [
                  'data' => [
                      'success' => false,
                      'model' => null,
                      'message' => 'An error occured.',
                  ],
                  'code' => 1, // Some semantic codes that you know them for yourself
              ];
          }
      }
    }
}
