<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;

class CandidateRepositoryImplement implements CandidateRepository {



    public function create(array $data)
    {
        return Candidate::create($data);
    }

    public function getAll()
    {
        return Candidate::all();
    }

    public function getById($id)
    {
        $candidate = Candidate::find($id);
        if (!$candidate) {
            return false;
        }
        return $candidate;
    }

    public function update($id, array $data)
    {
        $candidate = Candidate::find($id);
        if (!$candidate) {
            return null;
        }
        $candidate->update($data);
        return $candidate;
    }

    public function delete($id)
    {
        $candidate = Candidate::find($id);
        if (!$candidate) {
            return false;
        }
        return $candidate->delete();
    }

}