@extends('layouts.app')

@section('title', 'Kontak dan Saran')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-4 text-primary">Kontak dan Saran</h1>
        <p class="lead">
            Kami sangat menghargai masukan Anda untuk meningkatkan aplikasi ini. Kirimkan saran, kritik, atau pertanyaan Anda kepada kami!
        </p>
    </div>

    <div class="row align-items-center">
        <!-- Hubungi Kami -->
        <div class="col-md-6 mb-4">
            <div class="bg-light p-4 rounded shadow-sm">
                <h4 class="text-primary mb-3">Hubungi Kami</h4>
                <p>
                    <i class="bi bi-envelope-fill text-primary"></i>
                    <strong>Email:</strong> 
                    <a href="mailto:brasaescoklat@gmail.com">brasaescoklat@gmail.com</a>
                </p>
                <p>
                    <i class="bi bi-whatsapp text-success"></i>
                    <strong>WhatsApp:</strong> 
                    <a href="https://wa.me/6281234567890">+62 85606813000</a>
                </p>
            </div>
        </div>
        
       
        <!-- Form Kirim Saran -->
        <div class="col-md-6">
            <div class="bg-light p-4 rounded shadow-sm">
                <h4 class="text-primary mb-3">Kirim Saran</h4>
                <form id="contactForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama" required>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Nomor Telepon" required>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" required>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <textarea name="message" id="message" class="form-control" rows="5" placeholder="Tulis pesan Anda..." required></textarea>
                        </div>
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Kirim Pesan <i class="bi bi-send-fill"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            var alamat = document.getElementById('alamat').value;
            var message = document.getElementById('message').value;

            var whatsappMessage = 
                `Nama: ${name}%0AEmail: ${email}%0ANo Telp: ${phone}%0AAlamat: ${alamat}%0APesan: ${message}`;
            var whatsappURL = `https://wa.me/+6285606813000?text=${whatsappMessage}`;

            window.open(whatsappURL, '_blank');
        });
    </script>
@endsection

