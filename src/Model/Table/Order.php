<?php

// src/Model/Table/ArticlesTable.php

namespace App\Model\Table;

use Cake\ORM\Table;

class Orders extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
   
}


?>