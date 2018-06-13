<?php
namespace Admin\Model;
use Think\Model;
use Think\Think;

class KnowledgeModel extends  Model{
    public function addData($post,$thumb){
//        dump($post);die;
        if($thumb[size] !== '0'){
            $cfg = array(
                'rootPath'  =>WORKING_PATH . UPLOAD_ROOT_PATH
            );
            $upload = new \Think\Upload($cfg);
            $info = $upload ->uploadOne($thumb);
            if($info){
                $post['picture'] = UPLOAD_ROOT_PATH . $info['savepath'] .$info['savename'];
//                制作缩略图
                $image = new \Think\Image();
                $image -> open(WORKING_PATH . $post['picture']);
                $image ->thumb(90,100);
                $image ->save(WORKING_PATH . UPLOAD_ROOT_PATH . $info['savepath'] .'thumb_' .$info['savename']);
                $post['thumb'] = UPLOAD_ROOT_PATH . $info['savepath'] .'thumb_' .$info['savename'];
            }
            $post['addtime'] = time();
            return $this ->add($post);
        }
    }

}