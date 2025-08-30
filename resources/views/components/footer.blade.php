<footer class="bg-[#EA6A0A] text-white">
    <div class="max-w-[1440px] mx-auto px-6 lg:px-[50px] py-12 lg:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <img src="{{ asset('images/Logotipov2.svg') }}" alt="">
                </div>

                <p class="max-w-md leading-relaxed text-white/90">
                    Lorem ipsum lorem ipsums lorem Lorem ipsum lorem ipsums lorem Lorem ipsum lorem ipsums lorem
                </p>

                <div class="grid grid-cols-[auto_1fr] gap-x-6 gap-y-2 text-sm text-white/90">
                    <span class="opacity-80">End</span>  <span>Nonoonoonono<br>nononono<br>nononono</span>
                    <span class="opacity-80">Email</span><span>contato@clube.com</span>
                    <span class="opacity-80">Tel</span>  <span>(11) 99999-9999</span>
                </div>

                <ul class="flex items-center gap-3 pt-2">
                    @php $btn = 'w-10 h-10 grid place-items-center rounded-full bg-white/20 hover:bg-white/30 transition'; @endphp

                    <li><a class="{{ $btn }}" href="#" aria-label="X/Twitter"><img src="{{ asset('images/x.svg') }}" alt=""></a></li>
                    <li><a class="{{ $btn }}" href="#" aria-label="Instagram"><img src="{{ asset('images/x.svg') }}" alt=""></a></li>
                    <li><a class="{{ $btn }}" href="#" aria-label="Facebook"><img src="{{ asset('images/x.svg') }}" alt=""></a></li>
                    <li><a class="{{ $btn }}" href="#" aria-label="YouTube"><img src="{{ asset('images/x.svg') }}" alt=""></a></li>
                    <li><a class="{{ $btn }}" href="#" aria-label="TikTok"><img src="{{ asset('images/x.svg') }}" alt=""></a></li>
                </ul>
            </div>

            {{-- Coluna 2 – Links rápidos --}}
            <div class="lg:col-span-3 pt-4">
                <h4 class="text-2xl font-semibold mb-4">Links Rápidos</h4>
                <ul class="space-y-3 text-white/90">
                    <li><a class="hover:underline" href="#">O que é o Clube +</a></li>
                    <li><a class="hover:underline" href="#">Hotéis & Resorts</a></li>
                    <li><a class="hover:underline" href="#">Benefícios</a></li>
                    <li><a class="hover:underline" href="{{ route('beneficios') }}">Parceiros</a></li>
                    <li><a class="hover:underline" href="#">FAQs</a></li>
                    <li><a class="hover:underline" href="#">Contato</a></li>
                    <li><a class="hover:underline" href="#">Login e Cadastro</a></li>
                </ul>
            </div>

            {{-- Coluna 3 – Card de cadastro --}}
            <div class="lg:col-span-4">
                <div class="rounded-[16px] ring-1 ring-white/60 p-6 md:p-8">
                    <h4 class="text-2xl font-semibold">Cadastre-se Agora!</h4>
                    <p class="mt-2 text-sm text-white/90">
                        Optaquae perepedi dende officia cabore… texto de exemplo para o call-to-action.
                    </p>

                    <form class="mt-6 flex flex-col sm:flex-row gap-3">
                        <input type="email" placeholder="Seu email"
                               class="min-w-0 flex-1 h-11 bg-transparent border-0 border-b border-white/50
                               placeholder-white/70 focus:border-white focus:ring-0">
                        <button type="submit"
                                class="h-11 px-6 rounded-full border border-white text-white
                                hover:bg-white/10 transition">
                            Cadastre-se
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-10 pt-6 text-center font-light text-sm text-white">
            Clube + © {{ date('Y') }}. Todos os direitos reservados.
        </div>
    </div>
</footer>
