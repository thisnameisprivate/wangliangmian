<?php

namespace Home\Controller;
use Think\Controller;


class IndexController extends Controller {

    /**
     * 首页登陆展示页面
     * @return index
     */
    public function index () {
        $this->display();
    }
    /**
     * 登陆验证
     * @return page dump
     */
    public function login () {
        if ($_POST) {
            $user = M('user');
            $identifter = array($_POST['username'], md5($_POST['password']));
            $result = $user->where("username = '%s' and password = '%s'", $identifter)->select();
            if ($result) {
                cookie('username', $_POST['username']);
                $this->success('login success', U('Admin/Index/index'));
            } else {
                $this->error('login failed', U('Home/Index/index'));
            }
        }
    }
    /**
     * 首页客户信息查询
     */
    public function visitSearch () {
        $visitList = M('visitlist');
        if ($_GET['search'] == '') return false;
        if (is_string($_GET['search'])) {
            $username['name'] = array('like', "%{$_GET['search']}%");
            $visitListCount = $visitList->where($username)->count();
            $visitListData  = $visitList->where($username)->limit(($page = $_GET['page'] - 1) * $_GET['limit'], $_GET['limit'])->order('id desc')->select();
        }
        if (is_numeric($_GET['search'])) {
            $contact['contact'] = array('like', "%{$_GET['search']}%");
            $visitListCount = $visitList->where($contact)->count();
            $visitListData  = $visitList->where($contact)->limit(($page = $_GET['page'] - 1) * $_GET['limit'], $_GET['limit'])->order('id desc')->select();
        }
        $this->arrayRecursive($visitListData, 'urldecode', true);
        $jsonVisitData = urldecode(json_encode($visitListData));
        $visitListData = "{\"code\": 0, \"msg\": \"\", \"count\": $visitListCount, \"data\":$jsonVisitData}";
        $this->ajaxReturn($visitListData, 'eval');
    }
    /**
     * 清除数组中的中文乱码
     * @param $array
     * @param $function
     * @param bool $apply_to_keys_also
     */
    private function arrayRecursive (&$array, $function, $apply_to_keys_also = false) {
        static $recursive_counter = 0;
        if (++ $recursive_counter > 1000) {
            die ('possible deep recursion attack');
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
}