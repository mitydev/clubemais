<?php

return [

    'sections' => [

        'hero_slider' => [
            'label'   => 'Hero / Slider',
            'desc'    => 'Slider de destaque; alimentado por um Grupo de Banners.',
            'expects' => [ 'banners' => true ],
            'fields'  => [
                'height'       => 'Altura (px ou CSS – ex: "90vh")',
                'autoplay'     => 'bool (auto-rotação?)',
                'delay_ms'     => 'número (intervalo entre slides em ms)',
                'overlay'      => 'string (ex: "rgba(0,0,0,.25)")',
                'caption_show' => 'bool (exibir legenda textual por slide?)',
            ],
            'rules' => [
                'height'       => ['nullable','string','max:50'],
                'autoplay'     => ['nullable','boolean'],
                'delay_ms'     => ['nullable','integer','min:0','max:120000'],
                'overlay'      => ['nullable','string','max:50'],
                'caption_show' => ['nullable','boolean'],
            ],
            'defaults' => [
                'height'       => '90vh',
                'autoplay'     => true,
                'delay_ms'     => 5000,
                'overlay'      => 'rgba(0,0,0,.25)',
                'caption_show' => false,
            ],
        ],

        'oque_e' => [
            'label'   => 'O que é o Clube +',
            'desc'    => 'Bloco com imagem de fundo, título e descrição.',
            'fields'  => [
                'bg_image'     => 'URL da imagem de fundo (relativo a /public)',
                'card_image'   => 'URL da imagem do “quadro” (shape)',
                'title'        => 'Título (HTML permitido)',
                'text'         => 'Descrição em HTML/Texto',
                'link_text'    => 'Texto do link (opcional)',
                'link_url'     => 'URL do link (opcional)',
                'kicker_title' => 'Título abaixo (kicker)',
                'kicker_text'  => 'Chamada secundária (kicker)',
            ],
            'rules' => [
                'bg_image'     => ['nullable','string','max:255'],
                'card_image'   => ['nullable','string','max:255'],
                'title'        => ['nullable','string','max:500'],
                'text'         => ['nullable','string'],
                'link_text'    => ['nullable','string','max:100'],
                'link_url'     => ['nullable','string','max:255'],
                'kicker_title' => ['nullable','string','max:255'],
                'kicker_text'  => ['nullable','string','max:255'],
            ],
            'defaults' => [
                'bg_image'     => 'images/oque-e-1920.png',
                'card_image'   => 'images/oque-e.png',
                'title'        => 'O que é o <br> Clube +',
                'text'         => 'Descontos exclusivos, experiências únicas e benefícios especiais em hospedagens e roteiros.',
                'link_text'    => 'Viaje mais, aproveite melhor',
                'link_url'     => '#',
                'kicker_title' => 'Sua próxima viagem começa com vantagens!',
                'kicker_text'  => '',
            ],
        ],

        'destinations' => [
            'label'   => 'Destinos',
            'desc'    => 'Cards de destino; alimentado por um Grupo de Destinos.',
            'expects' => [ 'destinations' => true ],
            'fields'  => [
                'title'       => 'Título da sessão',
                'layout'      => 'string ("cards-4", "carousel" etc.)',
                'button_text' => 'Texto do CTA do card (ex.: "Veja o Hotel")',
            ],
            'rules' => [
                'title'       => ['nullable','string','max:255'],
                'layout'      => ['nullable','in:cards-4,carousel'],
                'button_text' => ['nullable','string','max:60'],
            ],
            'defaults' => [
                'title'       => 'Seu próximo destino com desconto',
                'layout'      => 'cards-4',
                'button_text' => 'Veja o Hotel',
            ],
        ],

        'advantages' => [
            'label'   => 'Vantagens / Assinaturas',
            'desc'    => 'Bloco amarelo com 3–4 cartões de benefício + badges + CTA.',
            'fields'  => [
                'title'    => 'Título da sessão',
                'cta_text' => 'Texto do botão principal',
                'cta_url'  => 'URL do botão',
                'items'    => 'array de cartões [{icon, title}]',
                'badges'   => 'array de imagens (URLs)',
            ],
            'rules' => [
                'title'            => ['nullable','string','max:255'],
                'cta_text'         => ['nullable','string','max:60'],
                'cta_url'          => ['nullable','string','max:255'],
                'items'            => ['nullable','array','max:8'],
                'items.*.icon'     => ['nullable','string','max:255'],
                'items.*.title'    => ['nullable','string','max:120'],
                'badges'           => ['nullable','array','max:12'],
                'badges.*'         => ['nullable','string','max:255'],
            ],
            'defaults' => [
                'title'    => 'Conheça as vantagens e assinaturas do Clube+',
                'cta_text' => 'ASSINE JÁ',
                'cta_url'  => '#',
                'items'    => [
                    ['icon' => 'images/cash.svg', 'title' => 'Desconto em passagens'],
                    ['icon' => 'images/cash.svg', 'title' => 'Descontos em mais de 80 hotéis'],
                    ['icon' => 'images/cash.svg', 'title' => 'Descontos em mais de 50 lojas'],
                ],
                'badges'   => [
                    'images/badge/moneybadge.svg',
                    'images/badge/holidaybadge.svg',
                    'images/badge/gymbadge.svg',
                    'images/badge/plusbadge.svg',
                    'images/badge/busbadge.svg',
                    'images/badge/beautybadge.svg',
                    'images/badge/dogbadge.svg',
                    'images/badge/pluswhitebadge.svg',
                ],
            ],
        ],

        'partners' => [
            'label'   => 'Parceiros',
            'desc'    => 'Grid de logos; pode vir de conteúdo estático ou de um grupo de banners.',
            'expects' => [ 'banners' => false ],
            'fields'  => [
                'title'   => 'Título (opcional)',
                'logos'   => 'array de imagens (URLs)',
                'cols'    => 'número de colunas',
                'link_to' => 'URL global (opcional)',
            ],
            'rules' => [
                'title'   => ['nullable','string','max:255'],
                'logos'   => ['nullable','array','max:24'],
                'logos.*' => ['nullable','string','max:255'],
                'cols'    => ['nullable','integer','min:2','max:12'],
                'link_to' => ['nullable','string','max:255'],
            ],
            'defaults' => [
                'title' => 'Nossos parceiros',
                'cols'  => 6,
                'logos' => [],
            ],
        ],

        'faq' => [
            'label'  => 'FAQ',
            'desc'   => 'Lista de perguntas e respostas.',
            'fields' => [
                'title' => 'Título (opcional)',
                'items' => 'array de {q, a}',
            ],
            'rules' => [
                'title'     => ['nullable','string','max:255'],
                'items'     => ['nullable','array','max:50'],
                'items.*.q' => ['nullable','string','max:300'],
                'items.*.a' => ['nullable','string'],
            ],
            'defaults' => [
                'title' => 'Perguntas frequentes',
                'items' => [
                    ['q' => 'Como funciona o Clube+?', 'a' => 'Você assina e tem acesso a descontos exclusivos.'],
                    ['q' => 'É possível cancelar?', 'a' => 'Sim, quando quiser.'],
                ],
            ],
        ],

        'content' => [
            'label'   => 'Conteúdo Livre',
            'desc'    => 'Bloco rico com HTML/markdown/texto.',
            'fields'  => [ 'html' => 'string (HTML)' ],
            'rules'   => [ 'html' => ['nullable','string'] ],
            'defaults'=> [ 'html' => '<p>Conteúdo livre…</p>' ],
        ],

        'oqe_hero' => [
        'label'   => 'O-que-é: Hero',
        'desc'    => 'Faixa com imagem grande + painel de texto à esquerda.',
        'fields'  => [
            'bg_image' => 'URL da imagem de fundo',
            'title'    => 'Título (H1)',
            'text'     => 'Texto do painel (quebre em frases com ponto para múltiplos <p>)',
        ],
        'rules' => [
            'bg_image' => ['nullable','string','max:255'],
            'title'    => ['nullable','string','max:300'],
            'text'     => ['nullable','string'],
        ],
        'defaults' => [
            'bg_image' => 'images/o-que-e/benefioPrograma.png',
            'title'    => 'O programa',
            'text'     => 'Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem.',
        ],
        ],

        'oqe_para_quem' => [
        'label' => 'O-que-é: Para quem é',
        'desc'  => 'Bloco de cópia à esquerda + arte à direita.',
        'fields'=> [
            'title'    => 'Título (H2)',
            'text'     => 'Texto (linhas separadas por ponto/linha viram múltiplos <p>)',
            'art_image'=> 'Imagem/arte à direita',
        ],
        'rules' => [
            'title'     => ['nullable','string','max:300'],
            'text'      => ['nullable','string'],
            'art_image' => ['nullable','string','max:255'],
        ],
        'defaults' => [
            'title'     => 'Para quem é?',
            'text'      => 'Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovdiem.|Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovdiem. Musam aliquo optae que nonecul.|Optaquae perepedi dende officia cabore… que nonecul.',
            'art_image' => 'images/o-que-e/praquem.png',
        ],
        ],

        'oqe_how' => [
        'label' => 'O-que-é: Como funciona',
        'desc'  => 'Título + lead + timeline de 5 passos (hex).',
        'fields'=> [
            'title' => 'Título',
            'lead'  => 'Texto introdutório (lead)',
            'steps' => 'Array de passos [{icon,title,desc}]',
        ],
        'rules' => [
            'title'      => ['nullable','string','max:200'],
            'lead'       => ['nullable','string'],
            'steps'      => ['nullable','array','max:10'],
            'steps.*.icon'  => ['nullable','string','max:255'],
            'steps.*.title' => ['nullable','string','max:120'],
            'steps.*.desc'  => ['nullable','string'],
        ],
        'defaults' => [
            'title' => 'Como funciona?',
            'lead'  => 'Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovdiem. Musam aliquo optae que nonecul.',
            'steps' => [
            ['icon'=>'money.png',   'title'=>'Lorem Ipsum', 'desc'=>'Optaquae perepedi dende officia cabore...'],
            ['icon'=>'praia.png',   'title'=>'Lorem Ipsum', 'desc'=>'Optaquae perepedi dende officia cabore... Musam aliquo optae.'],
            ['icon'=>'onibus.png',  'title'=>'Lorem Ipsum', 'desc'=>'Optaquae perepedi dende officia cabore...'],
            ['icon'=>'objetos.png', 'title'=>'Lorem Ipsum', 'desc'=>'Optaquae perepedi dende officia cabore... Musam aliquo optae.'],
            ['icon'=>'cruz.png',    'title'=>'Lorem Ipsum', 'desc'=>'Optaquae perepedi dende officia cabore...'],
            ],
        ],
        ],

        'oqe_depo' => [
        'label' => 'O-que-é: Depoimentos',
        'desc'  => 'Faixa azul + carrossel horizontal com trilho/slider.',
        'fields'=> [
            'title' => 'Título',
            'items' => 'Array de depoimentos [{name,role,avatar,text}]',
        ],
        'rules' => [
            'title'          => ['nullable','string','max:200'],
            'items'          => ['nullable','array','max:50'],
            'items.*.name'   => ['nullable','string','max:120'],
            'items.*.role'   => ['nullable','string','max:80'],
            'items.*.avatar' => ['nullable','string','max:255'],
            'items.*.text'   => ['nullable','string'],
        ],
        'defaults' => [
            'title' => 'Depoimentos',
            'items' => [
            ['name'=>'David Rodrigo W.','role'=>'Traveler','avatar'=>'images/o-que-e/user.png','text'=>'Optaquae perepedi dende officia...'],
            ['name'=>'Maria S.','role'=>'Traveler','avatar'=>'images/o-que-e/user.png','text'=>'Optaquae perepedi dende officia...'],
            ['name'=>'João P.','role'=>'Traveler','avatar'=>'images/o-que-e/user.png','text'=>'Optaquae perepedi dende officia...'],
            ],
        ],
        ],

        
        'beneficios_intro' => [
            'label'   => 'Benefícios • Intro',
            'desc'    => 'Bloco com título/texto à esquerda e cards com imagem+texto à direita.',
            'fields'  => [
                'title' => 'Título',
                'text'  => 'Texto (HTML ou texto)',
                'cards' => 'array de cards [{image, caption}]',
            ],
            'rules' => [
                'title'          => ['nullable','string','max:255'],
                'text'           => ['nullable','string'],
                'cards'          => ['nullable','array','max:8'],
                'cards.*.image'  => ['nullable','string','max:255'],
                'cards.*.caption'=> ['nullable','string','max:120'],
            ],
            'defaults' => [
                'title' => 'Nolren Upsim Lorem',
                'text'  => 'Optaquae perepedi dende officae cabore, niandi opti ut lam de cumque nimo ommolum...',
                'cards' => [
                    ['image' => 'images/bg-beneficios1.png', 'caption' => "Lorem ipsum\nlorem lorem"],
                    ['image' => 'images/bg-beneficios1.png', 'caption' => "Lorem ipsum\nlorem lorem"],
                ],
            ],
        ],

        'beneficios_numbers' => [
            'label'   => 'Benefícios • Números',
            'desc'    => 'Faixa com caixinhas de ícone + valor + rótulo.',
            'fields'  => [
                'items' => 'array [{icon, value, label}]',
            ],
            'rules' => [
                'items'         => ['nullable','array','max:12'],
                'items.*.icon'  => ['nullable','string','max:255'],
                'items.*.value' => ['nullable','string','max:50'],
                'items.*.label' => ['nullable','string','max:80'],
            ],
            'defaults' => [
                'items' => [
                    ['icon'=>'images/products.svg',   'value'=>'2000+', 'label'=>'Produtos'],
                    ['icon'=>'images/segmentos.svg',  'value'=>'7001+', 'label'=>'Segmentos'],
                    ['icon'=>'images/products.svg',   'value'=>'2000+', 'label'=>'Produtos'],
                    ['icon'=>'images/segmentos.svg',  'value'=>'7001+', 'label'=>'Segmentos'],
                ],
            ],
        ],


        'parc_rules' => [
            'label'   => 'Parceiros • Regras de uso',
            'desc'    => 'Texto + balão à direita com HTML interno.',
            'fields'  => [
                'title'      => 'Título',
                'paragraphs' => 'Parágrafos (array de strings ou texto com quebras)',
                'balloon_bg' => 'Imagem do balão (URL)',
                'pill_text'  => 'Texto da pílula',
                'slot_html'  => 'HTML dentro do balão',
                'show_button'=> 'bool Exibir botão',
            ],
            'rules' => [
                'title'       => ['nullable','string','max:255'],
                'paragraphs'  => ['nullable'], // aceitamos string ou array
                'balloon_bg'  => ['nullable','string','max:255'],
                'pill_text'   => ['nullable','string','max:120'],
                'slot_html'   => ['nullable','string'],
                'show_button' => ['nullable','boolean'],
            ],
            'defaults' => [
                'title'      => 'Regras de Uso',
                'paragraphs' => [],
                'balloon_bg' => 'images/parceiros/bg.png',
                'pill_text'  => 'Lorem Ipsum Lorem',
                'slot_html'  => '<p>Conteúdo do balão.</p>',
                'show_button'=> true,
            ],
        ],

        'parc_partner' => [
            'label'   => 'Parceiros • Seja Parceiro',
            'desc'    => 'Cabeçalho + formulário simples',
            'fields'  => [
                'title'       => 'Título',
                'lead'        => 'Texto introdutório',
                'fields'      => 'array de campos [{label,name,placeholder}]',
                'button_text' => 'Texto do botão',
                'anchor_id'   => 'id da seção (ancora)',
                'action'      => 'action do form',
                'method'      => 'method do form',
            ],
            'rules' => [
                'title'       => ['nullable','string','max:255'],
                'lead'        => ['nullable','string'],
                'fields'      => ['nullable','array','max:4'],
                'fields.*.label'       => ['nullable','string','max:120'],
                'fields.*.name'        => ['nullable','string','max:120'],
                'fields.*.placeholder' => ['nullable','string','max:120'],
                'button_text' => ['nullable','string','max:80'],
                'anchor_id'   => ['nullable','string','max:80'],
                'action'      => ['nullable','string','max:255'],
                'method'      => ['nullable','string','max:10'],
            ],
            'defaults' => [
                'title'       => 'Seja Parceiro',
                'lead'        => '',
                'fields'      => [],
                'button_text' => 'Enviar',
                'anchor_id'   => 'seja-parceiro',
                'action'      => '#',
                'method'      => 'post',
            ],
        ],
  
    ],

    'templates' => [
        'home' => [
            'label'            => 'Home',
            'allowed_sections' => ['hero_slider','oque_e','destinations','advantages','content'],
        ],
        'o_que_e' => [
            'label'            => 'Página: O que é',
            'allowed_sections' => ['oqe_hero','oqe_para_quem','oqe_how','oqe_depo','content'],
        ],
        'beneficios' => [
            'label'            => 'Benefícios',
            'allowed_sections' => ['hero_slider','beneficios_intro','beneficios_numbers','content'],
        ],
        'parceiros' => [
            'label'            => 'Parceiros',
            'allowed_sections' => ['hero_slider','parc_rules','parc_partner'],
        ],
        'faq_page' => [
            'label'     => 'Página: Perguntas Frequentes (FAQ)',
            'allowed_sections' => ['hero_slider', 'faq', 'content'],
        ],
        'default' => [
            'label'            => 'Padrão',
            'allowed_sections' => ['content'],
        ],
    ],
];
