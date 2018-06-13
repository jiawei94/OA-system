<?php

namespace Admin\Controller;

use Think\Controller;

class DocController extends CommonController{
    public function add()
    {
        if (IS_POST) {
            $post = I('post.');
            $model = D('Doc');
            $result = $model->saveData($post, $_FILES['file']);
            if ($result) {
                $this->success('添加公文成功!', U('Doc/showlist'), 3);
            } else {
                $this->error('添加公文失败!');
            }
        } else {
            $this->display();
        }
    }

    public function showList()
    {
        $data = M('doc')->select();
        $this->assign(data, $data);
        $this->display();
    }

    public function download()
    {
        $id = I('get.id');
        $data = M('doc')->find($id);
//        下载方法
        $file = WORKING_PATH  . $data[filepath];
        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header("Content-Length: " . filesize($file));
        readfile($file);
    }

    public function showContent(){
        $id = I('get.id');
        $data = M('doc') ->find($id);
        echo htmlspecialchars_decode($data['content']);
    }

    public  function edit(){
        if(IS_POST){
            $post =I('post.');
            $model = D('doc');
            $result = $model ->editData($post,$_FILES['file']);
            if($result){
                $this -> success('修改成功~',U('Doc/showList'),3);
            }else{
                $this -> error('修改失败');
            }

        }else{
            $id = I('get.id');
            $data = M('doc') -> find($id);
            $this -> assign(data,$data);
            $this ->display();
        }

    }
}



