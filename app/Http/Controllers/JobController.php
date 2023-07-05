<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    
    public function show()
    {
        $data = Job::all();

        if (!$data) {
            return response()->json(['error' => 'Job null'], 404);
        }

        return $data;
    }

    public function showById($id)
    {
        $data = Job::find($id);
        if (!$data) {
            return response()->json(['error' => 'Job not found'], 404);
        }

        return $data;
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:jobs'
        ];
        $message = [
            'required' => ':attribute wajib diisi',
            'unique' => 'skill :attribute sudah terdaftar'
        ];

        $validator = Validator::make($request->all(),$rules,$message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->messages()
            ]);
        }

        $create = Job::create($request->all());

        if ($create) {
            return response()->json([
                'status' => 'success',
                'data' => $create
            ]);
        }

        return response()->json([
            'status' => 'failed',
            'data' => $create
        ]);

    }

    public function update(Request $request, $id)
    {
        $cek = Job::find($id);
        if (!$cek) {
            return response()->json(['message' => 'Job not found'], 404);
        }
        $rules = [
            'name' => [
                'required',
                Rule::unique('jobs')->ignore($id),
                ]
        ];
        $message = [
            'required' => ':attribute wajib diisi',
            'unique' => ':attribute sudah terdaftar',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->messages()
            ]);
        }

        $data = Job::find($id);
        if (!$data) {
            return response()->json(['error' => 'Job not found'], 404);
        }
        $skill = $data->update($request->all());
        if ($skill) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Updated'
            ]);
        }

        return response()->json([
            'status' => 'failed',
            'message' => 'Data not Updated'
        ]);
    }

    public function destroy($id)
    {
        $data = Job::find($id);
        if (!$data) {
            return response()->json(['error' => 'Job not found'], 404);
        }
        $skill = $data->delete();
        if ($skill) {
            $data->update(['deleted_by' => 1]);
            return response()->json([
                'status' => 'success',
                'message' => 'Job Deleted'
            ]);
        }
        return response()->json([
            'status' => 'failed',
            'message' => 'Job not Deleted'
        ]);
    }

}
