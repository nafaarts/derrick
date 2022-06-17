<footer>
    <div class="derrick-container">
        <hr class="border-TERTIARY mx-10 mb-5">
        <div class="flex flex-col md:flex-row gap-10 my-10 md:my-20 text-center md:text-left text-DARKER">
            <div class="w-full md:w-1/4 flex justify-center">
                <img src="{{ asset('logo.png') }}" class="h-32" alt="Logo Derrick">
            </div>
            <div class="w-full md:w-1/4">
                <h4 class="text-2xl mb-4 font-bold text-HEADINGTEXT">Address</h4>
                <strong>PEM AKAMIGAS</strong>
                <p>Jl. Gajah Mada No.38, Mentul, Karangboyo, Kec. Cepu, Kabupaten Blora, Jawa Tengah 58315</p>
            </div>
            <div class="w-full md:w-1/4">
                <h4 class="text-2xl mb-4 font-bold text-HEADINGTEXT">Contact</h4>
                <p>
                    {{-- <i class="fas fa-fw fa-envelope mr-2"></i> --}}
                    <a href="mailto:derrickeksplorasiproduksi@gmail.com">derrickeksplorasiproduksi@gmail.com</a>
                </p>
            </div>
            <div class="w-full md:w-1/4">
                <h4 class="text-2xl mb-4 font-bold text-HEADINGTEXT">Follow Us</h4>
                <div class="sosmed flex w-fit mx-auto md:mx-0">
                    <a href="https://www.instagram.com/derrick2k22/" target="_blank">
                        <i class="text-2xl fab fa-fw fa-instagram-square"></i>
                    </a>
                    <a href="https://line.me/ti/p/@mng1518e" target="_blank" class="ml-4">
                        <i class="text-2xl fab fa-fw fa-line"></i>
                    </a>
                    <a href="https://www.linkedin.com/company/derrick-akamigas" target="_blank" class="ml-4">
                        <i class="text-2xl fab fa-fw fa-linkedin"></i>
                    </a>
                    <a href="mailto:derrickeksplorasiproduksi@gmail.com" target="_blank" class="ml-4">
                        <i class="text-2xl fas fa-fw fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-TERTIARY py-5 text-center">
        <small>Copyright &copy; Derrick {{ date('Y') }}</small>
    </div>
</footer>
