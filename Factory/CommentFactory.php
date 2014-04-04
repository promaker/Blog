<?php

namespace Promaker\Component\Blog\Factory;

use Promaker\Base\Factory\IFactory;
use Promaker\Component\Blog\Entity\Comment;

/**
* 
*/
class CommentFactory implements IFactory
{
    
    public function make($data)
    {
        return new Comment($data);
    }

    public function makeAll($collection)
    {
        $list = array();

        foreach ($collection as $data) {
            $list[] = new Comment($data);
        }

        return $list;
    }
}
