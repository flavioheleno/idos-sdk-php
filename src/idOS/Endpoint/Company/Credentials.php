<?php

declare(strict_types = 1);

namespace idOS\Endpoint\Company;

/**
 * Credentials Class Endpoint.
 */
class Credentials extends AbstractCompanyEndpoint {
    /**
     * Lists all credentials from the given company.
     *
     * @param array $filter
     *
     * @return array Response
     */
    public function listAll(array $filter = []) {
        return $this->sendGet(
            sprintf('/companies/%s/credentials', $this->companySlug),
            $filter
        );
    }

    /**
     * Creates a new credential for the given company.
     *
     * @param string $name
     * @param bool   $production
     *
     * @return array Response
     */
    public function createNew(
        string $name,
        bool $production
    ) : array {

        return $this->sendPost(
            sprintf('/companies/%s/credentials', $this->companySlug),
            [],
            [
                'name'       => $name,
                'production' => $production
            ]
        );
    }
}
