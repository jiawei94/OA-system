<?php
//命名空间声明
namespace Admin\Controller;
//引入父类控制器
use Think\Cache\Driver\Memcache;
use Think\Controller;
use Think\Think;


//声明类并且继承父类
class PublicController extends Controller{

    //登录页面展示
    public function login()
    {
        //展示模版
        $this->display();
    }
    //验证码
    public function captcha(){
        $cfg = array(
            'fontSize'  =>  12,              // 验证码字体大小(px)
            'useCurve'  =>  false,            // 是否画混淆曲线
            'useNoise'  =>  false,            // 是否添加杂点
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',           // 验证码字体，不设置随机获取
            'imageH'    =>  40,               // 验证码图片高度
            'imageW'    =>  80               // 验证码图片宽度
        );
        $verify = new \Think\Verify($cfg);
        $verify ->entry();
    }

    public function checkLogin(){
        $post = I('post.');
        $verify = new \Think\Verify();
        $result = $verify -> check($post['captcha']);
//        dump($result);
        if ($result){
            unset($post['captcha']);
            $data = M('user') -> where($post) ->find();
//            dump($data);die;
            if(data){
                session('id',$data['id']);
                session('username',$data['username']);
                session('role_id',$data['role_id']);
                $this ->success('登录成功',U('Index/index'),3);
            }else{
                $this -> error('登录失败');
            }
        }else{
            $this ->error('你输入的验证码错误。。。');
        }
    }

    public function logout(){
        //清除session
        session(null);
        //跳转到登录页面
        $this -> success('退出成功',U('login'),3);
    }
}