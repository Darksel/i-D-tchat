<?php

/**
 * Class AuthService
 * Check if user exists and is already authenticate or not
 *
 * @author Joseph Selven
 */
class AuthService
{
    protected $isAuth = false;
    protected $user;
    protected $userModel;

    public function __construct()
    {
        session_start();

        $this->userModel = new User();

        if (isset($_SESSION['userId']) && $user = $this->userModel->getById($_SESSION['userId'])) {
            $this->isAuth = true;
            $this->user = $user;
        }
    }

    /**
     * @return bool
     */
    public function getIsAuth()
    {
        return $this->isAuth;
    }

    /**
     * @return bool
     */
    public function getUser()
    {
        return $this->user;
    }
}
