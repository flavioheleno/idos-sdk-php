<?php

declare(strict_types = 1);

namespace idOS\Endpoint\Company;

/**
 * Companies Class Endpoint.
 */
class Companies extends AbstractCompanyEndpoint {
    /**
     * Creates a new company for the given parent company.
     *
     * @param string $name
     *
     * @return array Response
     */
    public function createNew(
        string $name
    ) : array {

        return $this->sendPost(
            sprintf('/companies/%s', $this->companySlug),
            [],
            [
                'name' => $name,
            ]
        );
    }
}
