<!DOCTYPE html>

<html lang="id">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Login | SIAKAD SDN Rantau Kanan 2</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:300,400,500,600&display=swap" rel="stylesheet">

<style>

body{
    font-family:'Poppins',sans-serif;
    height:100vh;
    margin:0;
    background:
    linear-gradient(rgba(7,39,66,.80), rgba(7,39,66,.90)),
    url('https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1600&q=80');
    background-size:cover;
    background-position:center;
    display:flex;
    align-items:center;
    justify-content:center;
}

.login-box{
    width:420px;
    backdrop-filter:blur(14px);
    background:rgba(255,255,255,.12);
    border-radius:18px;
    border:1px solid rgba(255,255,255,.25);
    box-shadow:0 10px 40px rgba(0,0,0,.45);
    padding:35px 35px 25px;
    color:white;
}

/* ALERT ERROR */
.alert-login{
    background:rgba(255,70,70,.18);
    border:1px solid rgba(255,70,70,.5);
    color:#ffdede;
    padding:10px 12px;
    border-radius:8px;
    font-size:13px;
    margin-bottom:15px;
    animation:fadeIn .4s ease;
}

@keyframes fadeIn{
    from{opacity:0; transform:translateY(-10px);}
    to{opacity:1; transform:translateY(0);}
}

.logo-box{text-align:center;margin-bottom:15px;}
.logo-circle{
    width:95px;height:95px;background:white;border-radius:50%;
    display:flex;align-items:center;justify-content:center;margin:0 auto 10px;
    box-shadow:0 4px 18px rgba(0,0,0,.4);
}
.logo-circle img{width:70px;}

.school-title{text-align:center;margin-bottom:20px;}
.school-title h3{margin:0;font-weight:600;letter-spacing:.5px;}
.school-title small{opacity:.85;}

.greeting{text-align:center;margin-bottom:15px;font-size:14px;opacity:.9;}
#clock{font-weight:600;letter-spacing:1px;}

.form-group{position:relative;margin-bottom:18px;}
.form-group i{position:absolute;top:13px;left:14px;color:#eee;}

.form-control{
    background:rgba(255,255,255,.15);
    border:1px solid rgba(255,255,255,.35);
    color:white;height:46px;padding-left:40px;border-radius:8px;
}
.form-control::placeholder{color:#ddd;}
.form-control:focus{border-color:white;box-shadow:0 0 10px rgba(255,255,255,.5);}

.btn-login{
    margin-top:5px;height:46px;border-radius:8px;background:#ffd24d;
    color:#1b2a3a;font-weight:600;border:none;
}
.btn-login:hover{background:#ffca2b;}

.footer{text-align:center;font-size:12px;margin-top:15px;opacity:.85;}

</style>

</head>

<body>

<div class="login-box">

<div class="logo-box">
    <div class="logo-circle">
        <img src="<?php echo base_url(); ?>assets/dist/img/tutwuri.png">
    </div>
</div>

<div class="school-title">
    <h3>SIAKAD</h3>
    <small>SDN Rantau Kanan 2</small>
</div>

<?php if($this->session->flashdata('error')): ?>

<div class="alert-login" id="alertError">
    <i class="fa fa-exclamation-triangle"></i>
    <?php echo $this->session->flashdata('error'); ?>
</div>
<?php endif; ?>

<div class="greeting">
    <div id="greet"></div>
    <div id="clock"></div>
</div>

<?php echo form_open('auth/check_login'); ?>

<div class="form-group">
    <i class="fa fa-user"></i>
    <input type="text" name="username" class="form-control" placeholder="Username" required>
</div>

<div class="form-group">
    <i class="fa fa-lock"></i>
    <input type="password" name="password" class="form-control" placeholder="Password" required>
</div>

<button type="submit" name="submit" class="btn btn-login btn-block">
    Masuk
</button>

</form>

<div class="footer">
    © <?php echo date('Y');?> Sistem Informasi Akademik Sekolah
</div>

</div>

<script>

/* AUTO HIDE ALERT */
setTimeout(function(){
    var alert=document.getElementById("alertError");
    if(alert){
        alert.style.transition="opacity 0.5s";
        alert.style.opacity="0";
    }
},4000);

/* CLOCK + GREETING */
function updateClock(){
    const now=new Date();
    const h=now.getHours();
    const m=String(now.getMinutes()).padStart(2,'0');
    const s=String(now.getSeconds()).padStart(2,'0');

    document.getElementById("clock").innerHTML=h+":"+m+":"+s;

    let greet="Selamat Malam";
    if(h>=4 && h<11) greet="Selamat Pagi";
    else if(h>=11 && h<15) greet="Selamat Siang";
    else if(h>=15 && h<18) greet="Selamat Sore";

    document.getElementById("greet").innerHTML=greet;
}
setInterval(updateClock,1000);
updateClock();

</script>

</body>
</html>
