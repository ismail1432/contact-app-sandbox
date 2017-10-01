<?php

/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 01/10/2017
 * Time: 10:05
 */

namespace AppBundle\DependencyInjection\Compiler;

use AppBundle\Printing\Printer;
use Symfony\Component\DependencyInjection\Reference;

class PrintingCompilerPass implements \Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface
{

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function process(\Symfony\Component\DependencyInjection\ContainerBuilder $container)
    {
        //Check if we have a service
        if (!$container->has(Printer::SERVICENAME)) {
            return;
        }

        $definition = $container->findDefinition(Printer::SERVICENAME);
        $formattersTags = $container->findTaggedServiceIds(
            'printing.formatter'
        );

        foreach ($formattersTags as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {

                $definition->addMethodCall(
                    'registerFormatter',
                    array($attributes['format'], new Reference($id))
                );
            }
        }

    }
}