<?php

namespace App;

class Prognosis extends Blank_Base
{

    public static function get_trend_ab($data_y, $order){
        if ($order == "desc") {
            $data_y = array_reverse($data_y);
        }
        $TREND_POINTS = 3;
        if (count($data_y) > $TREND_POINTS-1) {
            $data_y = array_slice($data_y, -$TREND_POINTS);
            $x_sum = 0;
            $y_sum = 0;
            $xy_sum = 0;
            $xx_sum = 0;
            for ($x = 0; $x < $TREND_POINTS; $x++) {
                $x_sum += $x;
                $y_sum += +$data_y[$x];
                $xy_sum += $x*$data_y[$x];
                $xx_sum += $x*$x;
            }
            $x_aver = $x_sum/$TREND_POINTS;
            $y_aver = $y_sum/$TREND_POINTS;
            $x_aver_2 = $x_aver*$x_aver;
            $b = ($xy_sum - $TREND_POINTS*$x_aver*$y_aver)/($xx_sum-$TREND_POINTS*$x_aver_2);
            $a = $y_aver-$b*$x_aver;
            return [$a,$b];
        } else {
            return false;
        }
    }
    public static function get_prognosis($data_y, $order){
        $TREND_POINTS = 3;
        $ab = Prognosis::get_trend_ab($data_y, $order);
        $prognosis = $ab[0] + $ab[1]*$TREND_POINTS;
        $prognosis = ($prognosis >= 0) ? $prognosis : 0;
        return $prognosis;
    }
    public static function get_prognosis_array($db_object, $order){
        $data = [];
        foreach($db_object as $item) {
            $attr = [];
            foreach($item['attributes'] as $key => $value) {
                if (!isset($data[$key])) {
                    $data[$key] = [];
                }
                array_push($data[$key], $value);
            }
        }
        $prognosis = [];
        foreach($data as $key => $value) {
            $prognosis[$key] = round(Prognosis::get_prognosis($value, $order),2);
        }
        return $prognosis;
    }
}
