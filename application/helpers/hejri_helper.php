<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Hijri date Convertor, convert the date to Hijri date
 *
 * @param string $format
 * @param int $timestamp
 * @return bool|string
 */
function hejriDateConvertor($format='_j _M _Yهـ', $timestamp=0)
{
    $gmonths = array("يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر");
    $smonths = array("كانون الثاني", "شباط", "آذار", "نيسان", "أيار", "حزيران", "تموز", "آب", "أيلول", "تشرين الأول", "تشرين الثاني", "كانون الأول");
    $days = array("الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت");
    $hmonths = array("محرم", "صفر", "شهر ربيع الأول", "شهر ربيع الثاني", "جمادى الأولى", "جمادى الآخرة", "رجب", "شعبان", "شهر رمضان", "شوال", "ذو القعدة", "ذو الحجة");

    if ($timestamp == 0) {
        $timestamp = time();
    }
    list($w, $mn, $am) = explode(' ', date("w n a", $timestamp));
    $j = intval($timestamp / 86400);
    $j = $j + 492150; //492534;
    $n = intval($j / 10631);
    $j = $j - ($n * 10631);
    $y = intval($j / 354.36667);
    $hy = ($n * 30) + $y + 1;
    $j = $j - round($y * 354.36667);
    $z = $j;
    $m = intval($j / 29.5);
    $hm = $m + 1;
    $j = $j - round($m * 29.5);
    $d = $j;
    $hd = intval($d);

    If ($hd == 0) {
        $hd = ($hm % 2 == 1) ? (29) : (30);
        $hm = $hm - 1;
    }

    If ($hm == 0) {
        $hm = 12;
        $hy = $hy - 1;
        if (round(($hy % 30) * 0.36667) > round((($hy - 1) % 30) * 0.36667)) {
            $hd = 30;
            $z = 355;
        } else {
            $hd = 29;
            $z = 354;
        }
    }
    $L = (round(($hy % 30) * 0.36667) > round((($hy - 1) % 30) * 0.36667)) ? (1) : (0);
    $str = '';
    for ($n = 0; $n <= strlen($format); $n++) {
        $c = substr($format, $n, 1);
        switch ($c) {
            case "l":
            case "D":
                $str.=$days[$w];
                break;
            case "F":
                $str.=$smonths[($mn - 1)];
                break;
            case "M":
                $str.=$gmonths[($mn - 1)];
                break;
            case "a":
                $str.= ( $am == 'am') ? ('ص') : ('م');
                break;
            case "A":
                $str.= ( $am == 'AM') ? ('صباحًا') : ('مساءً');
                break;
            case "_":
                $n = $n + 1;
                switch (substr($format, $n, 1)) {
                    case "j":
                        $str.=$hd;
                        break;
                    case "d":
                        $str.=str_pad($hd, 2, "0", STR_PAD_LEFT);
                        break;
                    case "z":
                        $str.=$z - 1;
                        break;
                    case "F":case "M":
                    $str.=$hmonths[($hm - 1)];
                    break;
                    case "t":
                        $t = ($hm % 2 == 1) ? (30) : (29);
                        If ($hm == 12 && $L == 1)
                            $t = 30;
                        $str.=$t;
                        break;
                    case "m":
                        $str.=str_pad($hm, 2, "0", STR_PAD_LEFT);
                        break;
                    case "n":
                        $str.=$hm;
                        break;
                    case "y":
                        $str.=substr($hy, 2);
                        break;
                    case "Y":
                        $str.=$hy;
                        break;
                    case "L":
                        $str.=$L;
                        break;
                }
                break;
            case '\\':
                $str.=substr($format, $n, 2);
                $n++;
                break;
            default:
                $str.=$c;
                break;
        }
    }
    return date($str, $timestamp);
}

/**
 * intPart
 *
 * @param $floatNum
 * @return float
 */
function intPart($floatNum)
{
    if ($floatNum< -0.0000001)
    {
        return ceil($floatNum-0.0000001);
    }
    return floor($floatNum+0.0000001);
}

/**
 * ConstractDayMonthYear
 *
 * extract day, month, year out of the date based on the format.
 *
 * @param $date
 * @param $format
 * @param $year
 * @param $month
 * @param $day
 */
