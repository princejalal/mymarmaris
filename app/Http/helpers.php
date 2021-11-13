<?php

/********************************************************************************************
 *  change validator message to string
 * ******************************************************************************************
 */


if (!function_exists('validator_string_message')) {

    function validator_string_message($errors) {
        $messages = '';

        // import validate message to string format
        foreach ($errors as $error):

            $messages .= $error;

        endforeach;

        return $messages;

    }


}


/*********************************************************************************************************
 *  general helper
 *
 * *******************************************************************************************************
 */

if (!function_exists('economy_info')) {

    function economy_info() {
        date_default_timezone_set('Asia/Tehran');
        $date = date('YmdH');


        $url = 'https://call4.tgju.org/ajax.json?'.$date;

        $response = file_get_contents($url);
        $resp = json_decode($response);
        $prices = [];

        $prices['bourse'] = $resp->current->bourse;
        $prices['ons'] = $resp->current->ons;
        $prices['sekee'] = $resp->current->sekee;
        $prices['dollar'] = $resp->current->price_dollar_rl;
        $prices['bitcoin'] = $resp->current->bitcoin;
        $prices['eur'] = $resp->current->price_eur;

        return $prices;

    }


}


/**
 * the css files use in more than 2 page
 *
 *
 */
if (!function_exists('general_style')) {

    function general_style() {

        $mainStyle = [
            'css/app.css',
            'css/style.css'
        ];


        foreach ($mainStyle as $css) {
            echo '<link rel="stylesheet"  href="'.asset($css).'">'."\n";
        }

    }


}

if (!function_exists('general_js')) {

    /**
     * the javascript files use in more than 2 page
     *
     */
    function general_js() {

        $mainJs = [
            'js/jquery.min.js',
            'js/popper.min.js',
            'js/bootstrap.min.js',
            'js/mdb.min.js'
        ];


        foreach ($mainJs as $js) {
            echo '<script src="'.asset($js).'"></script>'."\n";
        }


    }


}

if (!function_exists('react_js')) {

    /**
     * include react js files
     */
    function react_js() {

        $react = [
            'https://unpkg.com/react@16/umd/react.development.js',
            'https://unpkg.com/react-dom@16/umd/react-dom.development.js'
        ];


        foreach ($react as $js) {
            echo '<script crossorigin src="'.$js.'"></script>'."\n";
        }

    }


}

if (!function_exists('load_style')) {


    /**
     * load selected css file or files
     *
     * @param  string  $style
     */
    function load_style($style) {

        if (is_array($style)):

            foreach ($style as $css) {
                echo '<link rel="stylesheet" type="text/css" href="'.$css.'">'."\n";
            }

        else:

            echo '<link rel="stylesheet" type="text/css" href="'.$style.'">'."\n";

        endif;

    }


}

if (!function_exists('load_js')) {

    /**
     * load selected javascript file or files
     *
     *
     * @param  string  $js
     */
    function load_js($js) {

        if (is_array($js)):

            foreach ($js as $script) {
                echo '<script  src="'.$script.'"></script>'."\n";
            }

        else:

            echo '<script  src="'.$js.'"></script>';

        endif;


    }


}
if (!function_exists('sendSms')) {


    /**
     * @param  integer  $number
     * @param  integer  $confirmCode
     * @return mixed
     * @throws SoapFault
     */
    function sendSms($number, $confirmCode) {

        $client = new SoapClient("http://188.0.240.110/class/sms/wsdlservice/index.php?wsdl");

        $to = array ($number);

        $input_data = array ("verification-code" => $confirmCode);

        $user = "tafrihyab";

        $pass = "hasannejhad1357";

        $fromNum = "+98100020400";

        $toNum = array ($number);

        $pattern_code = "ses2cu62qc";

        $input_data = array ("verification-code" => $confirmCode);

        return $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);

    }

}


if (!function_exists('error_layout')) {
    /**
     * this function return error style with selected tag
     * @param  string  $message
     * @param  string  $tag
     * @param  string  $att
     * @return string
     */
    function error_layout($message, $tag = 'div', $color = 'alert-success') {

        return "<".$tag." class='alert ".$color." wow fadeIn text-center' ".">".$message."</".$tag.">";

    }

}

