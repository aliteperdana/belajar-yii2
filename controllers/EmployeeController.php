<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Employee;


class EmployeeController extends Controller
{

  public function actionIndex()
  {
    $employees=Employee::find()->all();
    return $this->render('index',['employees'=>$employees]);

  }

  public function actionCreate()
  {
    $model=new Employee();
    if (Yii::$app->request->post()) {
      $model->load(Yii::$app->request->post());
      if ($model->save()) {
        Yii::$app->session->setFlash('success','Data berhasil disimpan');
      }else{
        Yii::$app->session->setFlash('erro','Data gagal disimpan');
      }
      return $this->redirect(['index']);
    }else {
      return $this->render('create',['model'=>$model]);
    }
  }

}
