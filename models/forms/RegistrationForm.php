<?php

namespace app\models\forms;

use app\models\Users;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read Users|null $user
 *
 */
class RegistrationForm extends Model
{
    public $email;
    public $password;
    public $repeatPassword;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [['email', 'password', 'repeatPassword'], 'required'],
            ['email', 'unique', 'targetClass' => '\app\models\Users', 'message' => 'This email has already been taken.'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {

            if ($this->password != $this->repeatPassword) {
                $this->addError($attribute, 'Incorrect password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function registration()
    {
        if ($this->validate()) {
            $user = new Users();
            $user->email = $this->email;
            $user->pass = $user->setPassword($this->password);
            $user->role = Users::ROLE_USER;
            if ($user->save()) {
                \Yii::$app->getSession()->setFlash('success', 'successfully got on to the payment page');
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return Users|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Users::find()->where(['email' => $this->email])->one();
        }

        return $this->_user;
    }
}
