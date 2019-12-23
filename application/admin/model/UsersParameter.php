<?php

namespace app\admin\model;

use think\Model;

/**
 * 会员属性
 */
class UsersParameter extends Model
{
    private $admin_lang = 'cn';
    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
        $this->admin_lang = get_admin_lang();
    }

    /**
     * 校验是否允许非必填
     */
    public function isRequired($id_name='',$id_value='',$field='',$value='')
    {
        $return = true;

        $value = trim($value);
        if (($value == '0' && $field == 'is_required') || ($value == '1' && $field == 'is_hidden')) {
            $where = [
                $id_name => $id_value,
                'lang'   => $this->admin_lang,
            ];
            $paraData = M('users_parameter')->where($where)->field('dtype')->find();
            if ($paraData['dtype'] == 'email') {
                $usersData = getUsersConfigData('users.users_verification');
                if ($usersData == '2') {
                    if ($value == '0') {
                        $return = [
                            'msg'   => '您已选择：会员功能设置-注册验证-邮件验证，因此邮箱地址必须为必填！',
                        ];
                    }
                    if ($value == '1') {
                        $return = [
                            'msg'   => '您已选择：会员功能设置-注册验证-邮件验证，因此邮箱地址不可隐藏！',
                        ];
                    }
                    
                }
            }
        }

        return $return;
    }
}