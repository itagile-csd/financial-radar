<?php

namespace App;


class RevenueCalculator
{

    public static function filterRevenueByYear(array $list, $year){
        $returnValue = 0;
        foreach ($list as $assetFlow){
            $tempYear = $assetFlow->getDate();
            //$php_date = getdate($tempYear);
            $date = date("Y", $tempYear);

            if($date == $year){
                $returnValue += $assetFlow->getAmount();
            }
        }

        return $returnValue;
    }
}
