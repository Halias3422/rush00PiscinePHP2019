<?php

function checkUserBasketNotLog($singleProduct) {
    $here = 0;
    $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
        if (!$mysqli) {
            echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
            echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
            echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        $query = "SELECT * FROM `basket` WHERE `user_tmp_id` = ? AND `product_name` = ?";
        if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
            die("Error1 : " . mysqli_error($mysqli));
        }
        if (mysqli_stmt_bind_param($stmt, "ss", $_SESSION['notlog'], $singleProduct[1]) === false) {
            die("Error2 : " . mysqli_stmt_error($stmt));
        }
        if (mysqli_stmt_execute($stmt) === false) {
            die("Error3 : " . mysqli_stmt_error($stmt));
        }
        if (mysqli_stmt_bind_result($stmt, $col1, $col2, $col3, $col4, $col5) === FALSE) {
            die("Error4 : " . mysqli_stmt_error($stmt));
        }
        /* Récupération des valeurs */
        if (mysqli_stmt_fetch($stmt)) {
            $here = 1;
        }
        mysqli_stmt_close($stmt);

        if (mysqli_errno($mysqli)) {
            die("Error4 : " . mysqli_stmt_error($stmt));
        }
        mysqli_close($mysqli);
        if ($here == 1) {
            return FALSE;
        }
        else {
           return TRUE;
        }
}

function addInBasketNotLog($singleProduct) {
    $user_id = "";
    $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
    if (!$mysqli) {
        echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
        echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
        echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    $query = "INSERT INTO `basket`(`product_name`, `price`, `amount`, `user_id`, `user_tmp_id`) VALUE (?, ?, ?, ?, ?)";
    if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
        die("Error1 : " . mysqli_error($mysqli));
    }
    if (mysqli_stmt_bind_param($stmt, "ssssd", $singleProduct[1], $singleProduct[2], $singleProduct[0], $user_id, $_SESSION['notlog']) === false) {
        die("Error2 : " . mysqli_stmt_error($stmt));
    }
    if (mysqli_stmt_execute($stmt) === false) {
        die("Error3 : " . mysqli_stmt_error($stmt));
    }
    /* Récupération des valeurs */
    mysqli_stmt_close($stmt);

    if (mysqli_errno($mysqli)) {
        die("Error4 : " . mysqli_stmt_error($stmt));
    }
    mysqli_close($mysqli);
}

function updateBasketNotLog($singleProduct) {
    $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
    if (!$mysqli) {
        echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
        echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
        echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    $query = "UPDATE `basket` SET `amount` = `amount` + ? WHERE `user_tmp_id` = ? AND `product_name` = ?";
    if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
        die("Error1 : " . mysqli_error($mysqli));
    }
    if (mysqli_stmt_bind_param($stmt, "sss", $singleProduct[0], $_SESSION['notlog'], $singleProduct[1]) === false) {
        die("Error2 : " . mysqli_stmt_error($stmt));
    }
    if (mysqli_stmt_execute($stmt) === false) {
        die("Error3 : " . mysqli_stmt_error($stmt));
    }
    /* Récupération des valeurs */
    mysqli_stmt_close($stmt);

    if (mysqli_errno($mysqli)) {
        die("Error4 : " . mysqli_stmt_error($stmt));
    }
    mysqli_close($mysqli);

}

function deleteItemBasketNotLog() {
    $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
    if (!$mysqli) {
        echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
        echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
        echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    $query = "DELETE FROM `basket` WHERE `product_name` = ? AND `user_tmp_id` = ?";
    if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
        die("Error1 : " . mysqli_error($mysqli));
    }
    if (mysqli_stmt_bind_param($stmt, "ss", $_POST['product'], $_SESSION['notlog']) === false) {
        die("Error2 : " . mysqli_stmt_error($stmt));
    }
    if (mysqli_stmt_execute($stmt) === false) {
        die("Error3 : " . mysqli_stmt_error($stmt));
    }
    /* Récupération des valeurs */
    mysqli_stmt_close($stmt);

    if (mysqli_errno($mysqli)) {
        die("Error4 : " . mysqli_stmt_error($stmt));
    }
    mysqli_close($mysqli);
}

