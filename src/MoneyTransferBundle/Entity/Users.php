<?php

namespace MoneyTransferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @package MoneyTransfer\Entity
 * @ORM\Table(name="users")
 */
class Users
{
    /**
     * @var string
     * @ORM\Column(length=255)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="balance", type="decimal", precision=10, scale=2)
     */
    private $balance;

    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set balance
     *
     * @param string $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * Get balance
     *
     * @return string
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
