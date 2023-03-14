<?php

namespace App\Command;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Yaml\Yaml;

#[AsCommand(
    name: 'app:fixtures:dump',
    description: 'Add a short description for your command',
)]
class FixturesDumpCommand extends Command
{
    private string $file;

    public function __construct(
        protected readonly UserRepository $userRepository,
        protected readonly PostRepository $postRepository,
        protected readonly CommentRepository $commentRepository,
        protected readonly SerializerInterface $serializer,
        #[Autowire('%kernel.project_dir%')]
        string $projectDir
    )
    {
        $this->file = $projectDir.'/db.json';
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userCallback = function ($innerObject, $outerObject, string $attributeName, string $format = null, array $context = []) {
            return $innerObject instanceof User ? $innerObject->getId() : $innerObject;
        };

        $commentCallback = function ($innerObject, $outerObject, string $attributeName, string $format = null, array $context = []) {
            return ($innerObject instanceof Comment || $innerObject instanceof Post) ? $innerObject->getId() : $innerObject;
        };

        $db = $this->serializer->serialize([
                'users' => $this->userRepository->findAll(),
                'posts' => $this->postRepository->findAll(),
                'comments' => $this->commentRepository->findAll(),
            ],
            'json',
            [
                AbstractNormalizer::CALLBACKS => [$userCallback, $commentCallback],
                AbstractNormalizer::IGNORED_ATTRIBUTES => ['lazyObjectState', 'lazyObjectInitialized', 'lazyObjectAsInitialized']
            ]);

        file_put_contents($this->file, $db);

        return Command::SUCCESS;
    }
}
