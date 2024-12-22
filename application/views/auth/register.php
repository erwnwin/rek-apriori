<div id="loading-overlay" style="display: none;">
    <div id="loading-bar"></div>
</div>


<body class="hold-transition register-page">

    <div class="overlay" id="overlay" style="display: none;"></div>
    <div class="alert-box" id="alertBox" style="display: none;">
        <div class="alert-icon" id="alertIcon">
            <span class="checkmark" id="alertCheckmark">✓</span>
            <span class="error-icon" id="alertErrorIcon" style="display: none; color: white">✖</span>
        </div>
        <h2 id="alertTitle">Success</h2>
        <p id="alertMessage">We have successfully processed your request.</p>
        <button class="btnku" onclick="closeAlert()">Close</button>
    </div>

    <div class="register-container">
        <div class="svg-container-register">
            <lottie-player src="<?= base_url() ?>public/json/lottie-animation-register.json" background="transparent"
                speed="1" style="width: 300px; height: 300px" direction="1" mode="normal" loop
                autoplay></lottie-player>
        </div>

        <div class="register-form-container">

            <div class="register-form">
                <div class="mb-5">
                    <p class="lead">Register to Katalindo Medikarya Utama</p>
                </div>
                <form id="registerForm">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 14c2.5 0 4.5-2 4.5-4.5S14.5 5 12 5 7.5 7 7.5 9.5 9.5 14 12 14z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2 20c0-3.33 3.58-6 10-6s10 2.67 10 6" />
                                        </svg>

                                    </span>
                                </div>
                                <input type="text" id="first_name" name="first_name" class="form-control"
                                    placeholder="First Name">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                    </span>
                                </div>
                                <input type="text" id="last_name" name="last_name" class="form-control"
                                    placeholder="Last name">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 11c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-4.418 0-8 2.239-8 5v2h16v-2c0-2.761-3.582-5-8-5z" />
                                        </svg>
                                    </span>
                                </div>
                                <input type="text" id="username" name="username" class="form-control"
                                    placeholder="Type username">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2zm0 2l8 6 8-6" />
                                        </svg>
                                    </span>
                                </div>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Type email valid">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </span>
                                </div>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </span>
                                </div>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="Konfirmasi Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <!-- <label for="gender">Jenis Kelamin</label> -->
                            <select id=" jenis_kelamin" name="jenis_kelamin" class="form-control">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 2a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H6z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 0h12a2 2 0 012 2v0a2 2 0 01-2 2H6a2 2 0 01-2-2V2a2 2 0 012-2z" />
                                        </svg>

                                    </span>
                                </div>
                                <input type="number" id="phone" name="phone" class="form-control"
                                    placeholder="Nomor HP">
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 2C8.13 2 5 5.13 5 9c0 4.25 7 11 7 11s7-6.75 7-11c0-3.87-3.13-7-7-7z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </span>
                                </div>
                                <input type="text" id="address" name="address" class="form-control"
                                    placeholder="Alamat">
                            </div>
                        </div>
                    </div>
                    <div class="form-group remember-me-container">
                        <button type="submit" class="btn btn-primaryku btn-block" id="btnRegister">
                            <span id="btnLoader" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>
                            </span>
                            Register
                        </button>
                    </div>
                </form>
                <div class="links-container">
                    <a href="<?= base_url('login') ?>" class=" lupa-password">Sudah Punya Akun? Login sekarang!</a>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="<?= base_url('forgot-password') ?>" class="lupa-password">Lupa Password?</a>
                        <a href="<?= base_url('beranda') ?>" class="lupa-password">Beranda</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>