<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

setCookie("ASP.NET_SessionId","chvvkl55d30vgljpnrnjqja2", time()+36000);
//搜尋條件相同時不需要更改
setCookie("JubFrm-pagebox","%5EcourtFullName%3DTPHM%60%5Ejcatagory%3D0%5Eissimple%3D-1%5Etxtjudge%3D%E6%9B%BE%E5%BE%B7%E6%B0%B4", time()+36000);
setCookie("_ga","GA1.3.1353423917.1429331533", time()+36000);
setCookie("_gat","1", time()+36000);
//每一次重新搜尋都會更動
setCookie("x","j=ExKZIgGGiQD19KUxjSulmR7VrG+UqOC3c/i6aZmG+AcgRkTJik5uhdV/m/fbV1fON1gLHUHO1DrbgcLR4Txh03b9toUxLfoxKtkir4CoQPD28S346FdU6l4uRwIh/n+MgTvwh2RuOp3LZsGjcqosHmnB5YyDvbi5Mk3fVJ1T/iDK/pdpgOdkB5uZ/AWFEsM17yBnKXv2xnmoAU75juA1edyuvIlNWRPRcwLJKefInM9ROSalNLCkdSGg53keqfDK7zBq4rvRNlhJ/VURSMN6w6Dhh2pfsOXQTa0iKjnI2G15Y7paMKbJVdXJktbHWwCX", time()+3600);

//print_r($_SESSION);

echo "1".$_SESSION["eventtarget"]."<br>";
echo "2".$_SESSION["eventargument"]."<br>";
echo "3".$_SESSION["viewstate"]."<br>";
echo "4".$_SESSION["viewstategenerator"]."<br>";
echo "5".$_SESSION["eventvalidation"]."<br>";

?>

<form name="Form1" method="post" action="http://fyjud.lawbank.com.tw/listcontent5.aspx" id="Form1">

	<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="<?=$_SESSION["eventtarget"]?>" />
	<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="<?=$_SESSION["eventargument"]?>" />
	<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="<?=$_SESSION["viewstate"]?>" />

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="<?=$_SESSION["viewstategenerator"]?>" />
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="<?=$_SESSION["eventvalidation"]?>" />

</form>

<script>
document.getElementById('Form1').submit();
</script>

