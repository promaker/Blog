<?php

namespace Promaker\Component\Blog\Factory;

use Promaker\Base\Factory\IFactory;
use Promaker\Component\Blog\Entity\Category;

/**
* 
*/
class CategoryFactory implements IFactory
{
    
    public function make($data)
    {
        return new Category($data);
    }

    public function makeAll($collection)
    {
        $list = array();

        foreach ($collection as $data) {
            $list[] = new Category($data);
        }

        return $list;
    }
}
