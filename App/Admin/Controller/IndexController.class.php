<?php

namespace Admin\Controller;
use Think\Controller;

class IndexController extends Controller {
    /**
     * 登录验证
     *
     */
    public function index () {
        $userCookie = $_COOKIE['username'];
        if (! isset($userCookie)) $this->error('Please Login!', U("Home/Index/index"));
        $this->assign('userImageUrl', $userImageUrl[0]['imagePath']);
        $this->display();
    }
    /**
     * 列表页表单数据
     * @param null
     * @assign  $selectOption['arrivalStatus']
     *          $selectOption['diseases']
     *          $selectOption['custservice']
     *          $selectOPtion['fromaddress']
     */
    public function visitList () {
        $selectOption = D('Collection')->selectOption();
        $this->assign('status', $selectOption['status']);
        $this->display();
    }
    /**
     * 查询列表信息
     * @param null
     * @return string
     */
    public function visitCheck () {
        $visitList = M('visitlist');
        if ($_GET['search'] == '') {
            $visitListCount = $visitList->count();
            $visitListData = $visitList->limit(($page = $_GET['page'] - 1 ) * $_GET['limit'], $_GET['limit'])->order('id desc')->select();
        } else {
            if (is_string($_GET['search'])) {
                $username['name'] = array('like', "%{$_GET['search']}%");
                $visitListCount = $visitList->where($username)->count();
                $visitListData = $visitList->where($username)->limit(($page = $_GET['page'] - 1) * $_GET['limit'], $_GET['limit'])->order('id desc')->select();
            }
            if (is_numeric($_GET['search'])) {
                $contact['contact'] = array('like', "%{$_GET['search']}%");
                $visitListCount = $visitList->where($contact)->count();
                $visitListData = $visitList->where($contact)->limit(($page = $_GET['page'] - 1) * $_GET['limit'], $_GET['limit'])->order('id dsec')->select();
            }
        }
        $this->arrayRecursive($visitListData, 'urldecode', true);
        $jsonVisitData = urldecode(json_encode($visitListData));
//        $interval = ceil($visitListCount / $totalPage);
        $visitListData = "{\"code\":0, \"msg\":\"\", \"count\": $visitListCount, \"data\": $jsonVisitData}";
        $this->ajaxReturn(str_replace(array("\n", "\r"), '\n', $visitListData), 'eval');
    }
    private function arrayRecursive (&$array, $function, $apply_to_keys_also = false) {
        static $recursive_counter = 0;
        if (++ $recursive_counter > 1000) {
            die('possible deep recursion attack');
        }
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->arrayRecursive($array[$key], $function, $apply_to_keys_also);
            } else {
                $array[$key] = $function($value);
            }
            if ($apply_to_keys_also && is_string($key)) {
                $new_key = $function($key);
                if ($new_key != $key) {
                    $array[$new_key] = $array[$key];
                    unset($array[$key]);
                }
            }
        }
        $recursive_counter --;
    }
    /**
     * 添加列表信息
     * @param null
     * @@return string
     */
    public function visitAddData () {
        $visitData = json_decode($_GET['data'], true);
        $resolve = M('visitlist')->add($visitData);
        if (!empty($resolve)) {
            $this->ajaxReturn(true, 'eval');
        } else {
            $this->ajaxReturn(false, 'eval');
        }
    }
    /**
     * 修改列表信息
     * @param null
     * @@return string
     */
    public function editData () {
        $visitData = json_decode($_GET['data'], true);
        $resolve = M('visitlist')->where("id = {$_GET['id']}")->save($visitData);
        ! empty($resolve)
            ? $this->ajaxReturn(true, 'eval')
            : $this->ajaxReturn(false, 'eval');
    }
}