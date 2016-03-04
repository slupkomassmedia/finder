<?php

namespace linux0uid\ContentFinderBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class: FindInContentCommand
 *
 * @see ContainerAwareCommand
 */
class FindInContentCommand extends ContainerAwareCommand
{
    /**
     * configure
     *
     */
    protected function configure()
    {
        $this
            ->setName('find:in-content')
            ->setDescription('Search content in all file')
            ->addOption(
                'dir',
                null,
                InputOption::VALUE_REQUIRED,
                'Dirrectory'
            )
            ->addOption(
                'search',
                null,
                InputOption::VALUE_REQUIRED,
                'Search text'
            )
            ->addOption(
                'insensitive',
                null,
                InputOption::VALUE_NONE,
                'Search with case insensitive?'
            )
        ;
    }

    /**
     * execute
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        if ($search = $input->getOption('search')) {
            $dir = $input->getOption('dir');
            $insensitive = $input->getOption('insensitive');
            $result = $this->getContainer()->get('linux0uid_content_finder.finder')
                ->doSearch($search, $dir, $insensitive);
            $output->writeln('We found ' . count($result) . ' file(s).');
            foreach ($result as $file) {
                $output->writeln('File ' . $file['relativePathname']
                    . ' in ' . $file['realPath']);
            }
        }
    }

}