if (!function_exists('table_layout')) {

    /**
     *  create table layouts for show data from data base
     * @param  array  $ths
     * @param  object  $data
     * @param  array  $fields
     * @param  array  $options
     *
     */
    function table_layout(array $ths, object $data, array $fields, $options = [], $editInfo = [], $removeInfo = []) {

        $layouts = "<table class=\"table table-striped w-auto table-bordered text-right table-hover\"><thead><tr class=\"table-primary \">";

        foreach ($ths as $th):

            $layouts .= "<th>".$th."</th> ";

        endforeach;

        $layouts .= "</tr></thead><tbody>";

        foreach ($data as $key => $value):

            $layouts .= "<tr>";

            foreach ($fields as $field):

                $layouts .= "<td>".$data[$key]->$field."</td>";

            endforeach;


            if ($options != []):

                foreach ($options as $k => $v):

                    $layouts .= "<td>".$v."</td>";

                endforeach;

            endif;


            if ($editInfo != []):

                $layouts .= '<td>
                          <a  href="'.$editInfo['url'].'" class="btn btn-sm btn-success waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="ویرایش" data-original-title="edit item"><i class="far fa-edit"></i>
                          </a>
                        </td>';

            endif;

            if ($removeInfo != []):

                $layouts .= ' <td>
                                      <a href="'.$removeInfo['url'].'"  class="btn btn-sm btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="حذف" data-original-title="Remove item">X
                                     </a>
                               </td>';
            endif;


            $layouts .= "</tr>";

        endforeach;

        $layouts .= "</tbody></table>";


        echo $layouts;
    }

}

/*********************************************************************************************************
 *  date helper
 * *******************************************************************************************************
 */

if (!function_exists('now')) {

    /**
     * Get "now" time
     *
     * Returns time() based on the timezone parameter or on the
     * "time_reference" setting
     *
     * @param  string
     * @return    int
     */
    function now($timezone = null) {
        if (empty($timezone)) {
            $timezone = config_item('time_reference');
        }

        if ($timezone === 'local' OR $timezone === date_default_timezone_get()) {
            return time();
        }

        $datetime = new DateTime('now', new DateTimeZone($timezone));
        sscanf($datetime->format('j-n-Y G:i:s'), '%d-%d-%d %d:%d:%d', $day, $month, $year, $hour, $minute, $second);

        return mktime($hour, $minute, $second, $month, $day, $year);
    }

}
if (!function_exists('humanTiming')) {

    /**
     * @param  date format $time
     * @return string
     */
    function humanTiming($time) {

        $time = time() - $time; // to get the time since that moment
        $time = ($time < 1) ? 1 : $time;
        $tokens = array (
            31536000 => 'Years',
            2592000  => 'months',
            604800   => 'Weeks',
            86400    => 'Days',
            3600     => 'Hours',
            60       => 'Minute',
            1        => 'Seconds'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) {
                continue;
            }
            $numberOfUnits = floor($time / $unit);
            if ($unit <= 1) {
                return $text.(($numberOfUnits > 1) ? '' : '');
            }
            return $numberOfUnits.' '.$text.(($numberOfUnits > 1) ? '' : '');
        }
    }

}

// ------------------------------------------------------------------------

if (!function_exists('mdate')) {

    /**
     * Convert MySQL Style Datecodes
     *
     * This function is identical to PHPs date() function,
     * except that it allows date codes to be formatted using
     * the MySQL style, where each code letter is preceded
     * with a percent sign:  %Y %m %d etc...
     *
     * The benefit of doing dates this way is that you don't
     * have to worry about escaping your text letters that
     * match the date codes.
     *
     * @param  string
     * @param  int
     * @return    int
     */
    function mdate($datestr = '', $time = '') {
        if ($datestr === '') {
            return '';
        } elseif (empty($time)) {
            $time = now();
        }

        $datestr = str_replace('%\\', '', preg_replace('/([a-z]+?){1}/i', '\\\\\\1', $datestr));

        return date($datestr, $time);
    }

}

// ------------------------------------------------------------------------


// ------------------------------------------------------------------------

