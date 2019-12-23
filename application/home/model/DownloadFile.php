<?php

namespace app\home\model;

use think\Db;
use think\Model;

/**
 * 下载文件
 */
class DownloadFile extends Model
{
    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
    }
    
    /**
     * 获取指定下载文章的所有文件
     * @author 小虎哥 by 2018-4-3
     */
    public function getDownFile($aids = [], $field = '*')
    {
        $where = [];
        !empty($aids) && $where['aid'] = ['IN', $aids];
        $result = Db::name('DownloadFile')->field($field)
            ->where($where)
            ->order('sort_order asc')
            ->select();

        if (!empty($result)) {
            $hidden = '';
            foreach ($result as $key => $val) {
                $downurl     = ROOT_DIR."/index.php?m=home&c=View&a=downfile&id={$val['file_id']}&uhash={$val['uhash']}";

                $result[$key]['title'] = '';
                if (!empty($val['extract_code'])) {
                    $result[$key]['title'] = '提取码：'.$val['extract_code'];
                }
                $result[$key]['downurl'] = "javascript:ey_1563185380({$val['file_id']});";
                $result[$key]['ey_1563185380'] = "<input type='hidden' id='ey_file_list_{$val['file_id']}' value='{$downurl}' />";
                $result[$key]['ey_1563185376'] = $this->handleDownJs($hidden);
            }
            $result = group_same_key($result, 'aid');
        }

        return $result;
    }

    private function handleDownJs(&$hidden = '')
    {
        if (empty($hidden)) {
            $hidden = <<<EOF
                <script type="text/javascript">
                  function ey_1563185380(file_id) {
                    var downurl = document.getElementById("ey_file_list_"+file_id).value + "&_ajax=1";
                    //创建异步对象
                    var ajaxObj = new XMLHttpRequest();
                    ajaxObj.open("get", downurl, true);
                    ajaxObj.setRequestHeader("X-Requested-With","XMLHttpRequest");
                    ajaxObj.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    //发送请求
                    ajaxObj.send();
                    ajaxObj.onreadystatechange = function () {
                        // 这步为判断服务器是否正确响应
                        if (ajaxObj.readyState == 4 && ajaxObj.status == 200) {
                          var json = ajaxObj.responseText;  
                          var res = JSON.parse(json);
                          if (0 == res.code) {
                            alert(res.msg);
                          }else{
                            window.location.href = res.url;
                          }
                        } 
                    };
                  };
                </script>
EOF;
        }

        return $hidden;
    }
}