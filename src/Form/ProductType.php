<?php
namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use App\Form\ImageType;



class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class)
        ->add('price', NumberType::class)
        ->add('oldprice', NumberType::class)
        ->add('description', TextareaType::class)
        ->add('color', TextType::class)
        ->add('size', TextType::class)
        ->add('brand', TextType::class)
        ->add('availability', ChoiceType::class, array(
            'choices' => array(
                'In Stock' => 'instock',
                'Out Stock' => 'outstock'
            )
     ))
       
        ->add('category',ChoiceType::class, array(
         'choices' => array(
             'Clothing' => 'Clothing',
             'Phones' => 'Phones',
             'Accessories' => 'Accessories',
             'Computer' => 'Computer',
             'Office' => 'Office',
             'Consumer Electronics' => 'Consumer Electronics',
             'Jewelry' => 'Jewelry',
             'Watches' => 'Watches',
             'Bags' => 'Bags',
             'Shoes' => 'Shoes'
         )
        ))
        ->add('image', ImageType::class)
        ->add('reduction',TextType::class)
        ->add('new', TextType::class,array(
            'required'   => false)
        )
        ->add('collection', ChoiceType::class, array(
            'choices' => array(
                'Hiver' => 'Hiver',
                'Printemps' => 'Printemps',
                'Eté' => 'Eté',
                'Automne' => 'Automne'
            )
        ))
        ->add('genre', ChoiceType::class, array(
            'choices' => array(
            'Men' => 'men',
            'Women' => 'women',
            'Mixte' => 'mixte'
            )
        ))
        ->add('countdowndate', DateTimeType::class, array (
            'placeholder' => 'Select a value'
        ));
        
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Product::class
        ));
    }
}