<?php

namespace App\EventListener;

use Doctrine\ORM\Event\PreFlushEventArgs;

class DoctrineListener
{
    public function preFlush(PreFlushEventArgs $event) {
        $em = $event->getEntityManager();
        
        foreach ($em->getUnitOfWork()->getScheduledEntityDeletions() as $object) {
            if (method_exists($object, 'getDate_deleted')) {
                if ($object->getDate_deleted() instanceof \DateTime) {
                    continue;
                } else {
                    $object->setDate_deleted(new \Datetime());
                    $em->merge($object);
                    
                    $em->persist($object);
                }
            }
          }
       } 
}