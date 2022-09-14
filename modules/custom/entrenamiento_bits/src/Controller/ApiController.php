<?php

namespace Drupal\entrenamiento_bits\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\entrenamiento_bits\Services\EmployeeProvider;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends ControllerBase {

  private EmployeeProvider $employeeProvider;

  public function __construct(EmployeeProvider $employeeProvider) {
    $this->employeeProvider = $employeeProvider;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entrenamiento_bits.employee_provider')
    );
  }

  public function apiTest(): JsonResponse {
    return new JsonResponse($this->employeeProvider->loadData());
  }

}
