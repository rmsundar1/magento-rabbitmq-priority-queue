<?php
namespace Rmsundar\RabbitMqPriority\Model;

use Psr\Log\LoggerInterface;

class PriorityConsumer
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * PriorityConsumer constructor.
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string $message
     */
    public function consume($message)
    {
        $this->logger->info($message);
    }
}
