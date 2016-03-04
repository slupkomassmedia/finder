<?php

namespace linux0uid\ContentFinderBundle\Tests\Command;

use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use linux0uid\ContentFinderBundle\Command\FindInContentCommand;

/**
 * Class: FindInContentCommandTest
 *
 * @see KernelTestCase
 */
class FindInContentCommandTest extends KernelTestCase
{
    /**
     * Runs a command and returns it output
     */
    public function testExecute()
    {
        $kernel = $this->createKernel();
        $kernel->boot();
        $application = new Application($kernel);
        $application->add(new FindInContentCommand());

        $command = $application->find('find:in-content');
        $commandTester = new CommandTester($command);
        $commandTester->execute(
            array(
                '--search'      => 'retRO',
                '--dir'         => $kernel->locateResource('@linux0uidContentFinderBundle/Resources/files'),
                '--insensitive' => true,
            )
        );

        $this->assertRegExp('/1\ file/', $commandTester->getDisplay());

    }
}
