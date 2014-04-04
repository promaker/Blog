<?php

namespace Promaker\Component\Blog\Persistence;

use Promaker\Base\Persistence\APersistence;

use Promaker\Component\Blog\Repository\CommentRepository;
use Promaker\Component\Blog\Persistence\CommentPersistence;

use Promaker\Component\Blog\Repository\CategoryRepository;
use Promaker\Component\Blog\Persistence\CategoryPersistence;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
* 
*/
class PostAdoDbPersistence extends APersistence
{
    private $_db;
    private $_container;

    public function __construct($type, $host, $user, $pass, $db)
    {
        $vendorDir = FCPATH . 'vendor';

        require_once $vendorDir.'/adodb/adodb-php/adodb.inc.php';
        require_once $vendorDir.'/adodb/adodb-php/adodb-exceptions.inc.php';

        $this->_db = NewADOConnection($type);
        $this->_db->Connect($host, $user, $pass, $db);
        
        $this->_container = new ContainerBuilder();

        $this->_container->setParameter('db.type', $type);
        $this->_container->setParameter('db.host', $host);
        $this->_container->setParameter('db.user', $user);
        $this->_container->setParameter('db.pass', $pass);
        $this->_container->setParameter('db.db', $db);
        
        // Dependecy injection
        $this->_container
            ->register('CategoryPersistence', 'CategoryPersistence')
            ->addArgument('%db.type%')
            ->addArgument('%db.host%')
            ->addArgument('%db.user%')
            ->addArgument('%db.pass%')
            ->addArgument('%db.db%');

        $this->_container
            ->register('CategoryRepository', 'CategoryRepository')
            ->addArgument('@CategoryPersistence');
        
        $this->_container
            ->register('CommentPersistence', 'CommentPersistence')
            ->addArgument('%db.type%')
            ->addArgument('%db.host%')
            ->addArgument('%db.user%')
            ->addArgument('%db.pass%')
            ->addArgument('%db.db%');

        $this->_container
            ->register('CommentRepository', 'CommentRepository')
            ->addArgument('@CommentPersistence');
    }

    private function normalize(&$data)
    {
        if (!isset($data['ID'])) {
            $data['ID'] = null;
        }

        if (!isset($data['Title'])) {
            $data['Title'] = null;
        }

        if (!isset($data['Preview'])) {
            $data['Preview'] = null;
        }

        if (!isset($data['Description'])) {
            $data['Description'] = null;
        }

        if (!isset($data['Img'])) {
            $data['Img'] = null;
        }

        if (!isset($data['Video'])) {
            $data['Video'] = null;
        }

        if (!isset($data['Link'])) {
            $data['Link'] = null;
        }

        if (isset($data['Category']) && $data['Category'] instanceof Category) {
            $category = $data['Category'];
            $data['ID_Category'] = $category->getId();
            unset($data['Category']);
        }

        if (!isset($data['Comments'])) {
            $data['Comments'] = null;
        }

        if (!isset($data['CreatedAt'])) {
            $data['CreatedAt'] = date('Y-m-d h:i:s');
        }

        if (!isset($data['UpdatedAt'])) {
            $data['UpdatedAt'] = date('Y-m-d h:i:s');
        }

        if (!isset($data['Online'])) {
            $data['Online'] = 1;
        }

        if (!isset($data['Tags'])) {
            $data['Tags'] = null;
        }
    }

    public function persist($data)
    {
        $this->_db->StartTrans();
        
        $postId = $this->persistPost($data);

        if (isset($data['Comments']) && !$this->_db->HasFailedTrans()) {

            $commentRepository = $this->_container->get('CommentRepository');

            foreach ($data['Comments'] as $comment) {
                $comment->setPostId($postId);
                $commentRepository->persist($comment);
            }
        }

        $response = !$this->_db->HasFailedTrans();
        $this->_db->CompleteTrans();

        if (!$response) {
            throw new \Exception("PostDbPersitence Exception : Ocurrio un error al intentar guardar el post.", 1);
        }

        return $postId;
    }

    protected function persistPost($post)
    {
        $this->normalize($post);

        if (!isset($post['ID'])) {
            $sql = "INSERT INTO Blog_Posts (Title, Preview, Description, Img, Video, Link, ID_Category, Tags, CreatedAt, UpdatedAt, Online) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        } else {
            $sql = "UPDATE Blog_Posts SET Title = ?, Preview = ?, Description = ?, Img = ?, Video = ?, Link = ?, ID_Category = ?, Tags = ?, UpdatedAt = ?, Online) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            unset($post['CreatedAt']);
            $postId = $post['ID'];
            unset($post['ID']);
            $post[] $postId;
        }        

        if (!$this->_db->execute($sql, $post)) {
            throw new \Exception("PostDbPersitence Exception : Ocurrio un error al intentar guardar el post.");
        } else {
            return $this->_db->Insert_ID();
        }
    }

    public function persistAll($collection)
    {
        foreach ($collection as $data) {
            $this->persist($data);
        }
    }

    public function retrieveAll()
    {
        $sql = "SELECT Post.* FROM Blog_Posts AS Post WHERE Post.Online = 1";

        try {
            $posts = $this->_db->getAll($sql);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        if (!empty($posts)) {
            
            foreach ($posts as $key => $value) {
                $posts[$key]['Category'] = $this->retrieveCategory();
                $posts[$key]['Comments'] = $this->retrie
            }        

        } else {
            throw new \Exception("PostDbPersitence Exception : No se encontraron posts");
            
        }

    }
    public function retrieveAllWith($criteria)
    {

    }
    public function retrieve($id)
    {

    }

    public function remove($id)
    {

    }
}