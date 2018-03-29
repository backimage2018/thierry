<?php
namespace App\Form;

use App\Entity\Stock;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class StockType extends AbstractType {
    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('storequantity', IntegerType::class)
        ->add('eshopquantity', IntegerType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Stock::class,
        ));
    }
   
}