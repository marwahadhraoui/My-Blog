<?php

namespace App\Controller\Admin;

use App\Entity\ReservationHotel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReservationHotelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ReservationHotel::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('nom_client'),
            TextField::new('prenom_client'),
            TextField::new('adresse_client'),
            TextField::new('code_postal'),
            TextField::new('ville'),
            TextField::new('telephone'),
            TextField::new('email'),
            AssociationField::new('checks'),
            
          
           
        ];
    }
    
}
