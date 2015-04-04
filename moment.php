<?php
	require("userview.php");
	class Picture{
		private $pic_id;
		public function __construct(){
			$this->pic_id=uuid();
		}
		public function set_id($id){
			$this->pic_id=$id;
		}
		public function delete(){
			$conn=connect();
			if($conn){
				$sql='DELETE FROM moment WHERE pic_id="'.$this->pic_id.'";';
				if(mysqli_query($conn,$sql)){mysqli_close($conn);return(true);}
				mysqli_close($conn);
			}
			return(false);
		}
		public function show_info(){
			$conn=connect();
			if($conn){
				$sql='SELECT * FROM moment WHERE pic_id="'.$this->pic_id.'"';
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					$a=mysqli_fetch_array($result);
					mysqli_close($conn);
					return($a);
				}
				mysqli_close($conn);
				echo $sql;
			}
			return(NULL);
		}
		public function set_info($info){
			$sql='SELECT * FROM moment WHERE pic_id="'.$this->pic_id.'"';
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					$sql='UPDATE moment SET ';
					foreach($info as $key=>$value){
						$sql.=$key.'="'.$value.'", ';
					}
					$sql.=' WHERE pic_id="'.$this->pic_id.'";';
				}
				else{
					$sql='INSERT INTO moment(`user_id`, `pic_id`, `summary`, `take_date`, `upload_date`) VALUES (`'.$this->pic_id.'`, ';
					foreach($info as $key=>$value){
						$sql.=$key.'="'.$value.'", ';
					}
					$sql.=');';
				}
				$result=mysqli_query($conn,$sql);
				mysqli_close($conn);
				return($result);
		}
	}
	
	class PictureView{
		public function show_album_m($content){
			echo '
$(document).ready(function() {
	$(".moment-sml").height($(".moment-sml").width());
	
	//click a moment picture
	$(".moment-sml").click(function() {
		$(".moment-sml").children("p").hide();
		$(".pic-mask").remove();
		$(this).children("p").fadeIn("fast");
		$(this).prepend("<div class=\'pic-mask\'></div>");
	});
			
	//show upload picture dialog
	 $("#upload").click(function() {
		$("#upload-pic-box").fadeIn();
	});
	
	//close an overlay
	$(".close-overlay").click(function() {
		$(this).parent().parent().fadeOut();		
	});	
	
	//show picture detail dialog
	$(".moment").click(function() {
		temp=$(this).css("background-image");
		if(temp.length==none){return;}
		temp=temp.substr(4);
		temp=temp.substr(0,temp.length-1);
		$("#pic-detail-box img").attr({"src":temp});
		$("#pic-detail-box > a").attr({"href":temp});
		$("#pic-detail-box > h2").text($(this).children("p").text());
		$("#pic-detail-box img").css("max-height", $(".overlay-container").height()*0.75-100);
		$("#pic-detail-box").css("margin-top",($(".overlay-container").height()*0.95-$("#pic-detail-box").height())/2);
		$("#pic-detail-box").fadeIn();
		imgpadding=($("#pic-detail-box").width()-$("#pic-detail-box img").width())/2
		$("#pic-detail-box img").css("padding-left", imgpadding);
	});	
	
	//resize
	$(window).resize(function() {
		$(".moment-sml").height($(".moment-sml").width());	
    });
});
</script>
<title>iDating - Moments</title>
</head>

<body>
<div id="C">
<div id="A">
<!--sidebar-start-->
<ul>
<li><a href="accountmgt-m.php">My Page</a></li>
<li><a href="search-m.php">Search</a></li>
<li><a href="shake.php">Shake</a></li>
<li><a href="calendar-m.php">Calendar</a></li>
<li><a href="moments-m.php">Moments</a></li>
<li><a href="messages-m.php">Messages</a></li>
<li><a href="logout1.php">Log Out</a></li>
</ul>
<!--sidebar-end-->
</div>
<div id="B">
<!--header-start-->
<div class="header">
<div id="topnav">
<img id="upload" src="img/add.png" alt="upload moments">
</div>
<img id="nav" src="img/nav.png" alt="navigate">
<h1>Moments</h1>
</div>
<!--header-end-->

<!--container-start-->
<div class="container">
<!--moment-wall-start-->
<div id="moment-wall">
<table>
  ';
  $i=0;
  $count=0;
			foreach($content as $key=>$value){
				$count+=1;
				if($i==0){
					echo '<tr>'.$value;$i=1;}
				else{
					echo $value.'</tr>';$i=0;
				}
				if($count==20){break;}
			}
			if($i==1){echo'</tr>';}
			echo '
</table>
</div>
<!--moment-wall-end-->
</div>
<!--container-end-->'
		;}
		
		public function show_album($content,$page,$total){
			echo '
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$(".moment-big").height($(".moment-big").width());
	$(".moment-sml").height($(".moment-sml").width());
	
	//hover a moment picture
	$(".moment").hover(function() {
		$(this).children("p").fadeIn("fast");
		$(this).prepend("<div class=\'pic-mask\'></div>");
	},
	function() {
		$(this).children("p").hide();
		$(".pic-mask").remove();
	});	
	
	//show upload picture dialog
	 $("#upload").click(function() {
		$("body").append("<div class=\'mask\'></div>");
		$(".overlay-container").show();
		$("#upload-pic-box").css("margin-top",($(".overlay-container").height()*0.95-$("#upload-pic-box").height())/2);		
		$("#upload-pic-box").slideDown();
	});
	
	//close an overlay
	$(".close-overlay").click(function() {
		$(this).parent().slideUp("slow", function(){$(".overlay-container").hide();$(".mask").remove();});		
	});	
	
	//show picture detail dialog
	$(".moment").click(function() {
		temp=$(this).css("background-image");
		if(temp==none){return;}
		else{
			temp=temp.substr(4);
			temp=temp.substr(0,temp.length-1);
			$("body").append("<div class=\'mask\'></div>");
			$(".overlay-container").show();
			$("#pic-detail-box img").attr({"src":temp});
			$("#pic-detail-box > a").attr({"href":temp});
			$("#pic-detail-box > h2").text($(this).children("p").text());
			$("#pic-detail-box img").css("max-height", $(".overlay-container").height()*0.75-100);
			$("#pic-detail-box").css("margin-top",($(".overlay-container").height()*0.95-$("#pic-detail-box").height())/2);
			$("#pic-detail-box").slideDown();
			imgpadding=($("#pic-detail-box").width()-$("#pic-detail-box img").width())/2
			$("#pic-detail-box img").css("padding-left", imgpadding);}
	});	
	
	//resize
	$(window).resize(function() {
		$("#upload-pic-box").css("margin-top",($(".overlay-container").height()*0.95-$("#upload-pic-box").height())/2);
		$("#pic-detail-box").css("margin-top",($(".overlay-container").height()*0.95-$("#pic-detail-box").height())/2);
		imgpadding=($("#pic-detail-box").width()-$("#pic-detail-box img").width())/2
		$("#pic-detail-box img").css("padding-left", imgpadding);
		$(".moment-big").height($(".moment-big").width());
	    $(".moment-sml").height($(".moment-sml").width());	
    });
});
</script>
<title>iDating - Moments</title>
</head>

