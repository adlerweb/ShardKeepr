<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * Specifies the user this project belongs to.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     *
     * @var User
     */
    private $user;

    /**
     * Holds the parts needed for this project.
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ProjectPart",mappedBy="project",cascade={"persist", "remove"}, orphanRemoval=true)
     *
     * @var ArrayCollection
     */
    private $parts;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * Holds the project attachments.
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ProjectAttachment",mappedBy="project",cascade={"persist", "remove"}, orphanRemoval=true)
     *
     * @var ArrayCollection
     */
    private $attachments;

    public function __construct()
    {
        $this->parts = new ArrayCollection();
        $this->attachments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUser()
    {
        return $this->user;
    }
    
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getParts()
    {
        return $this->parts->getValues();
    }

    public function addPart($projectPart)
    {
        $projectPart->setProject($this);
        $this->parts->add($projectPart);
    }

    public function removePart($projectPart)
    {
        $projectPart->setProject(null);
        $this->parts->removeElement($projectPart);
    }

    public function getAttachments()
    {
        return $this->attachments->getValues();
    }

    public function addAttachment($projectAttachment)
    {
        if ($projectAttachment instanceof ProjectAttachment) {
            $projectAttachment->setProject($this);
        }
        $this->attachments->add($projectAttachment);
    }

    public function removeAttachment($projectAttachment)
    {
        if ($projectAttachment instanceof ProjectAttachment) {
            $projectAttachment->setProject(null);
        }
        $this->attachments->removeElement($projectAttachment);
    }
}