if (!function_exists('days_in_month')) {

    /**
     * Number of days in a month
     *
     * Takes a month/year as input and returns the number of days
     * for the given month/year. Takes leap years into consideration.
     *
     * @param  int    a numeric month
     * @param  int    a numeric year
     * @return    int
     */
    function days_in_month($month = 0, $year = '') {
        if ($month < 1 OR $month > 12) {
            return 0;
        } elseif (!is_numeric($year) OR strlen($year) !== 4) {
            $year = date('Y');
        }

        if (defined('CAL_GREGORIAN')) {
            return cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }

        if ($year >= 1970) {
            return (int) date('t', mktime(12, 0, 0, $month, 1, $year));
        }

        if ($month == 2) {
            if ($year % 400 === 0 OR ($year % 4 === 0 && $year % 100 !== 0)) {
                return 29;
            }
        }

        $days_in_month = array (
            31,
            28,
            31,
            30,
            31,
            30,
            31,
            31,
            30,
            31,
            30,
            31
        );
        return $days_in_month[$month - 1];
    }

}

// ------------------------------------------------------------------------

if (!function_exists('local_to_gmt')) {

    /**
     * Converts a local Unix timestamp to GMT
     *
     * @param  int    Unix timestamp
     * @return    int
     */
    function local_to_gmt($time = '') {
        if ($time === '') {
            $time = time();
        }

        return mktime(gmdate('G', $time), gmdate('i', $time), gmdate('s', $time), gmdate('n', $time),
            gmdate('j', $time), gmdate('Y', $time));
    }

}

// ------------------------------------------------------------------------

if (!function_exists('gmt_to_local')) {

    /**
     * Converts GMT time to a localized value
     *
     * Takes a Unix timestamp (in GMT) as input, and returns
     * at the local value based on the timezone and DST setting
     * submitted
     *
     * @param  int    Unix timestamp
     * @param  string    timezone
     * @param  bool    whether DST is active
     * @return    int
     */
    function gmt_to_local($time = '', $timezone = 'UTC', $dst = false) {
        if ($time === '') {
            return now();
        }

        $time += timezones($timezone) * 3600;

        return ($dst === true) ? $time + 3600 : $time;
    }

}

// ------------------------------------------------------------------------

if (!function_exists('mysql_to_unix')) {

    /**
     * Converts a MySQL Timestamp to Unix
     *
     * @param  int    MySQL timestamp YYYY-MM-DD HH:MM:SS
     * @return    int    Unix timstamp
     */
    function mysql_to_unix($time = '') {
        // We'll remove certain characters for backward compatibility
        // since the formatting changed with MySQL 4.1
        // YYYY-MM-DD HH:MM:SS

        $time = str_replace(array (
            '-',
            ':',
            ' '
        ), '', $time);

        // YYYYMMDDHHMMSS
        return mktime(substr($time, 8, 2), substr($time, 10, 2), substr($time, 12, 2), substr($time, 4, 2),
            substr($time, 6, 2), substr($time, 0, 4));
    }

}

// ------------------------------------------------------------------------

if (!function_exists('unix_to_human')) {

    /**
     * Unix to "Human"
     *
     * Formats Unix timestamp to the following prototype: 2006-08-21 11:35 PM
     *
     * @param  int    Unix timestamp
     * @param  bool    whether to show seconds
     * @param  string    format: us or euro
     * @return    string
     */
    function unix_to_human($time = '', $seconds = false, $fmt = 'us') {
        $r = date('Y', $time).'-'.date('m', $time).'-'.date('d', $time).' ';

        if ($fmt === 'us') {
            $r .= date('h', $time).':'.date('i', $time);
        } else {
            $r .= date('H', $time).':'.date('i', $time);
        }

        if ($seconds) {
            $r .= ':'.date('s', $time);
        }

        if ($fmt === 'us') {
            return $r.' '.date('A', $time);
        }

        return $r;
    }

}

// ------------------------------------------------------------------------

if (!function_exists('human_to_unix')) {

    /**
     * Convert "human" date to GMT
     *
     * Reverses the above process
     *
     * @param  string    format: us or euro
     * @return    int
     */
    function human_to_unix($datestr = '') {
        if ($datestr === '') {
            return false;
        }

        $datestr = preg_replace('/\040+/', ' ', trim($datestr));

        if (!preg_match('/^(\d{2}|\d{4})\-[0-9]{1,2}\-[0-9]{1,2}\s[0-9]{1,2}:[0-9]{1,2}(?::[0-9]{1,2})?(?:\s[AP]M)?$/i',
            $datestr)) {
            return false;
        }

        sscanf($datestr, '%d-%d-%d %s %s', $year, $month, $day, $time, $ampm);
        sscanf($time, '%d:%d:%d', $hour, $min, $sec);
        isset($sec) OR $sec = 0;

        if (isset($ampm)) {
            $ampm = strtolower($ampm);

            if ($ampm[0] === 'p' && $hour < 12) {
                $hour += 12;
            } elseif ($ampm[0] === 'a' && $hour === 12) {
                $hour = 0;
            }
        }

        return mktime($hour, $min, $sec, $month, $day, $year);
    }

}

