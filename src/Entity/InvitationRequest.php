<?php

namespace App\Entity;

use App\Repository\InvitationRequestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvitationRequestRepository::class)
 */
class InvitationRequest
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @ORM\Column(type="datetime")
     */
    private $requested_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expires_at;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="InvitationRequest", cascade={"persist", "remove"})
     */
    private $user;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getRequestedAt(): ?\DateTimeInterface
    {
        return $this->requested_at;
    }

    public function setRequestedAt(\DateTimeInterface $requested_at): self
    {
        $this->requested_at = $requested_at;

        return $this;
    }

    public function getExpiresAt(): ?\DateTimeInterface
    {
        return $this->expires_at;
    }

    public function setExpiresAt(\DateTimeInterface $expires_at): self
    {
        $this->expires_at = $expires_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        // set (or unset) the owning side of the relation if necessary
        $newInvitationRequest = null === $user ? null : $this;
        if ($user->getInvitationRequest() !== $newInvitationRequest) {
            $user->setInvitationRequest($newInvitationRequest);
        }

        return $this;
    }




}
