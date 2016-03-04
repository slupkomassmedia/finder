<?php

namespace linux0uid\ContentFinderBundle\Services;

use Symfony\Component\Finder\Finder;

/**
 * Class: FinderContext
 * @author linux0uid
 *
 */
class FinderContext
{

    /**
     * doSearch
     *
     * @param mixed $slug
     * @param mixed $dir
     * @param mixed $insensitive
     *
     * @return void
     */
    public function doSearch($slug, $dir, $insensitive = false)
    {
        
        $finder = new Finder();
        $finder->files()->in($dir);
        $ins = $insensitive ? 'i' : '';
        $content = $finder->files()->contains('/'.$slug.'/'.$ins);
        
        $request = [];
        foreach ($finder as $key => $file) {
            $request[$key]['realPath'] = $file->getRealpath();
            $request[$key]['relativePath'] = $file->getRelativePath();
            $request[$key]['relativePathname'] = $file->getRelativePathname();
        }
        return $request;
    }

}
