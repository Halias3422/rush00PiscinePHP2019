<?php
function updateProductAmount($singleProduct) {
    $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
    if (!$mysqli) {
        echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
        echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
        echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    $query = "UPDATE `products` SET `left` = `left` - ? WHERE `product_name` = ?";
    if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
        die("Error1 : " . mysqli_error($mysqli));
    }
    if (mysqli_stmt_bind_param($stmt, "ss", $singleProduct[0], $singleProduct[1]) === false) {
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

function addInBasket ($singleProduct) {
    $user_tmp = 1;
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
            if (mysqli_stmt_bind_param($stmt, "ssssd", $singleProduct[1], $singleProduct[2], $singleProduct[0], $_SESSION['login'], $user_tmp) === false) {
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

function checkUserBasket($singleProduct) {
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
            if (mysqli_stmt_bind_param($stmt, "ss", $_SESSION['login'], $singleProduct[1]) === false) {
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

function updateBasket($singleProduct) {
    $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
    if (!$mysqli) {
        echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
        echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
        echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    $query = "UPDATE `basket` SET `amount` = `amount` + ? WHERE `user_id` = ? AND `product_name` = ?";
    if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
        die("Error1 : " . mysqli_error($mysqli));
    }
    if (mysqli_stmt_bind_param($stmt, "sss", $singleProduct[0], $_SESSION['login'], $singleProduct[1]) === false) {
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

function deleteItemBasket() {
    $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
    if (!$mysqli) {
        echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
        echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
        echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    $query = "DELETE FROM `basket` WHERE `product_name` = ? AND `user_id` = ?";
    if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
        die("Error1 : " . mysqli_error($mysqli));
    }
    if (mysqli_stmt_bind_param($stmt, "ss", $_POST['product'], $_SESSION['login']) === false) {
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

function deleteBasket() {
    $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
    if (!$mysqli) {
        echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
        echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
        echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    $query = "DELETE FROM `basket` WHERE `user_id` = ?";
    if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
        die("Error1 : " . mysqli_error($mysqli));
    }
    if (mysqli_stmt_bind_param($stmt, "s", $_SESSION['login']) === false) {
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

function selectItemsBasketAmount() {
    $amount = 0;
    $here = 0;
    $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
        if (!$mysqli) {
            echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
            echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
            echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        $query = "SELECT `amount` FROM `basket` WHERE `user_id` = ? AND `product_name` = ?";
        if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
            die("Error1 : " . mysqli_error($mysqli));
        }
        if (mysqli_stmt_bind_param($stmt, "ss", $_SESSION['login'], $_POST['product']) === false) {
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

function updateProductsLeft() {
    $amount = selectItemsBasketAmount();
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
?>