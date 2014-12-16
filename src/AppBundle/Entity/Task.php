<?php

namespace AppBundle\Entity;

use AppBundle\Exception\InvalidStatusException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 */
class Task
{
    const STATUS_OPEN = 1;
    const STATUS_PROGRESS = 2;
    const STATUS_DONE = 3;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $importance;

    /**
     * @var integer
     */
    private $status = self::STATUS_OPEN;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Task
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set description
     *
     * @param string $description
     *
     * @return Task
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set importance
     *
     * @param integer $importance
     *
     * @return Task
     */
    public function setImportance($importance)
    {
        $this->importance = $importance;

        return $this;
    }

    /**
     * Get importance
     *
     * @return integer
     */
    public function getImportance()
    {
        return $this->importance;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @throws InvalidStatusException
     * @return Task
     */
    public function setStatus($status)
    {
        if (!in_array($status, array(self::STATUS_OPEN, self::STATUS_PROGRESS, self::STATUS_DONE))) {
            throw new InvalidStatusException('Status is invalid');
        }

        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }
}
