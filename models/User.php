<?php
require_once __DIR__ . '/../core/Model.php';
class User extends Model
{
    public static function findByEmail(string $email): array
    {
        $db = self::getDB();
        $stmt = $db->prepare("
        SELECT u.*, r.libelle AS role_libelle
        FROM utilisateurs u
        JOIN roles r ON u.role_id = r.role_id
        WHERE u.email = ?
    ");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id): array
    {
        $db = self::getDB();
        $stmt = $db->prepare("
        SELECT u.*, r.libelle AS role_libelle
        FROM utilisateurs u
        JOIN roles r ON u.role_id = r.role_id
        WHERE u.utilisateur_id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findByUsername(string $username)
    {
        $db = self::getDB();
        $stmt = $db->prepare("
                SELECT u.*, r.libelle AS role_libelle
        FROM utilisateurs u
        JOIN roles r ON u.role_id = r.role_id
        WHERE u.pseudo = ?
        ");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAll(): array
    {
        $db = self::getDB();
        $stmt = $db->query("
        SELECT u.*, r.libelle AS role_libelle
        FROM utilisateurs u
        JOIN roles r ON u.role_id = r.role_id
        ORDER BY u.nom, u.prenom
    ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $data): bool
    {
        $db = self::getDB();

        $stmt = $db->prepare("
        INSERT INTO utilisateurs 
        (pseudo, nom, prenom, email, password, adresse, date_naissance, photo, role_id)
        VALUES 
        (:pseudo, :nom, :prenom, :email, :password, :adresse, :date_naissance, :photo, :role_id)
    ");

        try {
            $stmt->execute([
                ':pseudo' => $data['pseudo'],
                ':nom' => $data['nom'],
                ':prenom' => $data['prenom'],
                ':email' => $data['email'],
                ':password' => $data['password'],
                ':adresse' => $data['adresse'],
                ':date_naissance' => $data['date_naissance'],
                ':photo' => $data['photo'] ?? null,
                ':role_id' => $data['role_id'] ?? 1
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Erreur PDO dans la fonction User::create() : " . $e->getMessage());
            return false;
        }
    }

    public static function update(array $data): bool
    {

    }

    public static function delete(int $id): bool
    {

    }

    public static function updatePassword(int $id, string $password): bool
    {

    }

    public static function updateRole(int $id, string $role): bool
    {

    }

    //Bool qui définit si l'email ou le pseydo est déjà utilisé.
    public static function checkUnicity(string $column, string $value): bool {
        $db = self::getDB();

        $allowed = ['email', 'pseudo'];
        if (!in_array($column, $allowed)) {
            throw new InvalidArgumentException("Maivaise colonne pasée en parametre sale shlag");
        }

        $stmt = $db->prepare("SELECT COUNT(*) FROM utilisateurs WHERE $column = ?");
        $stmt->execute([$value]);
        return $stmt->fetchColumn() == 0;
    }


}