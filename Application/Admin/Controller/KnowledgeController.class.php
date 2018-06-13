<?php

namespace Admin\Controller;
use Think\Controller;

class KnowledgeController extends CommonController{
    public function add()
    {
        if (IS_POST) {
            $post = I('post.');
            $model = D('Knowledge');
            $result = $model->addData($post, $_FILES['thumb']);
            if ($result) {
                $this->success('添加公文成功!', U('Knowledge/showlist'), 3);
            } else {
                $this->error('添加公文失败!');
            }
        } else {
            $this->display();
        }
    }

    public  function showList(){
        $model =  M('knowledge');
        $info = $model ->order('id asc') ->select();
        $this ->assign(data,$info);


        $count = $model ->count();
        $page = new \Think\Page($count,2);
        $show = $page ->show();
        $list = $model ->limit($page ->firstRow,$page ->listRows)->select();
        $this ->assign(show,$show);
        $this ->assign(data,$list);
        $this ->assign(count,$count);

        $this->display();
    }
    public function download(){
        $id = I('get.id');
        $data = M('knowledge') -> find($id);

        $file = WORKING_PATH  . $data['picture'];
        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header("Content-Length: " . filesize($file));
        readfile($file);
    }
}