<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */
namespace idOS\Endpoint\Company;

/**
 * Settings Class Endpoint.
 */
class Settings extends AbstractCompanyEndpoint
{
    /**
     * Lists all settings from the given company.
     *
     * @param array $filter
     *
     * @return array Response
     */
    public function listAll(array $filter = [])
    {
        return $this->sendGet(sprintf('/companies/%s/settings', $this->companySlug), $filter);
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
    public function createNew($section, $property, $value, $protected)
    {
        if (!is_string($section)) {
            throw new \InvalidArgumentException("Argument \$section passed to createNew() must be of the type string, " . (gettype($section) == "object" ? get_class($section) : gettype($section)) . " given");
        }
        if (!is_string($property)) {
            throw new \InvalidArgumentException("Argument \$property passed to createNew() must be of the type string, " . (gettype($property) == "object" ? get_class($property) : gettype($property)) . " given");
        }
        if (!is_string($value)) {
            throw new \InvalidArgumentException("Argument \$value passed to createNew() must be of the type string, " . (gettype($value) == "object" ? get_class($value) : gettype($value)) . " given");
        }
        if (!is_bool($protected)) {
            throw new \InvalidArgumentException("Argument \$protected passed to createNew() must be of the type bool, " . (gettype($protected) == "object" ? get_class($protected) : gettype($protected)) . " given");
        }
        $ret158541893723a6 = $this->sendPost(sprintf('/companies/%s/settings', $this->companySlug), [], ['section' => $section, 'property' => $property, 'value' => $value, 'protected' => $protected]);
        if (!is_array($ret158541893723a6)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret158541893723a6) . " given");
        }
        return $ret158541893723a6;
    }
}