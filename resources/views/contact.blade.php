@extends('layouts.public')
@section('title', 'Kontak Kami')

@section('content')
<div class="bg-surface py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="font-display text-4xl font-bold text-primary-dark mb-4">Hubungi Kami</h1>
            <p class="text-body-lg text-on-surface-variant">Punya pertanyaan, kendala, atau sekadar ingin memberikan masukan? Jangan ragu untuk menghubungi tim dukungan kami.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <!-- Contact Info -->
            <div class="space-y-8">
                <div class="bg-surface-white p-8 rounded-[1.5rem] border border-outline shadow-sm">
                    <h3 class="font-display text-title-lg font-bold text-text-primary mb-6">Informasi Kontak</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-label-md font-semibold text-text-primary uppercase tracking-wider mb-1">Email</p>
                                <a href="mailto:halo@smartumkmbali.id" class="text-body-md text-primary hover:underline">halo@smartumkmbali.id</a>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-accent-teal/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-accent-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <p class="text-label-md font-semibold text-text-primary uppercase tracking-wider mb-1">Telepon / WhatsApp</p>
                                <p class="text-body-md text-on-surface-variant">+62 812 3456 7890</p>
                                <p class="text-body-sm text-on-surface-variant mt-1">(Senin - Jumat, 09.00 - 17.00 WITA)</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-secondary/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-label-md font-semibold text-text-primary uppercase tracking-wider mb-1">Alamat Kantor</p>
                                <p class="text-body-md text-on-surface-variant">Jl. Raya Puputan No. 123,<br>Renon, Denpasar Selatan,<br>Bali 80226</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-surface-white p-8 rounded-[1.5rem] border border-outline shadow-card">
                <h3 class="font-display text-title-lg font-bold text-text-primary mb-6">Kirim Pesan</h3>
                
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-label-md font-semibold text-text-primary mb-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="w-full rounded-heritage border-outline focus:border-primary focus:ring focus:ring-primary/20 text-body-sm" placeholder="Masukkan nama Anda" required>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-label-md font-semibold text-text-primary mb-1">Email</label>
                        <input type="email" name="email" id="email" class="w-full rounded-heritage border-outline focus:border-primary focus:ring focus:ring-primary/20 text-body-sm" placeholder="contoh@email.com" required>
                    </div>

                    <div>
                        <label for="subject" class="block text-label-md font-semibold text-text-primary mb-1">Subjek</label>
                        <select name="subject" id="subject" class="w-full rounded-heritage border-outline focus:border-primary focus:ring focus:ring-primary/20 text-body-sm" required>
                            <option value="">Pilih subjek...</option>
                            <option value="Tanya Fitur">Pertanyaan Seputar Fitur</option>
                            <option value="Kendala Teknis">Bantuan Teknis / Bug</option>
                            <option value="Kerjasama">Peluang Kerjasama</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-label-md font-semibold text-text-primary mb-1">Pesan</label>
                        <textarea name="message" id="message" rows="5" class="w-full rounded-heritage border-outline focus:border-primary focus:ring focus:ring-primary/20 text-body-sm" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                    </div>

                    <button type="submit" class="w-full justify-center px-6 py-3 bg-primary text-white font-semibold rounded-heritage hover:bg-primary-dark transition-colors shadow-sm">
                        Kirim Pesan Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
