<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heavy Words</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
    <?php
    include_once '../componentes/cabecalho.php';
    ?>
    
    <main>
        <div class="mais_vendidos">
            <h3>Mais Vendidos</h3>
            <div class="vendidos_content">
                <div class="item_mais_vendido item_mais_vendido1">
                    <img src="../assets/img/heavyWords.png" alt="">
                    <p>Titulo</p>
                    <p>Preço</p>
                    <button>Comprar</button>
                </div>
                <div class="item_mais_vendido item_mais_vendido2">
                    <img src="../assets/img/heavyWords.png" alt="">

                    <p>Titulo</p>
                    <p>Preço</p>
                    <button>Comprar</button>
                </div>
                <div class="item_mais_vendido item_mais_vendido3">
                    <img src="../assets/img/heavyWords.png" alt="">

                    <p>Titulo</p>
                    <p>Preço</p>
                    <button>Comprar</button>
                </div>
            </div>
        </div>

        <div class="promocoes">
            <h3>Promoções</h3>
            <!-- array que fica renderizando os produtos com preço menor que X no banco cada vez que atualiza a pagina -->
            <div class="vendidos_content">
                <div class="item_mais_vendido item_mais_vendido1">
                    <img src="../assets/img/heavyWords.png" alt="">
                    <p>Titulo</p>
                    <p>Preço</p>
                    <button>Comprar</button>
                </div>
                <div class="item_mais_vendido item_mais_vendido2">
                    <img src="../assets/img/heavyWords.png" alt="">

                    <p>Titulo</p>
                    <p>Preço</p>
                    <button>Comprar</button>
                </div>
                <div class="item_mais_vendido item_mais_vendido3">
                    <img src="../assets/img/heavyWords.png" alt="">

                    <p>Titulo</p>
                    <p>Preço</p>
                    <button>Comprar</button>
                </div>
            </div>
        </div>

        <p>Nossa Localização</p>
        <div class="mapa-localizacao" style="width:100%;display:flex;justify-content:center;margin:32px 0;">
        <iframe 
            src="https://www.google.com/maps?q=Avenida+Paulista,+100,+São+Paulo&output=embed"
            width="600" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
    </main>

    <?php
    include_once '../componentes/rodape.php';
    ?>
</body>

</html>