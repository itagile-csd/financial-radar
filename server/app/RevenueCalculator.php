<?php

namespace App;


class RevenueCalculator
{

    public static function filterRevenueByYear(array $list, $year, $month = 0){
        $returnValue = 0;
        foreach ($list as $assetFlow){
            $timestamp = $assetFlow->getDate();
            $dateYear = date("Y", $timestamp);

            if($dateYear == $year){
                if($month == 0){
                    $returnValue += $assetFlow->getAmount();
                    continue;
                }
                $dateMonth = date("m", $timestamp);
                if($dateMonth == $month){
                    $returnValue += $assetFlow->getAmount();
                }
            }
        }

        return $returnValue;
    }
}
