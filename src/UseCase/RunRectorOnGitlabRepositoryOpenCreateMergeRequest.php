<?php
declare (strict_types=1);

namespace Acme\UseCase;

use Acme\Domain\Application\Procedures\InstallComposer;
use Acme\Domain\Application\Procedures\RunRector;
use Acme\Domain\Gitlab\CheckoutGitlabRepository;
use Acme\Domain\Gitlab\OpenGitlabMergeRequest;

final class RunRectorOnGitlabRepositoryOpenCreateMergeRequest
{
    private CheckoutGitlabRepository $checkoutGitlabRepository;

    private InstallComposer $installComposer;

    private RunRector $runRector;

    private OpenGitlabMergeRequest $createMergeRequest;


    public function __construct(
        CheckoutGitlabRepository $checkoutGitlabRepository,
        InstallComposer $installComposer,
        RunRector $runRector,
        OpenGitlabMergeRequest $createMergeRequest
    )
    {
        $this->checkoutGitlabRepository = $checkoutGitlabRepository;
        $this->installComposer = $installComposer;
        $this->runRector = $runRector;
        $this->createMergeRequest = $createMergeRequest;
    }


    public function __invoke(string $gitlabRepositoryName): void
    {
        $application = ($this->checkoutGitlabRepository)($gitlabRepositoryName);

        ($this->installComposer)($application);
        ($this->runRector)($application);
        ($this->createMergeRequest)($application);
    }
}