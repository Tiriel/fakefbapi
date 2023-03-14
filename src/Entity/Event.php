<?php

namespace App\Entity;

use App\Enum\AttachmentTypeEnum;
use App\Enum\EventTypeEnum;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event extends Attachment
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator('doctrine.uuid_generator')]
    #[ORM\Column]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cover = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $start_time = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $end_time = null;

    #[ORM\Column]
    private ?bool $is_draft = null;

    #[ORM\Column]
    private ?bool $is_online = null;

    #[ORM\Column]
    private ?bool $is_canceled = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, enumType: EventTypeEnum::class)]
    private ?EventTypeEnum $event_type = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Comment::class)]
    private Collection $comments;

    public function __construct()
    {
        $this->type = AttachmentTypeEnum::EVENT;
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): self
    {
        $this->cover = $cover;

        return $this;
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

    public function getStartTime(): ?\DateTimeImmutable
    {
        return $this->start_time;
    }

    public function setStartTime(\DateTimeImmutable $start_time): self
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndTime(): ?\DateTimeImmutable
    {
        return $this->end_time;
    }

    public function setEndTime(\DateTimeImmutable $end_time): self
    {
        $this->end_time = $end_time;

        return $this;
    }

    public function isIsDraft(): ?bool
    {
        return $this->is_draft;
    }

    public function setIsDraft(bool $is_draft): self
    {
        $this->is_draft = $is_draft;

        return $this;
    }

    public function isIsOnline(): ?bool
    {
        return $this->is_online;
    }

    public function setIsOnline(bool $is_online): self
    {
        $this->is_online = $is_online;

        return $this;
    }

    public function isIsCanceled(): ?bool
    {
        return $this->is_canceled;
    }

    public function setIsCanceled(bool $is_canceled): self
    {
        $this->is_canceled = $is_canceled;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEventType(): ?EventTypeEnum
    {
        return $this->event_type;
    }

    public function setEventType(EventTypeEnum $type): self
    {
        $this->event_type = $type;

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
            $comment->setEvent($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getEvent() === $this) {
                $comment->setEvent(null);
            }
        }

        return $this;
    }
}
