<?php 
/**
* 
*/
class User extends IController
{
  public $layout='site_mini';
    public $username;
    public $userid;

  function init()
  {

  }

	//注册
	public function regTelInfo()
    {
    	
        //获取添加的数据
        $data=$_POST;
        //获取验证码
        $code=$_COOKIE['reg'];
        //使用md5给密码加密
        $password=md5($data['password']);
        $tel=$data['mobile'];
        $username=$data['username'];


        //判断唯一性
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=iwebshop', 'root','root');
            $find="select * from iwebshop_user where username='$username' or tel='$tel'";
            // echo $sql;
           $req=$dbh->query($find);
           $findInfo=$req->fetch(2);

           if ($findInfo) {
                header('location:www.iwebshop.com/index.php?controller=errors&action=error&message=用户名或手机号已被注册');
           }


        //判断 验证码是否正确
        if ($data['mobile_code'] == $code) {
            
            $sql="insert into iwebshop_user(username,password,tel) value('$username','$password','$tel')";
           $res=$dbh->exec($sql);
           if ($res) {
            $msg = "恭喜您~注册成功";
               $this->redirect('/site/success?message='.urlencode($msg));
           }else{
            $msg = "抱歉~注册失败";
               $this->redirect('/site/success?message='.urlencode($msg));
           }
        }else {
             header('location:www.iwebshop.com/index.php?controller=errors&action=error&message=验证码码错误');
        }
        

    }

    public function showuser()
    {
      print_r($this->user);
    }
    //登录
    public function login_act()
    {
      //获取登录表单传输的数据
      $data=$_POST;
      //取出登录信息
      $login_info=$data['login_info'];
      //取出密码  并且使用md5加密
      $pwd=md5($data['password']);
      //连接数据库
       $dbh = new PDO('mysql:host=127.0.0.1;dbname=iwebshop', 'root','root');
            $sql="select * from iwebshop_user where username='$login_info' or tel='$login_info' or email='$login_info'";
            // echo $sql;
           $res=$dbh->query($sql);
           $info=$res->fetch(2);
           //判断是否查询到该账号
           if ($info) {
            //判断密码是否正确
            if ($info['password'] == $pwd) {
              ISafe::set('username',$info['username']);
              ISafe::set('user_pwd',$info['password']);
              $this->redirect("/ucenter/index");
              
            }else{
              //登录失败
             setcookie('errorLogin','0');
                $this->redirect('/simple/login');
                header('location:www.iwebshop.com/index.php?controller=errors&action=error&message=账号后密码错误');
             
             
            }
           }else{
            //登录失败
           setcookie('errorLogin','0');
            $this->redirect("/simple/login");
            header('location:www.iwebshop.com/index.php?controller=errors&action=error&message=账号后密码错误');
            
           }
    }

    

     //注册短信发送
    function sendreg()
    {
        


    //     $tel=$_POST['tel'];
    //     //生产一个随机验证码
    $reg=rand(10000,99999);
    setcookie('reg',$reg,time()+60);
    
    // $value=urlencode("#code#=$reg");
    // //发送短信
    // $data=@file_get_contents("http://v.juhe.cn/sms/send?mobile=$tel&tpl_id=179015&tpl_value=$value&key=bc1e5d336b2cbdbcb6bc728d72c928d4");
    // if ($data) {
    //     $arr=['code'=>1,'message'=>'发送成功','data'=>''];
    // }else{
    //     $arr=['code'=>0,'message'=>'发送失败','data'=>''];
    // }
    // echo json_encode($arr);
        // $code=$_COOKIE['reg'];
        echo $reg;
   
}

//手机号登录短信
 function sendlogin()
    {
        


    //     $tel=$_POST['tel'];
    //     //生产一个随机验证码
    $reg=rand(10000,99999);
    setcookie('regLogin',$reg,time()+60);
    
    // $value=urlencode("#code#=$reg");
    // //发送短信
    // $data=@file_get_contents("http://v.juhe.cn/sms/send?mobile=$tel&tpl_id=你的短信模板&tpl_value=$value&key=bc1e5d336b2cbdbcb6bc728d72c928d4");
    // if ($data) {
    //     $arr=['code'=>1,'message'=>'发送成功','data'=>''];
    // }else{
    //     $arr=['code'=>0,'message'=>'发送失败','data'=>''];
    // }
    // echo json_encode($arr);
        // $code=$_COOKIE['reg'];
        echo $reg;
   
}

//手机号找回密码短信
 function sendfind()
    {
        


    //     $tel=$_POST['tel'];
    //     //生产一个随机验证码
    $reg=rand(10000,99999);
    setcookie('sendfind',$reg,time()+60);
    
    // $value=urlencode("#code#=$reg");
    // //发送短信
    // $data=@file_get_contents("http://v.juhe.cn/sms/send?mobile=$tel&tpl_id=你的短信模板&tpl_value=$value&key=bc1e5d336b2cbdbcb6bc728d72c928d4");
    // if ($data) {
    //     $arr=['code'=>1,'message'=>'发送成功','data'=>''];
    // }else{
    //     $arr=['code'=>0,'message'=>'发送失败','data'=>''];
    // }
    // echo json_encode($arr);
        // $code=$_COOKIE['reg'];
        echo $reg;
   
}