<body>
<!--header-start-->
<div class="header">
<ul id="topnav">
  <li><a href="logout.php">Log Out</a>
  <li><a href="messages.php">Messages</a>
  <li><a href="moments.php">Moments</a>
  <li><a href="calendar.php">Calendar</a>
  <li><a href="search.php">Search</a>
  <li><a href="accountmgt.php">My Page</a>  
</ul>
<img src="img/logo_small.png" alt="iDating logo">
</div>
<!--header-end-->

<!--container-start-->
<div class="container">
<!--moment-wall-start-->
<div id="moment-wall">
<table>
  <tr>
    <td rowspan="2" colspan="2" class="moment moment-big background-cover-center"'.$content[0].'</td>
    <td class="moment moment-sml background-cover-center"'.$content[1].'</td>
    <td class="moment moment-sml background-cover-center"'.$content[2].'</td>
    <td class="moment moment-sml background-cover-center"'.$content[3].'</td>
  </tr>
  <tr>
    <td class="moment moment-sml background-cover-center"'.$content[4].'</td>
    <td class="moment moment-sml background-cover-center"'.$content[5].'</td>
    <td class="moment moment-sml background-cover-center"'.$content[6].'</td>
  </tr>
  <tr>
    <td class="moment moment-sml background-cover-center"'.$content[7].'</td>
    <td class="moment moment-sml background-cover-center"'.$content[8].'</td>
    <td class="moment moment-sml background-cover-center"'.$content[9].'</td>
    <td class="moment moment-sml background-cover-center"'.$content[10].'</td>
    <td class="moment moment-sml background-cover-center"'.$content[11].'</td>
  </tr>
</table>
</div>
<!--moment-wall-end-->

