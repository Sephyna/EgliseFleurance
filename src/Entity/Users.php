<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;



    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;



    /**
     * @ORM\ManyToOne(targetEntity=Roles::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $roles;

    /**
     * @ORM\OneToOne(targetEntity=InvitationRequest::class, mappedBy="users", cascade={"persist", "remove"})
     */
    private $invitationRequest;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }


    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    public function getRoles(): ?roles
    {
        return $this->roles;
    }

    public function setRole(?roles $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getInvitationRequest(): ?InvitationRequest
    {
        return $this->invitationRequest;
    }

    public function setInvitationRequest(?InvitationRequest $invitationRequest): self
    {
        $this->invitationRequest = $invitationRequest;

        // set (or unset) the owning side of the relation if necessary
        $newUsers = null === $invitationRequest ? null : $this;
        if ($invitationRequest->getUsers() !== $newUsers) {
            $invitationRequest->setUsers($newUsers);
        }

        return $this;
    }
}
