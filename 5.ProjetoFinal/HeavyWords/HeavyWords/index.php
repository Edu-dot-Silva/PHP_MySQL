<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heavy Words</title>
    <link rel="stylesheet" href="../HeavyWords/assets/css/reset.css">
    <link rel="stylesheet" href="../HeavyWords/assets/css/index.css">
</head>
<body>
    <?php
    include_once 'componentes/cabecalho.php';
    ?>
    
    <main>
        <div class="mais_vendidos">
            <h1>Mais Vendidos</h1>
            <div class="vendidos_content">
                <div class="item_mais_vendido item_mais_vendido1">
                    <img src="../HeavyWords/assets/img/heavyWords.png" alt="">
                    <p>Titulo</p>
                    <p>Preço</p>
                    <button>Comprar</button>
                </div>
                <div class="item_mais_vendido item_mais_vendido2">
                    <img src="../HeavyWords/assets/img/heavyWords.png" alt="">

                    <p>Titulo</p>
                    <p>Preço</p>
                    <button>Comprar</button>
                </div>
                <div class="item_mais_vendido item_mais_vendido3">
                    <img src="../HeavyWords/assets/img/heavyWords.png" alt="">

                    <p>Titulo</p>
                    <p>Preço</p>
                    <button>Comprar</button>
                </div>
            </div>
        </div>

        <div class="promocoes">
            <h1>Promoções</h1>
            <!-- array que fica renderizando os produtos com preço menor que X no banco cada vez que atualiza a pagina -->
            <div class="vendidos_content">
                <div class="item_mais_vendido item_mais_vendido1">
                    <img src="../HeavyWords/assets/img/heavyWords.png" alt="">
                    <p>Titulo</p>
                    <p>Preço</p>
                    <button>Comprar</button>
                </div>
                <div class="item_mais_vendido item_mais_vendido2">
                    <img src="../HeavyWords/assets/img/heavyWords.png" alt="">

                    <p>Titulo</p>
                    <p>Preço</p>
                    <button>Comprar</button>
                </div>
                <div class="item_mais_vendido item_mais_vendido3">
                    <img src="../HeavyWords/assets/img/heavyWords.png" alt="">

                    <p>Titulo</p>
                    <p>Preço</p>
                    <button>Comprar</button>
                </div>
            </div>
        </div>
    </main>

    <?php
    include_once 'componentes/rodape.php';
    ?>
</body>

</html>