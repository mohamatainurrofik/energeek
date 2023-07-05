<?php

namespace App\Http\Controllers;

use App\Services\Candidate\CandidateService;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    private $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    public function show()
    {
        $candidate = $this->candidateService->getAllCandidate();
        return $candidate;
    }

    public function showById($id)
    {
        $candidate = $this->candidateService->getCandidateById($id);
        return $candidate;
    }

    public function store(Request $request)
    {
        $candidate = $this->candidateService->createCandidate($request->all());

        return $candidate;
    }

    public function update(Request $request, $id)
    {
        $candidate = $this->candidateService->updateCandidate($id, $request->all());

        return $candidate;   
    }

    public function destroy($id)
    {
        $candidate = $this->candidateService->deleteCandidate($id);

        return $candidate;
    }
}
