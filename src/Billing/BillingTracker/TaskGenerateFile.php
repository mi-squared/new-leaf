<?php


namespace OpenEMR\Billing\BillingTracker;


use OpenEMR\Billing\BillingTracker\Traits\WritesToBillingLog;

class TaskGenerateFile implements ProcessingTaskInterface
{
    use WritesToBillingLog {
        setLogger as traitSetLogger;
    }

    /**
     * This is the object that represents generation of an output file
     * lik X-12, HCFA or UB04. The generator knows what to do based on
     * the action parameter.
     *
     * @var GeneratorInterface
     */
    protected $generator;

    public function __construct(GeneratorInterface $generator)
    {
        $this->generator = $generator;
    }

    public function setLogger(BillingLogger $logger)
    {
        $this->traitSetLogger($logger);
        $this->generator->setLogger($logger);
    }

    public function setup($context)
    {
        $this->generator->setup($context);
    }

    public function execute(BillingClaim $claim)
    {
        return $this->generator->execute($claim);
    }

    public function complete($context = null)
    {
        return $this->generator->complete($context);
    }
}
