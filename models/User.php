<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "User".
 *
 * @property int $id_user
 * @property string $email
 * @property string $phone
 * @property string $login
 * @property string $password
 *
 * @property Order[] $orders
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'phone', 'login', 'password'], 'required'],
            [['email', 'phone', 'login', 'password'], 'string', 'max' => 255],
            [['login'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'ФИО (кириллица, дефис и пробел)',
            'email' => 'Емейл',
            'phone' => 'Телефон(89999999999)',
            'login' => 'Логин (латиница)',
            'password' => 'Пароль',
            'password_repetition' => 'Повтор пароля',
            'consent' => 'Согласие на обработку данных',
            'admin' => 'Admin',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['user_id' => 'id_user']);
    }

    //IDENTITYINTERFACE PKGH{
        public static function tableName()
        {
            return 'user';
        }
    
        /**
         * Finds an identity by the given ID.
         *
         * @param string|int $id the ID to be looked for
         * @return IdentityInterface|null the identity object that matches the given ID.
         */
        public static function findIdentity($id)
        {
            return static::findOne($id);
        }
    
        /**
         * Finds an identity by the given token.
         *
         * @param string $token the token to be looked for
         * @return IdentityInterface|null the identity object that matches the given token.
         */
        public static function findIdentityByAccessToken($token, $type = null)
        {

        }
    
        /**
         * @return int|string current user ID
         */
        public function getId()
        {
            return $this->id;
        }
    
        /**
         * @return string current user auth key
         */
        public function getAuthKey()
        {

        }
    
        /**
         * @param string $authKey
         * @return bool if auth key is valid for current user
         */
        public function validateAuthKey($authKey)
        {

        }
    //}PKGH

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username'=> $username]);
    }
}