function ConstractDayMonthYear($date, $format, &$year = '', &$month = '', &$day = '')
{
    $year = '';
    $month = '';
    $day = '';

    $format=strtoupper($format);
    $format_Ar= str_split($format);
    $srcDate_Ar=str_split($date);

    for ($i=0;$i<count($format_Ar);$i++)
    {

        switch($format_Ar[$i])
        {
            case "D":
                $day.=$srcDate_Ar[$i];
                break;
            case "M":
                $month.=$srcDate_Ar[$i];
                break;
            case "Y":
                $year.=$srcDate_Ar[$i];
                break;
        }
    }
}

/**
 * HijriToGregorian
 *
 * $date like 10121400, $format like DDMMYYYY, take date & check if its hijri then convert to gregorian date in format (DD-MM-YYYY), if it gregorian the return empty;
 *
 * @param $date
 * @param $format
 * @return string
 */
function HijriToGregorian($date, $format)
{

    $year = '';
    $month = '';
    $day = '';

    ConstractDayMonthYear($date, $format, $year, $month, $day);

    $d=intval($day);
    $m=intval($month);
    $y=intval($year);

    if ($y<1700)
    {

        $jd=intPart((11*$y+3)/30)+354*$y+30*$m-intPart(($m-1)/2)+$d+1948440-385;

        if ($jd> 2299160 )
        {
            $l=$jd+68569;
            $n=intPart((4*$l)/146097);
            $l=$l-intPart((146097*$n+3)/4);
            $i=intPart((4000*($l+1))/1461001);
            $l=$l-intPart((1461*$i)/4)+31;
            $j=intPart((80*$l)/2447);
            $d=$l-intPart((2447*$j)/80);
            $l=intPart($j/11);
            $m=$j+2-12*$l;
            $y=100*($n-49)+$i+$l;
        }
        else
        {
            $j=$jd+1402;
            $k=intPart(($j-1)/1461);
            $l=$j-1461*$k;
            $n=intPart(($l-1)/365)-intPart($l/1461);
            $i=$l-365*$n+30;
            $j=intPart((80*$i)/2447);
            $d=$i-intPart((2447*$j)/80);
            $i=intPart($j/11);
            $m=$j+2-12*$i;
            $y=4*$k+$n+$i-4716;
        }

        if ($d<10)
            $d="0".$d;

        if ($m<10)
            $m="0".$m;

        return $d."-".$m."-".$y;
    }

    return "";
}

/**
 * GregorianToHijri
 *
 * $date like 10122011, $format like DDMMYYYY, take date & check if its gregorian then convert to hijri date in format (DD-MM-YYYY), if it hijri the return empty;
 *
 * @param $date
 * @param $format
 * @return string
 */
function GregorianToHijri($date, $format)
{

    $year = '';
    $month = '';
    $day = '';

    ConstractDayMonthYear($date, $format, $year, $month, $day);

    $d=intval($day);
    $m=intval($month);
    $y=intval($year);

    if ($y>1700)
    {
        if (($y>1582)||(($y==1582)&&($m>10))||(($y==1582)&&($m==10)&&($d>14)))
        {
            $jd=intPart((1461*($y+4800+intPart(($m-14)/12)))/4)+intPart((367*($m-2-12*(intPart(($m-14)/12))))/12)-intPart((3*(intPart(($y+4900+intPart(($m-14)/12))/100)))/4)+$d-32075;
        }
        else
        {
            $jd = 367*$y-intPart((7*($y+5001+intPart(($m-9)/7)))/4)+intPart((275*$m)/9)+$d+1729777;
        }

        $l=$jd-1948440+10632;
        $n=intPart(($l-1)/10631);
        $l=$l-10631*$n+354;
        $j=(intPart((10985-$l)/5316))*(intPart((50*$l)/17719))+(intPart($l/5670))*(intPart((43*$l)/15238));
        $l=$l-(intPart((30-$j)/15))*(intPart((17719*$j)/50))-(intPart($j/16))*(intPart((15238*$j)/43))+29;
        $m=intPart((24*$l)/709);
        $d=$l-intPart((709*$m)/24);
        $y=30*$n+$j-30;

        if ($d<10)
            $d="0".$d;

        if ($m<10)
            $m="0".$m;

        return $d."-".$m."-".$y;
    }

    return "";
}

