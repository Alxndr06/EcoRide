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
                ':pseudo'         => $data['pseudo'],
                ':nom'            => $data['nom'],
                ':prenom'         => $data['prenom'],
                ':email'          => $data['email'],
                ':password'       => $data['password'],
                ':adresse'        => $data['adresse'],
                ':date_naissance' => $data['date_naissance'],
                ':photo'          => $data['photo'] ?? null,
                ':role_id'        => $data['role_id'] ?? 1,
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Erreur PDO dans User::create() : " . $e->getMessage());
            return false;
        }
    }

    public static function update(array $data): bool
    {
        $db = self::getDB();
        // On s'assure de toujours avoir l'ID
        if (empty($data['utilisateur_id'])) {
            throw new InvalidArgumentException("L'identifiant utilisateur est requis pour la mise à jour.");
        }
        $fields = [];
        $params = [];
        $allowed = ['pseudo', 'nom', 'prenom', 'email', 'adresse', 'date_naissance', 'photo'];
        foreach ($allowed as $col) {
            if (isset($data[$col])) {
                $fields[] = "`$col` = :$col";
                $params[":$col"] = $data[$col];
            }
        }
        if (empty($fields)) {
            // Rien à mettre à jour
            return false;
        }
        $params[':id'] = $data['utilisateur_id'];
        $sql = "UPDATE utilisateurs SET " . implode(', ', $fields) . " WHERE utilisateur_id = :id";
        $stmt = $db->prepare($sql);
        try {
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Erreur PDO dans User::update() : " . $e->getMessage());
            return false;
        }
    }

    public static function delete(int $id): bool
    {
        $db = self::getDB();
        $stmt = $db->prepare("DELETE FROM utilisateurs WHERE utilisateur_id = ?");
        try {
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Erreur PDO dans User::delete() : " . $e->getMessage());
            return false;
        }
    }

    public static function updatePassword(int $id, string $password): bool
    {
        $db = self::getDB();
        $stmt = $db->prepare("
            UPDATE utilisateurs
            SET password = :password
            WHERE utilisateur_id = :id
        ");
        try {
            return $stmt->execute([
                ':password' => $password,
                ':id'       => $id,
            ]);
        } catch (PDOException $e) {
            error_log("Erreur PDO dans User::updatePassword() : " . $e->getMessage());
            return false;
        }
    }

    public static function updateRole(int $id, string $roleLibelle): bool
    {
        $db = self::getDB();

        $stmt = $db->prepare("SELECT role_id FROM roles WHERE libelle = ?");
        $stmt->execute([$roleLibelle]);
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$role) {
            return false;
        }
        $stmt2 = $db->prepare("
            UPDATE utilisateurs
            SET role_id = :role_id
            WHERE utilisateur_id = :id
        ");
        try {
            return $stmt2->execute([
                ':role_id' => $role['role_id'],
                ':id'      => $id,
            ]);
        } catch (PDOException $e) {
            error_log("Erreur PDO dans User::updateRole() : " . $e->getMessage());
            return false;
        }
    }

    // Bool qui définit si l'email ou le pseudo est déjà utilisé.
    public static function checkUnicity(string $column, string $value): bool {
        $db = self::getDB();
        $allowed = ['email', 'pseudo'];
        if (!in_array($column, $allowed)) {
            throw new InvalidArgumentException("Mauvaise colonne passée en paramètre.");
        }
        $stmt = $db->prepare("SELECT COUNT(*) FROM utilisateurs WHERE `$column` = ?");
        $stmt->execute([$value]);
        return $stmt->fetchColumn() == 0;
    }
}