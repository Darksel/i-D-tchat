<?php

require_once 'Core/Model.php';

class User extends Model
{
    protected $id;
    protected $name;
    protected $password;

    public function __construct(array $data = [])
    {
        if (isset($data['id'])) {
            $this->setId($data['id']);
        }

        if (isset($data['user_id'])) {
            $this->setId($data['user_id']);
        }

        if (isset($data['name'])) {
            $this->setName($data['name']);
        }

        if (isset($data['password'])) {
            $this->setPassword($data['password']);
        }
    }

    /**
     * Create User in the database
     *
     * @param $name
     * @param $password
     *
     * @return string
     */
    public function save($name, $password)
    {
        $sql = 'INSERT INTO user(name, password) VALUES(:name, :password)';

        $req = self::getDB()->prepare($sql);
        $req->execute([
            'name' => $name,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        return self::getDB()->lastInsertId();
    }

    /**
     * Get User by id
     *
     * @param $id
     *
     * @return bool|User
     */
    public function getById($id)
    {
        $sql = 'SELECT id, name FROM user WHERE id = :id';

        $req = self::getDB()->prepare($sql);
        $req->execute([
            'id' => $id
        ]);

        $result = $req->fetch();

        if ($result != false) {
            return new User($result);
        }

        return false;
    }

    /**
     * Check if the user name exist
     *
     * @param $name
     *
     * @return bool
     */
    public function checkIfNameAlreadyExist($name)
    {
        $sql = 'SELECT name FROM user WHERE name = :name';

        $req = self::getDB()->prepare($sql);
        $req->execute([
            'name' => $name
        ]);

        if ($req->rowCount() > 0) {
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
