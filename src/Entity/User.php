<?php

namespace App\Entity;

use App\Dto\HashPasswordDto;
use App\ValueObject\Uuid;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    private Uuid $id;
    private ?Account $account = null;
    private string $password;

    public function __construct(
        private string $name,
        private readonly string $login,
        HashPasswordDto $hashPasswordDto
    ) {
        $this->id = Uuid::create();
        $this->setPassword($hashPasswordDto);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(Account $account): void
    {
        $account->setUser($this);
        $this->account = $account;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(HashPasswordDto $dto): void {
        $this->password = $dto->hasher->hash($dto->password);
    }

    public function getRoles(): array
    {
        return ['USER'];
    }

    public function eraseCredentials()
    {
        return null;
    }

    public function getUserIdentifier(): string
    {
        return $this->login;
    }
}