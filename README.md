lightning Swap User
=================

Change the user in a single click, for Yii Framework.

###Install:

1. Copy the repository.
2. Unzip to protected folder.
3. In layout/main.php or on dashboard admin use this code

```php
<?php
$this->widget(
    'Masked',
    array(
        'modelNameUser' => 'User', //Name User model, for example may be - \users\models\User
        'fieldNameUser' => 'username' //Name field login
    )
);
?>
```
or one line 
```php
<?php $this->widget('Masked'); ?>
```

Note: Restrict access to this widget only necessary users.
