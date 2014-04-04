<?php

namespace Promaker\Component\Blog\Entity;

use Promaker\Base\Entity\IEntity;

/**
* 
*/
class Comment implements IEntity
{
    private $id;
    private $postId;
    private $name;
    private $email;
    private $comment;
    private $createdAt;

    public function __construct($data = array())
    {
        if (isset($data['ID'])) {
            $this->setId($data['ID']);
        }

        if (isset($data['ID_Post'])) {
            $this->setPostId($data['ID_Post']);
        }

        if (isset($data['Name'])) {
            $this->setName($data['Name']);
        }

        if (isset($data['Email'])) {
            $this->setEmail($data['Email']);
        }

        if (isset($data['Comment'])) {
            $this->setComment($data['Comment']);
        }

        if (isset($data['createdAt'])) {
            $this->setcreatedAt($data['createdAt']);
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
     * Gets the value of postId.
     *
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Sets the value of postId.
     *
     * @param mixed $postId the post id
     *
     * @return self
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;

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
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param mixed $email the email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the value of text.
     *
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Sets the value of text.
     *
     * @param mixed $comment the text
     *
     * @return self
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Gets the value of createdAt.
     *
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Sets the value of createdAt.
     *
     * @param mixed $createdAt the created at
     *
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
