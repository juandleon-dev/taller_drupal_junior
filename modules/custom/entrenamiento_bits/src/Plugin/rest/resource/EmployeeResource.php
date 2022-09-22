<?php

namespace Drupal\entrenamiento_bits\Plugin\rest\resource;

use Drupal\entrenamiento_bits\Services\EmployeeProvider;
use Drupal\rest\Annotation\RestResource;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Provide employee list endpoint
 *
 * @RestResource(
 *   id = "endpoint_employee_resource",
 *   label = @Translation("Endpoint Employee Resource"),
 *   uri_paths = {
 *     "canonical" = "/api/test"
 *   }
 * )
 */
class EmployeeResource extends ResourceBase
{

  public function get(): ResourceResponse
  {
    /** @var EmployeeProvider $employeeProvider */
    $employeeProvider = \Drupal::service('entrenamiento_bits.employee_provider');

    return new ResourceResponse($employeeProvider->loadData());
  }
}
