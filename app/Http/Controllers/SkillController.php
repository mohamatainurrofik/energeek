<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{

    public function show()
    {
        $data = Skill::all();

        if (!$data) {
            return response()->json(['error' => 'Skill null'], 404);
        }

        return $data;
    }

    public function showById($id)
    {
        $data = Skill::find($id);
        if (!$data) {
            return response()->json(['error' => 'Skill not found'], 404);
        }

        return $data;
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:skills'
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

        $create = Skill::create($request->all());

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
        $cek = Skill::find($id);
        if (!$cek) {
            return response()->json(['message' => 'Skill not found'], 404);
        }
        $rules = [
            'name' => 'required'
        ];
        $message = [
            'required' => ':attribute wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->messages()
            ]);
        }

        $data = Skill::find($id);
        if (!$data) {
            return response()->json(['error' => 'Skill not found'], 404);
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
        $data = Skill::find($id);
        if (!$data) {
            return response()->json(['error' => 'Skill not found'], 404);
        }
        $skill = $data->delete();
        if ($skill) {
            $data->update(['deleted_by' => 1]);
            return response()->json([
                'status' => 'success',
                'message' => 'Skill Deleted'
            ]);
        }
        return response()->json([
            'status' => 'failed',
            'message' => 'Skill not Deleted'
        ]);
    }
}
