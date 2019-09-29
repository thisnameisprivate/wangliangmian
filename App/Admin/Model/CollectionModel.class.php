<?php

namespace Admin\Model;
use Think\Model;

class CollectionModel extends Model {
    /**
     * 状态配置
     * @var array
     */
    private $collection =
        array(
            0 => 'arrivalTotal',
            1 => 'arrival',
            2 => 'arrivalOut',
            3 => 'yesterTotal',
            4 => 'yesterArrival',
            5 => 'yesterArrivalOut',
            6 => 'thisTotal',
            7 => 'thisArrival',
            8 => 'thisArrivalOut',
            9 => 'lastTotal',
            10 => 'lastArrival',
            11 => 'lastArrivalOut',
            12 => 'appTodayTotal',
            13 => 'appYesterTotal',
            14 => 'appThisTotal',
            15 => 'appLastTotal'
        );
    /**
     * SQL 语法配置
     * @var array
     */
    private $conditions =
        array(
            0 => "TO_DAYS(oldDate) = TO_DAYS(NOW())",
            1 => "TO_DAYS(NOW()) - TO_DAYS(oldDate) = 1",
            2 => "DATE_FORMAT(oldDate, '%Y%m') = DATE_FORMAT(CURDATE(), '%Y%m')"
        );
    /**
     * 表单下拉列表框
     * @return mixed
     */
    public function selectOption () {
        $selectCollection['status'] = M('status')->field('status')->select();
        return $selectCollection;
    }
}