// ------------------------------------------------------------------------

if (!function_exists('nice_date')) {

    /**
     * Turns many "reasonably-date-like" strings into something
     * that is actually useful. This only works for dates after unix epoch.
     *
     * @param  string    The terribly formatted date-like string
     * @param  string    Date format to return (same as php date function)
     * @return    string
     * @deprecated    3.1.3    Use DateTime::createFromFormat($input_format, $input)->format($output_format);
     */
    function nice_date($bad_date = '', $format = false) {
        if (empty($bad_date)) {
            return 'Unknown';
        } elseif (empty($format)) {
            $format = 'U';
        }

        // Date like: YYYYMM
        if (preg_match('/^\d{6}$/i', $bad_date)) {
            if (in_array(substr($bad_date, 0, 2), array (
                '19',
                '20'
            ))) {
                $year = substr($bad_date, 0, 4);
                $month = substr($bad_date, 4, 2);
            } else {
                $month = substr($bad_date, 0, 2);
                $year = substr($bad_date, 2, 4);
            }

            return date($format, strtotime($year.'-'.$month.'-01'));
        }

        // Date Like: YYYYMMDD
        if (preg_match('/^\d{8}$/i', $bad_date, $matches)) {
            return DateTime::createFromFormat('Ymd', $bad_date)->format($format);
        }

        // Date Like: MM-DD-YYYY __or__ M-D-YYYY (or anything in between)
        if (preg_match('/^(\d{1,2})-(\d{1,2})-(\d{4})$/i', $bad_date, $matches)) {
            return date($format, strtotime($matches[3].'-'.$matches[1].'-'.$matches[2]));
        }

        // Any other kind of string, when converted into UNIX time,
        // produces "0 seconds after epoc..." is probably bad...
        // return "Invalid Date".
        if (date('U', strtotime($bad_date)) === '0') {
            return 'Invalid Date';
        }

        // It's probably a valid-ish date format already
        return date($format, strtotime($bad_date));
    }

}

// ------------------------------------------------------------------------

if (!function_exists('timezones')) {

    /**
     * Timezones
     *
     * Returns an array of timezones. This is a helper function
     * for various other ones in this library
     *
     * @param  string    timezone
     * @return    string
     */
    function timezones($tz = '') {
        // Note: Don't change the order of these even though
        // some items appear to be in the wrong order

        $zones = array (
            'UM12'   => -12,
            'UM11'   => -11,
            'UM10'   => -10,
            'UM95'   => -9.5,
            'UM9'    => -9,
            'UM8'    => -8,
            'UM7'    => -7,
            'UM6'    => -6,
            'UM5'    => -5,
            'UM45'   => -4.5,
            'UM4'    => -4,
            'UM35'   => -3.5,
            'UM3'    => -3,
            'UM2'    => -2,
            'UM1'    => -1,
            'UTC'    => 0,
            'UP1'    => +1,
            'UP2'    => +2,
            'UP3'    => +3,
            'UP35'   => +3.5,
            'UP4'    => +4,
            'UP45'   => +4.5,
            'UP5'    => +5,
            'UP55'   => +5.5,
            'UP575'  => +5.75,
            'UP6'    => +6,
            'UP65'   => +6.5,
            'UP7'    => +7,
            'UP8'    => +8,
            'UP875'  => +8.75,
            'UP9'    => +9,
            'UP95'   => +9.5,
            'UP10'   => +10,
            'UP105'  => +10.5,
            'UP11'   => +11,
            'UP115'  => +11.5,
            'UP12'   => +12,
            'UP1275' => +12.75,
            'UP13'   => +13,
            'UP14'   => +14
        );

        if ($tz === '') {
            return $zones;
        }

        return isset($zones[$tz]) ? $zones[$tz] : 0;
    }

}

// ------------------------------------------------------------------------

