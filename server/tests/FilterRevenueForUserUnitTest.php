<?php

use PHPUnit\Framework\TestCase;

class FilterRevenueForUserUnitTest extends TestCase
{
    public function testFilter() {
        $list = array();
        $list[] = array('Employee' => "JE", 'Amount' => 10, 'Year' => '2017', 'Month' => '02');
        $list[] = array('Employee' => "JE", 'Amount' => -5, 'Year' => '2017', 'Month' => '02');
        $list[] = array('Employee' => "JE", 'Amount' => 3, 'Year' => '2017', 'Month' => '01');
        $list[] = array('Employee' => "JE", 'Amount' => 3, 'Year' => '2016', 'Month' => '01');



        assertThat(\App\RevenueCalculator::filterRevenueByYear($list, "2016"), is(3));
        assertThat(\App\RevenueCalculator::filterRevenueByYear($list, "2016", "01"), is(3));
        assertThat(\App\RevenueCalculator::filterRevenueByYear($list, "2016", "02"), is(0));
        assertThat(\App\RevenueCalculator::filterRevenueByYear($list, "2017"), is(8));
        assertThat(\App\RevenueCalculator::filterRevenueByYear($list, "2017", "02"), is(5));
    }
}

