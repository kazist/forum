<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Forum\Categories\Code\Models;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\Model\BaseModel;
use Kazist\KazistFactory;
use Kazist\Service\System\System;
use Kazist\Service\Database\Query;

/**
 * Description of MarketplaceModel
 *
 * @author sbc
 */
class CategoriesModel extends BaseModel {

    public function getCategoryTopics($category_id, $action, $offset, $limit) {

        $query = new Query();
        $query->select('*');
        $query->from('#__forum_topics', 'ft');
        $query->where('category_id=:category_id');
        $query->setParameter('category_id', $category_id);
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        $records = $query->loadObjectList();

        return $records;
    }

    public function getTotalCategoryTopics($category_id, $action, $offset, $limit) {

        $query = new Query();
        $query->select('COUNT(*) AS total');
        $query->from('#__forum_topics', 'ft');
        $query->where('category_id=:category_id');
        $query->setParameter('category_id', $category_id);
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        $record = $query->loadObject();

        return  $record->total;
    }

}
