# magento-rabbitmq-priority-queue
Sample module to demonstrate the rabbitMq priority queue and other queue arguments

> **Magento has resolved the bug of allowing arguments for rabbitmq queue and exchange while creating in 2.4.2.**

##### sample code for passing arguments to queue

````xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework-message-queue:etc/topology.xsd">
    <exchange name="magento" type="topic" connection="amqp">
        <binding id="sample.priority" topic="sample.priority.topic" destinationType="queue" destination="sample.priority">
            <arguments>
                <argument name="x-max-priority" xsi:type="number">10</argument>
            </arguments>
        </binding>
    </exchange>
</config>
````

> **Magento OOTB doesn't support passing extra arguments to the message properties.**

##### This module has a custom publisher which will allow passing extra properties while publishing a message to an exchange

Refer below classes to publish a message with properties
- https://github.com/rmsundar1/magento-rabbitmq-priority-queue/blob/main/Model/PriorityConsumer.php
- https://github.com/rmsundar1/magento-rabbitmq-priority-queue/blob/9e37bb80b985838361ebbe686fa8a19a525f834f/Console/Command/PriorityMessage.php#L53
