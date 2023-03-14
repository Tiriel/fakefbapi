<?php

namespace App\Entity;

use App\Enum\AttachmentTypeEnum;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\MappedSuperclass]
class Attachment
{
    #[ORM\Column]
    protected ?\DateTimeImmutable $created_time = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    protected ?User $from_user = null;

    #[ORM\Column(length: 255, enumType: AttachmentTypeEnum::class)]
    protected ?AttachmentTypeEnum $type = null;

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

    public function getType(): ?AttachmentTypeEnum
    {
        return $this->type;
    }

    public function setType(AttachmentTypeEnum $type): self
    {
        $this->type = $type;

        return $this;
    }
}
