<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        $data_users = User::paginate(10);
        return view('page.dashboard', compact('data_users'));
    }

    public function indexApi()
    {
        $data_users = User::paginate(10);
        return response(['data' => $data_users]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'status' => 'required|in:active,inactive',
            'position' => 'required',
        ])->validate();

        User::create($request->all());

        return redirect('/dashboard');
    }

    public function storeApi(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'status' => 'required|in:active,inactive',
            'position' => 'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['error' => $validator->errors()->all()], 400);
        }

        User::create($request->all());

        return response()->json(['success' => 'Create Success.']);
    }

    public function input()
    {
        return view('page.input');
    }

    public function show($id)
    {
        $user = User::where('id', '=', $id)->first();

        return view('page.edit', compact(['user', 'id']));
    }

    public function showApi($id)
    {
        $user = User::where('id', '=', $id)->first();

        return response()->json(['data' => $user]);
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'status' => 'required|in:active,inactive',
            'position' => 'required',
        ])->validate();

        User::where('id', '=', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'status' => $request->status,
                'position' => $request->position,
            ]);

        return redirect('/dashboard');
    }

    public function updateApi(Request $request, $id)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'status' => 'required|in:active,inactive',
            'position' => 'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['error' => $validator->errors()->all()], 400);
        }

        User::where('id', '=', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'status' => $request->status,
                'position' => $request->position,
            ]);

        return response()->json(['success' => 'Update Success.']);
    }

    public function destroy($id)
    {
        User::where('id', '=', $id)->delete();

        return redirect('/dashboard');
    }

    public function destroyApi($id)
    {
        User::where('id', '=', $id)->delete();

        return response()->json(['success' => 'Delete Success.']);
    }
}
