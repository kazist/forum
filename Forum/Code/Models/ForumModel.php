<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Forum\Forum\Code\Models;

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
class ForumModel extends BaseModel {

    //put your code here
    public function getAdditionalDetail($items) {

        $tmp_array = array();

        if (!empty($items)) {
            foreach ($items as $item) {
                $tmp_array[] = $this->getItemAdditionDetails($item);
            }
        }
        //print_r($tmp_array); exit;
        return $tmp_array;
    }

    public function getItemAdditionDetails($item) {
        $factory = new KazistFactory();

        $item_obj = (is_object($item)) ? $item : new \stdClass();

        $item_obj->title = ucwords($item->title);
        $item_obj->categories = $this->getForumCategories($item->id);

        return $item_obj;
    }

    public function getForumCategories($forum_id, $offset = 0, $limit = 10) {

        $factory = new KazistFactory();


        $query = new Query();
        $query->select('*');
        $query->from('#__forum_categories', 'fc');
        $query->where('forum_id=:forum_id');
        $query->setParameter('forum_id', $forum_id);
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        $records = $query->loadObjectList();


        if (!empty($records)) {
            foreach ($records as $key => $record) {
                $records[$key]->total_topics = $this->getCategoryCountTopics($record->id);
                $records[$key]->total_comments = $this->getCategoryCountComments($record->id);
                $records[$key]->latest_post = $this->getLatestPosts($record->id);
            }
        }

        return $records;
    }

    public function getTotalCategories($forum_id) {

        $factory = new KazistFactory();


        $query = new Query();
        $query->select('COUNT(*) AS total');
        $query->from('#__forum_categories', 'fc');
        $query->where('forum_id=:forum_id');
        $query->setParameter('forum_id', $forum_id);

        $record = $query->loadObject();

        return $record->total;
    }

    public function getCategoryCountComments($category_id) {

        $system = new System();

        $query = new Query();
        $query->select('COUNT(*) AS total');
        $query->from('#__notification_comments', 'nc');
        $query->leftJoin('nc', '#__forum_topics', 'ft', 'ft.id = nc.record_id');
        $query->where('ft.category_id=:category_id');
        $query->setParameter('category_id', $category_id);

        $record = $query->loadObject();

        return $record->total;
    }

    public function getCategoryCountTopics($category_id) {

        $factory = new KazistFactory();


        $query = new Query();
        $query->select('COUNT(*) AS total');
        $query->from('#__forum_topics', 'ft');
        $query->where('category_id=:category_id');
        $query->setParameter('category_id', $category_id);

        $record = $query->loadObject();

        return $record->total;
    }

    public function getLatestPosts($category_id) {

        $factory = new KazistFactory();


        $query = new Query();
        $query->select('ft.*, uu.name as user_name, uu.id as user_id');
        $query->from('#__forum_topics', 'ft');
        $query->leftJoin('ft', '#__users_users', 'uu', 'uu.id = ft.created_by');
        $query->where('category_id=' . $category_id);
        $query->setParameter('category_id', $category_id);
        $query->orderBy('ft.id ', 'DESC');

        $record = $query->loadObject();

        return $record;
    }

    public function loadForums() {
        $paths = array();

        $object_arr = new \stdClass();
        $factory = new KazistFactory();


        $forum_id = $this->request->request->get('forum_id');
        $offset = $this->request->request->get('offset');
        $action = $this->request->request->get('action');

        $object_arr->offset = ($action == 'previous') ? $offset - 10 : $offset + 10;
        $object_arr->forum_id = $forum_id;

        $template = 'forum.category.list.twig';
        $this->twig_paths[] = realpath(JPATH_ROOT . '/applications/Forum/generalviews');
        $html = $factory->renderData($object_arr, $template, $paths);


        return $html;
    }

}
