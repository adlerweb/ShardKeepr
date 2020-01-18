<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\UploadedFile;

/**
 * Holds a project attachment.
 *
 * @ORM\Entity
 **/
class ProjectAttachment extends UploadedFile
{
    /**
     * Creates a new project attachment.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setType('ProjectAttachment');
    }

    /**
     * The project object.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="attachments")
     *
     * @var Project
     */
    private $project = null;

    /**
     * Sets the project.
     *
     * @param Project $project The project to set
     */
    public function setProject(Project $project = null)
    {
        $this->project = $project;
    }

    /**
     * Returns the roject.
     *
     * @return Project the project
     */
    public function getProject()
    {
        return $this->project;
    }
}