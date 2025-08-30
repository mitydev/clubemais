<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Clube+ | Beneficios</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  @vite(['resources/css/default.css','resources/css/app.css','resources/js/app.js'])

  <style>
    :root{
      --page-w: 1440px;
      --gutter: clamp(24px, 4vw, 28px);
      --header-h: clamp(64px, 9vh, 100px);

      /* largura efetiva do miolo (limitada ao page-w) */
      --band-w-cap: min(100vw, var(--page-w));

      /* alinhamento do painel com o container central */
      --panel-left-desktop: calc(50vw - (var(--band-w-cap)/2) + var(--gutter));
      --panel-bottom-offset: clamp(24px, 8vh, 77px);
      --panel-pad: clamp(18px, 2.4vw, 36px);
      --panel-top-pad: clamp(40px, 12vh, 160px);
    }

    html, body{ margin:0; padding:0; overflow-x:hidden; }
    .section-inner{ max-width: var(--page-w); margin-inline: auto; padding-inline: var(--gutter);}
    .align-with-timeline{ margin-inline: 0 !important; max-width: var(--page-w) !important; }

  </style>
</head>

<body class="bg-white">

  @include('components.header')



  @include('components.footer')

<script>

</script>

</body>
</html>
