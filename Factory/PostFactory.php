<?php

namespace Promaker\Component\Blog\Factory;

use Promaker\Base\Factory\IFactory;
use Promaker\Component\Blog\Entity\Post;
use Promaker\Component\Blog\Factory\CategoryFactory;

/**
* 
*/
class PostFactory implements IFactory
{
    
    public function make($data)
    {
        if (isset($data['Category']) && is_array($data['Category'])) {
            $categoryFactory  = new CategoryFactory();
            $data['Category'] = $categoryFactory->make($data['Category']);
        }

        if (isset($data['Comments']) && is_array($data['Comments'])) {
            $commentFactory  = new CommentFactory();
            $data['Comments'] = $commentFactory->makeAll($data['Comments']);
        }

        return new Post($data);
    }

    public function makeAll($collection)
    {
        $list = array();
        $categoryFactory  = new CategoryFactory();
        $commentFactory  = new CommentFactory();

        foreach ($collection as $data) {
            if (isset($data['Category']) && is_array($data['Category'])) {
                $data['Category'] = $categoryFactory->make($data['Category']);
            }

            if (isset($data['Comments']) && is_array($data['Comments'])) {
                $data['Comments'] = $commentFactory->makeAll($data['Comments']);
            }

            $list[] = new Post($data);
        }

        return $list;
    }
}
