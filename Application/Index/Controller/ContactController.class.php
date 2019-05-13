<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/13
 * Time: 12:03
 */
namespace  Index\Controller;

use Think\Controller;
use Index\Controller\BaseController;

class ContactController extends  BaseController
{
    //contact
    public function index(){
        $this->display();
    }


}