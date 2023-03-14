<?php

namespace App\Entity;

use App\Enum\AttachmentTypeEnum;
use App\Enum\VideoFormatEnum;
use App\Enum\VideoStatusEnum;
use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video extends Attachment
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator('doctrine.uuid_generator')]
    #[ORM\Column]
    private ?Uuid $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255, enumType: VideoFormatEnum::class)]
    private ?VideoFormatEnum $format = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, enumType: VideoStatusEnum::class)]
    private ?VideoStatusEnum $status = null;

    #[ORM\OneToMany(mappedBy: 'video', targetEntity: Comment::class)]
    private Collection $comments;

    public function __construct()
    {
        $this->type = AttachmentTypeEnum::VIDEO;
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFormat(): ?VideoFormatEnum
    {
        return $this->format;
    }

    public function setFormat(VideoFormatEnum $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStatus(): ?VideoStatusEnum
    {
        return $this->status;
    }

    public function setStatus(VideoStatusEnum $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setVideo($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getVideo() === $this) {
                $comment->setVideo(null);
            }
        }

        return $this;
    }
}
