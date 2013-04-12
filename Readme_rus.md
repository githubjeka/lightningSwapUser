lightning Swap User
=================

Смена пользователя в один клик.

###Использование:

1. Скачайте архив.
2. Распакуйте в папку "protected" своего webapp.
3. В layout/main.php или на панели администратора добавте следующий код в необходимое место:

```php
<?php
$this->widget(
    'Masked',
    array(
        'modelNameUser' => 'User', //Имя модели User, например - \users\models\User
        'fieldNameUser' => 'username' //Имя поля login в модели User
    )
);
?>
```
Этот же код в одну строку. 
```php
<?php $this->widget('Masked'); ?>
```

Примечание: Предоставте права на использование этого кода, только необходимым пользователям.