<?php

namespace Promaker\Component\Blog\Entity;

use Promaker\Base\Entity\IEntity;
use Promaker\Component\Blog\Entity\Category;
use Promaker\Component\Blog\Entity\Comment;

/**
* Clase Post
*/
class Post implements IEntity
{
    protected $id;
    protected $title;
    protected $preview;
    protected $description;
    protected $img;
    protected $video;
    protected $link;
    
    /** 
     * @var Category
     */
    protected $category;

    /**
     * Array de Objectos Comment
     */
    protected $comments = array();
    protected $createdAt;
    protected $updatedAt;
    protected $online;
    protected $tags;

    public function __construct($data)
    {
        if (isset($data['ID'])) {
            $this->setId($data['ID']);
        }

        if (isset($data['Title'])) {
            $this->setTitle($data['Title']);
        }

        if (isset($data['Preview'])) {
            $this->setPreview($data['Preview']);
        }

        if (isset($data['Description'])) {
            $this->setDescription($data['Description']);
        }

        if (isset($data['Img'])) {
            $this->setImg($data['Img']);
        }

        if (isset($data['Video'])) {
            $this->setVideo($data['Video']);
        }

        if (isset($data['Link'])) {
            $this->setLink($data['Link']);
        }

        if (isset($data['Category']) && $data['Category'] instanceof Category) {
            $this->setCategory($data['Category']);
        }

        if (isset($data['Comments'])) {
            $this->setComments($data['Comments']);
        }

        if (isset($data['CreatedAt'])) {
            $this->setCreatedAt($data['CreatedAt']);
        }

        if (isset($data['UpdatedAt'])) {
            $this->setUpdatedAt($data['UpdatedAt']);
        }

        if (isset($data['Online'])) {
            $this->setOnline($data['Online']);
        }

        if (isset($data['Tags'])) {
            $this->setTags($data['Tags']);
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
     * Gets the value of title.
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the value of title.
     *
     * @param mixed $title the title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Gets the value of preview.
     *
     * @return mixed
     */
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * Sets the value of preview.
     *
     * @param mixed $preview the preview
     *
     * @return self
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;

        return $this;
    }

    /**
     * Gets the value of text.
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the value of text.
     *
     * @param mixed $description the text
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Gets the value of img.
     *
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Sets the value of img.
     *
     * @param mixed $img the img
     *
     * @return self
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Gets the value of video.
     *
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Sets the value of video.
     *
     * @param mixed $video the video
     *
     * @return self
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Gets the value of link.
     *
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Sets the value of link.
     *
     * @param mixed $link the link
     *
     * @return self
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Gets the value of category.
     *
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Sets the value of category.
     *
     * @param Category $category the category
     *
     * @return self
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Gets the value of comments.
     *
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Sets the value of comments.
     *
     * @param mixed $comments the comments
     *
     * @return self
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Sets the value of comment.
     *
     * @param Comment $comment the comment
     *
     * @return self
     */
    public function setComment(Comment $comment)
    {
        $this->comments[] = $comment;

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

    /**
     * Gets the value of updatedAt.
     *
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Sets the value of updatedAt.
     *
     * @param mixed $updatedAt the updated at
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

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

    /**
     * Gets the value of tags.
     *
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Sets the value of tags.
     *
     * @param mixed $tags the tags
     *
     * @return self
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }
}
