<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $name
 * @property string $surename
 * @property string $middle_name
 * @property string $type
 * @property string $inn
 * @property string $company_name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    const TYPES = ['individual', 'entrepreneur', 'organization'];

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'type', 'name', 'surename'], 'required'],
            [['type'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'name', 'surename', 'middle_name', 'inn', 'company_name'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            ['email', 'email'],
            [['inn'], 'required', 'when' => function ($model) {
                return $model->type > 0;
            }, 'whenClient' => "function (attribute, value) {
                return $('#user-type').val() > 0;
            }"],
            [['company_name'], 'required', 'when' => function ($model) {
                return $model->type == 2;
            }, 'whenClient' => "function (attribute, value) {
                return $('#user-type').val() == 2;
            }"]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'name' => 'Name',
            'surename' => 'Surename',
            'middle_name' => 'Middle Name',
            'type' => 'Type',
            'inn' => 'Inn',
            'company_name' => 'Company Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
