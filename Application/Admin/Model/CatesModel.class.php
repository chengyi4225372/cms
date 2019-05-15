<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/15
 * Time: 10:17
 */
namespace Admin\Model;

use Think\Model;

class CatesModel extends Model
{
    protected $table = 'cates';


    public function getone(){
        $model = M($this->table);
        $list = $model->where(array('pid'=>0))->order('id desc ')->select();
        return $list;
    }

    //添加一级
    public function Create_one($param)
    {

        $model = M($this->table);
        // 判断是否存在
        $flag = $model->where(array('cates_one' => $param['cates_one']))->find();
        if ($flag) {
            return array(
                'data' => $param['cates_one'] . '已经存在了',
                'msg' => $model->getLastSql(),
                'status' => 0,
            );
        }
        $doAdd = false;
        $doAdd = $model->add(array(
            'cates_one' => $param['title'],
            'pid' => 0,
            'create_time' => date('Y-m-d H:i:s'),
        ));
        $res = $doAdd ? array('msg' => 'success') : array('msg' => 'failed');
        return array(
            'data' => $res['msg'],
            'msg' => $model->getLastSql(),
            'status' => $doAdd ? 1 : 0,
        );
    }

    //删除一级
   public  function  del_one($param){
       $model = M($this->table);
       $doDel = false;
       $flag = $model->where(array('cates_one' => $param['cates_one'],''))->find();
       $doDel = $model->where(array('id' => array('in', $param['id'])))->save(array('is_deleted' => 1));

       $res = $doDel ? array('msg' => $doDel . ' deleted') : array('msg' => 'no delete');

       return array(
           'data' => $res['msg'],
           'msg' => $model->getLastSql(),
           'status' => $doDel ? 1 : 0,
       );
   }


}