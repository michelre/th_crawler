<?php
/**
 * Created by PhpStorm.
 * User: remimichel
 * Date: 27/12/14
 * Time: 07:58
 */

namespace AppBundle\Doctrine;

use AppBundle\Document\url;


class UrlDAO {

    private $dm;

    public function __construct($dm){
        $this->dm = $dm;
    }

    public function count($query = null){
        if(!$query)
            return $this->dm->getRepository('AppBundle:url')
                    ->count('{}');
        return null;
    }

    public function find($limit, $offset){
        return   $this->dm->getRepository('AppBundle:url')
                      ->find()
                      ->limit($limit)
                      ->skip($offset);
    }

    public function findByURI($uri){
        return $this->dm->getRepository('AppBundle:url')->findOneBy(array('uri' => $uri));
    }

    public function createOrUpdate($uri, $visited, $tracker){
        //$urlFound = $this->findByURI($uri);
        $url = new url();
        $url->setUri($uri);
        $url->setVisited($visited);
        $url->setTracker($tracker);
        $url->setLastIndexationDate(date("Y-m-d"));
        $this->dm->persist($url);
        $this->dm->flush();
    }

    public function delete($uri){

    }

} 