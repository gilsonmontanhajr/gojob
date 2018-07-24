<?php

namespace PHPixie\BundleFramework\Configuration\ORM;

/**
 * Merges multiple ORM wrappers
 */
class Wrappers implements \PHPixie\ORM\Wrappers
{
    /**
     * @var array
     */
    protected $wrappersMap;

    /**
     * @var array
     */
    protected $maps = array();

    /**
     * @var array
     */
    protected $names;

    /**
     * Constructor
     * @param \PHPixie\Bundles\ORM
     */
    public function __construct($bundlesOrm)
    {
        $types = array(
            'databaseRepositories',
            'databaseQueries',
            'databaseEntities',
            'embeddedEntities'
        );
        
        $this->maps = array_fill_keys($types, array());
        
        foreach($bundlesOrm->wrappersMap() as $bundleName => $ormWrappers) {
            foreach($types as $type) {
                foreach($ormWrappers->$type() as $name) {
                    $this->maps[$type][$name] = $ormWrappers;
                }
            }
        }
        
        foreach($this->maps as $type => $map) {
            $this->names[$type] = array_keys($map);
        }
    }

    /**
     * @inheritdoc
     */
    public function databaseRepositories()
    {
        return $this->names['databaseRepositories'];
    }

    /**
     * @inheritdoc
     */
    public function databaseQueries()
    {
        return $this->names['databaseQueries'];
    }

    /**
     * @inheritdoc
     */
    public function databaseEntities()
    {
        return $this->names['databaseEntities'];
    }

    /**
     * @inheritdoc
     */
    public function embeddedEntities()
    {
        return $this->names['embeddedEntities'];
    }

    /**
     * @inheritdoc
     */
    public function databaseRepositoryWrapper($repository)
    {
        return $this
            ->wrappers('databaseRepositories', $repository->modelName())
            ->databaseRepositoryWrapper($repository);
    }

    /**
     * @inheritdoc
     */
    public function databaseQueryWrapper($query)
    {
        return $this
            ->wrappers('databaseQueries', $query->modelName())
            ->databaseQueryWrapper($query);
    }

    /**
     * @inheritdoc
     */
    public function databaseEntityWrapper($entity)
    {
        return $this
            ->wrappers('databaseEntities', $entity->modelName())
            ->databaseEntityWrapper($entity);
    }

    /**
     * @inheritdoc
     */
    public function embeddedEntityWrapper($entity)
    {
        return $this
            ->wrappers('embeddedEntities', $entity->modelName())
            ->embeddedEntityWrapper($entity);
    }

    /**
     * @param string $type
     * @param string $modelName
     * @return \PHPixie\ORM\Wrappers
     */
    protected function wrappers($type, $modelName)
    {
        return $this->maps[$type][$modelName];
    }
}