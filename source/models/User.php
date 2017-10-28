<?php

namespace source\models;

use Yii;
use source\core\base\BaseActiveRecord;
use source\libs\Constants;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $role
 */
class User extends BaseActiveRecord implements IdentityInterface
{
    public $password;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [ [ 'username', 'auth_key', 'password_hash', 'email', 'role', ], 'required' ],
            [ [ 'username', 'email', ], 'unique' ],
            [ ['password'], 'required', 'on' => [ 'login', 'create' ] ],
            [ [ 'status', 'created_at', 'updated_at' ], 'integer' ],
            [ [ 'email' ], 'email' ],
            [ [ 'username', 'password_hash', 'password_reset_token', 'email', 'auth_key' ], 'string', 'max' => 255 ],
        ];
    }

    public function scenarios() {
        $parent = parent::scenarios();
        $parent['login'] = [
            'username', 'password',
        ];
        $parent['create'] = [
            'username', 'password', 'email', 'status', 'role',
        ];
        $parent['update'] = [
            'username', 'password', 'email', 'status', 'updated_at', 'role',
        ];

        return $parent;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id'            => Yii::t('app', 'ID'),
            'username'      => Yii::t('app', 'Username'),
            'password'      => Yii::t('app', 'Password'),
            'auth_key'      => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email'         => Yii::t('app', 'Email'),
            'status'        => Yii::t('app', 'Status'),
            'statusText'    => Yii::t('app', 'Status'),
            'created_at'    => Yii::t('app', 'Created At'),
            'updated_at'    => Yii::t('app', 'Updated At'),
            'role'          => Yii::t('app', 'Rule'),
        ];
    }

    public function getStatusText() {
        return Constants::getStatusItems($this->status);
    }

    public static function findByUsername($username) {
        return self::findOne(['username' => $username]);
    }

    public static function findIdentity($id) {
        return User::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = NULL) {
        return NULL;
    }

    public function getId() {
        return $this->id;
    }

    public function getAuthKey() {
        return $this->id;
    }

    public function validateAuthKey($authKey) {
        return $this->id === $authKey;
    }

    public function validatePassword($password, $password_hash) {
        return Yii::$app->security->validatePassword($password, $password_hash);
    }

    public function generatePasswordHash($password = NULL) {
        if (empty($password)) {
            $password = $this->password;
        }
        $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->getSecurity()->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->getSecurity()->generateRandomKey().'_'.time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = NULL;
    }


    public function login() {
        if (!$this->validate()) {
            return FALSE;
        }

        $user = User::findOne(['username' => $this->username]);

        if ($user !== NULL) {
            if ($this->validatePassword($this->password, $user->password_hash)) {
                \Yii::$app->user->login($user, 50000);

                return TRUE;
            }
        }

        return FALSE;
    }

    public function beforeValidate() {

        return parent::beforeValidate();
    }

    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->generateAuthKey();
            $this->generatePasswordHash();
            //$this->generatePasswordResetToken();
        } else {
            if (!empty($this->password)) {
                $this->generatePasswordHash();
            }
        }

        return parent::beforeSave($insert);
    }
}
