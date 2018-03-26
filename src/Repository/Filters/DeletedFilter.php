<?php
namespace App\Repository\Filters;

use Doctrine\ORM\Mapping\ClassMetaData;
use Doctrine\ORM\Query\Filter\SQLFilter;

class DeletedFilter extends SQLFilter
{
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        if ($targetEntity->hasField("date_deleted")) {
            $date = date("Y-m-d H:i:s");
            
            return $targetTableAlias.".date_deleted > '". $date . "' OR ".$targetTableAlias.".date_deleted IS NULL";
        }
        
        return "";
    }
}