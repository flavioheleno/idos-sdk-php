<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Endpoint\Profile\Process;

/**
 * Tasks Class Endpoint.
 */
class Tasks extends AbstractProcessEndpoint
{
    /**
     * Creates a new task for the given user.
     *
     * @param string $name
     * @param string $event
     * @param bool   $running
     * @param bool   $success
     * @param string $message
     *
     * @return array Response
     */
    public function createNew($name, $event, $running, $success, $message)
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to createNew() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        if (! is_string($event)) {
            throw new \InvalidArgumentException('Argument $event passed to createNew() must be of the type string, ' . (gettype($event) == 'object' ? get_class($event) : gettype($event)) . ' given');
        }
        if (! is_bool($running)) {
            throw new \InvalidArgumentException('Argument $running passed to createNew() must be of the type bool, ' . (gettype($running) == 'object' ? get_class($running) : gettype($running)) . ' given');
        }
        if (! is_bool($success)) {
            throw new \InvalidArgumentException('Argument $success passed to createNew() must be of the type bool, ' . (gettype($success) == 'object' ? get_class($success) : gettype($success)) . ' given');
        }
        if (! is_string($message)) {
            throw new \InvalidArgumentException('Argument $message passed to createNew() must be of the type string, ' . (gettype($message) == 'object' ? get_class($message) : gettype($message)) . ' given');
        }
        $ret15854189385b0e = $this->sendPost(sprintf('/profiles/%s/processes/%s/tasks', $this->userName, $this->processId), [], ['name' => $name, 'event' => $event, 'running' => $running, 'success' => $success, 'message' => $message]);
        if (! is_array($ret15854189385b0e)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189385b0e) . ' given');
        }

        return $ret15854189385b0e;
    }
    /**
     * Lists all tasks.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = [])
    {
        $ret1585418938665f = $this->sendGet(sprintf('/profiles/%s/processes/%s/tasks', $this->userName, $this->processId), $filters);
        if (! is_array($ret1585418938665f)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418938665f) . ' given');
        }

        return $ret1585418938665f;
    }
    /**
     * Retrieves a task given its slug.
     *
     * @param int $taskId
     *
     * @return array Response
     */
    public function getOne($taskId)
    {
        if (! is_int($taskId)) {
            throw new \InvalidArgumentException('Argument $taskId passed to getOne() must be of the type int, ' . (gettype($taskId) == 'object' ? get_class($taskId) : gettype($taskId)) . ' given');
        }
        $ret15854189386862 = $this->sendGet(sprintf('/profiles/%s/processes/%s/tasks/%s', $this->userName, $this->processId, $taskId));
        if (! is_array($ret15854189386862)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189386862) . ' given');
        }

        return $ret15854189386862;
    }
    /**
     * Updates a task given its slug.
     *
     * @param int    $taskId
     * @param mixed  $value
     * @param string $type
     *
     * @return array Response
     */
    public function updateOne($taskId, $name, $event, $running, $success, $message)
    {
        if (! is_int($taskId)) {
            throw new \InvalidArgumentException('Argument $taskId passed to updateOne() must be of the type int, ' . (gettype($taskId) == 'object' ? get_class($taskId) : gettype($taskId)) . ' given');
        }
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to updateOne() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        if (! is_string($event)) {
            throw new \InvalidArgumentException('Argument $event passed to updateOne() must be of the type string, ' . (gettype($event) == 'object' ? get_class($event) : gettype($event)) . ' given');
        }
        if (! is_bool($running)) {
            throw new \InvalidArgumentException('Argument $running passed to updateOne() must be of the type bool, ' . (gettype($running) == 'object' ? get_class($running) : gettype($running)) . ' given');
        }
        if (! is_bool($success)) {
            throw new \InvalidArgumentException('Argument $success passed to updateOne() must be of the type bool, ' . (gettype($success) == 'object' ? get_class($success) : gettype($success)) . ' given');
        }
        if (! is_string($message)) {
            throw new \InvalidArgumentException('Argument $message passed to updateOne() must be of the type string, ' . (gettype($message) == 'object' ? get_class($message) : gettype($message)) . ' given');
        }
        $ret15854189386c2d = $this->sendPatch(sprintf('/profiles/%s/processes/%s/tasks/%s', $this->userName, $this->processId, $taskId), [], ['name' => $name, 'event' => $event, 'running' => $running, 'success' => $success, 'message' => $message]);
        if (! is_array($ret15854189386c2d)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189386c2d) . ' given');
        }

        return $ret15854189386c2d;
    }
}
