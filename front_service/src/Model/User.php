<?php

namespace FrontApp\Model;

class User
{
    protected int $id_user;
    protected string $pseudo;
    protected ?string $pwd;
    protected ?string $conf_pwd;
    protected string $email;
    protected string $created_at;

    public function toArray(): array
    {
        return [
            'pseudo' => $this->pseudo,
            'pwd' => $this->pwd,
            'email' => $this->email
        ];
    }

    public static function fromArray(array $user): User
    {
        $u = new User();
        return $u->setIdUser($user['id_user'])
            ->setPseudo($user['pseudo'])
            ->setEmail($user['email'])
            ->setCreatedAt($user['created_at']);
    }

    /**
     * Hash un mot de passe, passé en paramètre, avant de l'assigner à la propriété pwd.
     *
     * @param string $pwd Mot de passe à hacher
     */
    public function setHashPwd(string $pwd): self
    {
        $this->pwd = password_hash($pwd, PASSWORD_ARGON2I);

        return $this;
    }

    /**
     * Vérifie la correspondance de la propriété pwd avec une chaîne de caractère fourni
     *
     * @param string $pwd Chaîne de caractère à vérifier
     * @return bool Renvoi true si la correspondance est vrai, sinon false
     */
    public function verifyPwd(string $pwd): bool
    {
        return password_verify($pwd, $this->pwd);
    }

    /**
     * Suppression du mot de passe de la propriété de l'objet
     */
    public function erasePwd()
    {
        $this->pwd = null;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     */
    public function setIdUser(int $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * @return string
     */
    public function getPwd(): string
    {
        return $this->pwd;
    }

    /**
     * @param string $pwd
     */
    public function setPwd(string $pwd): self
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * @return string
     */
    public function getConfPwd(): string
    {
        return $this->conf_pwd;
    }

    /**
     * @param string $conf_pwd
     */
    public function setConfPwd(string $conf_pwd): self
    {
        $this->conf_pwd = $conf_pwd;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt(string $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
