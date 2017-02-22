<?php

use PHPUnit\Framework\TestCase;

class FilterRevenueForUserUnitTest extends TestCase
{
    public function testFilter() {
        $list = array();
        $obj1 = new \App\AssetFlow();
        $obj1->setEmployeeId("JE");
        $obj1->setAmount(10);
        $obj1->setDate(strtotime("2017-02-10"));
        $list[] = $obj1;
        $obj2 = new \App\AssetFlow();
        $obj2->setEmployeeId("JE");
        $obj2->setAmount(-5);
        $obj2->setDate(strtotime("2017-02-02"));
        $list[] = $obj2;
        $obj3 = new \App\AssetFlow();
        $obj3->setEmployeeId("JE");
        $obj3->setAmount(15);
        $obj3->setDate(strtotime("2017-01-05"));
        $list[] = $obj3;
        $obj4 = new \App\AssetFlow();
        $obj4->setEmployeeId("JE");
        $obj4->setAmount(3);
        $obj4->setDate(strtotime("2016-01-23"));
        $list[] = $obj4;

        assertThat(\App\RevenueCalculator::filterRevenueByYear($list, "2016"), is(3));
        assertThat(\App\RevenueCalculator::filterRevenueByYear($list, "2016", 1), is(3));
        assertThat(\App\RevenueCalculator::filterRevenueByYear($list, "2016", 2), is(0));
        assertThat(\App\RevenueCalculator::filterRevenueByYear($list, "2017"), is(20));
        assertThat(\App\RevenueCalculator::filterRevenueByYear($list, "2017", 2), is(5));
    }
}

