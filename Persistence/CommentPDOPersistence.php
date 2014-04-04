<?php

namespace Promaker\Component\Blog\Persistence;

use Promaker\Base\Persistence\APersistence;

/**
* 
*/
class CommentPDOPersistence extends APersistence
{
    private $_db;

    public function __construct($type, $host, $user, $pass, $db)
    {
        $vendorDir = FCPATH . 'vendor';

        require_once $vendorDir.'/adodb/adodb-php/adodb.inc.php';
        require_once $vendorDir.'/adodb/adodb-php/adodb-exceptions.inc.php';

        $this->_db = NewADOConnection($type);
        $this->_db->Connect($host, $user, $pass, $db);
    }

    private function normalize(&$data)
    {
        if (!isset($data['ID'])) {
            $data['ID'] = null;
        }

        if (!isset($data['ID_Post'])) {
            $data['ID_Post'] = null;
        }

        if (!isset($data['Name'])) {
            $data['Name'] = null;
        }

        if (!isset($data['Email'])) {
            $data['Email'] = null;
        }

        if (!isset($data['Comment'])) {
            $data['Comment'] = null;
        }

        if (!isset($data['CreatedAt'])) {
            $data['CreatedAt'] = date('Y-m-d h:i:s');
        }
    }

    protected function persist($data)
    {
        $this->normalize($data);

        if (isset($data['ID'])) {
            $sql = "INSERT INTO Blog_Comments (ID_Post, Name, Email, Comment, CreatedAt) VALUES (?, ?, ?, ?, ?)";
        } else {
            $sql = "UPDATE Blog_Comments (Name, Email, Comment) VALUES (?, ?, ?)";
            
            $dataId = $data['ID'];
            unset($data['ID']);
            unset($data['CreatedAt']);
        }


        if (!$this->_db->execute($sql, $data)) {
            throw new \Exception("PostDbPersitence Exception : Ocurrio un error al intentar guardar el commentario del post.");
        } else {
            return $this->_db->Insert_ID();
        }
    }
}