  //手机号登陆
public function telLogin()
{
  $data=$_POST;
  print_r($data);
  //取出手机号
   $login_info=$data['mobile'];
      //取出验证码
      $reg=$data['mobile_code'];
      //取出cookie中的验证码
      $code=$_COOKIE['regLogin'];

      if ($code == $reg) {
         $dbh = new PDO('mysql:host=127.0.0.1;dbname=iwebshop', 'root','root');
            $sql="select * from iwebshop_user where tel='$login_info'";
            // echo $sql;
           $res=$dbh->query($sql);
           $info=$res->fetch(2);
           //存储cookie
            ISafe::set('username',$info['username']);
              ISafe::set('user_pwd',$info['password']);
              //转到个人页面
              $this->redirect("/ucenter/index");

      } else {
        header('location:www.iwebshop.com/index.php?controller=errors&action=error&message=验证码错误');
      }
}


    //生成修改密码的连接
public function emailUrl($userid='')
{
  
  $hash = IHash::md5( microtime(true) .mt_rand());
  

    //重新找回密码的数据
    $tb_find_password = new IModel("find_password");
    $tb_find_password->setData( array( 'hash' => $hash ,'user_id' => $userid , 'addtime' => time() ) );
$tb_find_password->query("`hash` = '{$hash}'");
 $tb_find_password->add();
 $url = IUrl::getHost().IUrl::creatUrl("/simple/restore_password/hash/{$hash}/user_id/".$userid);
return $url;
}

//短信找回密码
public function find_password_mobile()
{
  $data=$_POST;
  //取出数组中的用户名
  $username=$data['username'];
  //取出数组中的手机号
  $mobile=$data['mobile'];
  //取出数组的验证码
  $mobile_code=$data['mobile_code'];
  //  取出cookie中的验证码
  $code=$_COOKIE['sendfind'];
  //连接数据库
 $dbh = new PDO('mysql:host=127.0.0.1;dbname=iwebshop', 'root','root');
            $sql="select * from iwebshop_user where username='$username' and tel='$mobile'";
            // echo $sql;
           $res=$dbh->query($sql);
           $info=$res->fetch(2);
           //判断手机号和用户身份匹配
           if ($info) {
             if ($code == $mobile_code) {
              //生成url修改密码地址
              $url=$this->emailUrl($info['id']);
             
              //跳转
              header("location:$url");
                } else {
                  header('location:www.iwebshop.com/index.php?controller=errors&action=error&message=验证码错误');
                }
           }else{
             header('location:www.iwebshop.com/index.php?controller=errors&action=error&message=用户名和手机号不匹配');
           }

  
}

//邮箱找回密码
public function find_password_email()
{
  $data=$_POST;
  //取出数组中的用户名
  $username=$data['username'];
  //取出数组中的邮箱
  $email=$data['email'];
            //连接数据库 查询用户和邮箱是否匹配
            $dbh = new PDO('mysql:host=127.0.0.1;dbname=iwebshop', 'root','root');
            $sql="select * from iwebshop_user where username='$username' and email='$email'";
            // echo $sql;
           $res=$dbh->query($sql);
           $info=$res->fetch(2);
           //判断邮箱和用户是否匹配
           if ($info) {
              $smtp   = new SendMail();
               $url=$this->demo($info['id']);
              $content = mailTemplate::findPassword(array("{url}" => $url));
      $result = $smtp->send($email,"您的密码找回",$content);
      if($result===false)
      {
        IError::show(403,"发信失败,请重试！或者联系管理员查看邮件服务是否开启");
      }
      header('location:www.iwebshop.com/index.php?controller=site&action=success&message=恭喜您，密码重置邮件已经发送！请到您的邮箱中去激活');
           } else {
             header('location:www.iwebshop.com/index.php?controller=errors&action=error&message=该用户和邮箱不匹配');
           }


}

//验证用户名唯一性
public function verifyname()
{
  $name=$_POST['name'];
 
  //连接数据库 用户名是否已经存在
            $dbh = new PDO('mysql:host=127.0.0.1;dbname=iwebshop', 'root','root');
            $sql="select * from iwebshop_user where username='$name'";
            // echo $sql;
           $res=$dbh->query($sql);
           $info=$res->fetch(2);
           if ($info) {
              //返回json结果
             echo json_encode(array('code'=>0,'meg'=>'用户名已存在','data'=>''));
           } else {
            //返回json结果
            echo json_encode(array('code'=>1,'meg'=>'可以注册','data'=>''));  
           }
}

  //验证手机号唯一性
public function verifytel()
{
 $tel=$_POST['tel'];


 
  //连接数据库 手机号是否已经存在
            $dbh = new PDO('mysql:host=127.0.0.1;dbname=iwebshop', 'root','root');
            $sql="select * from iwebshop_user where tel='$tel'";
            // echo $sql;
           $res=$dbh->query($sql);
           $info=$res->fetch(2);
           if ($info) {
            //返回json结果
             echo json_encode(array('code'=>0,'meg'=>'手机号已存在','data'=>''));
           } else {
            //返回json结果
            echo json_encode(array('code'=>1,'meg'=>'可以注册','data'=>''));  
           }
}

   


    
}

 ?>