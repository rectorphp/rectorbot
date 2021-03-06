<?php

declare(strict_types=1);

namespace PHPMate\Domain\Composer;

use PHPMate\Domain\FileSystem\WorkingDirectory;

final class Composer
{
    public function __construct(
        private ComposerBinary $composerBinary
    ) {}


    /**
     * @throws ComposerJsonFileMissing
     */
    public function installInDirectory(WorkingDirectory $workingDirectory): void
    {
        if ($workingDirectory->fileExists('composer.json') === false) {
            throw new ComposerJsonFileMissing();
        }

        $this->composerBinary->execInDirectory($workingDirectory,'install');
    }
}
