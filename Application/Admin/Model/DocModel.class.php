<?php
namespace Admin\Model;
use Think\Model;

class DocModel extends Model{
    public function saveData($post,$file){
        if($file[size] !== '0'){
            $cfg = array(
                'rootPath'  =>  WORKING_PATH . UPLOAD_ROOT_PATH //保存根路径
                );
//            dump($cfg);die;
            $upload = new \Think\Upload($cfg);
            $info = $upload -> uploadOne($file);

            if($info){
                $post[addtime] =time();
                $post[filepath] =UPLOAD_ROOT_PATH .$info['savepath'].$info['savename'];
                $post[filename] = $info['savename'];
                $post[hasfile] = 1;
            }
        }
        return $this ->add($post);
    }

    public function editData($post,$file){
        if($file['size'] !== '0'){
            $cfg =array(
              'rootPath'    =>  WORKING_PATH . UPLOAD_ROOT_PATH
            );
            $upload = new \Think\Upload($cfg);
            $info = $upload ->uploadOne($file);
            if($info){
                $post[addtime] = time();
                $post[filename] = $info['name'];
                $post[filepath] = WORKING_PATH . $info['savepath'].$info['savename'];
                $post[hasfile] = 1;
            }
        }
//        dump($post);die;
        return $this -> save($post);
    }

}