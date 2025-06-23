@extends('layouts.frontend')

@section('styles')
<style>
    .question {
        font-size: 1.5rem;
        margin-bottom: 2rem;
        font-weight: 600;
        color: #343a40;
    }
    .radio-group {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: nowrap;
    }
    .radio-group label {
        position: relative;
        margin: 0 12px;
        cursor: pointer;
        font-size: 16px;
        color: #6c757d;
        font-weight: 500;
        display: flex;
        align-items: center;
    }
    .radio-group input[type="radio"] {
        display: none;
    }
    .radio-group label::before {
        content: '';
        display: inline-block;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid #6c757d;
        margin-right: 10px;
        transition: all 0.3s ease;
        vertical-align: middle;
        text-align: center;
        line-height: 36px;
        font-size: 20px;
        color: transparent;
    }
    .radio-group input[type="radio"]:nth-of-type(1) + label {
        color: #dc3545;
    }
    .radio-group input[type="radio"]:nth-of-type(1):checked + label::before {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
        content: '✔';
    }
    .radio-group input[type="radio"]:nth-of-type(2) + label {
        color: #fd7e14;
    }
    .radio-group input[type="radio"]:nth-of-type(2):checked + label::before {
        background-color: #fd7e14;
        border-color: #fd7e14;
        color: white;
        content: '✔';
    }
    .radio-group input[type="radio"]:nth-of-type(3) + label {
        color: #6c757d;
    }
    .radio-group input[type="radio"]:nth-of-type(3):checked + label::before {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
        content: '✔';
    }
    .radio-group input[type="radio"]:nth-of-type(4) + label {
        color: #0d6efd;
    }
    .radio-group input[type="radio"]:nth-of-type(4):checked + label::before {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
        content: '✔';
    }
    .radio-group input[type="radio"]:nth-of-type(5) + label {
        color: #28a745;
    }
    .radio-group input[type="radio"]:nth-of-type(5):checked + label::before {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
        content: '✔';
    }
    .radio-group input[type="radio"]:nth-of-type(1) + label::before,
    .radio-group input[type="radio"]:nth-of-type(5) + label::before {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }
    .radio-group input[type="radio"]:nth-of-type(2) + label::before,
    .radio-group input[type="radio"]:nth-of-type(3) + label::before,
    .radio-group input[type="radio"]:nth-of-type(4) + label::before {
        width: 40px;
        height: 40px;
        line-height: 40px;
    }
    .scale-right {
        font-size: 1.2rem;
        color: #28a745;
        font-weight: bold;
        margin-right: 20px;
    }
    .scale-left {
        font-size: 1.2rem;
        color: #dc3545;
        font-weight: bold;
        margin-left: 20px;
    }
    .step {
        display: none;
    }
    .step.active {
        display: block;
    }
    .step-buttons {
        text-align: center;
        margin-top: 50px;
    }
    .step-buttons .btn {
        margin: 0 10px;
    }
    .step-number-label {
        text-align: center;
        font-size: 1.25rem;
        font-weight: bold;
        color: #343a40;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('title', 'Pre-Test Magang - CDC Fakultas Psikologi UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Pre-Test Magang</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.mahasiswa-magangs.index') }}">My Applications</a></li>
                <li class="breadcrumb-item active">Pre-Test Magang</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Pre-Test Magang
                </div>

                <div class="card-body">
                    <form id="pretestForm" method="POST" action="{{ route('frontend.mahasiswa-magangs.store-test') }}">
                        @csrf
                        <input type="hidden" name="type" value="PRETEST">
                        <input type="hidden" name="magang_id" value="{{ $magang_id }}">

                        <div class="step active">
                            <div class="form-group">
                                <h5>Selamat Datang di Pre-Test Magang</h5>
                                <p>
                                    Pre-test ini dirancang untuk mengukur tingkat kesiapan dan kemampuan adaptasi Anda sebelum memulai program magang. Jawablah semua pertanyaan dengan jujur sesuai dengan kondisi Anda saat ini. Tidak ada jawaban benar atau salah.
                                </p>
                                <p>
                                    Instruksi: Pada setiap pernyataan, pilih skala 1-5 yang paling menggambarkan diri Anda, dengan:
                                </p>
                                <ul>
                                    <li><strong>1 - Tidak Pernah:</strong> Anda tidak pernah melakukan hal tersebut</li>
                                    <li><strong>2 - Pernah:</strong> Anda pernah melakukannya sesekali</li>
                                    <li><strong>3 - Jarang:</strong> Anda jarang melakukannya</li>
                                    <li><strong>4 - Sering:</strong> Anda sering melakukannya</li>
                                    <li><strong>5 - Selalu:</strong> Anda selalu melakukannya</li>
                                </ul>
                            </div>
                        </div>

                        <div class="step">
                            <div class="step-number-label">Bagian 1 dari 3</div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">1. Saya senang ketika bekerja dengan orang lain untuk menyelesaikan masalah.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_1_1" name="q_1" value="1" required>
                                    <label for="q_1_1"></label>

                                    <input type="radio" id="q_1_2" name="q_1" value="2">
                                    <label for="q_1_2"></label>

                                    <input type="radio" id="q_1_3" name="q_1" value="3">
                                    <label for="q_1_3"></label>

                                    <input type="radio" id="q_1_4" name="q_1" value="4">
                                    <label for="q_1_4"></label>

                                    <input type="radio" id="q_1_5" name="q_1" value="5">
                                    <label for="q_1_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">2. Saya tetap merasa nyaman dalam kondisi pekerjaan yang berubah.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_2_1" name="q_2" value="1" required>
                                    <label for="q_2_1"></label>

                                    <input type="radio" id="q_2_2" name="q_2" value="2">
                                    <label for="q_2_2"></label>

                                    <input type="radio" id="q_2_3" name="q_2" value="3">
                                    <label for="q_2_3"></label>

                                    <input type="radio" id="q_2_4" name="q_2" value="4">
                                    <label for="q_2_4"></label>

                                    <input type="radio" id="q_2_5" name="q_2" value="5">
                                    <label for="q_2_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">3. Saya mengingat informasi baru dengan mudah.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_3_1" name="q_3" value="1" required>
                                    <label for="q_3_1"></label>

                                    <input type="radio" id="q_3_2" name="q_3" value="2">
                                    <label for="q_3_2"></label>

                                    <input type="radio" id="q_3_3" name="q_3" value="3">
                                    <label for="q_3_3"></label>

                                    <input type="radio" id="q_3_4" name="q_3" value="4">
                                    <label for="q_3_4"></label>

                                    <input type="radio" id="q_3_5" name="q_3" value="5">
                                    <label for="q_3_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">4. Saya memberikan hasil yang baik dalam situasi yang berubah.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_4_1" name="q_4" value="1" required>
                                    <label for="q_4_1"></label>

                                    <input type="radio" id="q_4_2" name="q_4" value="2">
                                    <label for="q_4_2"></label>

                                    <input type="radio" id="q_4_3" name="q_4" value="3">
                                    <label for="q_4_3"></label>

                                    <input type="radio" id="q_4_4" name="q_4" value="4">
                                    <label for="q_4_4"></label>

                                    <input type="radio" id="q_4_5" name="q_4" value="5">
                                    <label for="q_4_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">5. Saya optimis dapat mempelajari informasi baru.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_5_1" name="q_5" value="1" required>
                                    <label for="q_5_1"></label>

                                    <input type="radio" id="q_5_2" name="q_5" value="2">
                                    <label for="q_5_2"></label>

                                    <input type="radio" id="q_5_3" name="q_5" value="3">
                                    <label for="q_5_3"></label>

                                    <input type="radio" id="q_5_4" name="q_5" value="4">
                                    <label for="q_5_4"></label>

                                    <input type="radio" id="q_5_5" name="q_5" value="5">
                                    <label for="q_5_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">6. Saya berpikir sangat logis ketika menyelesaikan berbagai masalah.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_6_1" name="q_6" value="1" required>
                                    <label for="q_6_1"></label>

                                    <input type="radio" id="q_6_2" name="q_6" value="2">
                                    <label for="q_6_2"></label>

                                    <input type="radio" id="q_6_3" name="q_6" value="3">
                                    <label for="q_6_3"></label>

                                    <input type="radio" id="q_6_4" name="q_6" value="4">
                                    <label for="q_6_4"></label>

                                    <input type="radio" id="q_6_5" name="q_6" value="5">
                                    <label for="q_6_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                        </div>

                        <div class="step">
                            <div class="step-number-label">Bagian 2 dari 3</div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">7. Saya menikmati perubahan suasana ketika melakukan berbagai pekerjaan.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_7_1" name="q_7" value="1" required>
                                    <label for="q_7_1"></label>

                                    <input type="radio" id="q_7_2" name="q_7" value="2">
                                    <label for="q_7_2"></label>

                                    <input type="radio" id="q_7_3" name="q_7" value="3">
                                    <label for="q_7_3"></label>

                                    <input type="radio" id="q_7_4" name="q_7" value="4">
                                    <label for="q_7_4"></label>

                                    <input type="radio" id="q_7_5" name="q_7" value="5">
                                    <label for="q_7_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">8. Saya memahami pendekatan yang terbaik untuk mempelajari sesuatu yang baru.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_8_1" name="q_8" value="1" required>
                                    <label for="q_8_1"></label>

                                    <input type="radio" id="q_8_2" name="q_8" value="2">
                                    <label for="q_8_2"></label>

                                    <input type="radio" id="q_8_3" name="q_8" value="3">
                                    <label for="q_8_3"></label>

                                    <input type="radio" id="q_8_4" name="q_8" value="4">
                                    <label for="q_8_4"></label>

                                    <input type="radio" id="q_8_5" name="q_8" value="5">
                                    <label for="q_8_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">9. Saya berusaha mencari feedback tentang keterampilan dan kemampuan yang dimiliki.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_9_1" name="q_9" value="1" required>
                                    <label for="q_9_1"></label>

                                    <input type="radio" id="q_9_2" name="q_9" value="2">
                                    <label for="q_9_2"></label>

                                    <input type="radio" id="q_9_3" name="q_9" value="3">
                                    <label for="q_9_3"></label>

                                    <input type="radio" id="q_9_4" name="q_9" value="4">
                                    <label for="q_9_4"></label>

                                    <input type="radio" id="q_9_5" name="q_9" value="5">
                                    <label for="q_9_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">10. Saya tidak langsung menerima informasi dari orang lain begitu saja.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_10_1" name="q_10" value="1" required>
                                    <label for="q_10_1"></label>

                                    <input type="radio" id="q_10_2" name="q_10" value="2">
                                    <label for="q_10_2"></label>

                                    <input type="radio" id="q_10_3" name="q_10" value="3">
                                    <label for="q_10_3"></label>

                                    <input type="radio" id="q_10_4" name="q_10" value="4">
                                    <label for="q_10_4"></label>

                                    <input type="radio" id="q_10_5" name="q_10" value="5">
                                    <label for="q_10_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">11. Saya merasa puas saat menggali lebih dalam tentang cara-cara untuk menyelesaikan masalah.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_11_1" name="q_11" value="1" required>
                                    <label for="q_11_1"></label>

                                    <input type="radio" id="q_11_2" name="q_11" value="2">
                                    <label for="q_11_2"></label>

                                    <input type="radio" id="q_11_3" name="q_11" value="3">
                                    <label for="q_11_3"></label>

                                    <input type="radio" id="q_11_4" name="q_11" value="4">
                                    <label for="q_11_4"></label>

                                    <input type="radio" id="q_11_5" name="q_11" value="5">
                                    <label for="q_11_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">12. Jika satu pendekatan pemecahan masalah itu gagal, saya mencoba cara yang lain.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_12_1" name="q_12" value="1" required>
                                    <label for="q_12_1"></label>

                                    <input type="radio" id="q_12_2" name="q_12" value="2">
                                    <label for="q_12_2"></label>

                                    <input type="radio" id="q_12_3" name="q_12" value="3">
                                    <label for="q_12_3"></label>

                                    <input type="radio" id="q_12_4" name="q_12" value="4">
                                    <label for="q_12_4"></label>

                                    <input type="radio" id="q_12_5" name="q_12" value="5">
                                    <label for="q_12_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                        </div>

                        <div class="step">
                            <div class="step-number-label">Bagian 3 dari 3</div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">13. Saya mencari orang baru, untuk belajar tentang topik di luar bidang pekerjaan saya.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_13_1" name="q_13" value="1" required>
                                    <label for="q_13_1"></label>

                                    <input type="radio" id="q_13_2" name="q_13" value="2">
                                    <label for="q_13_2"></label>

                                    <input type="radio" id="q_13_3" name="q_13" value="3">
                                    <label for="q_13_3"></label>

                                    <input type="radio" id="q_13_4" name="q_13" value="4">
                                    <label for="q_13_4"></label>

                                    <input type="radio" id="q_13_5" name="q_13" value="5">
                                    <label for="q_13_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">14. Saya dapat menemukan cara untuk menyelesaikan pekerjaan bahkan saat tidak diberikan arahan yang jelas.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_14_1" name="q_14" value="1" required>
                                    <label for="q_14_1"></label>

                                    <input type="radio" id="q_14_2" name="q_14" value="2">
                                    <label for="q_14_2"></label>

                                    <input type="radio" id="q_14_3" name="q_14" value="3">
                                    <label for="q_14_3"></label>

                                    <input type="radio" id="q_14_4" name="q_14" value="4">
                                    <label for="q_14_4"></label>

                                    <input type="radio" id="q_14_5" name="q_14" value="5">
                                    <label for="q_14_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">15. Saya berkenalan dengan banyak orang untuk mencari tahu cara menjadi seseorang yang lebih efektif dan efisien.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_15_1" name="q_15" value="1" required>
                                    <label for="q_15_1"></label>

                                    <input type="radio" id="q_15_2" name="q_15" value="2">
                                    <label for="q_15_2"></label>

                                    <input type="radio" id="q_15_3" name="q_15" value="3">
                                    <label for="q_15_3"></label>

                                    <input type="radio" id="q_15_4" name="q_15" value="4">
                                    <label for="q_15_4"></label>

                                    <input type="radio" id="q_15_5" name="q_15" value="5">
                                    <label for="q_15_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">16. Saya senang belajar dari orang lain.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_16_1" name="q_16" value="1" required>
                                    <label for="q_16_1"></label>

                                    <input type="radio" id="q_16_2" name="q_16" value="2">
                                    <label for="q_16_2"></label>

                                    <input type="radio" id="q_16_3" name="q_16" value="3">
                                    <label for="q_16_3"></label>

                                    <input type="radio" id="q_16_4" name="q_16" value="4">
                                    <label for="q_16_4"></label>

                                    <input type="radio" id="q_16_5" name="q_16" value="5">
                                    <label for="q_16_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">17. Saya mencari cara untuk menggunakan pengetahuan baru.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_17_1" name="q_17" value="1" required>
                                    <label for="q_17_1"></label>

                                    <input type="radio" id="q_17_2" name="q_17" value="2">
                                    <label for="q_17_2"></label>

                                    <input type="radio" id="q_17_3" name="q_17" value="3">
                                    <label for="q_17_3"></label>

                                    <input type="radio" id="q_17_4" name="q_17" value="4">
                                    <label for="q_17_4"></label>

                                    <input type="radio" id="q_17_5" name="q_17" value="5">
                                    <label for="q_17_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                            
                            <div class="card mb-4">
                                <p class="question text-center">18. Saya seringkali didatangi orang lain ketika mereka membutuhkan bantuan menyelesaikan masalah.</p>
                                <div class="radio-group">
                                    <span class="scale-left">Tidak Pernah</span>

                                    <input type="radio" id="q_18_1" name="q_18" value="1" required>
                                    <label for="q_18_1"></label>

                                    <input type="radio" id="q_18_2" name="q_18" value="2">
                                    <label for="q_18_2"></label>

                                    <input type="radio" id="q_18_3" name="q_18" value="3">
                                    <label for="q_18_3"></label>

                                    <input type="radio" id="q_18_4" name="q_18" value="4">
                                    <label for="q_18_4"></label>

                                    <input type="radio" id="q_18_5" name="q_18" value="5">
                                    <label for="q_18_5"></label>

                                    <span class="scale-right">Selalu</span>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="step-buttons text-center mt-5">
                            <button type="button" class="btn btn-secondary previous" onclick="nextPrev(-1)">
                                <i class="fas fa-arrow-left"></i> Sebelumnya
                            </button>
                            <button type="button" class="btn btn-primary next" onclick="nextPrev(1)">
                                Selanjutnya <i class="fas fa-arrow-right"></i>
                            </button>
                            <button type="submit" class="btn btn-success submit">Kirim <i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let currentStep = 0;
    showStep(currentStep);

    function showStep(step) {
        const steps = document.getElementsByClassName("step");
        const prevBtn = document.querySelector(".btn-secondary.previous");
        const nextBtn = document.querySelector(".btn-primary.next");
        const submitBtn = document.querySelector(".btn-success.submit");

        // Hide all steps and show the current step
        for (let i = 0; i < steps.length; i++) {
            steps[i].classList.remove("active");
        }
        steps[step].classList.add("active");

        // Update button visibility
        prevBtn.style.display = step === 0 ? "none" : "inline";
        nextBtn.style.display = step === steps.length - 1 ? "none" : "inline";
        submitBtn.style.display = step === steps.length - 1 ? "inline" : "none";
    }

    function nextPrev(n) {
        const steps = document.getElementsByClassName("step");
        const currentStepElem = Array.from(steps).find(step => step.classList.contains("active"));
        const currentStepIndex = Array.from(steps).indexOf(currentStepElem);

        // Validation for moving forward
        if (n === 1) {
            let allFieldsValid = true;
            let firstInvalidField = null;

            // Validate required radio groups
            const radioGroups = currentStepElem.querySelectorAll('.radio-group');
            radioGroups.forEach(group => {
                const groupName = group.querySelector('input[type="radio"]').name;
                const isAnswered = document.querySelector(`input[name="${groupName}"]:checked`);
                
                if (!isAnswered && currentStepIndex > 0) { // Skip validation for intro step
                    allFieldsValid = false;
                    if (!firstInvalidField) {
                        firstInvalidField = group;
                    }
                }
            });

            if (!allFieldsValid) {
                // Show error message
                Swal.fire({
                    icon: 'warning',
                    title: 'Mohon Lengkapi Semua Jawaban',
                    text: 'Silakan jawab semua pertanyaan sebelum melanjutkan ke bagian berikutnya.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Scroll to the first unanswered question
                    if (firstInvalidField) {
                        firstInvalidField.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                });
                return;
            }
        }

        // Handle navigation
        let nextStepIndex = currentStepIndex + n;
        if (nextStepIndex >= 0 && nextStepIndex < steps.length) {
            showStep(nextStepIndex);
        }

        // Scroll to the top of the page
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    // Add form submit handler
    document.getElementById('pretestForm').addEventListener('submit', function(e) {
        const steps = document.getElementsByClassName("step");
        const currentStep = Array.from(steps).findIndex(step => step.classList.contains("active"));
        
        // If not on the last step, prevent form submission
        if (currentStep < steps.length - 1) {
            e.preventDefault();
            nextPrev(1);
            return;
        }
        
        // Otherwise check if all questions are answered
        const lastStep = steps[steps.length - 1];
        const radioGroups = lastStep.querySelectorAll('.radio-group');
        let allAnswered = true;
        let firstUnanswered = null;
        
        radioGroups.forEach(group => {
            const groupName = group.querySelector('input[type="radio"]').name;
            const isAnswered = document.querySelector(`input[name="${groupName}"]:checked`);
            
            if (!isAnswered) {
                allAnswered = false;
                if (!firstUnanswered) {
                    firstUnanswered = group;
                }
            }
        });
        
        if (!allAnswered) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Mohon Lengkapi Semua Jawaban',
                text: 'Silakan jawab semua pertanyaan sebelum mengirimkan formulir.',
                confirmButtonText: 'OK'
            }).then(() => {
                if (firstUnanswered) {
                    firstUnanswered.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            });
        }
    });
</script>
@endsection 