<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class Category extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['title', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    // public function behaviors()
    //     {
    //         return [
    //             'timestamp' => [
    //                 'class' => 'yii\behaviors\TimestampBehavior',
    //                 'attributes' => [
    //                     ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
    //                     ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
    //                 ],
    //                 'value' => new Expression('NOW()'),
    //             ],
    //         ];
    //      }

    // public function behaviors()
    // {
    //   return[
    //     [
    //     'class'=>TimestampBehavior::className(),
    //     'createdAtAttribute'=>'created_at',
    //     'updatedAtAttribute'=>'updated_at',
    //     'value'=>new Expression('NOW()'),
    //     ],
    //     // BlameableBehavior::className(),
    //     // [
    //     //   'class'=>BlameableBehavior::className(),
    //     //   'createdByAttribute'=>'created_by',
    //     //   'updatedByAttribute'=>'updated_by',
    //     // ],
    //   ];
    // }

    public function behaviors(){
    return [
        [
        'class' => TimestampBehavior::className(),
        'createdAtAttribute' => 'created_at',
        'updatedAtAttribute' => 'updated_at',
        'value' => new Expression('NOW()'),
        ],
          BlameableBehavior::className()
      ];
    }

    // public function behaviors(){
    // return [
    //         TimestampBehavior::className(),
    //         BlameableBehavior::className()
    //       ];
    // }
    // //
    // public function behaviors()
    // {
    //     return [
    //         [
    //             'class' => TimestampBehavior::className(),
    //             'attributes' => [
    //                 ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
    //                 ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
    //             ],
    //             // if you're using datetime instead of UNIX timestamp:
    //             'value' => new Expression('NOW()'),
    //         ],
    //
    //     ];
    // }
}
