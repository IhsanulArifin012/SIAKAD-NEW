<style>
    .error-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 70vh;
        padding: 20px;
    }

    .error-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        padding: 50px;
        max-width: 600px;
        width: 100%;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .error-icon-wrapper {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #ff6b6b, #ee5253);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        box-shadow: 0 10px 20px rgba(238, 82, 83, 0.3);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); box-shadow: 0 10px 20px rgba(238, 82, 83, 0.3); }
        50% { transform: scale(1.05); box-shadow: 0 15px 30px rgba(238, 82, 83, 0.4); }
        100% { transform: scale(1); box-shadow: 0 10px 20px rgba(238, 82, 83, 0.3); }
    }

    .error-icon-wrapper i {
        font-size: 50px;
        color: white;
    }

    .error-card h2 {
        color: #2d3436;
        font-weight: 800;
        font-size: 32px;
        margin-bottom: 15px;
        letter-spacing: -0.5px;
    }

    .error-card p {
        color: #636e72;
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 35px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, #0b2f4a, #124a70);
        color: white !important;
        padding: 14px 32px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 8px 15px rgba(11, 47, 74, 0.2);
    }

    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 20px rgba(11, 47, 74, 0.3);
        opacity: 0.9;
    }

    .restricted-tag {
        display: inline-block;
        padding: 6px 16px;
        background: #ffeaa7;
        color: #d6a317;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }
</style>

<div class="error-container">
    <div class="error-card">
        <div class="restricted-tag">Akses Terbatas</div>
        <div class="error-icon-wrapper">
            <i class="fa fa-lock"></i>
        </div>
        <h2>Ups! Akses Ditolak</h2>
        <p>Maaf, Anda tidak memiliki izin untuk mengakses modul ini. Halaman ini hanya tersedia untuk tingkat pengguna tertentu dalam sistem akademik.</p>
        <a href="<?php echo site_url('tampilan_utama'); ?>" class="btn-back">
            <i class="fa fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
</div>
