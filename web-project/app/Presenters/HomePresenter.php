<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;


final class HomePresenter extends Nette\Application\UI\Presenter
{

    protected function createComponentRegistrationForm(): Form
    {
        $products= [
            'ETA139190001F Vestavná lednice s mrazákem'=> 'ETA139190001F Vestavná lednice s mrazákem',
            'ETA139190001D Vestavná lednice s mrazákem' => 'ETA139190001D',
            'ETA239590001C Vestavná myčka nádobí' => 'ETA239590001C',
        ];
        $form = new Form;
        $form->addText('firstName', 'Jméno*');
        $form->addText('sureName', 'Přijímení*');
        $form->addText('streetAndNumber', 'Ulice a č.p.*');
        $form->addText('city', 'Město');
        $form->addText('postalCode', 'Město*');
        $form->addText('phone','Telefon*' )
            ->setHtmlType('tel')
            ->setEmptyValue('+420');
        $form->addEmail('email','E-mail*');
        $form->addSelect('product','Vzberte zakoupený produkt*', $products)
                ->setPrompt('Vyberte produkt');
        $form->addText('date', 'Datum nákupu*')
            ->setHtmlType('date');
        $form->addMultiUpload('billing_list', 'Přiložte doklad o koupi (formát .pdf, .png, .jpg)');
        $form->addText('shop', 'Prodejna/e-shop');

        $form->addSubmit('send', 'Odeslat a dokončit registraci');
        $form->onSuccess[] = [$this, 'formSucceeded'];

        return $form;
    }
    public function formSucceeded(Form $form, $data): void
    {
        // here we will process the data sent by the form
        // $data->name contains name
        // $data->password contains password
        $this->flashMessage('You have successfully signed up.');
        $this->redirect('Home:');
    }

}
