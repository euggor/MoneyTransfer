<?php

namespace MoneyTransferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comments
 *
 * @package MoneyTransfer\Entity
 * @ORM\Table(name="comments")
 */
class Comments
{
    /**
     * @var integer
     */
    private $userId;

    /**
     * @var string
     */
    private $text;

    /**
     * @var integer
     */
    private $id;

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Comments
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Comments
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
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
