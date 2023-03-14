<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator('doctrine.uuid_generator')]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private ?Uuid $id = null;

    #[Ignore]
    #[ORM\Column(type: 'uuid', nullable: true)]
    private ?Uuid $attachment = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_time = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $from_user = null;

    #[ORM\Column]
    private ?int $like_count = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[Ignore]
    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'comments')]
    private ?self $parent = null;

    #[Ignore]
    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private Collection $comments;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?Post $post = null;

    #[Ignore]
    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?Photo $photo = null;

    #[Ignore]
    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?Event $event = null;

    #[Ignore]
    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?Video $video = null;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getAttachments(): ?Uuid
    {
        return $this->attachment;
    }

    public function setAttachments(?Uuid $attachments): self
    {
        $this->attachment = $attachments;

        return $this;
    }

    public function getCreatedTime(): ?\DateTimeImmutable
    {
        return $this->created_time;
    }

    public function setCreatedTime(\DateTimeImmutable $created_time): self
    {
        $this->created_time = $created_time;

        return $this;
    }

    public function getFromUser(): ?User
    {
        return $this->from_user;
    }

    public function setFromUser(?User $from_user): self
    {
        $this->from_user = $from_user;

        return $this;
    }

    public function getLikeCount(): ?int
    {
        return $this->like_count;
    }

    public function setLikeCount(int $like_count): self
    {
        $this->like_count = $like_count;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(self $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setParent($this);
        }

        return $this;
    }

    public function removeComment(self $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getParent() === $this) {
                $comment->setParent(null);
            }
        }

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getPhoto(): ?Photo
    {
        return $this->photo;
    }

    public function setPhoto(?Photo $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getVideo(): ?Video
    {
        return $this->video;
    }

    public function setVideo(?Video $video): self
    {
        $this->video = $video;

        return $this;
    }
}
