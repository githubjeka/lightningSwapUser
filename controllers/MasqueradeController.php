<?php
/**
 * MasqueradeController.php
 * MasqueradeController
 *
 * @author Evgeniy Tkachenko <et.coder@gmail.com>
 */
class MasqueradeController extends CController
{
    public $defaultAction = 'set';

    protected function swap($session)
    {
        $username = $session['swap_username'];
        $identity = new CUserIdentity($username, 'passwords are broken');
        Yii::app()->user->login($identity);
        $model = CActiveRecord::model($session['cookie_modelName_user'])->find(
            $session['cookie_fieldName_user'] . '="' . $username . '"'
        );
        if (isset($model)) {
            Yii::app()->user->id = $model->getAttribute($session['cookie_fieldId_user']);
        }
    }

    public function actionSet($username)
    {
        if (!Yii::app()->user->isGuest) {
            $session=new CHttpSession;
            $session['swap_username']=$username;
            $this->swap($session);
            return true;
        }
        throw new Exception('Not access');
    }
}