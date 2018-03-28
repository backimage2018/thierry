<?php
namespace App\Service;

class CaddieService
{
    
    public function totalCaddie($caddie)
    {
        $totalCaddie = 0;
        
        foreach ($caddie as $row)
        {
            
          $totalCaddie += $row->getTotal();
           
        }
        
        return $totalCaddie;
    }
    
}
