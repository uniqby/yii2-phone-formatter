<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 27.11.2015
 * Time: 11:00
 */

namespace uniqby\phoneFormatter\i18n;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

/**
 * @inheritdoc
 */
class Formatter extends \yii\i18n\Formatter
{
    /**
     * Converts phone to E164 format
     *
     * @param string $phone
     * @param $defaultRegionAlpha2
     * @return String
     */
    public static function asPhoneE164($phone, $defaultRegionAlpha2)
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $phoneNumber = $phoneUtil->parseAndKeepRawInput($phone, $defaultRegionAlpha2);
            return $phoneUtil->format($phoneNumber, PhoneNumberFormat::E164);
        } catch (NumberParseException $e) {
            return $phone;
        }
    }

    /**
     * Converts phone number to international format
     *
     * @param string $phone
     * @param $defaultRegionAlpha2
     * @return String
     */
    public static function asPhoneInt($phone, $defaultRegionAlpha2)
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $phoneNumber = $phoneUtil->parseAndKeepRawInput($phone, $defaultRegionAlpha2);
            return $phoneUtil->format($phoneNumber, PhoneNumberFormat::INTERNATIONAL);
        } catch (NumberParseException $e) {
            return $phone;
        }
    }
}