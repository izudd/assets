<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASSETS MANAGEMENT</title>
    @vite('resources/css/app.css')
    <style>
        /* Animasi fade + slide untuk teks */
        @keyframes fadeSlideIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeSlideIn {
            animation: fadeSlideIn 1s ease-out forwards;
        }

        /* Animasi gradient background */
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animated-bg {
            background: linear-gradient(-45deg, #a5b4fc, #93c5fd, #60a5fa, #3b82f6);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            position: relative;
            overflow: hidden;
        }

        /* Animasi icon bounce */
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-bounceIcon {
            animation: bounce 1s infinite;
        }

        /* Canvas partikel full screen */
        #particle-canvas {
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }
    </style>
</head>
<body class="animated-bg min-h-screen flex flex-col justify-center items-center font-sans text-white">

    <!-- Canvas Partikel -->
    <canvas id="particle-canvas"></canvas>

    <!-- Hero Section -->
    <div class="text-center space-y-6 relative z-10">
        <h1 class="text-5xl md:text-6xl font-extrabold drop-shadow-lg animate-fadeSlideIn">
            📦 ASSETS MANAGEMENT
        </h1>
        <p class="text-white/80 text-lg max-w-xl mx-auto animate-fadeSlideIn delay-200">
            Aplikasi manajemen aset berbasis web untuk memantau, mendokumentasikan, serta mempermudah mengelola data aset.
        </p>

        <!-- Tombol -->
        <div class="flex justify-center gap-4 mt-8 animate-fadeSlideIn delay-400">
            @auth
                <a href="{{ route('assets.index') }}" 
                   class="px-8 py-3 bg-blue-600 rounded-xl shadow-lg hover:bg-blue-700 hover:scale-105 transition transform flex items-center gap-2">
                   🚀 Masuk Dashboard <span class="animate-bounceIcon">✨</span>
                </a>
            @else
                <a href="{{ route('login') }}" 
                   class="px-8 py-3 bg-green-600 rounded-xl shadow-lg hover:bg-green-700 hover:scale-105 transition transform flex items-center gap-2">
                   🔑 Login <span class="animate-bounceIcon">➡️</span>
                </a>
                <a href="{{ route('register') }}" 
                   class="px-8 py-3 bg-white/20 text-white rounded-xl shadow-lg hover:bg-white/40 hover:scale-105 transition transform flex items-center gap-2">
                   📝 Register <span class="animate-bounceIcon">✨</span>
                </a>
            @endauth
        </div>
    </div>

    <!-- Footer -->
    <footer class="absolute bottom-4 text-sm text-white/70 z-10">
        &copy; {{ date('Y') }} ASSETS MANAGEMENT | Developed by BGZOO for KAP Budiandru & Rekan
    </footer>

    <!-- Script Partikel -->
    <script>
        const canvas = document.getElementById('particle-canvas');
        const ctx = canvas.getContext('2d');
        let particlesArray = [];

        function initCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }

        window.addEventListener('resize', () => {
            initCanvas();
        });

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
            particlesArray.forEach(p => {
                p.update();
                p.draw();
            });
            requestAnimationFrame(animate);
        }

        initCanvas();
        createParticles();
        animate();
    </script>

</body>
</html>