function selectItemsBasketAmountNotLog() {
    $amount = 0;
    $here = 0;
    $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
        if (!$mysqli) {
            echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
            echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
            echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        $query = "SELECT `amount` FROM `basket` WHERE `user_tmp_id` = ? AND `product_name` = ?";
        if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
            die("Error1 : " . mysqli_error($mysqli));
        }
        if (mysqli_stmt_bind_param($stmt, "ss", $_SESSION['notlog'], $_POST['product']) === false) {
            die("Error2 : " . mysqli_stmt_error($stmt));
        }
        if (mysqli_stmt_execute($stmt) === false) {
            die("Error3 : " . mysqli_stmt_error($stmt));
        }
        if (mysqli_stmt_bind_result($stmt, $col1) === FALSE) {
            die("Error4 : " . mysqli_stmt_error($stmt));
        }
        /* Récupération des valeurs */
        if (mysqli_stmt_fetch($stmt)) {
            $amount = $col1;
        }
        mysqli_stmt_close($stmt);

        if (mysqli_errno($mysqli)) {
            die("Error4 : " . mysqli_stmt_error($stmt));
        }
        mysqli_close($mysqli);
        return ($amount);
}

function updateProductsLeftNotLog() {
    $amount = selectItemsBasketAmountNotLog();
    $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
    if (!$mysqli) {
        echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
        echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
        echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    $query = "UPDATE `products` SET `left`= `left` + ? WHERE `product_name` = ? ";
    if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
        die("Error1 : " . mysqli_error($mysqli));
    }
    if (mysqli_stmt_bind_param($stmt, "ss", $amount, $_POST['product']) === false) {
        die("Error2 : " . mysqli_stmt_error($stmt));
    }
    if (mysqli_stmt_execute($stmt) === false) {
        die("Error3 : " . mysqli_stmt_error($stmt));
    }
    /* Récupération des valeurs */
    mysqli_stmt_close($stmt);

    if (mysqli_errno($mysqli)) {
        die("Error4 : " . mysqli_stmt_error($stmt));
    }
    mysqli_close($mysqli);
}

function selectBasketUserLog($product) {
    $here = 0;
    $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
        if (!$mysqli) {
            echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
            echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
            echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        $query = "SELECT * FROM `basket` WHERE `user_id` = ? AND `product_name` = ?";
        if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
            die("Error1 : " . mysqli_error($mysqli));
        }
        if (mysqli_stmt_bind_param($stmt, "ss", $_SESSION['login'], $product) === false) {
            die("Error2 : " . mysqli_stmt_error($stmt));
        }
        if (mysqli_stmt_execute($stmt) === false) {
            die("Error3 : " . mysqli_stmt_error($stmt));
        }
        if (mysqli_stmt_bind_result($stmt, $col1, $col2, $col3, $col4, $col5) === FALSE) {
            die("Error4 : " . mysqli_stmt_error($stmt));
        }
        /* Récupération des valeurs */
        if (mysqli_stmt_fetch($stmt)) {
            $here = 1;
        }
        mysqli_stmt_close($stmt);

        if (mysqli_errno($mysqli)) {
            die("Error4 : " . mysqli_stmt_error($stmt));
        }
        mysqli_close($mysqli);
        if ($here == 1) {
            return TRUE;
        }
        else {
           return FALSE;
        }
}

function updateProductUserLog($newAmount, $product) {
    $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
    if (!$mysqli) {
        echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
        echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
        echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    $query = "UPDATE `basket` SET `amount` = `amount` + ? WHERE `product_name` = ? AND `user_id` = ? ";
    if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
        die("Error1 : " . mysqli_error($mysqli));
    }
    if (mysqli_stmt_bind_param($stmt, "dss", $newAmount, $product, $_SESSION['login']) === false) {
        die("Error2 : " . mysqli_stmt_error($stmt));
    }
    if (mysqli_stmt_execute($stmt) === false) {
        die("Error3 : " . mysqli_stmt_error($stmt));
    }
    /* Récupération des valeurs */
    mysqli_stmt_close($stmt);

    if (mysqli_errno($mysqli)) {
        die("Error4 : " . mysqli_stmt_error($stmt));
    }
    mysqli_close($mysqli);
}

