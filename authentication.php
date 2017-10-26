<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 23:19
 */

namespace elkroketto\taimi;

class Authentication
{

    public function __construct() {
        session_start();
    }

    /**
     * Checks if user owns a valid session identifier
     * @return bool
     */
    public function checkUserAuthenticated() {
        if (!isset($_SESSION['taimi_userSession']) || empty($_SESSION['taimi_userSession'])) {
            return false;
        }

        $sessionId = session_id();
        $sessionRepo = $GLOBALS['entityManager']->getRepository('elkroketto\taimi\UserSession');
        $session = $sessionRepo->findOneBy([
            'sessionId' => $sessionId
        ]);

        if ($session == null) {
            return false;
        }

        if ($session->getSessionClosed() !== null) {
            return false;
        }

        $timeNow = new \DateTime("now");
        if ($session->getSessionValidUntil() < $timeNow) {
            return false;
        }

        return true;
    }

    public function signIn($username, $password) {
        $userRepo = $GLOBALS['entityManager']->getRepository('elkroketto\taimi\User');
        $user = $userRepo->findOneBy([
            'username' => $username
        ]);

        if ($user == null) {
            return false;
        }

        if (password_verify($password, $user->getPasswordHash())) {
            $_SESSION['taimi_userSession'] = true;

            session_regenerate_id();

            $session = new UserSession();
            $session->setSessionId(session_id());
            $session->setSessionStartedAt(new \DateTime("now"));
            $session->setSessionValidUntil((new \DateTime("now"))->add(new \DateInterval("P1D")));
            $session->setSessionClientIP($_SERVER['REMOTE_ADDR']);

            $session->setUser($user);
            $user->getSessions()->add($session);

            $GLOBALS['entityManager']->persist($session);
            $GLOBALS['entityManager']->persist($user);

            $GLOBALS['entityManager']->flush();

            return true;
        } else {
            return false;
        }
    }

    public function signOut() {
        $sessionId = session_id();
        $sessionRepo = $GLOBALS['entityManager']->getRepository('elkroketto\taimi\UserSession');
        $session = $sessionRepo->findOneBy([
            'sessionId' => $sessionId
        ]);

        $session->setSessionValidUntil(new \DateTime("now"));
        $session->setSessionClosed(new \DateTime("now"));

        $GLOBALS['entityManager']->persist($session);
        $GLOBALS['entityManager']->flush();

        return false;
    }

    public static function createUserHash($username, $password) {
        $pwdHash = password_hash($password, PASSWORD_BCRYPT);

        return $pwdHash;
    }

}