if (!function_exists('date_range')) {

    /**
     * Date range
     *
     * Returns a list of dates within a specified period.
     *
     * @param  int    unix_start    UNIX timestamp of period start date
     * @param  int    unix_end|days    UNIX timestamp of period end date
     *                    or interval in days.
     * @param  mixed    is_unix        Specifies whether the second parameter
     *                    is a UNIX timestamp or a day interval
     *                     - TRUE or 'unix' for a timestamp
     *                     - FALSE or 'days' for an interval
     * @param  string  date_format    Output date format, same as in date()
     * @return    array
     */
    function date_range($unix_start = '', $mixed = '', $is_unix = true, $format = 'Y-m-d') {
        if ($unix_start == '' OR $mixed == '' OR $format == '') {
            return false;
        }

        $is_unix = !(!$is_unix OR $is_unix === 'days');

        // Validate input and try strtotime() on invalid timestamps/intervals, just in case
        if ((!ctype_digit((string) $unix_start) && ($unix_start = @strtotime($unix_start)) === false) OR (!ctype_digit((string) $mixed) && ($is_unix === false OR ($mixed = @strtotime($mixed)) === false)) OR ($is_unix === true && $mixed < $unix_start)) {
            return false;
        }

        if ($is_unix && ($unix_start == $mixed OR date($format, $unix_start) === date($format, $mixed))) {
            return array (date($format, $unix_start));
        }

        $range = array ();

        $from = new DateTime();
        $from->setTimestamp($unix_start);

        if ($is_unix) {
            $arg = new DateTime();
            $arg->setTimestamp($mixed);
        } else {
            $arg = (int) $mixed;
        }

        $period = new DatePeriod($from, new DateInterval('P1D'), $arg);
        foreach ($period as $date) {
            $range[] = $date->format($format);
        }

        /* If a period end date was passed to the DatePeriod constructor, it might not
         * be in our results. Not sure if this is a bug or it's just possible because
         * the end date might actually be less than 24 hours away from the previously
         * generated DateTime object, but either way - we have to append it manually.
         */
        if (!is_int($arg) && $range[count($range) - 1] !== $arg->format($format)) {
            $range[] = $arg->format($format);
        }

        return $range;
    }

}


if (!function_exists('jalali_to_gregorian')) {

    function jalali_to_gregorian($jy, $jm, $jd, $mod = '') {
        if ($jy > 979) {
            $gy = 1600;
            $jy -= 979;
        } else {
            $gy = 621;
        }
        $days = (365 * $jy) + (((int) ($jy / 33)) * 8) + ((int) ((($jy % 33) + 3) / 4)) + 78 + $jd + (($jm < 7) ? ($jm - 1) * 31 : (($jm - 7) * 30) + 186);
        $gy += 400 * ((int) ($days / 146097));
        $days %= 146097;
        if ($days > 36524) {
            $gy += 100 * ((int) (--$days / 36524));
            $days %= 36524;
            if ($days >= 365) {
                $days++;
            }
        }
        $gy += 4 * ((int) ($days / 1461));
        $days %= 1461;
        if ($days > 365) {
            $gy += (int) (($days - 1) / 365);
            $days = ($days - 1) % 365;
        }
        $gd = $days + 1;
        foreach (array (
                     0,
                     31,
                     (($gy % 4 == 0 and $gy % 100 != 0) or ($gy % 400 == 0)) ? 29 : 28,
                     31,
                     30,
                     31,
                     30,
                     31,
                     31,
                     30,
                     31,
                     30,
                     31
                 ) as $gm => $v) {
            if ($gd <= $v) {
                break;
            }
            $gd -= $v;
        }
        return ($mod == '') ? array (
            $gy,
            $gm,
            $gd
        ) : $gy.$mod.$gm.$mod.$gd;
    }

}
if (!function_exists('gregorian_to_jalali')) {


    function gregorian_to_jalali($gy, $gm, $gd, $mod = '') {
        $g_d_m = array (
            0,
            31,
            59,
            90,
            120,
            151,
            181,
            212,
            243,
            273,
            304,
            334
        );
        if ($gy > 1600) {
            $jy = 979;
            $gy -= 1600;
        } else {
            $jy = 0;
            $gy -= 621;
        }
        $gy2 = ($gm > 2) ? ($gy + 1) : $gy;
        $days = (365 * $gy) + ((int) (($gy2 + 3) / 4)) - ((int) (($gy2 + 99) / 100)) + ((int) (($gy2 + 399) / 400)) - 80 + $gd + $g_d_m[$gm - 1];
        $jy += 33 * ((int) ($days / 12053));
        $days %= 12053;
        $jy += 4 * ((int) ($days / 1461));
        $days %= 1461;
        if ($days > 365) {
            $jy += (int) (($days - 1) / 365);
            $days = ($days - 1) % 365;
        }
        $jm = ($days < 186) ? 1 + (int) ($days / 31) : 7 + (int) (($days - 186) / 30);
        $jd = 1 + (($days < 186) ? ($days % 31) : (($days - 186) % 30));
        return ($mod == '') ? array (
            $jy,
            $jm,
            $jd
        ) : $jy.$mod.$jm.$mod.$jd;
    }

}

