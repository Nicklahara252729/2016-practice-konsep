<?php 
$koneksi = mysql_connect('localhost','root','satusampe250599') or die(mysql_error());
$db = mysql_select_db('2016_web_native_siswa',$koneksi) or die(mysql_error());
?>