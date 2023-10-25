<?php
require("db.php");

$id = $_GET['id'];

if (!isset($_GET["id"])){
    echo "<script>
alert('Вы не выбрали товар!');
location.href='index.php';
</script>";
    exit();
}

$item = $db->query("SELECT * FROM card WHERE id=$id")->fetchAll(2);

if(count($item) > 0 ){
    $item = $item[0];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $item['name'] ?></title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body class="single">
<header>
    <a href="../../index.php">Назад</a>
</header>

<main>
    <section class="info">
        <img src="<?= $item['photo'] ?>" alt="item">
        <h1><?= $item['name'] ?></h1>
        <p><?= $item['description'] ?></p>
    </section>

    <section class="buy">
        <div class="amount">
            <button>+</button>
            <span>1</span>
            <button>-</button>
        </div>
        <h2>$19</h2>
    </section>
</main>


</body>
</html>