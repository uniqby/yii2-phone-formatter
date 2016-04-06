<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 26.11.15
 * Time: 19:43
 *
 *
 */
namespace uniqby\phoneFormatter\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

/**
 * Class PhoneFormatterBehavior
 * @package common\components\behaviors
 *
 * @property ActiveRecord $owner
 */
class PhoneFormatterBehavior extends Behavior
{
    /**
     * @var array the attribute that will receive number value
     */
    public $attributes = ['number'];

    public $countryAlpha2 = 'RU';

    /**
     * @var callable|Expression The expression that will be used for generating the timestamp.
     * This can be either an anonymous function that returns the timestamp value,
     * or an [[Expression]] object representing a DB expression (e.g. `new Expression('NOW()')`).
     * If not set, it will use the value of `time()` to set the attributes.
     */
    public $value;


    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_VALIDATE => 'convertE164',
            BaseActiveRecord::EVENT_BEFORE_INSERT => 'convertE164',
            BaseActiveRecord::EVENT_BEFORE_UPDATE => 'convertE164',
            BaseActiveRecord::EVENT_AFTER_FIND => 'convertInt'
        ];
    }

    public function convertInt($event)
    {
        foreach ($this->attributes as $attribute) {
            $this->owner->{$attribute} = \Yii::$app->formatter->asPhoneInt(
                str_replace('++', '+', $this->owner->{$attribute}),
                $this->countryAlpha2
            );
        }
    }

    public function convertE164($event)
    {
        foreach ($this->attributes as $attribute) {
            $this->owner->{$attribute} = \Yii::$app->formatter->asPhoneE164(
                str_replace('++', '+', $this->owner->{$attribute}),
                $this->countryAlpha2
            );
        }
    }
}
