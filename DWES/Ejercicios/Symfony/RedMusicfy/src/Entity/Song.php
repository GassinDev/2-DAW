<?php

namespace App\Entity;

use App\Repository\SongRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SongRepository::class)]
class Song
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $author = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fotoPortada = null;

    #[ORM\Column(length: 255)]
    private ?string $fileAudio = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getFotoPortada(): ?string
    {
        return $this->fotoPortada;
    }

    public function setFotoPortada(?string $fotoPortada): static
    {
        $this->fotoPortada = $fotoPortada;

        return $this;
    }

    public function getFileAudio(): ?string
    {
        return $this->fileAudio;
    }

    public function setFileAudio(?string $fileAudio): static
    {
        $this->fileAudio = $fileAudio;

        return $this;
    }
}