function deleteProductUserNotLog($product) {
        $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
        if (!$mysqli) {
            echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
            echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
            echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        $query = "DELETE FROM `basket` WHERE `product_name` = ? AND `user_tmp_id` = ?";
        if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
            die("Error1 : " . mysqli_error($mysqli));
        }
        if (mysqli_stmt_bind_param($stmt, "ss", $product, $_SESSION['notlog']) === false) {
            die("Error2 : " . mysqli_stmt_error($stmt));
        }
        if (mysqli_stmt_execute($stmt) === false) {
            die("Error3 : " . mysqli_stmt_error($stmt));
        }
        /* Récupération des valeurs */
        mysqli_stmt_close($stmt);
    
        if (mysqli_errno($mysqli)) {
            die("Error4 : " . mysqli_stmt_error($stmt));
        }
        mysqli_close($mysqli);
}

function insertProductUserLog($amount, $product, $price) {
        $user_tmp_id = 1;
        $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
        if (!$mysqli) {
            echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
            echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
            echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        $query = "INSERT INTO `basket`(`product_name`, `price`, `amount`, `user_id`, `user_tmp_id`) VALUE (?, ?, ?, ?, ?)";
        if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
            die("Error1 : " . mysqli_error($mysqli));
        }
        if (mysqli_stmt_bind_param($stmt, "ssssd", $product, $price, $amount, $_SESSION['login'], $user_tmp_id) === false) {
            die("Error2 : " . mysqli_stmt_error($stmt));
        }
        if (mysqli_stmt_execute($stmt) === false) {
            die("Error3 : " . mysqli_stmt_error($stmt));
        }
        /* Récupération des valeurs */
        mysqli_stmt_close($stmt);
    
        if (mysqli_errno($mysqli)) {
            die("Error4 : " . mysqli_stmt_error($stmt));
        }
        mysqli_close($mysqli);
}

function selectBasketNotlog() {
    $product_name_tmp = [];
    $amount_tmp = [];
    $price = [];
    $i = 0;
    $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
    $query = "SELECT `product_name`, `amount`, `price` FROM `basket` WHERE `user_tmp_id` = ?";
    if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
        die("Error1 : " . mysqli_error($mysqli));
    }
    if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
        die("Error1 : " . mysqli_error($mysqli));
    }
    if (mysqli_stmt_bind_param($stmt, "s", $_SESSION['notlog']) === false) {
        die("Error2 : " . mysqli_stmt_error($stmt));
    }
    if (mysqli_stmt_execute($stmt) === false) {
        die("Error3 : " . mysqli_stmt_error($stmt));
    }
    if (mysqli_stmt_bind_result($stmt, $col1, $col2, $col3) === FALSE) {
        die("Error4 : " . mysqli_stmt_error($stmt));
    }
    /* Récupération des valeurs */
    while (mysqli_stmt_fetch($stmt)) {
        array_push($product_name_tmp, $col1);
        array_push($amount_tmp, $col2);
        array_push($price, $col3);
    }
    mysqli_stmt_close($stmt);

    if (mysqli_errno($mysqli)) {
        die("Error4 : " . mysqli_stmt_error($stmt));
    }
    mysqli_close($mysqli);
    foreach($product_name_tmp as $key=>$value) {
        if (selectBasketUserLog($value)) {
            updateProductUserLog($amount_tmp[$i], $value);
            deleteProductUserNotLog($value);
        }
        else {
            insertProductUserLog($amount_tmp[$i], $value, $price[$i]);
            deleteProductUserNotLog($value);
        }
        $i++;
    }
}
?>