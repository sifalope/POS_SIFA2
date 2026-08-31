<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Saya & Aplikasi</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fdf2f8;
            color: #334155;
            padding: 40px 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(244, 114, 182, 0.08);
            border: 1px solid #fbcfe8;
        }
        .profile-section {
            text-align: center;
            border-bottom: 2px solid #fce7f3;
            padding-bottom: 25px;
            margin-bottom: 25px;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #f472b6;
            margin-bottom: 15px;
        }
        .profile-section h1 {
            color: #9d174d;
            margin-bottom: 5px;
        }
        .profile-section p {
            color: #be185d;
            font-size: 1.1em;
            font-weight: 600;
        }
        .section-title {
            color: #831843;
            margin-bottom: 15px;
            font-size: 1.3em;
            border-left: 4px solid #ec4899;
            padding-left: 10px;
        }
        .app-description {
            line-height: 1.7;
            margin-bottom: 30px;
            color: #475569;
        }
        .tech-stack {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }
        .tech-item {
            background-color: #fce7f3;
            color: #be185d;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9em;
            border: 1px solid #fbcfe8;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .details-table td {
            padding: 10px 0;
            border-bottom: 1px solid #fce7f3;
        }
        .details-table td:first-child {
            font-weight: bold;
            width: 35%;
            color: #831843;
        }
        .details-table a {
            color: #be185d;
            text-decoration: none;
            font-weight: 600;
        }
        .details-table a:hover {
            text-decoration: underline;
        }
        .btn-wrapper {
            text-align: center;
            margin-top: 20px;
        }
        .btn-back {
            display: inline-block;
            padding: 11px 24px;
            background: linear-gradient(135deg, #f472b6, #ec4899);
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(244, 114, 182, 0.35);
            transition: all 0.25s ease;
        }
        .btn-back:hover {
            background: linear-gradient(135deg, #ec4899, #be185d);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Profile / Data Diri -->
        <div class="profile-section">
            <img src="{{ asset('images/sv.jpg') }}" alt="Foto Profil" class="profile-img">
            <h1>Sifa Agustina</h1>
            <p>Pengembang Aplikasi / Software Engineer</p>
        </div>

        <!-- Tentang Aplikasi -->
        <h2 class="section-title">Tentang Aplikasi</h2>
        <p class="app-description">
            Aplikasi ini dirancang khusus sebagai sistem Point of Sale (POS) dan manajemen stok produk.
            Sistem ini mempermudah pencatatan produk, pengelolaan kategori/jenis barang, pemantauan stok real-time, serta perhitungan harga beli dan harga jual secara efisien.
        </p>

        <!-- Spesifikasi Teknologi -->
        <h2 class="section-title">Teknologi yang Digunakan</h2>
        <div class="tech-stack">
            <div class="tech-item">PHP</div>
            <div class="tech-item">Laravel</div>
            <div class="tech-item">HTML5 & CSS</div>
            <div class="tech-item">MySQL</div>
            <div class="tech-item">JavaScript</div>
        </div>

        <!-- Detail Informasi Tambahan -->
        <h2 class="section-title">Informasi Pengembang</h2>
        <table class="details-table">
            <tr>
                <td>Kelas</td>
                <td>XII RPL 1</td>
            </tr>
            <tr>
                <td>Proyek</td>
                <td>Sistem Kasir & Manajemen Stok Produk</td>
            </tr>
            <tr>
                <td>Email</td>
                <td><a href="mailto:sifaagustina17082009@gmail.com">sifaagustina17082009@gmail.com</a></td>
            </tr>
            <tr>
                <td>WhatsApp</td>
                <td><a href="https://wa.me/6281234567890" target="_blank">+62 812-3456-7890</a></td>
            </tr>
            <tr>
                <td>Framework</td>
                <td>Laravel</td>
            </tr>
            <tr>
                <td>Bahasa Pemrograman</td>
                <td>PHP</td>
            </tr>
        </table>

        <!-- Tombol Kembali -->
        <div class="btn-wrapper">
            <a href="{{ route('produk.index') }}" class="btn-back">← Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>