<?php
/**
 * Masked.php
 * MaskedWidget
 *
 * @author Evgeniy Tkachenko <et.coder@gmail.com>
 */

class Masked extends CWidget
{
    const VIEW_AUTO_TYPE = 'autoComplete';
    const VIEW_DROP_TYPE = 'dropDown';

    public $modelNameUser = 'User';
    public $fieldNameUser = 'username';
    public $fieldIdUser = 'id';
    public $typeView = self::VIEW_DROP_TYPE; //may be 'dropDown' or 'autoComplete'
    public $ipWhiteList = array(); //allowed all users and localhost (see $this->accessControl())

    public function init()
    {
        $this->setIpWhiteList($this->ipWhiteList);

        $session = new CHttpSession();

        if ($this->accessControl()) {

            $session['cookie_modelName_user'] = $this->modelNameUser;
            $session['cookie_fieldName_user'] = $this->fieldNameUser;
            $session['cookie_fieldId_user'] = $this->fieldIdUser;
            $session['access'] = true;

            $this->viewWidget();

        } else {

            unset(
            $session['access'],
            $session['cookie_modelName_user'],
            $session['cookie_fieldName_user'],
            $session['cookie_fieldId_user']
            );

        }
    }

    protected function setIpWhiteList($listData)
    {
        if (is_array($listData)) {
            $this->ipWhiteList = array_merge(array('127.0.0.1', '::1/128'), $listData);
            return true;
        }
        throw new Exception('ipWhiteList should be array type.');
    }

    public function accessControl()
    {
        if (Yii::app()->user->isGuest) {
            return false;
        }

        if (!in_array($_SERVER['REMOTE_ADDR'], $this->ipWhiteList)) {

            if (count($this->ipWhiteList) == 2) {

                echo CHtml::openTag('div', array('class' => 'alert alert-info'));

                if (Yii::app()->language == 'ru') {
                    $strongText = 'Ваш ip address: ';
                    $mesText = ' Добавьте его в список безопасных.';
                } else {
                    $strongText = 'Your IP Address is: ';
                    $mesText = ' Add to white list of this IP';
                }
                echo CHtml::tag('strong', array(), $strongText . $_SERVER['REMOTE_ADDR']);
                echo $mesText;

                echo CHtml::closeTag('div');
            }
            return false;
        }

        return true;
    }

    protected function viewWidget()
    {
        $userModel = CActiveRecord::model($this->modelNameUser);

        if ($this->typeView === self::VIEW_DROP_TYPE) {
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
        }

        if ($this->typeView === self::VIEW_AUTO_TYPE) {

            $this->widget(
                'zii.widgets.jui.CJuiAutoComplete',
                array(
                    'name' => $this->fieldNameUser,
                    'source' => array_values(
                        Chtml::listData($userModel->findAll(), $this->fieldNameUser, $this->fieldNameUser)
                    ),
                    'options' => array(
                        'minLength' => 0,
                        'select' => 'js:function( event, ui ) {
                            $.ajax({
                                "url": "' . $this->getController()->createUrl('/masquerade') . '",
                                "data": "username="+ui.item.label,
                                "success": function(html) {
                                    document.location.replace(location.href)
                                }
                            });
                         }',
                    ),
                    'htmlOptions' => array(
                        'placeholder' => (Yii::app()->language == 'ru') ? 'Введите имя пользователя' : 'Enter login'
                    )
                )
            );
        }
    }

}