<?php
ob_start();
include"../koneksi.php";
include"../validpage_member.php";
if(!isset($_SESSION['user'])){
	session_start();
}
$kat = mysql_query("select * from kategori");

if(getenv('HTTP_X_FORWARDED_FOR')){
    $ip = getenv('HTTP_X_FORWARDED_FOR');
}else{
    $ip = getenv('REMOTE_ADDR');
}

$user = $_SESSION['user'];
if(isset($_GET['isbn_keranjang'])){
    $kode = $_GET['isbn_keranjang'];
    $cekksql = mysql_query("select * from keranjang where user='$user' and isbn='$kode'");
    $kjml = mysql_num_rows($cekksql);
    if($kjml > 0){
        $ksql = mysql_query("update keranjang set jumlah=(jumlah+1) where user='$user' and isbn='$kode'");
    }else{
        $ksql = mysql_query("insert into keranjang set ip_komputer='$ip', user='$user', isbn='$kode', jumlah='1', hapus_keranjang='ok'");
    }
    header("location:index.php");
}

$limit = 20;
if(!isset($_GET['halaman'])){
	$halaman = 1;
	$posisi = 0;
}else{
	$halaman = $_GET['halaman'];
	$posisi = ($halaman-1)*$limit;
}

if(isset($_GET['sch_cari'])){
	$keyword = $_GET['sch_cari'];
	if(!isset($_GET['kategori'])){
	$tsql = mysql_query("select * from buku join penulis on (buku.kode_penulis=penulis.kode_penulis) join penerbit on (buku.kode_penerbit=penerbit.kode_penerbit) where buku.judul like '%$keyword%' order by buku.isbn desc limit $posisi,$limit");
	}else{
		$kategori =$_GET['kategori'];
		$tsql = mysql_query("select * from buku join penulis on (buku.kode_penulis=penulis.kode_penulis) join penerbit on (buku.kode_penerbit=penerbit.kode_penerbit) where buku.judul like '%$keyword%' and buku.kategori='$kategori' order by buku.isbn desc limit $posisi,$limit");
	}
}else{
	$tsql = mysql_query("select * from buku join penulis on (buku.kode_penulis=penulis.kode_penulis) join penerbit on (buku.kode_penerbit=penerbit.kode_penerbit) order by buku.isbn desc limit $posisi,$limit");
}

$tjml = mysql_num_rows($tsql);

$batas=6;
if(isset($_GET['isbn'])){
    $kodeisbn = $_GET['isbn'];
    $sql_isbn = mysql_query("select * from buku join penulis on (buku.kode_penulis=penulis.kode_penulis) join penerbit on (buku.kode_penerbit=penerbit.kode_penerbit) where isbn='$kodeisbn'");
    $risbn = mysql_fetch_array($sql_isbn);
    $sql_more = mysql_query("select * from buku where kode_penulis='$risbn[kode_penulis]' limit $batas");
    
}

