<?php
class UtilityHelper {
    /**
     * Ordinal from the number
     * @param  int $number    Number to prefix to ordinal
     * @return string         The Ordinal
     */
    public function ordinal($number)
    {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if (($number % 100) >= 11 && ($number % 100) <= 13) {
           return 'th';
        }

        return $ends[$number % 10];
    }

    /**
     * Ordinal and number
     * @param  int $number         Number to prefix to ordinal
     * @param  string $separator   The string to use between the number and ordinal
     * @return string              The Ordinal and Number
     */
    public function numberWithOrdinal($number, $separator = '')
    {
        return $number . $separator . self::ordinal($number);
    }
}