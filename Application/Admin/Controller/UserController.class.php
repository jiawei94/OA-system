<?php
namespace Admin\Controller;
use Think\Controller;

class UserController extends CommonController{
     public function add(){
         if(IS_POST){
             //处理表单提交
             $model = M('User');
             //创建数据对象
             $data = $model -> create();
             //添加时间字段
             $data['addtime'] = time();
             //保存数据表
             $result = $model -> add($data);
            if($result){
                $this -> success('保存成功',U('showList'),3);
            }else{
                $this -> error('保存失败');
            }
         }else{
             $data = M('dept')->field('id,name') ->select();
             $this ->assign(data,$data);
             $this ->display();
         }
     }
     public function showList(){
         $model =  M('user');
         $count = $model ->count();
         $page = new \Think\Page($count,2);

         $show = $page ->show();
         $data = $model ->limit($page ->firstRow,$page ->listRows)->select();
         $this ->assign(show,$show);
         $this ->assign(data,$data);
         $this ->assign(count,$count);
         $this ->display();
     }
}