<?php

namespace MoneyTransferBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use MoneyTransferBundle\Exception\NotEnoughMoney;
use MoneyTransferBundle\Exception\NoSuchUser;

class MoneyTransferCommand extends ContainerAwareCommand
{
    const MINIMAL_AMOUNT = '0.01';
    private $entityManager;
    private $repository;

    /**
     * Configure the command
     */
    protected function configure()
    {
        $this
            ->setName('moneytransfer:transfer')
            ->setDescription('Transfer money from one user\'s balance to another')
            ->addArgument('sender', InputArgument::REQUIRED, 'User name who sends money')
            ->addArgument('receiver', InputArgument::REQUIRED, 'User name who receives money')
            ->addArgument('amount', InputArgument::REQUIRED, 'Amount of money to transfer')
        ;
    }

    /**
     * Initialize the command
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $this->repository = $this->entityManager->getRepository('MoneyTransferBundle:Users');
    }

    /**
     * The command logic
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws NotEnoughMoney
     * @throws NoSuchUser
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $senderName = $input->getArgument('sender');
        $receiverName = $input->getArgument('receiver');
        $amount = $input->getArgument('amount');
        $output->writeln("Command input: sender=\"$senderName\" receiver=\"$receiverName\" amount=\"$amount\"\n");

        if ($amount < self::MINIMAL_AMOUNT) { # nothing to do
            $output->writeln("COMMAND IGNORED: Sender $senderName requests amount $amount less than minimal allowed sum " . self::MINIMAL_AMOUNT);
            return;
        }

        // Get sender info
        $sender = $this->repository->findOneByName($senderName);
        if (!$sender) {
            throw new NoSuchUser("Sender $senderName not found");
        }
        $senderBalance = $sender->getBalance();

        $output->writeln("Sender $senderName found: id={$sender->getId()} Initial balance=$senderBalance");
        if ($amount > $senderBalance) {
            throw new NotEnoughMoney("Sender $senderName's balance=$senderBalance Amount to transfer=$amount");
        }

        // Get receiver info
        $receiver = $this->repository->findOneByName($receiverName);
        if (!$receiver) {
            throw new NoSuchUser("Receiver $receiverName not found");
        }
        $receiverBalance = $receiver->getBalance();
        $output->writeln("Receiver $receiverName found: id={$receiver->getId()} Initial balance=$receiverBalance");

        // Money transfer
        $senderBalance -= $amount;
        $receiverBalance += $amount;

        $sender->setBalance($senderBalance);
        $receiver->setBalance($receiverBalance);
        $output->writeln("COMMAND SUCCEED: Sender $senderName's new balance={$sender->getBalance()} Receiver $receiverName's new balance={$receiver->getBalance()}");

        $this->entityManager->flush();
    }
}