if (!function_exists('changeDate')) {

    /**
     * change date gregorian to jalali or jalali to gregorian
     *
     * @param  date format $date
     * @param  string  $delimiter
     * @param  bool  $offset
     * @param  string  $mode
     * @return array|string
     */
    function changeDate($date, $delimiter, $offset = false, $mode = '-') {

        // if date have (space or time) like 2019-08-29 12:52:23 first explod with space and then explod with $delimiter
        if (strpos($date, ' ') == true):

            $dateWithoutTime = explode(' ', $date);

            $explodeDate = explode($delimiter, $dateWithoutTime[0]);

        else:

            $explodeDate = explode($delimiter, $date);

        endif;

        if ($offset == false):

            $res = jalali_to_gregorian($explodeDate[0], $explodeDate[1], $explodeDate[2], $mode);

        else:

            $res = gregorian_to_jalali($explodeDate[0], $explodeDate[1], $explodeDate[2], $mode);

        endif;

        return $res;
    }

}

/********************************************************************************************
 *  word count and reading time helper
 * ******************************************************************************************
 */

if (!function_exists('countArticleWord')) {

    function countArticleWord($string) {
        $stringWithOutHtmlTag = strip_tags($string);
        $character_count = mb_str_word_count($stringWithOutHtmlTag);
        return $character_count;
    }

}
if (!function_exists('mb_str_word_count')) {

    function mb_str_word_count($string, $format = 0, $charlist = '[]') {
//        $string = trim($string);
        if (empty($string)) {
            $words = array ();
        } else {
            $words = preg_split('~[^\p{L}\p{N}\']+~u', $string);
        }
        switch ($format) {
            case 0:
                return count($words);
                break;
            case 1:
            case 2:
                return $words;
                break;
            default:
                return $words;
                break;
        }
    }

}
if (!function_exists('reading_time')) {

    function reading_time($word_count) {


        $minutes = floor($word_count / 200);
        $seconds = floor($word_count % 200 / (200 / 60));

        $str_minutes = ($minutes == 1) ? "دقیقه" : "دقیقه";
        $str_seconds = ($seconds == 1) ? "ثانیه" : "ثانیه";

        if ($minutes == 0) {
            return "{$seconds} {$str_seconds}";
        } else {
            return "{$minutes} {$str_minutes}, {$seconds} {$str_seconds}";
        }
    }

}

if (!function_exists('post_summary')) {

    function post_summary($string, $start = 0., $end = 150) {

        $summary = str_replace('&nbsp;', ' ', strip_tags($string));

        $sum = mb_substr($summary, $start, $end);
        return $sum.' ...';
    }

}


if (!function_exists('url_format')) {

    function url_format($str) {

        $urlFormat = preg_replace('/ /', '-', $str);
        return $urlFormat;

    }
}

if (!function_exists('url_to_post')) {

    function url_to_post($kind, $id, $str) {

        $id = $id;
        $str = $str;

        return '/'.$kind.'/'.$id.'/'.$str;
    }

}


if (!function_exists('diffrent_time')) {

    /**
     * @param $int value day or month for calculation diffrent time to now
     * @param  string  $kind  kind of calculation <p>month or day or year</p>
     * @return false|string
     */
    function diffrent_time($int, $kind = 'month') {

        return date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))).$int.$kind));

    }


}

if (!function_exists('check_property')) {

    function check_property($variable, $peroperty) {

        if (isset($variable->$peroperty)):

            return $variable->$peroperty;

        endif;

        return '';
    }

}

