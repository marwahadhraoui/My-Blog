<?php

namespace App\Controller\Admin;

use App\Entity\ReservationService;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReservationServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ReservationService::class;
    }

  
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('nom_client'),
            TextField::new('prenom_client'),
            TextField::new('mail'),
            IntegerField::new('telephone'),
            AssociationField::new('service')
        ];
    }
    
}
