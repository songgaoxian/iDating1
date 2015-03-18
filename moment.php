<?php
	require("session.php");
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
		public function show_album($content,$page,$total){
			echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame.css">
<link rel="stylesheet" type="text/CSS" href="pink-theme.css">
<link rel="stylesheet" type="text/CSS" href="moments.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$(".moment-big").height($(".moment-big").width());
	$(".moment-sml").height($(".moment-sml").width());
	
	$(".moment").hover(function() {
		$(this).children("p").fadeIn("fast");
		$(this).prepend("<div class=\'pic-mask\'></div>");
	},
	function() {
		$(this).children("p").hide();
		$(".pic-mask").remove();
	});	
	
	 $("#upload").click(function() {
		$("body").append("<div class=\'mask\'></div>");
		$("#upload-pic-box").slideDown();
		$("#upload-pic-box").css("left",($(window).innerWidth()*0.94-$("#upload-pic-box").width())/2);		
	});
	
	$(".close-overlay").click(function() {
		$(".mask").remove();
	    $(this).parent().slideUp();		
	});	
	
	$(".moment").click(function() {
		temp=$(this).css("background-image");
		temp=temp.substr(4);
		temp=temp.substr(0,temp.length-1);
		$("body").append("<div class=\'mask\'></div>");
	    $("#pic-detail-box").slideDown();
		$("#pic-detail-box").css("left",($(window).innerWidth()*0.94-$("#pic-detail-box").width())/2);
		$("#pic-detail-box").children("a").children("img").attr({"src":temp});
		$("#pic-detail-box").children("a").attr({"href":temp});
		$("#pic-detail-box").children("h2").text($(this).children("p").text());
	});	
	
	$(window).resize(function() {
		$(".moment-big").height($(".moment-big").width());
	    $(".moment-sml").height($(".moment-sml").width());
        $("#upload-pic-box").css("left",($(window).innerWidth()*0.94-$("#upload-pic-box").width())/2);
		$("#pic-detail-box").css("left",($(window).innerWidth()*0.94-$("#upload-pic-box").width())/2);
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
  <li><a href="calendar.html">Calendar</a>
  <li><a href="search.php">Search</a>
  <li><a href="accountmgt.php">My Page</a>  
</ul>
<img src="img/logo_small.png" alt="iDating logo">
</div>
<!--header-end-->

<!--content-start-->
<div class="container">
<!--momentWall-start-->
<div id="moment-wall">
<table>
<tr>
<td rowspan="2" colspan="2" class="moment moment-big"'.$content[0].'</td>
<td class="moment moment-sml"'.$content[1].'</td>
<td class="moment moment-sml"'.$content[2].'</td>
<td class="moment moment-sml"'.$content[3].'</td>
</tr>
<tr>
<td class="moment moment-sml"'.$content[4].'</td>
<td class="moment moment-sml"'.$content[5].'</td>
<td class="moment moment-sml"'.$content[6].'</td>
</tr>
<tr>
<td class="moment moment-sml"'.$content[7].'</td>
<td class="moment moment-sml"'.$content[8].'</td>
<td class="moment moment-sml"'.$content[9].'</td>
<td class="moment moment-sml"'.$content[10].'</td>
<td class="moment moment-sml"'.$content[11].'</td>
</tr>
</table>
</div>

<div id="moment-btns">
<button id="upload" type="button" class="btn btn-lg">Upload My Moment</button>
<a href="moments.php?page='.min($page+1,$total).'"><div id="next" type="button" class="btn" style="text-align:center">&gt;</div></a>
<a href="moments.php?page='.max($page-1,1).'"><div id="previous" type="button" class="btn" style="text-align:center">&lt;</div></a>
</div>
</div>
';}
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
							$sql='INSERT INTO `moment` (`user_id`, `pic_id`, `summary`, `upload_date`) VALUES (\''.$user_id.'\', \''.$filename.'\', \''.$_POST['title'].'\', CURRENT_TIMESTAMP);';
							$result=mysqli_query($conn,$sql);
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
			session_start();
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
				$sql='SELECT pic_id,summary FROM moment ORDER BY upload_date DESC;';
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
					else{$content[$count]=' onclick="get_info(\''.$row['pic_id'].'\')" style="background-image:url(portrait/'.$row['pic_id'].')"><p>'.$row['summary'].'</p>';}
					$count+=1;
				}
				mysqli_close($conn);
				$view=new PictureView();
				$view->show_album($content,min($page,(int)($total/12+1)),(int)$total/12+1);
			}
		}
	}
?>