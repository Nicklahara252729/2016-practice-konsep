<?php
ob_start();
include"../koneksi.php";
include"../validpage_user.php";
if(!isset($_SESSION['user'])){
	session_start();
}

$limit_buku = 20;
if(!isset($_GET['halaman'])){
    $halaman = 1;
    $posisi =0;
}else{
    $halaman = $_GET['halaman'];
    $posisi = ($halaman-1)*$limit_buku;
}
if(isset($_GET['sch_buku'])){
    $bukuword = $_GET['sch_buku'];
    if(isset($_GET['buku_kategori'])){
        $sqlgetkat = $_GET['buku_kategori'];
    $sql_buku = mysql_query("select * from buku join penulis on(buku.kode_penulis=penulis.kode_penulis) join penerbit on (buku.kode_penerbit=penerbit.kode_penerbit) where buku.judul like'%$bukuword%' and buku.kategori like '%$sqlgetkat%' limit $posisi,$limit_buku");        
    }
    $sql_buku = mysql_query("select * from buku join penulis on(buku.kode_penulis=penulis.kode_penulis) join penerbit on (buku.kode_penerbit=penerbit.kode_penerbit) where buku.judul like'%$bukuword%' limit $posisi,$limit_buku");
}else{
$sql_buku = mysql_query("select * from buku join penulis on(buku.kode_penulis=penulis.kode_penulis) join penerbit on (buku.kode_penerbit=penerbit.kode_penerbit) limit $posisi,$limit_buku");
}
$sql_kodebuku  = mysql_query("select * from buku");
$fkodebuku = mysql_fetch_array($sql_kodebuku);
//------------------------------------------------------
$limit_penulis = 20;
if(!isset($_GET['halamanpenulis'])){
    $halaman_penulis = 1;
    $posisi_penulis =0;
}else{
    $halaman_penulis = $_GET['halamanpenulis'];
    $posisi_penulis = ($halaman-1)*$limit_penulis;
}
if(isset($_GET['sch_penulis'])){
    $penulisword = $_GET['sch_penulis'];
    $sql_penulis = mysql_query("select * from penulis where nama like'%$penulisword%' limit $posisi_penulis,$limit_penulis");
}else{
$sql_penulis = mysql_query("select * from penulis limit $posisi_penulis,$limit_penulis");
}

//------------------------------------------
if(isset($_POST['bisbn'])){
    $isbn = strip_tags(trim($_POST['bisbn']));
    $judul = strip_tags(trim($_POST['bjudul']));
    $tahun = $_POST['btahun']."-".$_POST['bbulan']."-".$_POST['btgl'];
    $penulis = strip_tags(trim($_POST['b_kode_penulis']));    
    $penerbit = strip_tags(trim($_POST['b_kode_penerbit']));
    $stok = strip_tags(trim($_POST['bstok']));
    $harga = strip_tags(trim($_POST['bharga']));
    $kategori = strip_tags(trim($_POST['b_kategori']));
    $sinopsis = strip_tags(trim($_POST['bsinopsis']));
    $gambar = $_FILES['bgambar']['name']?$_FILES['bgambar']['name']:"2ign.jpg";
    $size_buku = $_FILES['bgambar']['size'];
    $sql_cekbuku = mysql_query("select * from buku where isbn='$isbn'");
    $jcekbuku = mysql_num_rows($sql_cekbuku);
    if($jcekbuku > 0){
        ?>
<script>alert('Buku dengan isbn <?php echo $isbn; ?> sudah ada');history.back();</script>
        <?php
    }else{
        if($size_buku > 2097152){
            ?>
<script>alert('Ukuran foto terlalu besar');history.back();</script>
<?php
        }else{
        $simpanbuku = mysql_query("insert into buku set isbn='$isbn', judul='$judul', sinopsis='$sinopsis',tahun_terbit='$tahun', kode_penulis='$penulis', kode_penerbit='$penerbit',stok='$stok', harga='$harga',gambar='$gambar', kategori='$kategori',buku_hapus='ok'");
            if($simpanbuku && isset($_FILES['bgambar']['name'])){
                move_uploaded_file($_FILE['bgambar']['tmp_name'],"img/".$gambar);
            }
        }
        header("location:index.php");
    }
}

if(isset($_GET['isbn_del'])){
    $kodedel = $_GET['isbn_del'];
    $sqldel = mysql_query("delete from buku where isbn='$kodedel'");
    header("location:index.php");
}

