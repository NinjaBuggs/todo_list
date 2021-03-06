<?php
declare(strict_types=1);

namespace App\Todo\Application\UseCase;

use App\Todo\Application\Command\CreateTaskCommand;
use App\Todo\Domain\Entity\Task;
use App\Todo\Domain\Repository\TasksRepositoryInterface;
use NinjaBuggs\ServiceBus\Command\UseCaseInterface;
use NinjaBuggs\ServiceBus\TransactionalHandlerInterface;

class CreateTaskCommandHandler implements UseCaseInterface, TransactionalHandlerInterface
{
    private $tasksRepository;

    public function __construct(TasksRepositoryInterface $tasksRepository)
    {
        $this->tasksRepository = $tasksRepository;
    }

    public function __invoke(CreateTaskCommand $command): void
    {
        $task = new Task($command->getId(), $command->getText());

        $this->tasksRepository->add($task);
    }
}
