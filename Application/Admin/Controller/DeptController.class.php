<?php
namespace Admin\Controller;
use Think\Controller;

class DeptController extends Controller{

    public function  add(){
        if (IS_POST){
            $post = I('post.');
            $result = M('dept') -> add($post);

            if($result){
                $this -> success('添加成功',U('showList'),3);
            }else{
                $this -> error('添加失败');
            }
        }else{
            $data = M('dept')->where('pid=0')->select();
            $this->assign(data, $data);
            $this->display();
        }
    }

    public function showList(){
        $model= M('dept');
        $data = $model ->order('sort asc')->select();
        foreach ($data as $key =>$value){
            if($value['pid'] > 0){
                $info = $model ->find($value['pid']);
                $data[$key]['deptname'] = $info['name'];
            }
        }
        load('@/tree');
        $data = getTree($data);
        $this ->assign(data,$data);

        $model =  M('dept');
        $count = $model ->count();
        $page = new \Think\Page($count,5);
        $show = $page ->show();
        $page = $model ->limit($page ->firstRow,$page ->listRows)->select();
        $this ->assign(show,$show);
        $this ->assign(page,$page);
        $this ->assign(count,$count);

        $this ->display();
    }

    public function edit(){
        if(IS_POST){
            $post = I('post.');
            $result = M('dept') ->save($post);
            if($result !== false){
                $this ->success('修改成功',U('showList'),3);
            }else{
                $this -> error('修改失败');
            }
        }else{
            $id = I('get.id');
            $model = M('dept');
            $data = $model -> find($id);
            $info =  $model ->where('id != ' .$id) ->select();
            $this -> assign(data,$data);
            $this -> assign(info,$info);
            $this -> display();
        }

    }

    public  function  del(){
        $id = I('get.id');
        dump($id);
        $model = M('dept');
        $result = $model -> delete($id);
        if($result){
            $this ->success('删除成功!');
        }else{
            $this ->error('删除失败!');
        }
    }
}

