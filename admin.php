<?php
require("db.php");
if(!empty($_GET)){
    if(isset($_GET['delete_cat'])) {
        $id = $_GET['id'];

        if ($db->query("DELETE FROM categories WHERE id=$id")){
            echo "<script>
            alert('Удалено!');
            location.href='admin.php';
            </script>";
            exit();
        }
    }

    if(isset($_GET['delete_item'])) {
        $id = $_GET['id'];

        if ($db->query("DELETE FROM card WHERE id=$id")){
            echo "<script>
            alert('Удалено!');
            location.href='admin.php';
            </script>";
            exit();
        }
    }

    if(isset($_GET['new_cat'])){
        $name = $_GET['new_cat'];
        if ($db->query("INSERT INTO categories (name) VALUES ('$name')")){
            echo "<script>
            alert('Успешно добавлено!');
            location.href='admin.php';
            </script>";
        } else {
            var_dump($db->errorInfo());
        }
    }
    if(isset($_GET['new_item_name'])){
        $name = $_GET['new_item_name'];
        $photo = $_GET['photo'];
        $description = $_GET['description'];
        $price = $_GET['price'];
        $category = $_GET['category'];
        if ($db->query("INSERT INTO card (name, photo, description, price, category) VALUES ('$name', '$photo', '$description',$price, $category)")){
            echo "<script>
            alert('Успешно добавлено!');
            location.href='admin.php';
            </script>";
        } else {
            var_dump($db->errorInfo());
        }
    }
    if(isset($_GET['cat_name'])){
        $name = $_GET['cat_name'];
        $id = $_GET['id'];
        if ($db->query("UPDATE categories SET name='$name' WHERE id=$id" )){
            echo "<script>
            alert('Успешно изменено!');
            location.href='admin.php';
            </script>";
        } else {
            var_dump($db->errorInfo());
        }
    }
    if(isset($_GET['item_name'])){
        $name = $_GET['item_name'];
        $photo = $_GET['photo'];
        $description = $_GET['description'];
        $price = $_GET['price'];
        $category = $_GET['category'];
        $id = $_GET['id'];
        if ($db->query("UPDATE card  SET name='$name', photo='$photo', description='$description', price=$price, category=$category WHERE id=$id")){
            echo "<script>
            alert('Успешно изменено!');
            location.href='admin.php';
            </script>";
        } else {
            var_dump($db->errorInfo());
        }
    }
}

$categories = $db->query("SELECT * FROM categories")->fetchAll(2);
$items = $db->query("SELECT * FROM card")->fetchAll(2);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <title>Document</title>
</head>
<body>

<a href="../../index.php">Назад</a>

<h1>Admin's Panel</h1>

<main>
    <section class="categories">
        <h2>Категории</h2>
        <div class="container">
            <form action="#"  class="item">
                <label>
                    Название
                    <input type="text" name="new_cat">
                </label>
                <button>Добавить</button>
            </form>

            <form action="#" class="item">
                Название <input type="text" name="new_item_name">
                Описание товара <input type="text" name="description">
                Ссылка на фото <input type="text" name="photo">
                Цена <input type="text" name="price">
                Категория <input type="text" name="category">

                <select name="category">
                    <?php foreach($categories as $cat){ ?>
                        <option value="<?= $cat['id']; ?>"><?= $cat['name'];  ?></option>
                    <?php } ?>
                </select>
                <button>Добавить</button>
            </form>

            <?php foreach($categories as $item){?>
                <form action="#" class="item">
                    Название <input type="text" name="cat_name" value="<?= $item['name']; ?>">
                    <input type="hidden" name="id" value="<?= $item['id']; ?>">
                    <button>Обновить</button>
                    <button name="delete_cat">Удалить</button>
                </form>
            <?php } ?>
        </div>
    </section>

    <section class="items">
        <h2>Товары</h2>
        <div class="container">
            <?php
            foreach($items as $item){?>
                <form action="#" class="item">
                    <img src="<?= $item['photo'] ?>" alt="" width="100" height="100">
                    Название <input type="text" name="item_name" value="<?= $item['name']; ?>">
                    Описание товара <input type="text" name="description" value="<?= $item['description']; ?>">
                    Ссылка на фото <input type="text" name="photo" value="<?= $item['photo']; ?>">
                    Цена <input type="text" name="price" value="<?= $item['price']; ?>">
                    Категория <input type="text" name="category" value="<?= $item['category']; ?>">

                    <select name="category">
                        <?php foreach($categories as $cat){ ?>
                            <option <?php if($item['category'] == $cat['id']) echo "selected"; ?> value="<?= $cat['id']; ?>"><?= $cat['name'];  ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                    <button>Обновить</button>
                    <button name="delete_item">Удалить</button>
                </form>
            <?php } ?>
        </div>
    </section>
</main>


<!--<style>-->
<!--    *{-->
<!--        box-sizing: border-box;-->
<!--        font-family:'Product Sans',Arial, sans-serif;-->
<!--    }-->
<!---->
<!--    .single{-->
<!--        padding:20px;-->
<!--    }-->
<!---->
<!--    a{-->
<!--        display:block;-->
<!--        text-decoration:none;-->
<!--        padding: 10px 20px;-->
<!--        border-radius: 50px;-->
<!--        background-color:white;-->
<!--        color:black;-->
<!--        box-shadow:0px 4px 10px rgba(0,0,0,0.25);-->
<!--    }-->
<!---->
<!--    a.button, a:hover, a.selected{-->
<!--        background-color:#20A920;-->
<!--        color:white;-->
<!--    }-->
<!---->
<!--    .amount{-->
<!--        display:flex;-->
<!--        align-items: center;-->
<!--        gap: 20px;-->
<!--        padding:10px;-->
<!--        background-color: #F2F2F2;-->
<!--        border-radius: 50px;-->
<!--    }-->
<!---->
<!--    .buy{-->
<!--        display:flex;-->
<!--        align-items:center;-->
<!--        justify-content: space-between;-->
<!--        gap:20px;-->
<!--    }-->
<!---->
<!--    .amount button{-->
<!--        background-color: transparent;-->
<!--    }-->
<!---->
<!--    .single header{-->
<!--        display:flex;-->
<!--        margin-bottom: 50px;-->
<!--    }-->
<!---->
<!--    img{-->
<!--        max-width: 100%;-->
<!--    }-->
<!---->
<!--    .filtres{-->
<!--        display:flex;-->
<!--        align-items: center;-->
<!--        gap: 20px;-->
<!--    }-->
<!--    .container{-->
<!--        display:grid;-->
<!--        grid-template-columns:1fr 1fr;-->
<!--        grid-auto-rows: auto;-->
<!--        gap:20px;-->
<!--    }-->
<!---->
<!--    .container h2{-->
<!--        grid-column-end:span 2;-->
<!--    }-->
<!--    .items{-->
<!--        padding:10px;-->
<!--        text-align:center;-->
<!--        box-shadow:0px 4px 10px rgba(0,0,0.25);-->
<!--        border-radius: 10px;-->
<!--    }-->
<!---->
<!--    form{-->
<!--        display:grid;-->
<!--        gap:5px;-->
<!--    }-->
<!---->
<!--</style>-->
</body>
</html>