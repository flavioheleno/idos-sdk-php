<?php

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
    public function listAll(array $filter = []) {
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
    public function getOne($hash) {
        return $this->sendGet(
            sprintf('/companies/%s/widgets/%s', $this->companySlug, $hash)
        );
    }
}