<?php

namespace App;


class RevenueCalculator
{

    public static function filterRevenueByYear(array $list, $year, $month = null){
        $returnValue = 0;
        foreach ($list as $assetFlow){
            $dateYear = $assetFlow['Year'];

            if ($dateYear == $year)
            {
                if (($month === null) || ($month == $assetFlow['Month']) )
                {
                    $returnValue += $assetFlow['Amount'];

                }

            }
        }

        return $returnValue;
    }
}
