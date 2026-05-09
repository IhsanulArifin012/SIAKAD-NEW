<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | SIAKAD SDN Rantau Kanan 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/select2/dist/css/select2.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/sweetalert2/sweetalert2.min.css'); ?>">
    <!-- Google Fonts removed to avoid external stylesheet load failures in offline/blocked environments -->

    <style>
        :root{
            --panel-bg: rgba(255,255,255,.92);
            --panel-border: rgba(255,255,255,.55);
            --text: #10202f;
            --muted: #607285;
            --input-bg: #f7fafc;
            --input-border: #d6e0ea;
            --accent: #0b6ea8;
            --accent-hover: #075b8b;
            --gold: #f3b23c;
        }

        body{
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            color: var(--text);
            background:
                linear-gradient(90deg, rgba(6,29,47,.44) 0%, rgba(6,29,47,.18) 42%, rgba(6,29,47,.66) 100%),
                url('<?php echo base_url('assets/dist/img/login/school-background.jpg'); ?>'),
                url('<?php echo base_url('assets/dist/img/boxed-bg.jpg'); ?>');
            background-size: cover;
            background-position: center;
            overflow-x: hidden;
        }

        body::before{
            content: "";
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle at 18% 15%, rgba(243,178,60,.22), transparent 26%),
                linear-gradient(180deg, rgba(255,255,255,.08), rgba(7,28,45,.22));
            pointer-events: none;
        }

        .login-shell{
            position: relative;
            z-index: 1;
            width: min(440px, 100%);
        }

        .login-card{
            width: 100%;
            background: var(--panel-bg);
            border: 1px solid var(--panel-border);
            border-radius: 12px;
            box-shadow: 0 24px 70px rgba(5,22,36,.34);
            padding: 32px;
        }

        @supports ((-webkit-backdrop-filter: blur(1px)) or (backdrop-filter: blur(1px))) {
            .login-card{
                -webkit-backdrop-filter: blur(16px);
                backdrop-filter: blur(16px);
            }
        }

        .school-kicker{
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .logo-box{text-align:left;margin:0;}
        .logo-circle{
            width: 72px;
            height: 72px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            box-shadow: 0 8px 22px rgba(16,32,47,.16);
            border: 1px solid rgba(11,110,168,.16);
        }
        .logo-circle img{width: 52px; max-width: 52px; height: auto; display:block;}

        .school-title{margin:0;}
        .school-title h3{
            margin:0;
            color: #0c2c45;
            font-size: 30px;
            font-weight: 700;
            line-height: 1;
            letter-spacing: .4px;
        }
        .school-title small{
            display: block;
            margin-top: 6px;
            color: var(--muted);
            font-size: 14px;
        }

        .login-heading{
            margin-bottom: 22px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(96,114,133,.18);
        }

        .login-heading h1{
            margin: 0 0 8px;
            font-size: 24px;
            font-weight: 700;
            color: #122f47;
        }

        .login-heading p{
            margin: 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.5;
        }

        .greeting{
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
            padding: 12px 14px;
            border: 1px solid rgba(11,110,168,.14);
            border-radius: 10px;
            background: rgba(11,110,168,.06);
            color: #24465f;
            font-size: 13px;
        }
        #clock{font-weight:700;letter-spacing:.4px;color:#0b6ea8;}

        .form-group{position:relative;margin-bottom:16px;}
        .form-group i{position:absolute;top:14px;left:14px;color:#7d90a2;}

        .form-control{
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            color: var(--text);
            height: 46px;
            padding-left: 40px;
            border-radius: 8px;
        }
        .form-control::placeholder{color: #8293a5;}
        .form-control:focus{
            border-color: rgba(11,110,168,.62);
            box-shadow: 0 0 0 3px rgba(11,110,168,.14);
            background: #fff;
        }

        .select2-container{width:100%!important;}
        .select2-container--default .select2-selection--single{
            height: 46px;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 8px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered{
            color: var(--text);
            line-height: 44px;
            padding-left: 40px;
            padding-right: 34px;
        }
        .select2-container--default .select2-selection--single .select2-selection__placeholder{
            color: #8293a5;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow{
            height: 44px;
            right: 8px;
        }
        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--open .select2-selection--single{
            border-color: rgba(11,110,168,.62);
            box-shadow: 0 0 0 3px rgba(11,110,168,.14);
            background: #fff;
        }
        .select2-dropdown{
            border-color: var(--input-border);
            border-radius: 8px;
            overflow: hidden;
        }
        .select2-search--dropdown .select2-search__field{
            border: 1px solid var(--input-border);
            border-radius: 6px;
            outline: none;
        }

        .btn-login{
            height: 48px;
            border-radius: 8px;
            background: var(--accent);
            color: #fff;
            font-weight: 700;
            border: none;
            box-shadow: 0 12px 24px rgba(11,110,168,.22);
        }
        .btn-login:hover{background: var(--accent-hover);}

        .footer{
            text-align:center;
            font-size: 12px;
            margin-top: 18px;
            color: var(--muted);
        }

        .offline-note{
            position: fixed;
            left: 24px;
            bottom: 22px;
            z-index: 1;
            padding: 9px 12px;
            border-radius: 8px;
            background: rgba(255,255,255,.86);
            color: #26465d;
            font-size: 12px;
            box-shadow: 0 12px 30px rgba(5,22,36,.18);
        }

        @media (max-width: 768px){
            body{
                justify-content: center;
                padding: 24px 16px;
            }
            .offline-note{display:none;}
        }

        @media (max-width: 480px){
            .login-card{padding: 24px 20px 18px;}
            .logo-circle{width: 64px; height: 64px;}
            .logo-circle img{width: 46px; max-width: 46px;}
            .school-title h3{font-size: 26px;}
            .login-heading h1{font-size: 21px;}
            .greeting{align-items:flex-start;flex-direction:column;}
        }
    </style>
</head>
<body>

<div class="login-shell">
    <div class="login-card">
        <div class="school-kicker">
            <div class="logo-box">
                <div class="logo-circle">
                    <img
                        src="<?php echo base_url('assets/dist/img/tutwuri.png'); ?>"
                        alt="Logo Tut Wuri Handayani"
                        loading="eager"
                        decoding="async"
                        onerror="this.onerror=null;this.src='<?php echo base_url('assets/dist/img/tutwuri.jpg'); ?>';"
                    >
                </div>
            </div>

            <div class="school-title">
                <h3>SIAKAD</h3>
                <small>SDN Rantau Kanan 2</small>
            </div>
        </div>

        <div class="login-heading">
            <h1>Selamat Datang</h1>
            <p>Sistem Informasi Akademik Sekolah Dasar</p>
        </div>

        <?php
            $flashError = $this->session->flashdata('error');
            $flashSuccess = $this->session->flashdata('success');
            if ($flashError) { $this->session->unset_userdata('error'); }
            if ($flashSuccess) { $this->session->unset_userdata('success'); }
        ?>

        <div class="greeting">
            <div id="greet"></div>
            <div id="clock"></div>
        </div>

        <?php echo form_open('auth/check_login', 'id="form-login"'); ?>
            <div class="form-group">
                <i class="fa fa-user"></i>
                <select name="username" id="username" class="form-control username-select" required <?php echo empty($users) ? 'disabled' : ''; ?>>
                    <option value=""><?php echo empty($users) ? 'Tidak ada user tersedia' : 'Pilih username'; ?></option>
                    <?php foreach (($users ?? array()) as $user): ?>
                        <option value="<?php echo html_escape($user['username']); ?>">
                            <?php echo html_escape($user['username']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button type="submit" name="submit" class="btn btn-login btn-block">Masuk</button>
        </form>

        <div class="footer">
            &copy; <?php echo date('Y');?> Sistem Informasi Akademik Sekolah
        </div>
    </div>
</div>


<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bower_components/select2/dist/js/select2.full.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bower_components/select2/dist/js/i18n/id.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweetalert2/sweetalert2.min.js'); ?>"></script>
<script>
    var flashError = <?php echo json_encode($flashError ?: ''); ?>;
    var flashSuccess = <?php echo json_encode($flashSuccess ?: ''); ?>;
    var hasUsers = <?php echo empty($users) ? 'false' : 'true'; ?>;

    $('.username-select').select2({
        placeholder: hasUsers ? 'Pilih username' : 'Tidak ada user tersedia',
        allowClear: hasUsers,
        width: '100%',
        language: 'id'
    });

    $('#form-login').on('submit', function(e) {
        if (!$('#username').val()) {
            e.preventDefault();
            Swal.fire({
                title: 'Peringatan',
                text: hasUsers ? 'Username wajib dipilih.' : 'Tidak ada user tersedia.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        }
    });

    if (flashError || flashSuccess) {
        Swal.fire({
            title: flashError ? 'Gagal' : 'Berhasil',
            text: flashError || flashSuccess,
            icon: flashError ? 'error' : 'success',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: true,
            confirmButtonText: 'OK'
        });
    }

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