if (!function_exists('check_Info')) {

    function check_Info($variable, $peroperty, $mainInfo) {

        if (isset($variable->$peroperty)):

            return $variable->$peroperty;

        endif;

        return $mainInfo;
    }

}

if (!function_exists('changeUrlStyle')) :

    function changeUrlStyle($input, $implode = '-', $explode = ' ') {
        $result = implode($implode, explode($explode, $input));
        return $result;
    }

endif;


if (!function_exists('getCurrencyIcon')) {

    function getCurrencyIcon($id) {
        $currency = \App\Currency::where('currency_id', $id)->first();

        return $currency->currency_icon;

    }

}

if (!function_exists('get_lang_id')) {
    function get_lang_id($shortName) {

        $language = \App\Language::where('lang_short_name', $shortName)->first();

        if ($language):
            return $language->lang_id;
        endif;
        return null;

    }

}


if (!function_exists('check_link_in_text')) {

    function check_link_in_text($text) {

        $pattern = '~[a-z]+://\S+~';

        $count = preg_match_all($pattern, $text, $out);

        if ($count > 0):
            return true;
        endif;

        return false;

    }

}
if (!function_exists('locale_words')) {

    function locale_words($word) {

        return __('message.'.$word);

    }


}

if (!file_exists('get_lang_info')) {
    function get_lang_info($id) {

        $lang = \App\Language::where("lang_id", $id)->first();

        return $lang;
    }
}

if (!file_exists('get_currency_info')) {

    function get_currency_info($id) {

        $currency = \App\Currency::where("Currency_id", $id)->first();

        return $currency;
    }
}


if (!function_exists('check_user_lang')) {

    function check_user_lang($country) {

        $lang = 'en';

        switch ($country) {
            case "DJ":
            case "ER":
            case "ET":

                $lang = "aa";
                break;

            case "AE":
            case "BH":
            case "DZ":
            case "EG":
            case "IQ":
            case "JO":
            case "KW":
            case "LB":
            case "LY":
            case "MA":
            case "OM":
            case "QA":
            case "SA":
            case "SD":
            case "SY":
            case "TN":
            case "YE":

                $lang = "ar";
                break;

            case "AZ":

                $lang = "az";
                break;

            case "BY":

                $lang = "be";
                break;

            case "BG":

                $lang = "bg";
                break;

            case "BD":

                $lang = "bn";
                break;

            case "BA":

                $lang = "bs";
                break;

            case "CZ":

                $lang = "cs";
                break;

            case "DK":

                $lang = "da";
                break;

            case "AT":
            case "CH":
            case "DE":
            case "LU":

                $lang = "de";
                break;

            case "MV":

                $lang = "dv";
                break;

            case "BT":

                $lang = "dz";
                break;

            case "GR":

                $lang = "el";
                break;

            case "AG":
            case "AI":
            case "AQ":
            case "AS":
            case "AU":
            case "BB":
            case "BW":
            case "CA":
            case "GB":
            case "IE":
            case "KE":
            case "NG":
            case "NZ":
            case "PH":
            case "SG":
            case "US":
            case "ZA":
            case "ZM":
            case "ZW":

                $lang = "en";
                break;

            case "AD":
            case "AR":
            case "BO":
            case "CL":
            case "CO":
            case "CR":
            case "CU":
            case "DO":
            case "EC":
            case "ES":
            case "GT":
            case "HN":
            case "MX":
            case "NI":
            case "PA":
            case "PE":
            case "PR":
            case "PY":
            case "SV":
            case "UY":
            case "VE":

                $lang = "es";
                break;

            case "EE":

                $lang = "et";
                break;

            case "IR":

                $lang = "fa";
                break;

            case "FI":

                $lang = "fi";
                break;

            case "FO":

                $lang = "fo";
                break;

            case "BE":
            case "FR":
            case "SN":

                $lang = "fr";
                break;

            case "IL":

                $lang = "he";
                break;

            case "IN":

                $lang = "hi";
                break;

            case "HR":

                $lang = "hr";
                break;

            case "HT":

                $lang = "ht";
                break;

            case "HU":

                $lang = "hu";
                break;

            case "AM":

                $lang = "hy";
                break;

            case "ID":

                $lang = "id";
                break;

            case "IS":

                $lang = "is";
                break;

            case "IT":

                $lang = "it";
                break;

            case "JP":

                $lang = "ja";
                break;

            case "GE":

                $lang = "ka";
                break;

            case "KZ":

                $lang = "kk";
                break;

            case "GL":

                $lang = "kl";
                break;

            case "KH":

                $lang = "km";
                break;

            case "KR":

                $lang = "ko";
                break;

            case "KG":

                $lang = "ky";
                break;

            case "UG":

                $lang = "lg";
                break;

            case "LA":

                $lang = "lo";
                break;

            case "LT":

                $lang = "lt";
                break;

            case "LV":

                $lang = "lv";
                break;

            case "MG":

                $lang = "mg";
                break;

            case "MK":

                $lang = "mk";
                break;

            case "MN":

                $lang = "mn";
                break;

            case "MY":

                $lang = "ms";
                break;

            case "MT":

                $lang = "mt";
                break;

            case "MM":

                $lang = "my";
                break;

            case "NP":

                $lang = "ne";
                break;
            case "TR":
                $lang = 'tr';
                break;
            case "AW":
            case "NL":

                $lang = "nl";
                break;

            case "NO":

                $lang = "no";
                break;

            case "PL":

                $lang = "pl";
                break;

            case "AF":

                $lang = "ps";
                break;

            case "AO":
            case "BR":
            case "PT":

                $lang = "pt";
                break;

            case "RO":

                $lang = "ro";
                break;

            case "RU":
            case "UA":

                $lang = "ru";
                break;

            case "RW":

                $lang = "rw";
                break;

            case "AX":

                $lang = "se";
                break;

            case "SK":

                $lang = "sk";
                break;

            case "SI":

                $lang = "sl";
                break;

            case "SO":

                $lang = "so";
                break;

            case "AL":
        }

        return $lang;
    }
}


