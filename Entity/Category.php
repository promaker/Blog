<?php

namespace Promaker\Component\Blog\Entity;

use Promaker\Base\Entity\IEntity;

/**
* 
*/
class Category implements IEntity
{
    protected $id;
    protected $name;
    protected $online;

    public function __construct($data = array())
    {
        if (isset($data['ID'])) {
            $this->setId($data['ID']);
        }

        if (isset($data['Nombre'])) {
            $this->setName($data['Nombre']);
        }

        if (isset($data['Online'])) {
            $this->setOnline($data['Online']);
        }
    }

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of name.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the value of name.
     *
     * @param mixed $name the name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the value of online.
     *
     * @return mixed
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * Sets the value of online.
     *
     * @param mixed $online the online
     *
     * @return self
     */
    public function setOnline($online)
    {
        $this->online = $online;

        return $this;
    }
}