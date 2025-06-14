<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../" />
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="SMART KORPRI NASIONAL" />
    <meta name="keywords" content="SMART KORPRI NASIONAL" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="SMART KORPRI NASIONAL" />

    <link rel="shortcut icon" href="favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!--begin::Fonts(mandatory for all pages)-->
    <style>
        body {
            background: url('/images/bg-3.svg') no-repeat center center;
            background-size: cover;
            max-height: 100vh;
            padding: 2rem;
        }

        .glass-box {
            /* background: rgba(255, 255, 255, 0.2); */
            background: white;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .text-black {
            color: #FFDB49;
        }

        .bg-yellow {
            background-color: #FFDB49;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center">
        <div class="row w-100">
            <div
                class="col-lg-6 d-none d-lg-flex flex-column align-items-top justify-content-start text-center text-white">
                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center mb-3 w-50 mt-4">
                    <div class="rounded bg-white shadow me-2 p-2 ">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/67/Coat_of_arms_of_South_Sulawesi.svg/1200px-Coat_of_arms_of_South_Sulawesi.svg.png"
                            alt="Logo 99" class="" style="width: 70px;">
                    </div>
                    <div class="text-white small d-none d-md-block">
                        <div>Pemerintah Provinsi</div>
                        <div class="fw-bold">Sulawesi Selatan</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex justify-content-center">
                <div class="glass-box p-4 p-md-5 rounded-4 shadow-lg w-100 mt-3" style="max-width: 600px;">
                    <!-- Logo section -->
                    <div class="container">
                        <div class="row justify-content-center px-5 mx-auto">
                            <!-- Logo 99 -->

                            <div class="col-6 col-md-3 d-flex align-items-center justify-content-end mb-3 w-50">
                                <img src="/images/logo-99.png" alt="Logo 99" class="rounded bg-white shadow me-2"
                                    style="width: 70px;">
                                <div class="text-black small d-none d-md-block">
                                    <div>Dewan Pengurus</div>
                                    <div class="fw-bold">Masjid Kubah 99</div>
                                </div>
                            </div>

                            <!-- BSrE -->
                            <div class="col-6 col-md-3 d-flex align-items-center justify-content-start mb-3 w-50">
                                <img src="/images/bsre.png" alt="BSrE" class="rounded bg-white shadow me-2 p-2"
                                    style="width: 70px;">
                                <div class="text-black small fw-bold d-none d-md-block">
                                    <div>Balai</div>
                                    <div>Sertifikat</div>
                                    <div>Elektronik</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Welcome text -->
                    <div class="text-center mb-4">
                        <h2 class="fw-semibold text-black">Selamat Datang</h2>
                        <h3 class="fw-bold text-black">Sistem Administrasi Elektronik</h3>
                        <p class="text-black fw-semibold">Dewan Pengurus Masjid Kubah 99</p>
                        <p class="text-secondary">Silahkan Masukkan Akun Anda</p>
                    </div>

                    <!-- Form -->
                    <!-- Form -->
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_forms" data-kt-redirect-url="/panel"
                        action="" method="post">
                        {{ csrf_field() }}
                        <!-- NIP/NIK -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="inputNIK" placeholder="NIP/NIK"
                                name="email">
                            <label for="email">Username</label>
                        </div>

                        <!-- Password -->
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" placeholder="Password"
                                name="password">
                            <label for="password">Password</label>
                        </div>
                        <div class="fv-row mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="butShow">
                                <label class="form-check-label" for="butShow">
                                    Lihat password
                                </label>
                            </div>
                        </div>
                        <!-- Captcha (dengan row) -->
                        <div class="row mb-5">
                            <div class="col-lg-6">
                                {{-- {!! Captcha::img('mini') !!} --}}
                            </div>
                            <div class="col-lg-6">
                                <input type="text" style="text-align: center; font-size: 25px; font-weight: bold;"
                                    autocomplete="off" class="form-control border-left-1 border-right-1 border-top-1"
                                    name="captcha" placeholder="captcha" required>
                            </div>
                        </div>

                        <!-- Tombol Masuk -->
                        <div class="d-grid mb-3 mt-5">
                            <button type="submit" class="btn bg-yellow text-white fw-bold py-2">Masuk</button>
                        </div>

                        <!-- Kembali -->
                        <div class="text-center">
                            <a href="#" class="text-black">Kembali Ke Halaman Utama</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $('#butShow').click(function() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        });
    </script>
</body>
<!--end::Body-->

</html>
