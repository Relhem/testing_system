<!DOCTYPE html>
<html>
<head>
	<title>Тестирующая система</title>
	<meta charset="utf-8">
	<meta name="keywords" content="">
	<meta name="deskription" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="shortcut icon" href="/images/favicon.ico" type="image/png">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</head>
<body>

<?php 
require("authtest.php");
?>


<div style="height: 80px; width: 190px; font-size: 14px; font-weight: bold; background: white; position: fixed; top: -100px; right: 120px; border: 1px solid rgba(0,0,0,.1);" id="tip">
<table>
 <tr>
   <td><img style="width: 35px; height: 44px;" src="/images/voskl.png"> </td>
   
   <td>Вы можете перейти к тесту напрямую, напечатав его номер в поле "Номер теста".</td>
 
 </tr>

</table>
</div>

<div class="back_gray">
 <div style="position: absolute;">
 <a style="text-decoration: none; border: none; color: rgb(68,68,68); font-size: 15px; font-weight: bold; margin: 5px;" href="system.php"><img style="width: 35px; height: 35px;" src="/images/home.png"></img></a>
 </div>
<div style="margin-left:0px;" id="title">
 <center>Добро пожаловать в систему тестирования,<span> <?php echo $_SESSION['name'].''?></span>!</center>
</div>
</div>
<div style="font-size: 12px; margin-top: 5px">
<center> <?php echo 'Дата: '.date('Y/m/d');?></center>
</div>

<div id="up_block_list">
<center>
<table>
<tr>
<form method="post">
<td><input style="width: 135px; padding: 3px 10px 3px 10px;" name="per_t" type="text" placeholder="Номер теста"></td>
<td><input type="submit" class="button" name="per_b" value="Переход"></td>
</form>
<tr>
<tr><div style="margin-left: 0px; font-size: 13px;"> Введите номер теста, чтобы перейти к нему.</div></tr>
</table>
</center>
</div>



<div id="block_list">
<center><div style="font-size: 16px; margin-bottom: -10px;">Последние <red>тесты</red>, созданные пользователями:</div></center>
<br>


<script type="text/javascript">
jQuery(document).ready(function($) {
$(window).scroll(function(){
    if  ($(window).scrollTop() > 120){	
        $('#tip').animate({'top':'0px'},500);
	}
        else
        $('#tip').stop(true).animate({'top':'-100px'},500);   
    });
    /*$('#tip.close').bind('click',function(){
        $(this).parent().remove();  
    });*/
    });
</script>




<?php 

 if (isset($_POST['per_b']))
 {
	 header("Location: http://t-syst.techhost.wtf/goto.php?id=".$_POST['per_t']); 
 }



			$mysqli = new mysqli('localhost', '', '', ''); 
				if (mysqli_connect_errno()) {
                printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error());
                exit;
                }

					$query = "SELECT id,name,open,created_by,date_info,password FROM tests ORDER BY id DESC LIMIT 15";	
					if ($result = $mysqli->query($query)) {
                    while($row = $result->fetch_assoc()){		
					echo '<div class="list_element">
<a href="goto.php?id='.$row['id'].'">
<div style="font-weight: bold; ">'.$row['name'].' (#'.$row['id'].')</div>
<table>
 <tr>
   <td width="138px"><div style="margin-left: 13px;font-size: 13px;">Создатель: '.$row['created_by'].'</div></td>
    <td><div style="font-size: 13px;">Дата создания: '.$row['date_info'].'</div></td>';
	
	if ($row['password'] == '' || isset($row['password']) == false) echo '
	   <td><div style="margin-left: 13px;font-size: 13px; color: green;">Защита: Без пароля</div></td>';
	   	else echo'
	   <td><div style="margin-left: 13px;font-size: 13px; color: red;">Защита: С паролем</div></td>';
	   
	  	if ($row['open'] == 1) echo '
	   	   <td><div style="margin-left: 13px;font-size: 13px; "><span class="tooltiptext" data-tooltip="После тестирования вы увидите номера вопросов, в которых вы ошиблись.">Ответы: Открытый</span></div></td>
		   <td> <div style="margin-left: 3px; background: green; width: 7px; height: 7px;" title="123123"></div> </td>
		   ';
		   else echo ' <td><div style="margin-left: 13px;font-size: 13px;"><span class="tooltiptext" data-tooltip="После тестирования вы не сможете увидеть номера вопросов, в которых ошиблись.">Ответы: Закрытый</span></div></td>
		      <td> <div style="margin-left: 3px; background: red; width: 7px; height: 7px;"></div> </td>';
		   
		   echo '
 </tr>
</table>
</a>
</div>';
                      }
					     $result->close();
					}  	 					
			$mysqli->close();
			
			
			
?>


<center><a style="text-decoration: none;" href="system.php"><input type="submit" style="margin-top: 15px;" class="menu_button" name="back" value="Вернуться"></a></center>

<div style="height: 10px;"></div>


</div> 








	
</body>
</html>