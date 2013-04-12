<?php
/**
 * Masked.php
 * MaskedWidget
 *
 * @author Evgeniy Tkachenko <et.coder@gmail.com>
 */
class Masked extends CWidget
{
    public $modelNameUser = 'User';
    public $fieldNameUser = 'username';

    public function init()
    {
        $userModel = CActiveRecord::model($this->modelNameUser);
        $controller = $this->getController();
        echo CHtml::activeDropDownList(
            $userModel,
            $this->fieldNameUser,
            Chtml::listData($userModel->findAll(), $this->fieldNameUser, $this->fieldNameUser),
            array(
                'onchange' => 'js:document.location.replace("' .
                    $controller->createUrl(
                        '/masquerade'
                    ) . '?username="+this.value)',
                'empty' => '-------------',
            )
        );
        $session = new CHttpSession();
        $session['cookie_modelName_user'] = $this->modelNameUser;
        $session['cookie_fieldName_user'] = $this->fieldNameUser;
    }
}