<?php

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
        $name
    ) {

        return $this->sendPost(
            sprintf('/companies/%s', $this->companySlug),
            [],
            [
                'name' => $name,
            ]
        );
    }
}
