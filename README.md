# yii2-phone-formatter
Phone numbers formatter and behavior for Yii2 Framework

### Composer

The preferred way to install this extension is through [Composer](http://getcomposer.org/).

Either run

```
php composer.phar require uniqby/yii2-phone-formatter "dev-master"
```

or add

```
"uniqby/yii2-phone-formatter": "dev-master"
```

to the require section of your ```composer.json```

## Configuration

### Configure your application in common config:
```php
'components' => [
    'formatter' => [
        'class' => 'uniqby\phoneFormatter\i18n\Formatter',
    ]
]
```

Now you can use asPhoneE164 and asPhoneInt methods

```php
echo \Yii::$app->formatter->asPhoneE164(
    '+375259862464',
    'BY'
);

echo \Yii::$app->formatter->asPhoneInt(
    '+375 25 986-24-64',
    'BY'
);
```

### Behavior
You can add behavior to your models

```php
/**
 * @inheritdoc
 */
public function behaviors()
{
    return [
        'convertPhone' => [
            'class' => PhoneFormatterBehavior::className(),
            'attributes' => [
                'number'
            ]
        ]
    ];
}
```