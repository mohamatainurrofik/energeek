<?php

namespace App\Services\Candidate;

use App\Models\Skill;
use App\Repositories\Candidate\CandidateRepository;
use App\Services\Candidate\CandidateService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CandidateServiceImplement implements CandidateService {

    protected $candidateRepository;

    public function __construct(CandidateRepository $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }

    public function getAllCandidate()
    {
        return $this->candidateRepository->getAll();
    }

    public function getCandidateById($id)
    {
        $candidate = $this->candidateRepository->getById($id);
        if (!$candidate) {
            return response()->json(['message' => 'Candidate not found'], 404);
        }
        return $candidate;
    }

    public function createCandidate(array $data)
    {
        $rules = [
            'job_id' => 'required',
            'name' => 'required',
            'email' => 'required|email:rfc|unique:candidates',
            'phone' => 'required|numeric|unique:candidates',
            'year' => 'required|numeric',
            'skill_sets.*' => 'required|distinct'

        ];
        $message = [
            'required' => ':attribute wajib diisi',
            'unique' => ':attribute sudah terdaftar',
            'email' => ':attribute tidak valid',
            'distinct' => ':attribute tidak boleh redundant'
        ];
        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->messages()
            ]);
        }

        $candidate = $this->candidateRepository->create($data);
        $dataSkill = Skill::find($data['skill_sets']);
        $candidate->skill()->attach($dataSkill);
        if ($candidate) {
            return response()->json([
                'status' => 'success',
                'data' => $candidate
            ]);
        }

        return response()->json([
            'status' => 'failed',
            'data' => $candidate
        ]);
    }

    public function updateCandidate($id, array $data)
    {
        $cek = $this->candidateRepository->getById($id);
        if (!$cek) {
            return response()->json(['message' => 'Candidate not found'], 404);
        }
        $rules = [
            'name' => 'required',
            'email' => [
                'required',
                'email:rfc',
                Rule::unique('candidates')->ignore($id),
            ],
            'phone' => ['required','numeric',Rule::unique('candidates')->ignore($id)],
            'year' => 'required|numeric',
            'skill_sets.*' => 'required|distinct'

        ];
        $message = [
            'required' => ':attribute wajib diisi',
            'unique' => ':attribute sudah terdaftar',
            'email' => ':attribute tidak valid',
            'distinct' => ':attribute tidak boleh redundant'
        ];
        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->messages()
            ]);
        }

        $candidate = $this->candidateRepository->update($id, $data);
        $dataSkill = Skill::find($data['skill_sets']);
        $candidate->skill()->sync($dataSkill);
        if ($candidate) {
            return response()->json([
                'status' => 'success',
                'data' => $candidate
            ]);
        }

        return response()->json([
            'status' => 'failed',
            'data' => $candidate
        ]);

    }

    public function deleteCandidate($id)
    {
        $data = $this->candidateRepository->getById($id);
        if (!$data) {
            // Handle entity not found
            return response()->json(['error' => 'Candidate not found'], 404);
        }
        $data->skill()->detach();
        $candidate = $this->candidateRepository->delete($id);
        $data->update([
            'deleted_by' => 1
        ]);
        return response()->json(['message' => 'Candidate deleted'], 200);
    }
}