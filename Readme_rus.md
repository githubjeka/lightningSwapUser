lightning Swap User
=================

Смена пользователя в один клик.

###Использование:

1. Скачайте архив.
2. Распакуйте в папку "protected" своего webapp.
3. В layout/main.php или на панели администратора добавьте следующий код в необходимое место:

```php
<?php
$this->widget(
    'Masked',
    array(
        'modelNameUser' => 'User', //Имя модели User, например - \users\models\User
        'fieldNameUser' => 'username', //Имя поля login в модели User
        'fieldIdUser' => 'id', //Имя поля ID в модели User
        'ipWhiteList' => array(), // Список ip адресов, которым будет доступен виджет.
        'typeView' => 'dropDown' // Тип виджета - 'autoComplete' (CJuiAutoComplete) или 'dropDown' (dropDownList) 
    )
);
?>
```
ipWhiteList - по умолчанию array('127.0.0.1', '::1/128') - localhost. К этим ip адресам будут добавлены ваши.

Этот же код в одну строку:
```php
<?php $this->widget('Masked'); ?>
```

Примечание: Предоставьте права на использование этого кода, только необходимым пользователям.
