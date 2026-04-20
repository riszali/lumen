@extends('layouts.app')

@section('title', 'Shop | LUMEN')

@section('content')
<!-- Hero Section (Sync with Home Discover Design) -->
<section class="relative w-full min-h-[90vh] flex items-center justify-center overflow-hidden bg-[#252322]">
    <!-- WebGL Glow Background -->
    <canvas id="glcanvas" class="absolute inset-0 w-full h-full opacity-60"></canvas>
    
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-[#252322] via-transparent to-[#252322] z-10 pointer-events-none"></div>

    <!-- Efek Glow Lantai (Floor Reflection) -->
    <div class="absolute bottom-[30%] left-1/2 -translate-x-1/2 w-[80%] max-w-4xl h-24 bg-brand-sage/30 mix-blend-screen filter blur-[70px] rounded-full pointer-events-none z-10"></div>

    <div class="relative z-20 w-full max-w-7xl mx-auto px-4 flex flex-col items-center pt-24 pb-12">

        <!-- Photo Collage (Rata Horizontal) -->
        <div class="flex flex-nowrap justify-center items-center -space-x-3 sm:space-x-0 sm:gap-6 lg:gap-8 w-full mb-4 lg:mb-12 px-2 sm:px-0">
            
            <!-- Pic 1 -->
            <div class="relative z-0 transform hover:-translate-y-2 transition-transform duration-500 w-[18%] sm:w-28 lg:w-40">
                <div class="final-img w-full aspect-square rounded-lg sm:rounded-2xl overflow-hidden shadow-2xl border border-white/10">
                    <img src="{{ asset('assets/images/vs-1.jpg') }}" class="w-full h-full object-cover">
                </div>
            </div>
            
            <!-- Pic 2 -->
            <div class="relative z-10 transform hover:-translate-y-2 transition-transform duration-500 w-[26%] sm:w-36 lg:w-52">
                <div class="final-img w-full aspect-[4/5] rounded-lg sm:rounded-2xl overflow-hidden shadow-2xl border border-white/10">
                    <img src="{{ asset('assets/images/an-1.jpg') }}" class="w-full h-full object-cover">
                </div>
            </div>
            
            <!-- Pic 3 (Center Anchor - Paling Tinggi) -->
            <div class="relative z-20 transform hover:-translate-y-2 transition-transform duration-500 w-[38%] sm:w-48 lg:w-64">
                <div class="final-img w-full aspect-[3/4] rounded-lg sm:rounded-2xl overflow-hidden shadow-[0_30px_60px_rgba(0,0,0,0.8)] border border-brand-sage/40">
                    <img src="{{ asset('assets/images/fc-1.jpg') }}" class="w-full h-full object-cover">
                </div>
            </div>
            
            <!-- Pic 4 -->
            <div class="relative z-10 transform hover:-translate-y-2 transition-transform duration-500 w-[26%] sm:w-36 lg:w-52">
                <div class="final-img w-full aspect-[4/5] rounded-lg sm:rounded-2xl overflow-hidden shadow-2xl border border-white/10">
                    <img src="{{ asset('assets/images/Pic-33.jpg') }}" class="w-full h-full object-cover">
                </div>
            </div>
            
            <!-- Pic 5 -->
            <div class="relative z-0 transform hover:-translate-y-2 transition-transform duration-500 w-[18%] sm:w-28 lg:w-40">
                <div class="final-img w-full aspect-square rounded-lg sm:rounded-2xl overflow-hidden shadow-2xl border border-white/10">
                    <img src="{{ asset('assets/images/lv-1.jpg') }}" class="w-full h-full object-cover">
                </div>
            </div>

        </div>
        
        <!-- Header Text -->
        <div class="text-center mt-0 z-20 relative">
            <h1 class="font-serif text-4xl sm:text-6xl text-[#EDE7D4] mb-4 drop-shadow-2xl">The Archetype Collection</h1>
            <p class="text-[#EDE7D4]/80 font-light tracking-wide text-sm sm:text-base max-w-2xl mx-auto px-4">Explore our carefully curated selection of exquisite designs.</p>
        </div>
        
    </div>
</section>

<!-- Shop Content Section -->
<section class="relative w-full bg-[#252322] py-12 lg:py-24 z-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Toolbar (Filter & Sort) -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 mb-12 bg-white/[0.02] backdrop-blur-md border border-white/5 rounded-2xl p-4 sm:p-6 shadow-lg">
            <!-- Categories -->
            <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-4 w-full md:w-auto">
                <a href="{{ route('shop.index') }}" class="px-4 py-2 rounded-full text-[10px] sm:text-xs font-bold uppercase tracking-widest transition {{ !request('category') ? 'bg-brand-sage text-brand-dark' : 'text-brand-gray hover:text-brand-cream border border-white/10 hover:border-white/30' }}">
                    All
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="px-4 py-2 rounded-full text-[10px] sm:text-xs font-bold uppercase tracking-widest transition {{ request('category') == $category->slug ? 'bg-brand-sage text-brand-dark' : 'text-brand-gray hover:text-brand-cream border border-white/10 hover:border-white/30' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            <!-- Sort -->
            <div class="w-full md:w-auto flex justify-center md:justify-end">
                <form action="{{ route('shop.index') }}" method="GET" class="flex items-center gap-3">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <label for="sort" class="text-xs text-brand-gray uppercase tracking-widest hidden sm:block">Sort by:</label>
                    <div class="relative">
                        <select name="sort" id="sort" onchange="this.form.submit()" class="bg-black/30 border border-white/10 text-brand-cream text-[10px] sm:text-xs rounded-xl focus:ring-brand-sage focus:border-brand-sage block w-full py-2.5 pl-4 pr-10 appearance-none [&>option]:bg-brand-dark [&>option]:text-brand-cream cursor-pointer">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-brand-gray">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Product Grid (Diubah jadi 2 kolom di Mobile) -->
        @if($products->count() > 0)
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 lg:gap-8">
                @foreach($products as $product)
                <!-- Padding dan border radius dibuat responsif agar proporsional di HP -->
                <div class="group cursor-pointer bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1rem] sm:rounded-[2rem] p-3 sm:p-4 shadow-[0_8px_32px_rgba(0,0,0,0.3)] hover:bg-white/[0.08] hover:-translate-y-2 transition-all duration-500 flex flex-col">
                    
                    <a href="{{ route('shop.show', $product->slug) }}" class="block relative overflow-hidden mb-3 sm:mb-6 aspect-[4/5] rounded-[0.75rem] sm:rounded-[1.5rem] shadow-inner border border-white/5">
                        @if($product->primaryImage)
                            <img src="{{ Storage::url($product->primaryImage->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover object-center group-hover:scale-110 transition duration-700">
                        @else
                            <div class="w-full h-full bg-black/40 flex items-center justify-center text-white/30 text-[8px] sm:text-[10px] uppercase tracking-widest">No Image</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        @if($product->is_featured)
                            <div class="absolute top-2 right-2 sm:top-4 sm:right-4">
                                <span class="bg-brand-sage text-brand-dark text-[8px] sm:text-[10px] font-bold uppercase tracking-widest px-2 py-1 rounded-sm shadow-md">Featured</span>
                            </div>
                        @endif
                    </a>
                    
                    <div class="text-center px-1 sm:px-2 pb-1 sm:pb-2 flex-grow flex flex-col justify-end">
                        <!-- Teks nama dikecilkan sedikit di HP -->
                        <h4 class="text-brand-cream font-serif text-xs sm:text-lg tracking-wide mb-1 sm:mb-2 transition group-hover:text-brand-sage line-clamp-2">
                            <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                        </h4>
                        <!-- Teks harga dikecilkan sedikit di HP -->
                        <p class="text-brand-sage text-[10px] sm:text-sm font-semibold tracking-wider">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="mt-16 flex justify-center glass-pagination">
                {{ $products->links() }}
            </div>
            @endif

        @else
            <!-- State jika tidak ada produk -->
            <div class="text-center py-20 bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.3)] max-w-2xl mx-auto">
                <svg class="w-16 h-16 mx-auto mb-6 text-brand-gray opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <p class="text-brand-cream font-medium tracking-wide mb-2 uppercase text-sm">No Products Found</p>
                <p class="text-brand-gray text-xs font-light mb-8">Try adjusting your filters or check back later for new arrivals.</p>
                <a href="{{ route('shop.index') }}" class="inline-block border border-white/20 text-brand-cream px-8 py-3 rounded-full uppercase tracking-widest text-[10px] font-bold hover:bg-white/10 transition duration-300">
                    Clear Filters
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Menambahkan CSS inline untuk styling paginasi default Laravel jika digunakan -->
<style>
    .glass-pagination nav p { color: #AAAB9A; display: none; }
    .glass-pagination nav > div:first-child { display: none; }
    .glass-pagination nav span, .glass-pagination nav a {
        background-color: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.1);
        color: #EDE7D4;
        font-weight: 600;
        font-size: 0.875rem;
    }
    .glass-pagination nav a:hover { background-color: rgba(255, 255, 255, 0.15); border-radius: 9999px; }
    .glass-pagination nav span[aria-current="page"] span {
        background-color: rgba(170, 171, 154, 0.3) !important;
        border-color: rgba(170, 171, 154, 0.5) !important;
        color: #EDE7D4 !important;
        border-radius: 9999px;
    }
</style>

<script>
    // WebGL Script untuk latar belakang halaman Shop
    function initGLSLBackground() {
        const canvas = document.getElementById("glcanvas");
        if (!canvas) return;
        const gl = canvas.getContext("webgl");
        if (!gl) return;

        function resize() {
            const d = window.devicePixelRatio || 1;
            const parent = canvas.parentElement;
            canvas.width = parent.clientWidth * d;
            canvas.height = parent.clientHeight * d;
            gl.viewport(0, 0, canvas.width, canvas.height);
        }
        resize();
        window.addEventListener("resize", resize);

        const vert = `
            attribute vec2 pos;
            void main() {
                gl_Position = vec4(pos, 0.0, 1.0);
            }
        `;

        const frag = `
            precision highp float;
            uniform vec2 u_res;
            uniform float u_time;
            uniform float u_speed;

            void main() {
                vec2 FC = gl_FragCoord.xy;
                float t = u_time * u_speed;
                vec2 r = u_res;
                vec2 p = (FC * 2.0 - r) / r.y;
                vec3 c = vec3(0.0);

                for (float i = 0.0; i < 42.0; i++) {
                    float a = i / 1.5 + t * 0.5;
                    vec2 q = p;
                    q.x = q.x + sin(q.y * 19.0 + t * 2.0 + i) * 29.0 * smoothstep(0.0, -2.0, q.y);
                    float d = length(q - vec2(cos(a), sin(a)) * (0.4 * smoothstep(0.0, 0.5, -q.y)));
                    c = c + vec3(0.34, 0.30, 0.24) * (0.015 / d);
                }

                vec3 col = c * c + 0.05;
                float vignette = smoothstep(2.5, 0.2, length(p));
                gl_FragColor = vec4(col * vignette, 1.0);
            }
        `;

        function compile(src, type) {
            const s = gl.createShader(type);
            gl.shaderSource(s, src);
            gl.compileShader(s);
            return s;
        }

        function link(vs, fs) {
            const p = gl.createProgram();
            gl.attachShader(p, vs);
            gl.attachShader(p, fs);
            gl.bindAttribLocation(p, 0, "pos");
            gl.linkProgram(p);
            return p;
        }

        const program = link(compile(vert, gl.VERTEX_SHADER), compile(frag, gl.FRAGMENT_SHADER));
        gl.useProgram(program);

        const buf = gl.createBuffer();
        gl.bindBuffer(gl.ARRAY_BUFFER, buf);
        gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1,-1, 3,-1, -1,3]), gl.STATIC_DRAW);
        gl.enableVertexAttribArray(0);
        gl.vertexAttribPointer(0, 2, gl.FLOAT, false, 0, 0);

        const u_res   = gl.getUniformLocation(program, "u_res");
        const u_time  = gl.getUniformLocation(program, "u_time");
        const u_speed = gl.getUniformLocation(program, "u_speed");

        let start = performance.now();

        function draw() {
            const now = performance.now();
            const t = (now - start) * 0.001;

            gl.uniform2f(u_res, canvas.width, canvas.height);
            gl.uniform1f(u_time, t);
            gl.uniform1f(u_speed, 1.0);

            gl.drawArrays(gl.TRIANGLES, 0, 3);
            requestAnimationFrame(draw);
        }
        draw();
    }
    window.addEventListener("load", initGLSLBackground);
</script>
@endsection