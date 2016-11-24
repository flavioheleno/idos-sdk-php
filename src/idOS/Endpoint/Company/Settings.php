<?php

declare(strict_types = 1);

namespace idOS\Endpoint\Company;

/**
 * Settings Class Endpoint.
 */
class Settings extends AbstractCompanyEndpoint {
    /**
     * Lists all settings from the given company.
     *
     * @param array $filter
     *
     * @return array Response
     */
    public function listAll(array $filter = []) {
        return $this->sendGet(
            sprintf('/companies/%s/settings', $this->companySlug),
            $filter
        );
    }

    /**
     * Creates a new setting for the given company.
     *
     * @param string $section
     * @param string $property
     * @param string $value
     * @param bool   $protected
     *
     * @return array Response
     */
    public function createNew(
        string $section,
        string $property,
        string $value,
        bool $protected
    ) : array {

        return $this->sendPost(
            sprintf('/companies/%s/settings', $this->companySlug),
            [],
            [
                'section' => $section,
                'property' => $property,
                'value' => $value,
                'protected' => $protected
            ]
        );
    }
}
