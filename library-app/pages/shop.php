<?php

session_start();

if (isset($_SESSION['name']) && isset($_SESSION['password'])) {
    include_once('config.php');
    require_once('functions.php');
    $sql = 'SELECT * FROM LIVROS';

    $result = $conexao->query($sql);
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
        padding-bottom: 2rem;

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
    }

    .prod-name {
        white-space: wrap;
        word-wrap: break-word;
    }
</style>

<body>
    <main class="system-div">
        <div class="system-nav">
            <a href="system.php"> Sistema</a>
            <a href="" class="<?php echo levelVerify($user_level) ?>">
                Dashboard
            </a>
            <a href="shop.php"> Loja</a>
            <a href="history.php"> Histórico</a>
            <a href=""> Dashboard</a>
        </div>
        <div class="system-content">
            <div class="products-div">

                <a href='purchase.php?id=$data[id_livro]' class='prod-anchor'>
                    <div class='prod-box'>
                        <img class='prod-img' src='../images/1984.png' alt=''>
                        <div class='prod-data'>
                            <h3 class='prod-name'>$data[nome_livro]aaaaaaaaaaaaaaaaaaaaaaaa</h3>
                            <p class='prod-value'>R$ $data[valor]</p>
                        </div>
                    </div>
                </a>

                <?php
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
                ?>
            </div>
        </div>
    </main>
</body>

<script>
</script>

</html>