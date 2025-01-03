<?php

session_start();

if (isset($_SESSION['name']) && isset($_SESSION['password'])) {
    include_once('config.php');
    require_once('functions.php');
    $sql = 'SELECT * FROM LIVROS ORDER BY nome_livro ASC';

    $result = $conexao->query($sql);

    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $sqlSearch = "SELECT * FROM LIVROS WHERE UPPER(nome_livro) LIKE UPPER('%$search%') OR UPPER(autor) LIKE UPPER('%$search%')";

        $result = $conexao->query($sqlSearch);
    }

} else {
    header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Loja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<style>
    :root {
        --white: #faf7f0;
        --gray: #d8d2c2;
        --brown: #b17457;
        --lightbrown: #b99470;
        --black: #4a4947;
    }

    body {
        background-color: var(--gray);
    }

    main {
        justify-content: center;
        flex-direction: row;
    }

    .products-div {
        display: grid;
        grid-template-columns: repeat(4, 200px);
        /* gap: 30px; */
        column-gap: 18px;
        row-gap: 25px;
        grid-auto-rows: minmax(250px, auto);
        margin-top: 1rem;
        align-items: center;
        justify-content: center;
        padding-block: 2rem;

    }

    .prod-anchor {
        text-decoration: none;
        height: 100%;
        width: 100%;
    }

    .prod-box {
        border-radius: 5px;
        grid-row: span 1;
        grid-column: span 1;
        padding-top: 5px;
        background-color: var(--brown);
        height: 100%;
        transition: 0.4s;
        transition-timing-function: ease-out;
    }

    .prod-box:hover {
        width: 100%;
        height: 100%;
        transform: scale(1.1);
        /* box-shadow: 10px 10px 10px 10px rgba(0, 0, 0, 0.2); */
        box-shadow: 0px 0px 0px 0px white inset, 5px 5px 5px rgba(0, 0, 0, 0.4);

    }

    .prod-img {
        width: 100%;
        height: 70%;
        object-fit: cover;
        /* border-radius: 5px 5px 0 0; */
    }

    .prod-data {
        color: white;
        padding: 5px;
        display: grid;
    }

    .prod-name {
        padding-inline: 5px;
        inline-size: 200px;
        white-space: wrap;
        word-wrap: break-word;
    }

    .prod-value {
        position: sticky;
    }
</style>

<body>
    <main class="system-div">
        <div class="system-nav">
            <a href="system.php"> Sistema</a>
            <a href="" class="<?php echo levelVerify($_SESSION['user_level']) ?>">
                Dashboard
            </a>
            <a href="shop.php"> Loja</a>
            <a href="history.php"> Histórico</a>
            <a href="stock.php" class="<?php echo levelVerify($_SESSION['user_level']) ?>">Estoque</a>
            <a href="demands.php" class="<?php echo levelVerify($_SESSION['user_level']) ?>">Pedidos</a>
        </div>
        <div class="system-content">

            <!-- NAVBAR  -->
            <nav>
                <input class="search-bar" type="text" name="search-bar" id="" placeholder="Pesquisar">
                <button class="btn btn-info search-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" onclick="" class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg></button>
            </nav>

            <!-- ///////////////////// -->
            <?php
            // NOTE: O objetivo da variável key é linkar este bloco de código com ou debaixo
            $key = 0;
            if ($result->num_rows == 0) {
                echo ("<p class='error-message'>Não foi possível encontrar nenhum produto. <a href='shop.php'>Voltar</a></p>");
                $key = 1;
            }
            ?>

            <div class="products-div">

                <?php
                if ($key == 0) {
                    while ($data = $result->fetch_assoc()) {
                        echo "<a href='purchase.php?id=$data[id_livro]' class='prod-anchor'>
                    <div class='prod-box'>
                    <img class='prod-img' src='../images/$data[foto]' alt=''>
                    <div class='prod-data'>
                        <h3 class='prod-name'>$data[nome_livro]</h3>
                        <p class='prod-value'>R$ $data[valor]</p>
                    </div>
                </div>
                </a>
                ";
                    }
                    $key = 0;
                }
                ?>

            </div>
        </div>
    </main>
</body>

<script src="../js/search-bar.js">
</script>

</html>