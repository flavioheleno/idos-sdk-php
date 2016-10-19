<?php

declare(strict_types = 1);

namespace idOS\Endpoint\Company;

/**
 * Widget Class Endpoint.
 */
class Widgets extends AbstractCompanyEndpoint {
    /**
     * List all widgets.
     *
     * @param array $filter
     *
     * @return array Response
     */
    public function listAll(array $filter = []) : array {
        return $this->sendGet(
            sprintf('/companies/%s/widgets', $this->companySlug),
            $filter
        );
    }

    /**
     * Retrieves a widget given its hash.
     *
     * @param string $hash
     *
     * @return array Response
     */
    public function getOne(string $hash) : array {
        return $this->sendGet(
            sprintf('/companies/%s/widgets/%s', $this->companySlug, $hash)
        );
    }
}
