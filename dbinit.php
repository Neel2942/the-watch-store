<?php
class DatabaseConnection
{
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB_HOST = 'localhost:3308';
    const DB_NAME = 'thewatchstore';

    private $dbc;

    function __construct()
    {
        $this->dbc = @mysqli_connect(
            self::DB_HOST,
            self::DB_USER,
            self::DB_PASSWORD,
            self::DB_NAME
        )
            or die('Could not connect to MySQL: ' . mysqli_connect_error());

        mysqli_set_charset($this->dbc, 'utf8');
    }

    function prepare_string($string)
    {
        $string = strip_tags($string);
        $string = mysqli_real_escape_string($this->dbc, trim($string));
        return $string;
    }
    function get_dbc()
    {
        return $this->dbc;
    }
    //Get all province from database
    function get_all_province()
    {
        $query = 'SELECT * FROM province;';
        $result = @mysqli_query($this->dbc, $query);
        return $result;
    }
    //Get city of a specific province from database
    function get_city($provinceID)
    {
        $query = "SELECT * FROM city WHERE provinceID = ?;";
        $stmt = mysqli_prepare($this->dbc, $query);
        mysqli_stmt_bind_param(
            $stmt,
            'i',
            $provinceID
        );

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    }
    //Register user
    function register_user($firstName, $lastName, $phone, $address, $postalCode, $provinceID, $cityID, $email, $password)
    {

        $firstName_clean = $this->prepare_string($firstName);
        $lastName_clean = $this->prepare_string($lastName);
        $phone_clean = $this->prepare_string($phone);
        $address_clean = $this->prepare_string($address);
        $postal_code_clean = $this->prepare_string($postalCode);
        $provinceID_clean = $this->prepare_string($provinceID);
        $cityID_clean = $this->prepare_string($cityID);
        $email_clean = $this->prepare_string($email);
        $password_clean = $this->prepare_string($password);

        $query = "INSERT INTO users (firstName, lastName, phone, address, postalcode, provinceID, cityID, email, password) VALUES (?,?,?,?,?,?,?,?);";

        $stmt = mysqli_prepare($this->dbc, $query);

        mysqli_stmt_bind_param(
            $stmt,
            'sssssiiss',
            $firstName_clean,
            $lastName_clean,
            $phone_clean,
            $address_clean,
            $postal_code_clean,
            $provinceID_clean,
            $cityID_clean,
            $email_clean,
            $password_clean
        );

        $result = mysqli_stmt_execute($stmt);

        return $result;
    }
    //Check if email already exist or not in database
    function check_email($email)
    {
        $query = "SELECT * FROM users WHERE email = ?;";
        $stmt = mysqli_prepare($this->dbc, $query);
        mysqli_stmt_bind_param(
            $stmt,
            's',
            $email
        );

        $result =  mysqli_stmt_execute($stmt);
        return $result;
    }
    //Login user
    function login_user($email, $password)
    {
        $query = "SELECT * FROM users WHERE email = ?;";
        $stmt = mysqli_prepare($this->dbc, $query);
        mysqli_stmt_bind_param(
            $stmt,
            's',
            $email
        );

        $result =  mysqli_stmt_execute($stmt);
        $stmt->close();

        if ($result) {
            $query2 = "SELECT * FROM users WHERE email = ? and password = ?;";
            $stmt2 = mysqli_prepare($this->dbc, $query2);
            mysqli_stmt_bind_param(
                $stmt2,
                'ss',
                $email,
                $password
            );
            mysqli_stmt_execute($stmt2);
            $result2 = mysqli_stmt_get_result($stmt2);
            return $result2;
        }
    }
    //Get user by id from database
    function get_user_by_id($userID)
    {
        $query = 'SELECT firstname,lastname,phone,address,email,postalcode,provinceID,cityID FROM users WHERE id = ?;';
        $stmt = mysqli_prepare($this->dbc, $query);
        mysqli_stmt_bind_param(
            $stmt,
            'i',
            $userID
        );
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    }
    //Get all watches from database
    function get_watches()
    {
        $query = 'SELECT watchID,model,brand,description,price,imageURL FROM watches;';
        $result = @mysqli_query($this->dbc, $query);
        return $result;
    }
    //Get watches category from database
    function get_watch_categories()
    {
        $query = 'SELECT * FROM categories;';
        $result = @mysqli_query($this->dbc, $query);
        return $result;
    }
    //Get watches of a specific category from database
    function sort_watches_by_categories($categoryID)
    {
        $categoryID_clean = $this->prepare_string($categoryID);
        if ($categoryID_clean === "allwatch") {
            $query = 'SELECT watchID,brand,description,price,imageURL FROM watches;';
            $result = @mysqli_query($this->dbc, $query);
            return $result;
        } else {
            $query = 'SELECT watchID,model,brand,description,price,imageURL FROM watches w,categories c WHERE w.categoryID = c.categoryID AND w.categoryID = ?;';
            $stmt = mysqli_prepare($this->dbc, $query);
            mysqli_stmt_bind_param(
                $stmt,
                'i',
                $categoryID_clean
            );

            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            return $result;
        }
    }
    //Get category and brand of watches from database
    function get_watches_brand_and_categories($catName)
    {
        $name = $catName;
        $query = 'SELECT watchID,brand,description,categoryName,imageURL FROM watches w,categories c WHERE w.categoryID = c.categoryID AND c.categoryName = ?;';
        $stmt = mysqli_prepare($this->dbc, $query);
        mysqli_stmt_bind_param(
            $stmt,
            's',
            $name
        );

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    }
    //Insert into cart
    function insert_cart($watchID, $price, $userID)
    {
        $query = "SELECT * FROM cart WHERE watchID=? AND userID=?";
        $stmt = mysqli_prepare($this->dbc, $query);
        mysqli_stmt_bind_param(
            $stmt,
            'ii',
            $watchID,
            $userID
        );
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $numRows = 0;
        while ($row = mysqli_fetch_array($result)) {
            $numRows++;
        }
        $stmt->close();
        if ($numRows == 0) {
            $query2 = 'INSERT INTO cart(watchID, price, userID) VALUES (?,?,?);';
            $stmt2 = mysqli_prepare($this->dbc, $query2);
            mysqli_stmt_bind_param(
                $stmt2,
                'iii',
                $watchID,
                $price,
                $userID
            );
            $result2 = mysqli_stmt_execute($stmt2);
            return $result2;
        } else {
            $query3 = 'UPDATE cart SET productQuantity = productQuantity + 1 WHERE watchID = ?;';
            $stmt3 = mysqli_prepare($this->dbc, $query3);
            mysqli_stmt_bind_param(
                $stmt3,
                'i',
                $watchID,
            );
            $result3 = mysqli_stmt_execute($stmt3);
            return $result3;
        }
    }
    //Get items from cart database
    function get_cart()
    {
        $query = 'SELECT * FROM cart where userID=0 and orderProductID=0;';
        $result = @mysqli_query($this->dbc, $query);
        return $result;
    }
    //Get cart of a particular user from database
    function get_cart_by_user($userID)
    {
        $query = 'SELECT * FROM cart where userID=? and orderProductID=0;';
        $stmt = mysqli_prepare($this->dbc, $query);
        mysqli_stmt_bind_param(
            $stmt,
            'i',
            $userID
        );
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    }
    //Delete cart from database
    function delete_cart($cartID)
    {
        $query = 'DELETE FROM cart WHERE cartID=?;';
        $stmt = mysqli_prepare($this->dbc, $query);
        mysqli_stmt_bind_param(
            $stmt,
            'i',
            $cartID
        );
        $result = mysqli_stmt_execute($stmt);
        return $result;
    }
    //Insert into orderitem
    function insert_orderitem($price, $quantity, $watchID, $cartID, $userID)
    {
        $query = 'INSERT INTO orderitem(orderProductPrice,orderProductQuantity,watchID,cartID,userID) VALUES (?,?,?,?,?);';
        $stmt = mysqli_prepare($this->dbc, $query);
        mysqli_stmt_bind_param(
            $stmt,
            'iiiii',
            $price,
            $quantity,
            $watchID,
            $cartID,
            $userID
        );
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    }
    //Get watch from cart and orderitem for checkout
    function get_watch_for_checkout($userID)
    {
        $query = "SELECT * FROM watches w,orderitem o WHERE o.watchID=w.watchID AND orderproductid=0 AND userID = ?";
        $stmt = mysqli_prepare($this->dbc, $query);
        mysqli_stmt_bind_param(
            $stmt,
            'i',
            $userID
        );
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    }
    //Insert into orderproduct and updating orderitem
    function insert_orderproduct($userID, $firstName, $lastName, $email, $phone, $address, $provinceName, $cityName, $postalCode, $subTotal, $grandTotal)
    {
        $query = "INSERT INTO orderproduct(userid, firstName, lastName, email, phone, address, province, city, postalcode, subtotal, grandtotal) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($this->dbc, $query);

        mysqli_stmt_bind_param(
            $stmt,
            'issssssssii',
            $userID,
            $firstName,
            $lastName,
            $email,
            $phone,
            $address,
            $provinceName,
            $cityName,
            $postalCode,
            $subTotal,
            $grandTotal
        );

        $result =  mysqli_stmt_execute($stmt);
        if ($result) {
            $id = mysqli_insert_id($this->dbc);
        }
        $stmt->close();
        //Updadting orderitem in database
        $result2 = $this->get_watch_for_checkout($userID);
        while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            $query2 = "UPDATE orderitem SET orderProductID=$id WHERE orderItemID=?";
            $stmt2 = mysqli_prepare($this->dbc, $query2);
            mysqli_stmt_bind_param(
                $stmt2,
                'i',
                $row['orderItemID']
            );
            mysqli_stmt_execute($stmt2);
            $result = mysqli_stmt_get_result($stmt2);
        }
        //Updating cart in database
        $result3 = $this->get_cart_by_user($userID);
        while ($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
            $query3 = "UPDATE cart SET orderProductID=$id WHERE cartID=?";
            $stmt3 = mysqli_prepare($this->dbc, $query3);
            mysqli_stmt_bind_param(
                $stmt3,
                'i',
                $row['cartID']
            );
            mysqli_stmt_execute($stmt3);
            $result = mysqli_stmt_get_result($stmt3);
        }
        return $id;
    }
    //Customer invoice
    function customer_invoice($userID, $orderProductID)
    {
        $query = 'SELECT * FROM orderproduct op,orderitem oi,watches w WHERE oi.watchID = w.watchID AND op.orderProductID = oi.orderProductID AND op.userID = ? AND oi.orderProductID = ?;';
        $stmt = mysqli_prepare($this->dbc, $query);
        mysqli_stmt_bind_param(
            $stmt,
            'ii',
            $userID,
            $orderProductID
        );
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    }
}
