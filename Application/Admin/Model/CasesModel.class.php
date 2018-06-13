<?php

namespace Admin\Model;

use Think\Model;

class CasesModel extends Model
{
    protected $tableName = 'cases';

    // 获取列表
    public function getCases()
    {

        $model = M('cases');

		$map['is_deleted'] = 0;

        $list = $model->where($map)->order('id desc')->limit($limit)->select();
        
        return $list;

    }

    // 创建
     public function Create($param)
    {

    	$model = M('cases');

    	// 判断是否存在
    	$flag = $model->where(['title' => $param['title'], 'is_deleted' => 0])->find();

        if ($flag) {

            return [

                'data' => $param['title'] . '已经存在了',

                'msg' => $model->getLastSql(),

                'status' => 0,

            ];

        }


        $doAdd = false;

        $doAdd = $model->add([

            'title' => $param['title'],

            'desc' => $param['desc'],

            'create_time' => date('Y-m-d H:i:s'),

            'cover' => $param['cover'],

            'content' => $param['content'],

            'is_show' => $param['is_show'],

        ]);

        $res = $doAdd ? ['msg' => 'success'] : ['msg' => 'failed'];

        return [

            'data' => $res['msg'],

            'msg' => $model->getLastSql(),

            'status' => $doAdd ? 1 : 0,

        ];

    }

    // 修改
     public function Edit($param)
    {

    	$model = M('cases');

    	// 判断是否存在
    	$flag = $model->where(['title' => $param['title'], 'is_deleted' => 0, 'id' => ['neq', $param['id']]])->find();

        if ($flag) {

            return [

                'data' => $param['title'] . '已经存在了',

                'msg' => $model->getLastSql(),

                'status' => 0,

            ];

        }

        $doMod = false;

        $doMod = $model

            ->where(['id' => $param['id']])

        	->save([

            'title' => $param['title'],

            'desc' => $param['desc'],

            'cover' => $param['cover'],

            'content' => $param['content'],

            'is_show' => $param['is_show'],

        ]);

        $res = $doMod ? ['msg' => 'success'] : ['msg' => 'failed'];

        return [

            'data' => $res['msg'],

            'msg' => $model->getLastSql(),

            'status' => $doMod ? 1 : 0,

        ];

    }

    // 删除
  	  public function Del($param)
    {

    	$model = M('cases');

 		$doDel = false;

        $doDel = $model->where(['id' => ['in', $param['id']]])->save(['is_deleted' => 1]);

        $res = $doDel ? ['msg' => $doDel . ' deleted'] : ['msg' => 'no delete'];

        return [

            'data' => $res['msg'],

            'msg' => $model->getLastSql(),

            'status' => $doDel ? 1 : 0,

        ];

    }
      
}