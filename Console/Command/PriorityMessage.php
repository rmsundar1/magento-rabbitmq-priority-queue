<?php
namespace Rmsundar\RabbitMqPriority\Console\Command;

use Magento\Framework\MessageQueue\PublisherInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PriorityMessage extends Command
{
    /**
     * Message priority
     */
    private const MESSAGE_PRIORITY = 'priority';
    private const TOPIC_NAME = 'sample.priority.topic';

    /**
     * @var PublisherInterface
     */
    private $publisher;

    /**
     * PriorityMessage constructor.
     * @param PublisherInterface $publisher
     * @param string|null $name
     */
    public function __construct(PublisherInterface $publisher, string $name = null)
    {
        $this->publisher = $publisher;
        parent::__construct($name);
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('rabbitmq:priority:sample');
        $this->setDescription('To test priority message');
        $this->addOption(self::MESSAGE_PRIORITY, '-p', InputOption::VALUE_OPTIONAL, 'Message priority', 1);
        parent::configure();
    }

    /**
     * CLI command description
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $priority = $input->getOption(self::MESSAGE_PRIORITY);
        $message = 'Message Priority: ' . $priority;
        $this->publisher->publish(
            self::TOPIC_NAME,
            [
                'body' => $message,
                'properties' => ['priority' => $priority]
            ]
        );
        $output->writeln('<info>Message Published with priority ' .  $priority . '</info>');
    }
}
