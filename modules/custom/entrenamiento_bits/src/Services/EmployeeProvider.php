<?php

namespace Drupal\entrenamiento_bits\Services;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;

class EmployeeProvider {

  /**
   * @var ConfigFactoryInterface
   */
  private ConfigFactoryInterface $configFactory;

  private EntityTypeManagerInterface $entityTypeManager;

  public function __construct(EntityTypeManagerInterface $entityTypeManager, ConfigFactoryInterface $configFactory) {
    $this->entityTypeManager = $entityTypeManager;
    $this->configFactory = $configFactory;
  }

  public function loadData() {
    return [
      'data' => $this->getColaboradores(),
      'config' => $this->getClaveApi(),
    ];
  }

  private function getColaboradores(): array {
    $storage = $this->entityTypeManager->getStorage('node');
    $colaboradores = $storage->getQuery()
      ->condition('type', 'colaboradores_bits')
      ->execute();

    if (!$colaboradores) {
      return [];
    }

    $result = [];
    foreach ($colaboradores as $colaboradorId) {
      $node = $storage->load($colaboradorId);
      $result[] = [
        'name' => $node->get('field_nombre')->value,
        'last_name' => $node->get('field_apellido')->value,
        'age' => $node->get('field_edad')->value,
      ];
    }

    return $result;
  }

  private function getClaveApi(): array {
    $config = $this->configFactory->get('entrenamiento_bits.clave_api_bits');
    return ['clave_api' => $config->get('clave_api') ?: ''];
  }

}
