<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Employee;
use app\models\Customer;
use app\models\Order;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionHello($nama="")
    {
      return  "<h1> Hello ".$nama."</h1>";
    }

    public function actionTampil(){
      return $this->render('hello', [
        'nama' => 'Alit Perdana Putra',
        'jenisKelamin' => 'Pria'
      ]);
    }

    public function actionKomentar()
    {
      $model = new \app\models\Komentar();
      // Jika form di-submit dengan method post
      if (Yii::$app->request->post()) {
        $model->load(Yii::$app->request->post());
        if ($model->validate()) {
          Yii::$app->session->setFlash('success','Terima Kasih');
        }else {
          Yii::$app->session->setFlash('error','Maaf, Teradpat Kesalahan!');
        }
        return $this->render('hasil_komentar',['model'=>$model]);
      }

      return $this->render('komentar',[
        'model'=>$model,
      ]);
    }

    public function actionQuery()
    {
      $db=Yii::$app->db;
      $command= $db->createCommand('SELECT * FROM employee');
      $employees=$command->queryAll();
      // Ektrak Data
      foreach ($employees as $employee) {
        echo "<br>";
        echo $employee['id'];
        echo $employee['name'];
        echo $employee['age'];
      }
    }

    public function actionQuery2()
    {
      $db=Yii::$app->db;
      // return single row
      $employee= $db->createCommand('SELECT * FROM employee WHERE id=1')->queryOne();
      echo $employee['id'].". ";
      echo $employee['name'].". ";
      echo "(".$employee['age'].")";
      // return single column (the first column)
      $name=$db->createCommand('SELECT name FROM employee')->queryColumn();
      echo "<hr>";
      print_r($name);
      // return Scalar
      $count=$db->createCommand('SELECT COUNT(*) FROM employee')->queryScalar();
      echo "<hr>";
      echo "jumlah karyawan ".$count;
    }

    public function actionQueryBinding()
    {
      $db=Yii::$app->db;
      $command= $db->createCommand('SELECT * FROM employee WHERE id=:id',['id'=>2]);
      $employee=$command->queryOne();
      // Ektrak Data
        echo "<br>";
        echo $employee['id'];
        echo $employee['name'];
        echo $employee['age'];
    }

    public function actionInsert()
    {
      $db=Yii::$app->db;
      $insertEmployee=$db->createCommand()->insert('employee',['name'=>'Alit','age'=>26])->execute();
      echo $insertEmployee." Row affected";
    }

    public function actionUpdate()
    {
      $db=Yii::$app->db;
      $insertEmployee=$db->createCommand()->update('employee',['age'=>1],'name="Alit"')->execute();
      echo $insertEmployee." Row affected";
    }

    public function actionActiveRecord()
    {
      // $employees=\app\models\Employee::find()->all();
      // foreach ($employees as $employee ) {
      //   echo "<br>";
      //   echo $employee->id."-";
      //   echo $employee->name."-";
      //   echo $employee->age;
      // }

      // $employees=Employee::find()->where(
      //     ['id'=> 2]
      //   )->one();
      // echo "<br>";
      // echo $employees->id."-";
      // echo $employees->name."-";
      // echo $employees->age;

      // $employees=Employee::find()->where(
      //     ['>','age','10']
      //   )->orderBy('id DESC')->all();
      // // print_r($employees);
      // foreach ($employees as $employee) {
      //   echo "<br>";
      //   echo $employee->id."-";
      //   echo $employee->name."-";
      //   echo $employee->age;
      // }

      // $employees=Employee::find()->count();
      // echo $employees;

      // $employees=Employee::findOne(['name'=>'alit']);
      // echo $employees->id."-";
      // echo $employees->name."-";
      // echo $employees->age;

      // $employees=Employee::findAll(['name'=>['Alit','dewi']]);
      // // print_r($employees);
      // foreach ($employees as $employee ) {
      //   echo "<br>";
      //   echo $employee->id."-";
      //   echo $employee->name."-";
      //   echo $employee->age;
      // }

      // $employee= new Employee();
      // $employee->name='James Bond4';
      // $employee->age=200;
      // $employee->gender="male";
      // $employee->save();

      // $employee=Employee::findOne(['name'=>'Alit']);
      // $employee->age=26;
      // $employee->save();

      // $employee=Employee::findOne(['name'=>'alit','age'=>1]);
      // $employee->delete();

    }

    public function actionRelasi()
    {
      $customer=Customer::findOne(1);
      // print_r($customer);
      // echo $customer->name;

      $orders=$customer->orders;
      // print_r($orders);
      // echo $orders->price."<br>";
      // echo $orders->name;
      foreach ($orders as $key) {
        echo $customer->name.'<br>';
        echo  $key->name;
      }
    }

    public function actionTransaksiData()
    {
      $transaksi=Employee::getDb()->beginTransaction();
      try {
        $employee=new Employee();
        $employee->name='Gamora';
        $employee->age=37;
        $employee->gender='female';
        $employee->save();

        $transaksi->commit();
      } catch (\Exception $e) {
        $transaksi->rollBack();
        throw $e;
      }

    }
}
