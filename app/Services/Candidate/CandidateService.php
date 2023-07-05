<?php

namespace App\Services\Candidate;


interface CandidateService {

    public function getAllCandidate();
    public function getCandidateById($id);
    public function createCandidate(array $data);
    public function updateCandidate($id, array $data);
    public function deleteCandidate($id);

}