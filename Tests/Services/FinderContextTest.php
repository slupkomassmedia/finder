<?php

namespace linux0uid\ContentFinderBundle\Tests\Services;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use linux0uid\ContentFinderBundle\Services\FinderContext;

/**
 * Class: FinderContextTest
 *
 * @see KernelTestCase
 */
class FinderContextTest extends KernelTestCase
{
    /**
     * container
     *
     * @var mixed
     */
    private $container;

    /**
     * testExecute
     *
     */
    public function testExecute()
    {
        $kernel = $this->createKernel();
        $kernel->boot();
        $this->container = $kernel->getContainer();

        // init search parameters
        $params = [];
        $params[] = [
            'slug' => 'retRO',
            'dir' => $kernel->locateResource('@linux0uidContentFinderBundle/Resources/files'),
            'insensitive' => false,
            'count' => 0
        ];
        $params[] = [
            'slug' => 'retRO',
            'dir' => $kernel->locateResource('@linux0uidContentFinderBundle/Resources/files'),
            'insensitive' => true,
            'count' => 1
        ];
        $params[] = [
            'slug' => 'finDerTExt',
            'dir' => $kernel->locateResource('@linux0uidContentFinderBundle/Resources/files'),
            'insensitive' => true,
            'count' => 2
        ];

        // check Service working
        foreach ($params as $key => $param) {
            $result = $this->container->get('linux0uid_content_finder.finder')
                ->doSearch(
                    $param['slug'],
                    $param['dir'],
                    $param['insensitive']
                )
            ;
            $this->assertEquals($param['count'], count($result));
        }
    }

}
