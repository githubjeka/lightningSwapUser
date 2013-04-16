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

    protected function swap($username)
    {
        $model = CActiveRecord::model(Yii::app()->session['cookie_modelName_user'])->findByAttributes(
            array(Yii::app()->session['cookie_fieldName_user'] => $username)
        );

        if (isset($model)) {
            $identity = new CUserIdentity($username, 'passwords are broken');
            Yii::app()->user->login($identity);
            Yii::app()->user->id = $model->getAttribute(Yii::app()->session['cookie_fieldId_user']);
        }
    }

    public function actionSet($username = null)
    {
        if (Yii::app()->session['access'] == true and Yii::app()->request->isAjaxRequest) {
            $this->swap($username);
            return true;
        }
        throw new CHttpException(404, 'The requested page does not exist.');
    }
}