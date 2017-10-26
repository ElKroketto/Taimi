<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 19.10.2017
 * Time: 21:12
 */

namespace elkroketto\taimi;

include_once('Database.php');

class TaimiDAO
{
    private $db;
    private $tblPrefix;

    public function __construct()
    {
        $db = new \Database();
    }

    /* PROJECT */
    public function getAllProjects(bool $includeDeleted = false)
    {
        if ($includeDeleted === true) {
            $this->db->query("SELECT * FROM $this->tblPrefix.Project");
        } else {
            $this->db->query("SELECT * FROM $this->tblPrefix.Project WHERE deletedAt = NULL");
        }

        return $this->db->resultset();
    }

    public function getProject(int $projectId) {
        $this->db->query("SELECT * FROM $this->tblPrefix.Project WHERE project.id = :projectId");
        $this->db->bind(':projectId', $projectId);

        return $this->db->single();
    }





    /* FIRST TIME SETUP METHODS */

}


