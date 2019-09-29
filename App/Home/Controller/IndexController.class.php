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
     * 登陆详情统计
     * @return country status
     */
//    private function loginLog ($requestVerify, $boolean) {
//        $ips = get_client_ip();
//        $ip = new \Org\Net\IpLocation('UTFwry.dat');
//        $ares = $ip->getlocation($ips);
//        $login_log['username']              = $requestVerify['username'];
//        $login_log['password']              = md5($requestVerify['password']);
//        $login_log['fromaddress']           = empty($ares['country']) ? '生产环境IP: Localhost' : $ares['country'];
//        $login_log['ip']                    = $ips;
//        $boolean ? $login_log['status']     = '登陆成功' : $login_log['status'] = '登陆失败';
//        M('login_log')->add($login_log);
//    }
}