if(isset($_GET['hsp_buku'])){
    $kodealldel = $_GET['hsp_buku'];
    $sqldelall = mysql_query("delete from buku where buku_hapus='$kodealldel'");
    header("location:index.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../css/admin.css" rel="stylesheet">
    <script src="../jquery-mobile/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="../js/java.js" type="text/javascript"></script>
<title>Welcome <?php echo $_SESSION['nama']; ?></title>
<script>
window.setTimeout("waktu()",1000);
function waktu(){
	var now = new Date();
	var jam = now.getHours();
	var menit = now.getMinutes();
	var detik = now.getSeconds();
	window.setTimeout("waktu()",1000);
	document.getElementById('jam').innerHTML= jam + " : " + menit + " : " + detik ;
}

    function cekfoto(){
        var filein = document.getElementById('bgambar');
        var info = filein.files[0];
        var size = info.size;
        var mbsize = Math.round(size / 1048576);
        var kbsize = Math.round(size / 1024);
        if(size > 2097152){
            document.getElementById('msgfoto').style.color="red";
            document.getElementById('msgfoto').innerHTML="Maximal foto 2 mb ! Yours " +(mbsize) +" mb";
            document.getElementById('msgfoto').focus();
            return false;
        }else{
            document.getElementById('msgfoto').style.color="blue";
            document.getElementById('msgfoto').innerHTML="Gambar diteriman : "+(kbsize) +" kb";
        }
    }
</script>
</head>

<body>
<main>
<div class="content" id="left-side">
<div class="isi-ls" id="ls-satu">
<p>DROP<b>BOOKS</b></p></div>
<div class="isi-ls" id="ls-dua">
<div class="isi-ld" id="ld-satu">
<img src="../img/<?php echo $_SESSION['foto']; ?>" class="img-user">
</div>
<div class="isi-ld" id="ld-dua">
<p>
<span class="name"><?php echo $_SESSION['user']; ?></span><br>
Status :<?php echo $_SESSION['level']; ?> <b></b><br>
<div id="jam"></div>
</p>
</div>
</div>
<div class="isi-ls" id="ls-tiga">
<ul>
<li>Home</li>
<li class="li-buku">Buku</li>
<li class="li-penulis">Penulis</li>
<li class="li-penerbit">Penerbit</li>
</ul>
</div>
</div>
<div class="content" id="right-side">
<div class="isi-rs" id="rs-satu">
<button type="button" class="logout" onClick="location.href='../logout.php'">LOGOUT</button>
</div>
<div class="isi-content" id="buku">
    <div class="isi-satu">
        <div class="sub-isi" id="sub-satu">
            <a href="index.php?hsp_buku=<?php echo $fkodebuku['buku_hapus']; ?>"><button type="hapus" class="hapus">Delete All</button></a>
            <button type="button" onclick="windows.print();" class="print">Print</button>
            <button type="button" class="tambah" id="addbuku">+ Add Data</button>
            <form method="get" enctype="multipart/form-data" name="cari_buku" id="car_buku" target="_self">
                <input type="text" name="sch_buku" id="sch_buku" placeholder="Search" onkeyup="this.submit();">
                <select name="buku_kategori" id="buku_kategori" class="penerbit">
                    <option selected disabled>- Pilih Kategori -</option>
                    <?php
                    $sql_getpenulis=mysql_query("select * from kategori");
                    while($fgetpenulis = mysql_fetch_assoc($sql_getpenulis)){
                        echo"<option value='$fgetpenulis[kategori]'>$fgetpenulis[kategori]</option>";
                    }
                    ?>
                </select>
            </form>
        </div>
        <div class="sub-isi" id="sub-dua">
            <table>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tahun Terbit</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Kategori</th>
                    <th>Sinopsis</th>
                    <th>Tindakan</th>
                </tr>
            </table>
        </div>
    </div>
    <div class="isi-dua">
        <table>
            <?php
            $jbuku = mysql_num_rows($sql_buku);
            if($jbuku > 0){
                $no =1;
            while ($fbuku = mysql_fetch_array($sql_buku)){
                if($no%2==0){
                    $warna = "#f8f8f8";
                }else{
                    $warna = "white";
                }
            ?>
            <tr bgcolor="<?php echo $warna; ?>">
                <td align="center"><?php echo $no; ?></td>
                <td><?php echo $fbuku['judul']; ?></td>
                <td align="center"><?php echo $fbuku['tahun_terbit']; ?></td>
                <td><?php echo $fbuku['nama']; ?></td>
                <td><?php echo $fbuku['nama_penerbit']; ?></td>
                <td align="center"><?php echo $fbuku['stok']; ?></td>
                <td><?php echo"Rp.".number_format($fbuku['harga'],0,',','.'); ?></td>
                <td><img src="../img/<?php echo $fbuku['gambar']; ?>" class="img-umum"></td>
                <td><?php echo $fbuku['kategori']; ?></td>
                <td align="right"><a href="sinosis.php?id=<?php echo $fbuku['kategori']; ?>"><button type="button" class="read">Read</button></a></td>
                <td align="right">
                    <a href="index.php?isbn_del=<?php echo $fbuku['isbn']; ?>"><button type="button" class="del">Delete</button></a> &nbsp; | &nbsp; 
                    <a href="edit-buku.php?isbn_ebuk=<?php echo $fbuku['isbn']; ?>"><button type="button" class="ed">Edit</button></a>
                </td>
            </tr>
            <?php
                $no++;
            }
            }else{
                echo "Tidak Ditemukan";
            }
                ?>
        </table>
        
    </div>
    <div class="isi-tiga">
        <table>
          <tr>
        <?php
        $sql_buku1= mysql_query("select * from buku");
        $jmlbuku = mysql_num_rows($sql_buku1);
        $jmlhal_buku = ceil($jmlbuku/$limit_buku);
        if($halaman > 1){
            $prev = $halaman -1;
            echo "<td><a href='$_SERVER[PHP_SELF]?halaman=$prev'><< </a></td>";
        }else{
            echo"<span class='prev' disabled><td><< </td></span>";
        }
        
        for($i=1;$i<=$jmlhal_buku;$i++)
            if($i!=$halaman){
                echo"<td><a href='$_SERVER[PHP_SELF]?halaman=$i'>$i</a></td>";
            }else{
                echo"<span current><td>$i</td></span>";
            }
        if($halaman < $jmlhal_buku){
            $next = $halaman+1;
            echo"<td><a href='$_SERVER[PHP_SELF]?halaman=$next'> >></a></td>";
        }else{
            echo"<span class='next'><td> >></td></span>";
        }
        ?>
              </tr>  
            </table>
    </div>
    </div>

</div>
<div class="form-tambah" id="tmbhbuku">
        <button type="button" class="close" id="cbuku">X</button>
        <div class="form">
        <form target="_self" name="input_buku" id="input_buku" enctype="multipart/form-data" method="post">
            <div class="isi-form" id="form-dua">
                <div class="form-title">
                    INPUT DATA BUKU
                </div>
            <input type="text" name="bisbn" id="bisbn" placeholder="ISBN" required>
         
            <input type="text" name="bjudul" id="bjudul" placeholder="Judul" required>
                <select name="btahun" id="btahun" class="tahun" required>
                    <option disabled selected>- Pilih Tahun -</option>
                    <?php
                    for($i=1999;$i<=2016;$i++){
                        echo"<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
                <select name="b_kode_penulis" id="b_kode_penulis" class=penerbit required>
                    <option selected disabled>- Pilih Penulis -</option>
                    <?php
                    $sql_getpenulis=mysql_query("select * from penulis order by nama desc");
                    while($fgetpenulis = mysql_fetch_assoc($sql_getpenulis)){
                        echo"<option value='$fgetpenulis[kode_penulis]'>$fgetpenulis[nama]</option>";
                    }
                    ?>
                </select>
                 <select name="b_kode_penerbit" id="b_kode_penerbit" class=penerbit required>
                    <option selected disabled>- Pilih Penerbit -</option>
                    <?php
                    $sql_getpenulis=mysql_query("select * from penerbit order by nama_penerbit desc");
                    while($fgetpenulis = mysql_fetch_assoc($sql_getpenulis)){
                        echo"<option value='$fgetpenulis[kode_penerbit]'>$fgetpenulis[nama_penerbit]</option>";
                    }
                    ?>
                </select>
                <input type="number" name="bstok" id="bstok" placeholder="Stok" min="1" required>
                <input type="number" name="bharga" id="bharga" placeholder="Harga" min="100000" required>
                 <select name="b_kategori" id="b_kategori" class=penerbit required>
                    <option selected disabled>- Pilih Kategori -</option>
                    <?php
                    $sql_getpenulis=mysql_query("select * from kategori");
                    while($fgetpenulis = mysql_fetch_assoc($sql_getpenulis)){
                        echo"<option value='$fgetpenulis[kategori]'>$fgetpenulis[kategori]</option>";
                    }
                    ?>
                </select>
                <input type="file" name="bgambar" id="bgambar" onfocus="cekfoto();" onblur="cekfoto();" onchange="cekfoto();" >
                <div id="msgfoto"></div>
                <button type="submit">Simpan</button>
                <button type="reset">Reset</button>
            </div>
            <div class="isi-form" id="form-satu" >
                <textarea name="bsinopsis" id="sinopsis" require placeholder="SINOPSIS"d></textarea>
            </div>
        </form>
            </div>
    </div>
</main>
</body>
</html>
<?php
mysql_close($koneksi);
ob_flush();
?>