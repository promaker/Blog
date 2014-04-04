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
class PostPDOPersistence extends APersistence
{
    private $_db;
    private $_container;

    public function __construct($type, $host, $user, $pass, $db)
    {
        $vendorDir = FCPATH . 'vendor';

        $this->_db = new PDO("$type:host=$host;dbname=$db", $user, $pass);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

        if (isset($data['Category']) && $data['Category'] instanceof Category) {
            $category = $data['Category'];
            $data['ID_Category'] = $category->getId();
            unset($data['Category']);
        }
    }

    public function persist($data)
    {
        try {

            $this->_db->beginTransaction();
            
            $postId = $this->persistPost($data);

            if (isset($data['Comments']) && !$this->_db->HasFailedTrans()) {

                $commentRepository = $this->_container->get('CommentRepository');

                foreach ($data['Comments'] as $comment) {
                    $comment->setPostId($postId);
                    $commentRepository->persist($comment);
                }
            }

            $this->_db->commit();

        } catch (Exception $e) {
            $this->_db->rollback();
            throw new \Exception("PostDbPersitence Exception : Ocurrio un error al intentar guardar el post. ");
        }

        return $postId;
    }

    protected function persistPost($post)
    {
        if (!isset($post['ID'])) {
            $sql = "INSERT INTO Blog_Posts (Title, Preview, Description, Img, Video, Link, ID_Category, Tags, CreatedAt, UpdatedAt, Online) VALUES (:Title, :Preview, :Description, :Img, :Video, :Link, :ID_Category, :Tags, NOW(), NOW(), :Online)";

        } else {
            $sql = "UPDATE Blog_Posts SET Title = :Title, Preview = :Preview, Description = :Description, Img = :Img, Video = :Video, Link = :Link, ID_Category = :ID_Category, Tags = :Tags, UpdatedAt = NOW() WHERE ID = :ID";
        }

        $stmt = $this->_db->prepare($sql);

        if (!$stmt->execute($post)) {
            throw new \Exception("PostDbPersitence Exception : Ocurrio un error al intentar guardar el post.");
        } else {
            return $this->_db->lastInsertId();
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
                // $posts[$key]['Comments'] = $this->retrie
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