$sql_hitung = mysql_query("select sum(jumlah) as j_buku from keranjang where ip_komputer='$ip' and user='$user'");
if(isset($sql_hitung)){
    $rhitung = mysql_fetch_array($sql_hitung);
    $jhitung = $rhitung['j_buku'];
}else{
    $jhitung = 0;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Drop Book</title>
<link href="../css/style.css" rel="stylesheet">
    <link href="../css/scroll.css" rel="stylesheet">
<script src="../jquery-mobile/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="../js/java.js" type="text/javascript"></script>
</head>

<body>

<span class="top" id="top"><img src="../img/top.png"></span>
<div class="detail-barang">
    <button type="button" class="close" onclick="location.href='index.php'">X</button>
    <div class="content-detail">
        <div class="isi-detail" id="detail-satu">
            <div class="isi-ds" id="ds-satu">
                <img src="../img/<?php echo $risbn['gambar'];  ?>" class="img-dssatu">
            </div>
            <div class="isi-ds" id="ds-dua">
                <p>Koleksi Lain Karangan : &nbsp; <?php echo $risbn['nama']; ?></p>
                <?php
                while ($fmore = mysql_fetch_array($sql_more)){
            
                ?>
                <div class="isi-dd"><img src="../img/<?php echo $fmore['gambar']; ?>" class="img-more"></div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="isi-detail" id="detail-dua">
            <table>
                <tr>
                    <td>ISBN</td>
                    <td>:</td>
                    <td><?php echo $risbn['isbn']; ?></td>
                </tr>
                <tr>
                    <td>Judul</td>
                    <td>:</td>
                    <td><?php echo $risbn['judul']; ?></td>
                </tr>
                <tr>
                    <td>Tahun Terbit</td>
                    <td>:</td>
                    <td><?php echo $risbn['tahun_terbit']; ?></td>
                </tr>
                <tr>
                    <td>Penulis</td>
                    <td>:</td>
                    <td><?php echo $risbn['nama']; ?></td>
                </tr>
                <tr>
                    <td>Penerbit</td>
                    <td>:</td>
                    <td><?php echo $risbn['nama_penerbit']; ?></td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td>:</td>
                    <td><?php echo $risbn['kategori']; ?></td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td>:</td>
                    <td><?php echo"Rp.".number_format($risbn['harga'],0,',','.'); ?></td>
                </tr>
            </table>
            <button type="button" class="btn-db">Beli</button><br>
            <a href='detail.php?isbn_keranjang=<?php echo $risbn['isbn']; ?>'><button type="button" class="btn-dk">+ Keranjang</button></a>
        </div>
        <div class="isi-detail" id="detail-tiga">
            <span>SINOPSIS</span>
            <p><br><?php echo $risbn['sinopsis']; ?></p>
        </div>
    </div>
    </div>
<header>
<div class="header-atas">
<div class="content-header">
<p><img src="../img/<?php echo $_SESSION['foto']; ?>" class="img-profil"><h1>DROP<b>BOOKS</b></h1><span>Toko Buku ditangan Anda ! Rasakan pengalaman membaca dan membeli buku dengan sekali klik</span><br><button type="button" onClick="location.href='../logout.php'">LOGOUT</button></p>
</div>
</div>
<div class="header-tengah">
<div class="content-header">
<a href="index.php"><img src="../img/logo.png" class="logo"></a>
<ul>
<li>HORROR</li>
<li>HUMOR</li>
<li>IT</li>
<li>BISNIS</li>
<li>SEJARAH</li>
<li>TEKNOLOGI</li>
<li class="li-cart"><img src="../img/keranjang.png" class="img-keranjang"><?php echo $jhitung; ?></li>
</ul>
<form target="_self" id="cari" name="cari" enctype="multipart/form-data" method="get">
	<input type="text" name="sch_cari" id="sch_cari" placeholder="Cari Buku, Penulis, Penerbit" onKeyUp="this.submit();">
    <select name="kategori" id="kategori">
    <option disabled selected>ALL</option>
    <?php
	while($rkat = mysql_fetch_array($kat)){
		echo"<option value='$rkat[kategori]'>$rkat[kategori]</option>";
	}
	?>
    </select>
</form>
</div>
</div>
<div class="header-bawah">
<div class="content-header">
<div class="kategori" id="kat-satu"><p>SEJARAH</p></div>
<div class="kategori" id="kat-dua"><p>HORROR</p></div>
<div class="kategori" id="kat-tiga"><p>HUMOR</p></div>
<div class="kategori" id="kat-empat"><p>IT</p></div>
<div class="kategori" id="kat-lima"><p>BISNIS</p></div>
<div class="kategori" id="kat-enam"><p>TEKNOLOGI</p></div>
</div>
</div>
</header>
<main>
<div class="content">
<div class="content-atas">
<?php
if($tjml > 0){
	while ($row = mysql_fetch_array($tsql)){
?>
<div class="isi-content">
<img src="../img/<?php echo $row['gambar']; ?>" class="gambar">
<div class="keterangan">
<p><h3><?php echo $row['judul']; ?></h3><span><?php echo "Rp.".number_format($row['harga'],0,',','.'); ?></span><br><a href="detail.php?isbn=<?php echo $row['isbn']; ?> " class="detail">Detail</a> <a href="keranjang.php?isbn=<?php echo $row['isbn']; ?>" class="keranjang">Keranjang</a></p>
</div>
</div>

<?php
	}
}
?>
</div>
<div class="page">
<?php
$psql = mysql_query("select * from buku");
$pjml = mysql_num_rows($psql);
$jmlhal = ceil($pjml/$limit);
if($halaman > 1){
	$prev = $halaman-1;
	echo"<div class='page-box'><a href='$_SERVER[PHP_SELF]?halaman=$prev'><< PREV</a></div>";
}else{
	echo"<div class='page-box'><span class='disabled'><< PREV</span></div>";
}

for($i=1;$i<=$jmlhal;$i++)
if($i!=$halaman){
	echo"<div class='page-box' id='pb-satu'><a href='$_SERVER[PHP_SELF]?halaman=$i'>$i</a></div>";
}else{
	echo" <div class='page-box' id='pb-satu'><span class='current'>$i</span></div>";
}

if($halaman < $jmlhal){
	$next =$halaman+1;
	echo"<div class='page-box'><a href='$_SERVER[PHP_SELF]?halaman=$next'>NEXT >></a></div>";
}else{
	echo"<div class='page-box'><span class='disabled'>NEXT >></span></div>";
}
?>
</div>
</div>
</div>
</main>
<footer>
<div class="footer-atas">
<div class="cf-atas">
<div class="isi-fa" id="fa-satu"></div>
<div class="isi-fa" id="fa-dua"></div>
<div class="isi-fa" id="fa-tiga"></div>
</div>
</div>
<div class="footer-bawah">
<div class="cf-bawah">
<p>Copyright &copy; Nico Lahara 2016 All Right Reserved<br> <span>Ketentuan | Kebijakan | Terms | About Us | Support</span></p>
</div>
</div>
</footer>
</body>
</html>
<?php
mysql_close($koneksi);
ob_flush();
?>