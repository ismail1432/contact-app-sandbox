<?php

/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 29/09/2017
 * Time: 14:16
 */
namespace AppBundle\Command;

use AppBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateContactCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:create:contact')

            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a new user.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a user...')
                 // configure an argument
            ->addArgument('nom', InputArgument::REQUIRED, 'The lastname contact')
            ->addArgument('prenom', InputArgument::REQUIRED, 'The firstname contact')
            ->addArgument('telephone', InputArgument::REQUIRED, 'The phone contact')
            ->addArgument('email', InputArgument::REQUIRED, 'The email contact')

             ;
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $contact = new Contact();

        $nom = $input->getArgument('nom');
        $prenom = $input->getArgument('prenom');
        $phone = $input->getArgument('telephone');
        $mail = $input->getArgument('email');

        $contact->hydrateContact($nom,$prenom,$mail,$phone);

        $this->getContainer()->get('create.fake-contact')->createContact($contact);
        $output->write('Contact created "\n" ');
    }

}