<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use libphonenumber\PhoneNumber;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="Il existe déjà un compte avec cet email.")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Assert\Type("int")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Type("string")
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas valide."
     * )
     * @Assert\Length(
     *      min = 5,
     *      max = 180,
     *      minMessage = "L'email doit au moins faire {{ limit }} caractères.",
     *      maxMessage = "L'email doit fait au maximum {{ limit }} caractères.",
     *      allowEmptyString = false
     * )
     * @Assert\NotBlank(message="Veuillez renseigner un email.")
     * @Assert\NotNull(message="Veuillez renseigner un email.")
     * @Assert\Regex(
     * pattern = "/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ",
     * match=true,
     * message="L'adresse mail n'est pas valide")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Assert\Type("array")
     * @Assert\NotBlank(message="Veuilpopolez ajouter un rôle.")
     * @Assert\NotNull(message="Veuillez ajouter un rôle.")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Type("string")
     * @Assert\Length(
     *      min = 5,
     *      max = 255,
     *      minMessage = "Le mot de passe doit au moins faire {{ limit }} caractères.",
     *      maxMessage = "Le mot de passe doit fait au maximum {{ limit }} caractères.",
     *      allowEmptyString = false
     * )
     * @Assert\NotBlank(message="Veuillez renseigner un mot de passe.")
     * @Assert\NotNull(message="Veuillez renseigner un mot de passe.")
     *
     * @Assert\Regex(
     * pattern = "/^(?=.*\d)(?=.*[A-Z])(?=.*[@#$%])(?!.*(.)\1{2}).*[a-z]/m",
     * match=true,
     * message="Votre mot de passe doit comporter au moins huit caractères, dont des lettres majuscules et minuscules, un chiffre et un symbole.")
     */

    private $password;


    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type(type="bool")
     * @Assert\NotNull
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="phone_number")
     * @Assert\Type (
     *     type = "phone_number",
     *      message = "ta mère"
     * )
     *
     * @Assert\NotBlank(message="Veuillez renseigner un numéro de téléphone.")
     * @Assert\NotNull(message="Veuillez renseigner  un numéro de téléphone.")
     *
     * @Assert\Regex(
     * pattern = "/^\+(?:[0-9] ?){6,14}[0-9]$/",
     * match=true,
     * message="{{ value }} n'est pas un numéro de téléphone valide.")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Veuillez renseigner un nom d'au moins {{ limit }} caractères.",
     *      maxMessage = "Veuillez renseigner un nom d'au maximum {{ limit }} caractères.",
     *      allowEmptyString = false
     * )
     * @Assert\NotBlank(message="Veuillez renseigner un nom.")
     * @Assert\NotNull(message="Veuillez renseigner  un nom.")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Le nom ne peux pas contenir de nombre."
     * )
     */
    private $username;



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
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return $this->username;
    }


    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;


        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
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


    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getPhone(): ?PhoneNumber
    {

        return $this->phone;
    }

    public function setPhone(PhoneNumber $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
}
