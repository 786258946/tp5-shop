<?php


namespace app\home\controller;

use app\user\logic\PayLogic;

class Index extends Base
{
    public function _initialize() {
        parent::_initialize();
        $this->alipay_return();
        $this->Express100();
    }

    public function index()
    {
        /*首页焦点*/
        $m = input('param.m/s');
        if (empty($m)) {
            $this->request->get(['m'=>'Index']);
        }
        /*end*/
        
        $filename = 'index.html';

        $seo_pseudo = config('ey_config.seo_pseudo');
        if (file_exists($filename) && 2 == $seo_pseudo && !isset($_GET['clear'])) {
            if ((isMobile() && !file_exists('./template/mobile')) || !isMobile()) {
                header('HTTP/1.1 301 Moved Permanently');
                header('Location:index.html');
                exit;
            }
        }

        /*获取当前页面URL*/
        $result['pageurl'] = request()->url(true);
        /*--end*/
        $eyou = array(
            'field' => $result,
        );
        $this->eyou = array_merge($this->eyou, $eyou);
        $this->assign('eyou', $this->eyou);
        
        /*模板文件*/
        $viewfile = 'index';
        /*--end*/

        /*多语言内置模板文件名*/
        if (!empty($this->home_lang)) {
            $viewfilepath = TEMPLATE_PATH.$this->theme_style.DS.$viewfile."_{$this->home_lang}.".$this->view_suffix;
            if (file_exists($viewfilepath)) {
                $viewfile .= "_{$this->home_lang}";
            }
        }
        /*--end*/

        $html = $this->fetch(":{$viewfile}");
        
        return $html;
    }

    /**
     * 支付宝回调
     */
    private function alipay_return()
    {
        $param = input('param.');
        if (isset($param['transaction_type']) && isset($param['is_ailpay_notify'])) {
            // 跳转处理回调信息
            $pay_logic = new PayLogic();
            $pay_logic->alipay_return();
        }
    }

    /**
     * 快递100返回时，重定向关闭父级弹框
     */
    private function Express100()
    {
        $coname = input('param.coname/s', '');
        $m = input('param.m/s', '');
        if (!empty($coname) || 'user' == $m) {
            if (isWeixin()) {
                $this->redirect(url('user/Shop/shop_centre'));
                exit;
            }else{
                $this->redirect(url('api/Rewrite/close_parent_layer'));
                exit;
            }
        }
    }
}