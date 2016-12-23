<?php

namespace idOS\Endpoint\Profile;

/**
 * Recommendation Class Endpoint.
 */
class Recommendation extends AbstractProfileEndpoint {
    /**
     * Retrieves a processe given its slug.
     *
     * @return array Response
     */
    public function getOne() {
        return $this->sendGet(
            sprintf('/profiles/%s/recommendation', $this->userName)
        );
    }

    /**
     * Tries to update a recommendaton and if it doesnt exists, creates a new one.
     *
     * @param string $result
     * @param array  $passed
     * @param array  $failed
     *
     * @return array Response
     */
    public function upsertOne(
        $result,
        $passed,
        $failed
    ) {
        return $this->sendPut(
            sprintf('/profiles/%s/recommendation', $this->userName),
            [],
            [
                'result' => $result,
                'passed' => $passed,
                'failed' => $failed
            ]
        );
    }
}
