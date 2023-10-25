<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>CRUD</title>
</head>
<body>

<header>
    <h1>Little PetShop</h1>
    <a href="admin.php">Admin Panel</a> <br>
</header>

<main>
    <section class="filtres">
        <?php
        require "db.php";
        $id = $_GET['id'];
        $categories = $db->query("SELECT * FROM categories")->fetchAll(2);
        foreach($categories as $item){
            ?>
            <a href="?category=<? echo $item['id']; ?> " <?php if ($item['id'] == $_GET['category']) echo "class = 'selected'" ?>>
                <?php echo $item['name'];?>
            </a>
        <?php } ?>
    </section>

    <section class="container">
        <h2>Popular Items</h2>

        <?php
        $card = $db->query("SELECT * FROM card")->fetchAll(2);
        foreach($card as $item){?>
            <div class="items">
                <img src="<?php echo $item['photo'] ?>" alt="photo" width="100">
                <h3><? echo $item['name'] ?></h3>
                <p>$ <? echo $item['price'] ?> </p>
                <a href="single.php?id=<?= $item['id']; ?>">Подробнее</a>
            </div>
        <?}?>


    </section>
</main>

</body>
</html>