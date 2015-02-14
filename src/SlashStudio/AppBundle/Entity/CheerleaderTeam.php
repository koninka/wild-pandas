<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cheerleader team
 *
 * @ORM\Table(name="cheerleader_team")
 * @ORM\Entity(repositoryClass="CheerleaderTeamRepository")
 */
class CheerleaderTeam extends BaseTeam
{

}
