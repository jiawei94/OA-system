<?php
return array(
    //'配置项'=>'配置值'

    //模版常量
    'TMPL_PARSE_STRING' => array(
        '__ADMIN__' => __ROOT__ . '/Public/Admin'
    ),
    'DB_CHARSET' => 'utf8',
    'DB_TYPE' => 'mysql',
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'oasystem',
    'DB_USER' => 'root',
    'DB_PWD' => 'jiawei',
    'DB_PORT' => '3306',
    'DB_PREFIX' => 'oa_',

    'RBAC_ROLES'            =>      array(
        1   =>  '高层管理',
        2   =>  '中层领带',
        3   =>  '普通职员'
    ),
    //权限数组（关联角色数组）
    'RBAC_ROLE_AUTHS'       =>      array(
        1   =>  '*/*',//拥有全部的权限
        2   =>  array('index/*','email/*','knowledge/*'),
        3   =>  array('index/*','email/*','knowledge/*','doc/add')
    ),

);