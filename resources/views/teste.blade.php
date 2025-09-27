<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>

<select id="select-filter">
    <option value="">Selecione</option>
    <option value="123">Exemplo 1</option>
    <option value="456">Exemplo 2</option>
</select>

<button id="buscar-btn">BUSCAR</button>

<div id="search-results-container"></div>

<script>
    document.getElementById("buscar-btn").addEventListener("click", async (e) => {
        e.preventDefault();

        const selectedValue = document.getElementById("select-filter").value;
        if (!selectedValue) return;

        try {
            // faz POST para o backend que devolve o slug
            const response = await fetch("/api/get_taxonomy_slug", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ term_id: selectedValue })
            });

            const slug = await response.text();

            if (slug && slug !== "error") {
                const newRedirectPath = `/local/${slug}`;

                // carrega HTML da página de destino
                const res = await fetch(newRedirectPath);
                const html = await res.text();

                // extrai só o conteúdo do #main-content
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, "text/html");
                const content = doc.querySelector("#main-content");

                if (content) {
                    document.getElementById("search-results-container").innerHTML =
                        content.innerHTML;
                }

                // atualiza a URL do browser
                history.pushState({}, "", newRedirectPath);
            } else {
                console.error("Erro ao obter slug da taxonomia.");
            }
        } catch (err) {
            console.error("Falha na requisição:", err);
        }
    });
</script>

</body>
</html>
