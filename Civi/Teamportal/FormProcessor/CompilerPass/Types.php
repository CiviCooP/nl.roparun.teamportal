<?php
/**
 * @author Jaap Jansma <jaap.jansma@civicoop.org>
 * @license AGPL-3.0
 */

namespace Civi\Teamportal\FormProcessor\CompilerPass;

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Types implements CompilerPassInterface {

  public function process(ContainerBuilder $container) {
    if (!$container->hasDefinition('form_processor_type_factory')) {
      return;
    }
    $typeFactoryDefinition = $container->getDefinition('form_processor_type_factory');
    $typeFactoryDefinition->addMethodCall('addType', array(new Definition('Civi\Teamportal\FormProcessor\Type\TeamLeden')));
  }

}