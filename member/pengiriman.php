<?php
ob_start();
include"../koneksi.php";
include"../validpage_member.php";
if(!isset($_SESSION['user'])){
	session_start();
}

if(getenv('HTTP_X_FORWARDED_FOR')){
    $ip = getenv('HTTP_X_FORWARDED_FOR');
}else{
    $ip = getenv('REMOTE_ADDR');
}
    
$kat = mysql_query("select * from kategori");

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
$user = $_SESSION['user'];
if(isset($_GET['isbn'])){
    $kode = $_GET['isbn'];
    $cekksql = mysql_query("select * from keranjang where ip_komputer='$ip' and user");
    $kjml = mysql_num_rows($cekksql);
    if($kjml > 0){
        $ksql = mysql_query("update keranjang set jumlah=(jumlah + 1) where ip_komputer='$ip' and user='$user'");
    }else{
        $ksql = mysql_query("insert into keranjang set ip_komputer='$ip', user='$user', isbn='$kode', jumlah='1'");
    }
}

$sql_hitung = mysql_query("select sum(jumlah) as j_buku from keranjang where ip_komputer='$ip' and user='$user'");
if(isset($sql_hitung)){
    $rhitung = mysql_fetch_array($sql_hitung);
    $jhitung = $rhitung['j_buku'];
}else{
    $jhitung = 0;
}


$sql_lihat_keranjang = mysql_query("select * from keranjang join buku on (keranjang.isbn=buku.isbn) join penulis on(buku.kode_penulis=penulis.kode_penulis) join penerbit on (buku.kode_penerbit=penerbit.kode_penerbit) where keranjang.ip_komputer='$ip' and keranjang.user='$user'");

$jml_lihat = mysql_num_rows($sql_lihat_keranjang);

$text = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
$panjangtext = strlen($text);
$hasil ="";
for($i=1;$i<=5;$i++){
    $hasil = trim($hasil).substr($text,mt_rand(0,$panjangtext),1);
}

if(isset($_POST['kode'])){
    $kode = strip_tags(trim($_POST['kode']));
    $nama = strip_tags(trim($_POST['nama']));
    $alamat = strip_tags(trim($_POST['alamat']));
    $email = strip_tags(trim($_POST['email']));
    $tgl  = strip_tags(trim($_POST['tgl']));
    $sql_get = mysql_query("select * from keranjang where user='$user' and ip_komputer='$ip'");
    while($rker=mysql_fetch_array($sql_get)){
        $sql_beli = mysql_query("insert into pembelian set jumlah='$rker[jumlah]', user='$nama', alamat='$alamat', email='$email', isbn='$rker[isbn]', kode_transaksi='$kode', status='dikirim', tgl_pembelian='$tgl'");
        if($sql_beli){
            $sql_hps_keranjang = mysql_query("delete from keranjang where user='$user' and isbn='$rker[isbn]'");
            $sql_hps_buku= mysql_query("update buku set stok=(stok-1) where isbn='$rker[isbn]'");
            header("location:index.php");
        }
    }
}

$sql_hps = mysql_query("select * from keranjang where user='$user'");
$rhps = mysql_fetch_array($sql_hps);

