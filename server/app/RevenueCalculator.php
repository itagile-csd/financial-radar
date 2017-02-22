<?php

namespace App;


class RevenueCalculator
{

    public static function filterRevenueByYear(array $list, $year, $month = 0){
        $returnValue = 0;
        foreach ($list as $assetFlow){
            $dateYear = $assetFlow['Year'];

            if($dateYear == $year){
                if($month == 0){
                    $returnValue += $assetFlow['Amount'];
                    continue;
                }
                $dateMonth = $assetFlow['Month'];
                if($dateMonth == $month){
                    $returnValue += $assetFlow['Amount'];
                }
            }
        }

        return $returnValue;
    }
}
