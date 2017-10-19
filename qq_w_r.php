<?php
define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . '/includes/lib_order.php');

if ($_REQUEST['act'] == 'qq_edt'){

    $smarty->display('qq_edt.htm');
}
elseif ($_REQUEST['act'] == 'qq_write'){
    $myfile = fopen("../qq.txt", "w");
    $qq_kefu=$_POST['qq_kefu_w']."\r\n";
    fwrite($myfile, $qq_kefu);
    fclose($myfile);
    $smarty->display('qq_edt.htm');
    
}elseif ($_REQUEST['act'] == 'qq_read'){
    $file_path = "../qq.txt";
    if(file_exists($file_path)){
        $fp = fopen($file_path,"r");
        $qq_kefu = "";
        $buffer = 1024;//每次读取 1024 字节
        while(!feof($fp)){//循环读取，直至读取完整个文件
            $qq_kefu .= fread($fp,$buffer);
        } 
        $qq_kefu = str_replace("\r\n","",$qq_kefu);
    }
    $smarty->assign('qq_kefu', $qq_kefu);
    $smarty->display('qq_edt.htm');
}