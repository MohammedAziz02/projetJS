<?php

namespace gestionclub\DAO;

use PDO;
use PDOException;

use gestionclub\Helpers\DatabaseConnection;
use gestionclub\Models\Admin;
// require __DIR__ . "/../../vendor/autoload.php";


class AdminDAO {
    private static $db;

    private static function initialize() {
        self::$db = DatabaseConnection::getInstance()->getConnection();
    }

    public static function getAdminByEmail($email) {
        try {

            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "SELECT * FROM Admin WHERE email = ?";
            $stmt = self::$db->prepare($query);
            $stmt->execute([$email]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $membre = new Admin(
                    $result['idAdmin'],
                    $result['username'],
                    $result['email'],
                    $result['password']
                );

                return $membre;
            } else {
                // echo "here";
                return null;
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

}
?>