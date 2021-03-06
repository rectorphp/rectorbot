<?php

declare(strict_types=1);

namespace PHPMate\Domain\Rector;

use PHPMate\Domain\FileSystem\WorkingDirectory;

final class Rector
{
    public function __construct(
        private RectorBinary $rectorBinary
    ) {}

    /**
     * @throws RectorConfigFileMissing
     */
    public function runInDirectory(WorkingDirectory $workingDirectory): void
    {
        if ($workingDirectory->fileExists('rector.php') === false) {
            throw new RectorConfigFileMissing();
        }

        $this->rectorBinary->execInDirectory($workingDirectory, 'process --dry-run');
    }
}
