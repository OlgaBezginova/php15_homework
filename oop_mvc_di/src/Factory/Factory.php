<?php


namespace Factory;


class Factory implements FactoryInterface
{
    public function create(string $type, array $arguments = [])
    {
        $data = $this->getClassArgs($type);

        if (!empty($arguments)) {
            $data = array_merge($data, $arguments);
        }

        foreach ($data as $parameterName => $parameter) {
            if (class_exists($parameter)) {

                $data[$parameterName] = $this->create($parameter);
            }
        }

        return new $type(...array_values($data));
    }

    private function getClassArgs($className)
    {

        $reflection = new \ReflectionClass($className);

        $parameters = [];

        if(!empty($reflection->getConstructor())) {
            foreach ($reflection->getConstructor()->getParameters() as $parameter) {
                if ($parameter->isOptional()) {
                    break;
                }

                if ($parameter->getClass()->getName() == $className) {
                    throw new \Error('Infinite recursion in class ' . $className . ' with argument "' . $parameter->getName() . '"');
                }

                $parameters[$parameter->getName()] = $parameter->getClass()->getName();

            }
        }

        return $parameters;
    }
}