if(isset($_GET['hapus'])){
    $kode_hapus = $_GET['hapus'];
    $sql_delete = mysql_query("delete from keranjang where hapus_keranjang='$kode_hapus' and user='$user'");
    header("location:pengiriman.php?user=$user");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $_SESSION['nama']; ?></title>
<link href="../css/style.css" rel="stylesheet">
<link href="../css/scroll.css" rel="stylesheet">
<script src="../jquery-mobile/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="../js/java.js" type="text/javascript"></script>
</head>

<body>

<span class="top" id="top"><img src="../img/top.png"></span>
<div class="cart">
    <button type="button" class="close" id="cart" onclick="location.href='index.php'">X</button>
    <div class="content-cart">
        <div class="isi-cart" id="cart-empat">
            <div class="isi-ce" id="ce-satu">
                <img src="../img/<?php echo $_SESSION['foto']; ?>" class="img-ce">
            </div>
            <div class="isi-ce" id="ce-dua">
                <form name="paid" id="paid" enctype="multipart/form-data" method="post">
             <table>
                 <tr>
                     <td>Kode Transaksi</td>
                     <td>:</td>
                     <td><b><?php echo $hasil; ?></b><input type="hidden" value="<?php echo $hasil; ?>" name="kode" id="kode"></td>
                 </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td><?php echo $_SESSION['nama']; ?><input type="hidden" value="<?php echo $_SESSION['nama']; ?>" name="nama" id="nama"></td>
                 </tr>
                 <tr>
                     <td>Tanggal Pembelian</td>
                     <td>:</td>
                     <td><input type="text" name="tgl" id="tgl" value="<?php echo date('Y'.'-'.'m'.'-'.'d');?>" readonly></td>
                 </tr>
                 <tr>
                     <td>Email</td>
                     <td>:</td>
                     <td><input type="email" name="email" id="email" placeholder="example@email.com" required></td>
                 </tr>
                 <tr>
                     <td>Alamat Pengiriman</td>
                     <td>:</td>
                     <td><textarea name="alamat" id="alamat" placeholder="Alamat" required></textarea></td>
                 </tr>
                    </table>
            </div>
            <div class="isi-ce" id="ce-tiga">
                </div>
        </div>
        <div class="isi-cart" id="cart-dua">
            <?php
            $no = 1;
        $total = 0;
        $totalbayar = 0;
             
            ?>
        <table>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total / Item</th>
            </tr>
        
        <?php
        if($jml_lihat > 0){
        while ($rlihat = mysql_fetch_array($sql_lihat_keranjang)){ 
          
            $total=($rlihat['harga']*$rlihat['jumlah']);
            $totalbayar = $totalbayar + $total;
        if($no%2==0){
            $warna = "#f8f8f8";
        }else{
            $warna = "white";
        }
            $titem = $rlihat['jumlah']*$rlihat['harga'];
        ?>
        <tr bgcolor="<?php echo $warna; ?>" class="tr-isi">
            <td align="center"><?php echo $no; ?></td>
            <td align="center"><img src="../img/<?php echo $rlihat['gambar']; ?>" class="cart-img"></td>

            <td><?php echo $rlihat['judul']; ?></td>
            <td><?php echo $rlihat['nama']; ?></td>
            <td><?php echo $rlihat['nama_penerbit']; ?></td>
            <td align="center"><?php echo $rlihat['tahun_terbit']; ?></td>
            <td><?php echo $rlihat['kategori']; ?></td>
            <td align="right"><?php echo"Rp.".number_format($rlihat['harga'],0,',','.'); ?></td>
            <td align="center"><?php echo $rlihat['jumlah']; ?></td>
            <td align="right" style="padding-right:10px;"><?php echo"Rp.".number_format($titem,2,',','.');  ?></td>
        </tr>
        <?php
            $no++;
        }
        }else{
            echo"emty";
        }
            ?>
            </table>
        </div>
        <div class="isi-cart" id="cart-tiga">
            <ul>
                <li>Jumlah Barang : &nbsp; <u><b><?php echo $jhitung; ?></b></u></li>
                <li>Total Bayar : &nbsp; <u><b><?php echo"Rp.".number_format($totalbayar,0,',','.'); ?></b></u> </li>
                <li><a href="pengiriman.php?hapus=<?php echo $rhps['hapus_keranjang']; ?>"><button type="button" class="delete">DELETE</button></a><button type="submit" class="check">PAID</button></li>
            </ul>
            
            </form>
        </div>
    </div>
    </div>
<header>
<div class="header-atas">
<div class="content-header">
<p><h1>DROP<b>BOOKS</b></h1><br><span>Toko Buku ditangan Anda ! Rasakan pengalaman membaca dan membeli buku dengan sekali klik</span><br><button type="button" onClick="location.href='../logout.php'">LOGOUT</button> <button type="button">PROFIL</button></p>
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
<li><img src="../img/keranjang.png" class="img-keranjang"><?php echo $jhitung; ?></li>
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
<p><h3><?php echo $row['judul']; ?></h3><span><?php echo "Rp.".number_format($row['harga'],0,',','.'); ?></span><br><a href="detail.php?isbn=<?php echo $row['isbn']; ?> " class="detail">Detail</a> <a href="index.php?isbn=<?php echo $row['isbn']; ?>" class="keranjang">Keranjang</a></p>
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