if (!function_exists('set_user_lang_by_ip')) {

    function set_user_lang_by_ip($languages) {

        $acceptLang = [];

        foreach ($languages as $language):

            $acceptLang[] = $language->lang_short_name;

        endforeach;


        // user language by defalut en
        $userLang = 'en';

        if (isset($_SERVER['REMOTE_ADDR'])) {
            try {
                // get geolocation information from user ip
                $ipdat = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$_SERVER['REMOTE_ADDR']);
            } catch (Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
            }

            try {
                $ip_api = file_get_contents("http://ip-api.com/json/".$_SERVER['REMOTE_ADDR']);
            } catch (Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
            }

            if (isset($ipdat)):
                // change to array format
                $userIpInfo = (array) json_decode($ipdat);
                // check user language with check_user_lang function
                $userLang = check_user_lang($userIpInfo['geoplugin_countryCode']);
            elseif (isset($ip_api)):
                // change to array format
                $userIpInfo = (array) json_decode($ip_api);
                // check user language with check_user_lang function
                $userLang = check_user_lang($userIpInfo['countryCode']);

            endif;
            // if user language exists in site language return it else return website default language
            $userLang = in_array($userLang, $acceptLang) ? $userLang : 'en';

        }

        return $userLang;

    }


}


if (!function_exists('check_is_mobile')) {


    function check_is_mobile() {

        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $useragent = $_SERVER['HTTP_USER_AGENT'];

            if (preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',
                    $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',
                    substr($useragent, 0, 4))):

                return true;

            endif;
        }


        return false;

    }

}

if (!function_exists('check_language_exists')) {

    function check_language_exists($lng) {

        $languages = \App\Language::where('publish', 1)->get();

        $acceptLang = [];

        foreach ($languages as $language):

            $acceptLang[] = $language->lang_short_name;

        endforeach;

        // if user language exists in site language return it else return website default language
        $lng = in_array($lng, $acceptLang) ? $lng : 'en';

        return $lng;

    }


}

if (!function_exists('detect_browser_language')) {

    function detect_browser_language() {

        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])):

            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            return $lang;

        endif;

        return false;

    }

}

if (!function_exists('change_zone')) {
    function change_zone($dateTime, $locale = 'Europe/Istanbul') {
        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dateTime, 'UTC');
        return $date->setTimezone($locale);
    }

}

if (!function_exists('change_img_class_and_src')) {

    function change_img_class_and_src($string) {

        $stepOne = str_replace('<img', '<img class="lazy"', $string);

        $stepTwo = str_replace('src', 'data-src', $stepOne);

        return $stepTwo;

    }

}