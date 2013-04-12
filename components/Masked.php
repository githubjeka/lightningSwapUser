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
    public $fieldIdUser = 'id';

    public function init()
    {
        $userModel = CActiveRecord::model($this->modelNameUser);

        echo CHtml::dropDownList(
            'user',
            $this->fieldNameUser,
            Chtml::listData($userModel->findAll(), $this->fieldNameUser, $this->fieldNameUser),
            array(
                'ajax' => array(
                    'url' => $this->getController()->createUrl('/masquerade'),
                    'encode' => false,
                    'data' => 'js:{"username":this.value}',
                    'success' => 'js: function(html) {
                        document.location.replace(location.href)
                    }',
                ),
                'empty' => '-------------',
            )
        );
        $session = new CHttpSession();
        $session['cookie_modelName_user'] = $this->modelNameUser;
        $session['cookie_fieldName_user'] = $this->fieldNameUser;
        $session['cookie_fieldId_user'] = $this->fieldIdUser;
    }
}