lightning Swap User
=================
[Russian version readme](https://github.com/githubjeka/lightningSwapUser/blob/master/Readme_rus.md)
 

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
        'fieldNameUser' => 'username', //Name field login
        'fieldIdUser' => 'id', //Name field ID
        'ipWhiteList' => array(), // List of ip addresses that are available widget.
        'typeView' => 'dropDown' // Type of widget - 'autoComplete' (CJuiAutoComplete) or 'dropDown' (dropDownList) 
    )
);
?>
```
ipWhiteList - default array('127.0.0.1', '::1/128') - localhost. These ip addresses will be added to your.

or one line this code:
```php
<?php $this->widget('Masked'); ?>
```

Note: Restrict access to this widget only necessary users.
