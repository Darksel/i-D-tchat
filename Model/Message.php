<?php

require_once 'Core/Model.php';
require_once 'Model/User.php';

/**
 * Class Message
 * Message Model
 *
 * @author Joseph Selven
 */
class Message extends Model
{
    protected $id;
    protected $userId;
    protected $content;
    protected $user;

    public function __construct(array $data = [])
    {
        if (isset($data['id'])) {
            $this->setId($data['id']);
        }

        if (isset($data['content'])) {
            $this->setContent($data['content']);
        }

        if (isset($data['user_id'])) {
            $this->setUserId($data['user_id']);
            $this->user = new User($data);
        }
    }

    /**
     * Get all messages
     *
     * @return array
     */
    public function getAll()
    {
        $sql = 'SELECT message.id AS id, content, user_id, name FROM message
                INNER JOIN user ON message.user_id = user.id
                GROUP BY message.id';

        $results = self::getDB()->query($sql);
        $messages = [];

        foreach ($results as $data) {
            $messages[] = new Message($data);
        }

        return $messages;
    }

    /**
     * save message in the database
     *
     * @param $userId
     * @param $content
     *
     * @return string
     */
    public function save($userId, $content)
    {
        $sql = 'INSERT INTO message(user_id, content) VALUES(:user_id, :content)';

        $req = self::getDB()->prepare($sql);
        $req->execute([
            'user_id' => $userId,
            'content' => $content
        ]);

        return self::getDB()->lastInsertId();
    }

    /**
     * Get tchat messages, select only 50 last row
     *
     * @return array
     */
    public function getTchatMessages()
    {
        $sql = 'SELECT * FROM (
                    SELECT message.id AS id, content, user_id, name FROM message
                    INNER JOIN user ON message.user_id = user.id
                    GROUP BY message.id
                    ORDER BY id DESC
                    LIMIT 50
                ) sub ORDER BY id ';

        $results = self::getDB()->query($sql);
        $messages = [];

        foreach ($results as $data) {
            $messages[] = new Message($data);
        }

        return $messages;
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
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}
