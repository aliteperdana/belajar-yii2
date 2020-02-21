<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Employee;
use yii\data\Pagination;


class EmployeeController extends Controller
{

  public function actionIndex()
  {
    // $employees=Employee::find()->all();
    // return $this->render('index',['employees'=>$employees]);

    // Membuat penomoran halaman
    $query=Employee::find();
    $countQuery= clone $query;
    $pages=new Pagination(
        ['totalCount'=>$countQuery->count(),
        'defaultPageSize'=>10]
      );
    $employees=$query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();

    return $this->render('index',['employees'=>$employees,
        'pages'=>$pages]);
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


  public function actionUpdate($id)
  {
    $model=Employee::findOne($id);
    if (Yii::$app->request->post()) {
      $model->load(Yii::$app->request->post());
      if ($model->save()) {
        Yii::$app->session->setFlash('success','Data berhasil update');
      }else{
        Yii::$app->session->setFlash('error','Data gagal update');
      }
      return $this->redirect(['index']);
    }else {
      return $this->render('update',['model'=>$model]);
    }
  }


  public function actionDelete($id)
  {
    $model=Employee::findOne($id);
    if ($model->delete())
    {
      Yii::$app->session->setFlash('success','Data berhasil di hapus');
    }else
    {
      Yii::$app->session->setFlash('error','Data berhasil gagal hapus');
    }
    return $this->redirect(['index']);
  }
}