<div id="moment-btns">
<button id="upload" type="button" class="btn btn-lg">Upload My Moment</button>
<a href="moments.php?page='.min($page+1,$total).'"><div id="next" type="button" class="btn" style="text-align:center">&gt;</div></a>
<a href="moments.php?page='.max($page-1,1).'"><div id="previous" type="button" class="btn" style="text-align:center">&lt;</div></a>
</div>
</div>
<!--container-end-->
';}
		public function show_picture($pic_info){
			
		}
	}
	class PictureViewController{
		public function upload_picture(){
			session_start();
			$conn=connect();
			$session=new Session();
			$user_id=$session->get_uid();
			if($user_id==NULL){header('Location: index.html');}
			if(!$conn){return;}
			if(isset($_FILES['filename'])){
				$target_dir = "portrait/";
				$target_file = $target_dir.basename($_FILES["filename"]["name"]);
				$imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
				if($_SERVER["REQUEST_METHOD"]=="POST"){
					$check = getimagesize($_FILES["filename"]["tmp_name"]);
					if(!$check){
						echo('<script type="text/javascript">alert("file is not an image! please try again!")</script>');
					}
					else if($_FILES["filename"]["size"] > 5000000){
						echo('<script type="text/javascript">alert("file is too big!")</script>');
					}
					else{
						$filename=uuid().'.'.$imageFileType;
						$target_file=$target_dir.$filename;
						$a=move_uploaded_file($_FILES["filename"]["tmp_name"],$target_file);
							$sql='INSERT INTO `moment` (`user_id`, `pic_id`,`title`, `summary`,`take_date`, `upload_date`) VALUES (\''.$user_id.'\', \''.$filename.'\', \''.$_POST['title'].'\', \''.$_POST['descrp'].'\',\''.$_POST['take_date'].'\', CURRENT_TIMESTAMP);';
							$result=mysqli_query($conn,$sql);
							//echo $sql;
							if($result){echo('<script type="text/javascript">alert("upload!")</script>');}
							else{echo('<script type="text/javascript">alert("fail...")</script>');}
					}
				}
			}
		}
		public function show_picture($pic_id){
			$conn=connect();
			if($conn){
				$sql='SELECT * FROM moment WHERE pic_id="'.$pic_id.'";';
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					$result=mysqli_fetch_array($result);
					$view=new PictureView();
					$view->show_picture($result);
				}
			}
		}
		public function show_pictures(){
			$page=1;
			$session=new Session();
			if($session->get_uid()==NULL){
				//header("Location: index.html");
				//return;
			}
			if(isset($_GET['page'])){$page=(int)($_GET['page']);}
			$conn=connect();
			$total=0;
			if($conn){
				$sql='SELECT COUNT(*) FROM moment;';
				$result=mysqli_query($conn,$sql);
				$row=mysqli_fetch_array($result);
				$total=(int)$row[0];
				$sql='SELECT pic_id,title FROM moment ORDER BY upload_date DESC;';
				$result=mysqli_query($conn,$sql);
				$count=0;
				$content=array();
				while($count<12*($page-1)){$row = mysqli_fetch_array($result);$count+=1;}
				$count=0;
				while($count<12){
					$row = mysqli_fetch_array($result);
					if($row==false){
						$content[$count]='"><p></p>';
					}
					else{$content[$count]=' onclick="get_info(\''.$row['pic_id'].'\')" style="background-image:url(portrait/'.$row['pic_id'].')"><p>'.$row['title'].'</p>';}
					$count+=1;
				}
				mysqli_close($conn);
				$view=new PictureView();
				$user=new User();
				$user->set_user($session->get_uid());
				$data=$user->show_info();
				echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame.css">
<link rel="stylesheet" type="text/CSS" href="'.$data['theme'].'-theme.css">
<link rel="stylesheet" type="text/CSS" href="moments.css">';
				$view->show_album($content,min($page,(int)($total/12+1)),(int)$total/12+1);
			}
		}
		public function show_pictures_m(){
			$session=new Session();
			if($session->get_uid()==NULL){
				//header("Location: index.html");
				//return;
			}
			$conn=connect();
			$total=0;
			if($conn){
				$sql='SELECT COUNT(*) FROM moment;';
				$result=mysqli_query($conn,$sql);
				$row=mysqli_fetch_array($result);
				$total=(int)$row[0];
				$sql='SELECT pic_id,summary FROM moment ORDER BY upload_date DESC;';
				$result=mysqli_query($conn,$sql);
				$count=0;
				$content=array();
				while($count<20){
					$row = mysqli_fetch_array($result);
					if($row==false){
						$content[$count]='"<p></p>';
					}
					else{$content[$count]='<td class="moment moment-sml background-cover-center" style=\'background-image:url(portrait/'.$row['pic_id'].')\'><p>123123'.$row['title'].'</p></td>';}
					$count+=1;
				}
				mysqli_close($conn);
				$user=new User();
				$user->set_user($session->get_uid());
				$data=$user->show_info();
				echo '<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame-m.css">
<link rel="stylesheet" type="text/CSS" href="'.$data['theme'].'-theme.css">
<link rel="stylesheet" type="text/CSS" href="moments-m.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>';
				$view=new PictureView();
				$view->show_album_m($content);
			}
		}
	}
?>