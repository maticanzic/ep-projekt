<?php
    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');
    header("X-XSS-Protection: 1; mode=block");
    require_once("model/OrderArticleDB.php");
    require_once("ViewHelper.php");

    class OrderArticlesController {
        public static function getOrderArticlesById($id) {
            return OrderArticleDB::get(["id_order" => $id]);
        }
        
        /*public static function get($id) {
            echo ViewHelper::render("view/order-detail.php", OrderDB::get(["id" => $id]));
        }

        public static function index() {
            echo ViewHelper::render("view/order-list.php", [
                "orders" => OrderArticleDB::getAll()
            ]);
        }

        public static function addForm($values = [
            "id_user" => "",
            "id_seller" => "",
            "status" => 0
        ]) {
            echo ViewHelper::render("view/order-add.php", $values);
        }*/

        public static function add($values) {
            $data = array_filter($values, "self::getRules");

            if (self::checkValues($data)) {
                $id = OrderArticleDB::insert($data);
            } else {
                echo ViewHelper::redirect(BASE_URL . "articles");
            }
        }


        public static function delete($id) {
            $data = filter_input_array(INPUT_POST, [
                'delete_confirmation' => FILTER_REQUIRE_SCALAR
            ]);

            if (self::checkValues($data)) {
                OrderArticlesDB::delete(["id" => $id]);
                $url = BASE_URL . "orders";
            } else {
                $url = BASE_URL . "orders/edit/" . $id;
            }

            ViewHelper::redirect($url);
        }

        /**
         * Returns TRUE if given $input array contains no FALSE values
         * @param type $input
         * @return type
         */
        public static function checkValues($input) {
            if (empty($input)) {
                return FALSE;
            }

            $result = TRUE;
            foreach ($input as $value) {
                $result = $result && $value !== false;
            }

            return $result;
        }

        /**
         * Returns an array of filtering rules for manipulation orders
         * @return type
         */
        public static function getRules() {
            return [
                'id_order' => FILTER_SANITIZE_NUMBER_INT,
                'id_article' => FILTER_SANITIZE_NUMBER_INT,
                'amount' => FILTER_SANITIZE_NUMBER_INT
            ];
        }
    }
?>