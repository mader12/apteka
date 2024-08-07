<?php

namespace app\models\users;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $family фамилия
 * @property string|null $name Имя
 * @property string|null $surname Отчество
 * @property string|null $email
 * @property string|null $pass
 * @property int|null $role
 *
 * @property Orders[] $orders
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public const GUEST_ID_DEFAULT = 1;
    public const ROLE_GUEST = 0;
    public const ROLE_USER = 1;
    public const ROLE_ADMINISTRATOR = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }
    public function getId()
    {
        return $this->id;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function validateAuthKey($authKey) {
        return $this->email === $authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->email;
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public function setPassword ($password) {

        return Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role'], 'integer'],
            [['family', 'name', 'surname', 'email'], 'string', 'max' => 255],
            [['pass'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'family' => 'Family',
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'E Mail',
            'pass' => 'Pass',
            'pass' => 'Pass',
            'role' => 'Role',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['user_id' => 'id']);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->pass === Yii::$app->security->generatePasswordHash($password);
    }


    public static function findByEmail($email)
    {
        return static::find()->where(['email' => $email])->one();
    }
}
