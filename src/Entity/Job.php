<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobRepository::class)]
class Job
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column]
    private ?bool $remote_allowed = null;

    #[ORM\Column]
    private ?int $salary_min = null;

    #[ORM\Column]
    private ?int $salary_max = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToOne(inversedBy: 'job', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $company = null;

    /**
     * @var Collection<int, JobCategory>
     */
    #[ORM\ManyToMany(targetEntity: JobCategory::class, inversedBy: 'jobs')]
    private Collection $jobCategory;

    /**
     * @var Collection<int, JobApplication>
     */
    #[ORM\OneToMany(targetEntity: JobApplication::class, mappedBy: 'job')]
    private Collection $jobApplication;

    #[ORM\ManyToOne(inversedBy: 'jobs')]
    private ?JobType $jobType = null;

    public function __construct()
    {
        $this->jobCategory = new ArrayCollection();
        $this->jobApplication = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function isRemoteAllowed(): ?bool
    {
        return $this->remote_allowed;
    }

    public function setRemoteAllowed(bool $remote_allowed): static
    {
        $this->remote_allowed = $remote_allowed;

        return $this;
    }

    public function getSalaryMin(): ?int
    {
        return $this->salary_min;
    }

    public function setSalaryMin(int $salary_min): static
    {
        $this->salary_min = $salary_min;

        return $this;
    }

    public function getSalaryMax(): ?int
    {
        return $this->salary_max;
    }

    public function setSalaryMax(int $salary_max): static
    {
        $this->salary_max = $salary_max;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(Company $company): static
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection<int, JobCategory>
     */
    public function getJobCategory(): Collection
    {
        return $this->jobCategory;
    }

    public function addJobCategory(JobCategory $jobCategory): static
    {
        if (!$this->jobCategory->contains($jobCategory)) {
            $this->jobCategory->add($jobCategory);
        }

        return $this;
    }

    public function removeJobCategory(JobCategory $jobCategory): static
    {
        $this->jobCategory->removeElement($jobCategory);

        return $this;
    }

    /**
     * @return Collection<int, JobApplication>
     */
    public function getJobApplication(): Collection
    {
        return $this->jobApplication;
    }

    public function addJobApplication(JobApplication $jobApplication): static
    {
        if (!$this->jobApplication->contains($jobApplication)) {
            $this->jobApplication->add($jobApplication);
            $jobApplication->setJob($this);
        }

        return $this;
    }

    public function removeJobApplication(JobApplication $jobApplication): static
    {
        if ($this->jobApplication->removeElement($jobApplication)) {
            // set the owning side to null (unless already changed)
            if ($jobApplication->getJob() === $this) {
                $jobApplication->setJob(null);
            }
        }

        return $this;
    }

    public function getJobType(): ?JobType
    {
        return $this->jobType;
    }

    public function setJobType(?JobType $jobType): static
    {
        $this->jobType = $jobType;

        return $this;
    }

}
