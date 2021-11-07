<?php
ob_start();
include"koneksi.php";
if(!isset($_SESSION['user'])){
    session_start();
}
$pesan = "Welcome ! Please login first";
if(isset($_POST['username'])){
    $user = strip_tags(trim($_POST['username']));
    $pass = strip_tags(trim($_POST['password']));
    $pass1 = sha1($pass);
    if(isset($_POST['remember'])){
        setcookie("username",$user,time() + (3600 * 24));
        setcookie("password",$pass,time() + (3600 * 24));
    }else{
        unset($_COOKIE['username']);
        unset($_CO0KIE['password']);
    }
    $sql = mysql_query("select * from user where username='$user' and password='$pass1'");
    $jml = mysql_num_rows($sql);
    $r  = mysql_fetch_array($sql);
    if($jml > 0){
        $_SESSION['nama']=$r['nama'];
        $_SESSION['user']=$r['username'];
        $_SESSION['pass']=$r['password'];
        $_SESSION['email']=$r['email'];
        $_SESSION['level']=$r['level'];
        $_SESSION['foto']=$r['foto'];
        if($r['level']=="admin" or $level=="user"){
            header("lcoation:admin/index.php");
        }else{
            header("location:member/index.php");
        }
        $pesan = "Username dan password valid";
    }else{
        $pesan = "Username dan Password tidak valid";
    }
}

if(isset($_POST['rusername'])){
    $ruser = strip_tags($_POST['rusername']);
    $rnama = strip_tags($_POST['rnama']);
    $rpass = strip_tags($_POST['rpassword']);
    $remail = strip_tags($_POST['remail']);
    $rfoto = $_FILES['rfile']['name']?$_FILES['rfile']['name']:"default.png";
    $rsize = $_FILES['rfile']['size'];
    $rsql = mysql_query("select * from user where username='$ruser' and password='$rpass'");
    $rjml = mysql_num_rows($rsql);
    if($rjml  > 0){
        ?>
<script>alert('Username <?php echo $ruser; ?> sudah ada');history.back();</script>
<?php
    }else{
        if($rsize > 2097152){
            ?>
<script>alert('Ukuran foto terlalu besar !');history.back();</script>
<?php
        }else{
            $simpan = mysql_query("insert into user set nama='$rnama', username='$ruser', password='$rpass','");
        }
    }
}
?>
<!doctype html>
<html>
    <head>
        <title>Shopping Store</title>
    </head>
    <body>
        <span class="top"><p>TOP</p></span>
        <div class="login">
            <div class="content-login">
                <div class="isi-login" id="top-login">
                    <div class="isi-tl">
                        <img>
                    </div>
                </div>
                <div class="isi-login" id="bottom-login">
                    <div class="msglogin"></div>
                    <form target="_self" name="login" id="login" enctype="multipart/form-data" method="post">
                        <input type="text" name="username" id="username" placeholder="Username" required value="<?php ?>">
                        <input type="password" name="password" id="password" placeholder="Password" required value="<?php ?>">
                        <input type="checkbox" name="remember" id="remember"> Remember Me<br>
                        <button type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="register">
            <div class="content-login">
                <div class="isi-login" id="top-login">
                    <div class="isi-tl">
                        <img>
                    </div>
                </div>
                <div class="isi-login" id="bottom-login">
                    <form target="_self" name="register" id="register" enctype="multipart/form-data" method="post">
                       <input type="text" name="rnama" id="rnama" placeholder="Nama Lengkap" required>
                        <input type="text" name="rusername" id="rusername" placeholder="Username" required>
                        <input type="password" name="rpassword" id="rpassword" placeholder="Password" required onblur="">
                        <input type="password" name="rconfirm" id="rconfirm" placeholder=" Confirm Password" required onblur="" onfocus="">
                        <div id="msgpass"></div><br>
                        <input type="email" placeholder="Email (Example@email.com)" name="remail" id="remail" required onfocus="">
                        <label for="file">Pilih Foto</label><br>
                        <input type="file" id="rfile" name="rfile" onblur="" onfocus="" onchange="">
                        Maksimal ukuran foto 2 Mb.
                        <div id="msgfile"></div><br>
                        <button type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <header>
            <div class="header-atas">
                <div class="content-header">
                    <div class="isi-ha">
                        <button type="button" class="btn-login">Login</button>
                        <button type="button" class="btn-register">Register</button>
                    </div>
                </div>
            </div>
            <div class="header-tengah">
                <div class="content-header">
                    <div class="isi-ht" id="ht-satu">
                        <img>
                    </div>
                    <div class="isi-ht" id="ht-dua">
                        <ul>
                            <li>Highlight</li>
                            <li>Discount</li>
                            <li>Top Produk</li>
                            <li>Keranjang</li>
                        </ul>
                    </div>
                    <div class="isi-ht" id="ht-tiga">
                        <form target="_self" name="cari" id="cari" enctype="multipart/form-data" method="get">
                            <input type="search" name="sch_cari" id="sch_cari" placeholder="Search" onkeyup="this.submit();">
                            <select name="kategori" id="kategori">
                                <option disabled selected>ALL</option>
                                <?php
                                ?>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="header-bawah">
                <div class="content-header">
                    <div class="isi-hb" id="hb-satu">
                        <img>
                    </div>
                    <div class="isi-hb" id="hb-dua">
                    </div>
                    <div class="isi-hb" id="hb-tiga"></div>
                    <div class="isi-hb" id="hb-empat"></div>
                    <div class="isi-hb" id="hb-lima"></div>
                    <div class="isi-hb" id="hb-enam"></div>
                </div>
            </div>
        </header>
        <main>
            <div class="content">
                <div class="in-content" id="top-content">
                    <div class="isi-content">
                        <div class="isi-atas">
                            <img>
                            <div class="price"></div>
                        </div>
                        <div class="isi-bawah">
                            <div class="in-ib"></div>
                            <div class="in-ib"></div>
                        </div>
                    </div>
                </div>
                <div class="in-content" id="bottom-content">
                    
                </div>
            </div>
        </main>
        <footer>
            <div class="footer-atas">
                <div class="cf-atas">
                    <div class="isi-fa" id="fa-satu"></div>
                    <div class="isi-fa" id="fa-dua"></div>
                    <div class="isi-fa" id="fa-tiga">
                        <div class="newaletter">
                            <form enctype="multipart/form-data" name="news" id="news" method="post" target="_self">
                            <input type="email" name="newsletter" id="newletter" placeholder="Email (Example@email.com)">
                                <input type="radio" value="L"> Laki - Laki 
                                <input type="radio" value="P"> Perempuan
                                <button type="submit">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bawah">
                <div class="cf-bawah">
                    <p>Copyright &cong; 2016 Nico Lahara All Rights Reserved <br> Ketentuan | Kebijakan</p>
                </div>
            </div>
        </footer>
    </body>
</html>
<?php
ob_flush();
?>