<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 animate-gradientBG relative overflow-hidden">
        
        <!-- Partikel ringan di background -->
        <canvas id="particle-canvas" class="absolute inset-0 w-full h-full pointer-events-none"></canvas>

        <!-- Card login -->
        <div class="relative z-10 bg-white/10 backdrop-blur-md rounded-2xl shadow-xl p-8 w-full max-w-md text-white">
            <h1 class="text-3xl font-extrabold text-center mb-6 drop-shadow-lg">📦 ASSETS MANAGEMENT</h1>
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <x-text-input id="email" class="block mt-1 w-full bg-white/20 placeholder-white/50 text-white border-white focus:border-blue-300 focus:ring focus:ring-blue-300 rounded-lg" 
                                  type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-300" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-white" />
                    <x-text-input id="password" class="block mt-1 w-full bg-white/20 placeholder-white/50 text-white border-white focus:border-blue-300 focus:ring focus:ring-blue-300 rounded-lg"
                                  type="password" name="password" required autocomplete="current-password" placeholder="********"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-300" />
                </div>

                <!-- Remember Me -->
                <div class="block mb-4">
                    <label for="remember_me" class="inline-flex items-center text-white/90">
                        <input id="remember_me" type="checkbox" class="rounded border-white text-blue-500 shadow-sm focus:ring-blue-300" name="remember">
                        <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-white/80 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300" 
                           href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ml-3 bg-blue-600 hover:bg-blue-700 transform hover:scale-105 transition">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Partikel -->
    <script>
        const canvas = document.getElementById('particle-canvas');
        const ctx = canvas.getContext('2d');
        let particlesArray = [];

        function initCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }

        window.addEventListener('resize', initCanvas);

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 3 + 1;
                this.speedX = (Math.random() - 0.5) * 0.5;
                this.speedY = (Math.random() - 0.5) * 0.5;
                this.color = 'rgba(255,255,255,' + (Math.random() * 0.5 + 0.3) + ')';
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                if(this.x < 0 || this.x > canvas.width) this.speedX *= -1;
                if(this.y < 0 || this.y > canvas.height) this.speedY *= -1;
            }
            draw() {
                ctx.fillStyle = this.color;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        function createParticles() {
            particlesArray = [];
            for(let i = 0; i < 100; i++) {
                particlesArray.push(new Particle());
            }
        }

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particlesArray.forEach(p => { p.update(); p.draw(); });
            requestAnimationFrame(animate);
        }

        initCanvas();
        createParticles();
        animate();
    </script>

    <!-- Gradient BG Animasi -->
    <style>
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradientBG {
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }
    </style>
</x-guest-layout>
