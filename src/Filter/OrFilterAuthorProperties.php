<?php

namespace App\Filter;

use Doctrine\ORM\QueryBuilder;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;

class OrFilterAuthorProperties extends AbstractFilter
{

    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?Operation $operationName = null, array $context = []): void
    {
        // dd($this->getProperties());
        if ($property !== 'orAuthorProperties' || !is_array($value)) {
            return;
        }

        $alias = $queryBuilder->getRootAliases()[0];
        $orX = $queryBuilder->expr()->orX();

        $nb = 0;
        foreach ($value as $k => $v) {
            $nb++;
            $propertyToArray = explode('.', $k);
            if (count($propertyToArray) === 2) {
                $author = $propertyToArray[0]. (string) $nb;
                $queryBuilder->leftJoin(sprintf('%s.author', $alias), 'a' . (string) $nb)
                    ->leftJoin(sprintf("App\Entity\\" . ucfirst($propertyToArray[0]), $alias), $author. (string) $nb, 'WITH', "a" . (string) $nb . ".id={$author}.id");

                $parameterName = $queryNameGenerator->generateParameterName($propertyToArray[1]);
                $orX->add($queryBuilder->expr()->like(sprintf('%s.%s', $author, $propertyToArray[1]), ':' . $parameterName));
                $queryBuilder->setParameter($parameterName, '%' . $v . '%');
            }
        }

        $queryBuilder->andWhere($orX);


    }



    public function getDescription(string $resourceClass): array
    {
        return [
            'orAuthorProperties' => [
                'property' => null,
                'type' => 'string',
                'required' => false,
            ],
        ];
    }

}
