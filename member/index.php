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
if(isset($_GET['isbn_keranjang'])){
    $kode = $_GET['isbn_keranjang'];
    $cekksql = mysql_query("select * from keranjang where isbn='$kode' and user='$user'");
    $kjml = mysql_num_rows($cekksql);
    if($kjml > 0){
        $ksql = mysql_query("update keranjang set jumlah=(jumlah+1) where user='$user' and isbn='$kode'");
    }else{
        $ksql = mysql_query("insert into keranjang set ip_komputer='$ip', user='$user', isbn='$kode', jumlah='1', hapus_keranjang='ok'");
    }
    header("location:index.php");
}

$sql_hitung = mysql_query("select sum(jumlah) as j_buku from keranjang where ip_komputer='$ip' and user='$user'");
if(isset($sql_hitung)){
    $rhitung = mysql_fetch_array($sql_hitung);
    $jhitung = $rhitung['j_buku'];
}else{
    $jhitung = 0;
}


$sql_lihat_keranjang = mysql_query("select * from keranjang join buku on (keranjang.isbn=buku.isbn) join penulis on(buku.kode_penulis=penulis.kode_penulis) join penerbit on (buku.kode_penerbit=penerbit.kode_penerbit) where keranjang.ip_komputer='$ip' and keranjang.user='$user'");


if(isset($_GET['id'])){
    $id= $_GET['id'];
    $hsp_keranjang = mysql_query("delete from keranjang where id_keranjang='$id' and user='$user' and ip_komputer='$ip'");
    header("location:index.php");
}

$hps_all = mysql_query("select * from keranjang where user='$user'");
$rhps = mysql_fetch_array($hps_all);

if(isset($_GET['hapus'])){
    $hapus = $_GET['hapus'];
    $sql_delall = mysql_query("delete from keranjang where hapus_keranjang='$hapus' and user='$user' ");
    header("location:index.php");
}

if(isset($_GET['tambah'])){
    $kodetambah = $_GET['tambah'];
    $sql_tambah = mysql_query("update keranjang set jumlah=(jumlah+1) where user='$user' and id_keranjang='$kodetambah'");
    header("location:index.php");
}
if(isset($_GET['kurang'])){
    $kodekurang = $_GET['kurang'];
    $cek_kurang = mysql_query("select sum(jumlah) as totkurang from keranjang where user='$user' and id_keranjang='$kodekurang'");
    $rkurang = mysql_fetch_array($cek_kurang);
    $jmlkurang = $rkurang['totkurang'];
    if($jmlkurang >1){
    $sql_kurang = mysql_query("update keranjang set jumlah=(jumlah-1) where user='$user' and id_keranjang='$kodekurang'");
    }else{
        $cek_kurang = mysql_query("select sum(jumlah) as totkurang from keranjang where user='$user' and id_keranjang='$kodekurang'");
    }
    header("location:index.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $_SESSION['nama']; ?></title>
<link href="../css/style.css" rel="stylesheet">
<script src="../jquery-mobile/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="../js/java.js" type="text/javascript"></script>
</head>

<body>

<span class="top" id="top"><img src="../img/top.png"></span>

<div class="profil">
        <button type="button" class="close" onclick="location.href='index.php'">X</button>
        <div class="content-profil">
            <div class="isi-profil" id="profil-satu">
                <div class="in-profil" id="in-satu">
                    <img src="../img/<?php echo $_SESSION['foto']; ?>" class="img-in">
                </div>
            </div>
            <div class="isi-profil" id="profil-dua">
                <div class="in-profil" id="in-dua">
                    <table>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['nama']; ?></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['user']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['email']; ?></td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
<div class="cart">
    <button type="button" class="close" id="cart" onclick="location.href='index.php'">X</button>
    <div class="content-cart">
        <div class="isi-cart" id="cart-satu">
            <ul>
                <li><img src="../img/<?php echo $_SESSION['foto']; ?>" class="img-cart"></li>
                <li><img src="../img/keranjang.png" class="img-cart"></li>
                <li>Barang Belanjaan anda :&nbsp; <span><?php echo $jhitung; ?></span></li>
            </ul>
        </div>
        <div class="isi-cart" id="cart-dua">
            <?php
            $jml_cart= mysql_num_rows($sql_lihat_keranjang);
            if($jml_cart > 0){
                ?>
        <table>
            <tr>
                <th>No</th>
                <th>Gambar </th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total / Item</th>
                <th>Tindakan</th>
            </tr>
        
        <?php
            
        $no = 1;
        while ($rlihat = mysql_fetch_array($sql_lihat_keranjang)){    
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
            <td align="center"><?php echo $rlihat['jumlah']; ?> &nbsp;
                <a href="index.php?tambah=<?php echo $rlihat['id_keranjang']; ?>"><button type="button" class="tambah">+</button></a> &nbsp; <a href="index.php?kurang=<?php echo $rlihat['id_keranjang']; ?>"><button type="button" class="kurang">-</button></a>
            </td>
            <td align="right"><?php echo"Rp.".number_format($titem,2,',','.');  ?></td>
            <td align="center"><a href="index.php?id=<?php echo $rlihat['id_keranjang']?>"><button type="button" class="hps">HAPUS</button></a> &nbsp; <!--| &nbsp; <a href="edit-keranjang?id=<?php echo $rlihat['id_keranjang']; ?>"><button type="button" class="edt">EDIT</button></a>--></td>
        </tr>
        <?php
            $no++;
        }
            }else{
                echo"empty";
            }
            ?>
            </table>
        </div>
        <div class="isi-cart" id="cart-tiga">
            <a href="index.php?hapus=<?php echo $rhps['hapus_keranjang']; ?>"><button type="button" class="delete">DELETE ALL</button></a>
            <a href="pengiriman.php?user=<?php echo $user; ?> "><button type="button" class="check">CHECK OUT</button></a>
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
<p><h3><?php echo $row['judul']; ?></h3><span><?php echo "Rp.".number_format($row['harga'],0,',','.'); ?></span><br><a href="detail.php?isbn=<?php echo $row['isbn']; ?> " class="detail">Detail</a> <a href="index.php?isbn_keranjang=<?php echo $row['isbn']; ?>" class="keranjang">Keranjang</a></p>
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
