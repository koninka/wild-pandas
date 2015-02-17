<?php

namespace SlashStudio\AppBundle\Admin;
use Sonata\AdminBundle\Exception\NoValueException;

use Sonata\DoctrineORMAdminBundle\Admin\FieldDescription as BaseFieldDescription;

class FieldDescription extends BaseFieldDescription
{

    /**
     * {@inheritdoc}
     */
    public function getFieldValue($object, $fieldName)
    {
        $camelizedFieldName = self::camelize($fieldName);

        $getters = array();
        $parameters = array();

        // prefer method name given in the code option
        if ($this->getOption('code')) {
            $getters[] = $this->getOption('code');
        }
        // parameters for the method given in the code option
        if ($this->getOption('parameters')) {
            $parameters = $this->getOption('parameters');
        }
        $getters[] = 'get' . $camelizedFieldName;
        $getters[] = 'is' . $camelizedFieldName;

        foreach ($getters as $getter) {
            if (method_exists($object, $getter) || is_callable([$object, $getter])) {
                if (!in_array($getter, ['_action', '_select', 'get_select', 'isSelect', 'getSelect', 'Action', 'get_action', 'is_action', 'getAction', 'getBatch', 'isBatch', '_batch']) && strpos($getter, '.') === false) {
                    $result = call_user_func_array(array($object, $getter), $parameters);
//                    if ($result != null) {
                        return $result;
//                    }
                }
            }
        }

        if (isset($object->{$fieldName})) {
            return $object->{$fieldName};
        }

        throw new NoValueException(sprintf('Unable to retrieve the value of `%s`', $this->getName()));
    }
}
