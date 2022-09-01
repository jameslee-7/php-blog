<?php	
	session_start();
	
    if(!isset($_SESSION['loggedUsername'])){
        header("location:login.php");
        exit;
    }

    if($_SESSION['isAdmin']==0){//判断是否为管理员
    header("location:resources.php");
    exit;
    }
?>
<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="utf-8" />
		<meta name="author" content="Leo" />
		<meta name="Keywords" content="Leo的博客"/>
		<meta name="Description" content="Leo的博客,关于区块链技术"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Leo的博客</title>
		
		<link rel="shortcut icon" href="img/block.png">
		<link rel="apple-touch-icon" sizes="57x57" href="img/block.png" />
		<link rel="apple-touch-icon" sizes="72x72" href="img/block.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="img/block.png" />
		<link  rel="apple-touch-icon" sizes="144x144" href="img/block.png" />
		
		<link rel="stylesheet" href="css/common.css"/>
		<link rel="stylesheet" href="css/icon-mass.css"/>
		<link rel="stylesheet" href="css/addat.css"/>
		<script type="text/javascript" src="js/selector.js"></script>
	</head>
	<body ondragstart="return false"  onselect="document.selection.empty()">
	
		<?php
		include_once "head.php";
		?>
		
		<header>
		</header>

		<?php
		include_once "head1.php";
		?>
		<div class="embellish">
			<a class="rocket"></a>
			<div class="aside"></div>
		</div>

        <?php
		include("mysql.php"); 	//引入连接数据库
        if(!empty($_GET['id'])){
            $edit = $_GET['id'];
            $sql = "select * from source where id='$edit'";
            $query = mysqli_query($link, $sql);
            $rs = mysqli_fetch_array($query);
        }
    
        if (!empty($_POST['sub'])) {    
            $title = $_POST['title'];  //获取title表单内容
            $con = $_POST['con'];      //获取contents表单内容  
            $hid = $_POST['hid'];
            $sql="update source set title='$title', contents='$con' where id='$hid'";
            mysqli_query($link, $sql);  //执行插入语句 
            
            echo "<script>alert('资源修改成功！');location.href='resources.php'</script>";
        }
        ?>

            <div class="bd">            

                <form action="editsource.php" method="post">
                    <input type="hidden" name="hid" value="<?php echo $rs['id'];?>">
                    标题:<br>
                    <input type="text" name="title" value="<?php echo $rs['title'];?>">
                    <br><br>
                    内容:<br>
                    <textarea rows="10" cols="100" name="con" ><?php echo $rs['contents'];?></textarea><br><br>
                    <input type="submit"  name="sub" value="提交">
                </form>

			</div>
		
		<footer class="clearfix"><p>© Copyright 2022 All Rights Reserved Power by Leo | V1.0</p></footer>

	</body>
</html>