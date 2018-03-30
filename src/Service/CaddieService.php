<?php
namespace App\Service;

class CaddieService
{
    
    public function totalCaddie($caddie)
    {
        $totalcaddie = 0;
        
        foreach ($caddie as $row)
        {
            
          $totalcaddie += $row['total'];
           
        }
        
        return number_format($totalcaddie, 2, '.', '');
    }
    
}
