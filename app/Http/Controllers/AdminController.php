<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Admin::query();

        // Fitur Search: Fullname ATAU Username
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('fullname', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $admins = $query->latest()->paginate(10);

        return AdminResource::collection($admins);
    }

    public function store(AdminCreateRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($request->password);
        if ($request->hasFile('profile')) {
            $path = $request->file('profile')->store('admin_profiles', 'public');
            $data['profile'] = $path;
        }

        $admin = Admin::create($data);

        return new AdminResource($admin);
    }

    public function show(int $adminId)
    {
        $admin = Admin::find($adminId);
        if(!$admin){
            return response()->json([
               "message"=>"Admin TIdak di temukan"
            ],404);
        }
        return new AdminResource($admin);
    }

    public function destroy(int $adminId)
    {
        $admin = Admin::find($adminId);
        if(!$admin){
            return response()->json([
                "message"=>"Admin TIdak di temukan"
            ],404);
        }

        // Hapus file foto dari storage saat data dihapus agar tidak menuh-menuhin server
        if ($admin->profile && Storage::disk('public')->exists($admin->profile)) {
            Storage::disk('public')->delete($admin->profile);
        }

        $admin->delete();

        return response()->json([
            'message' => 'Admin berhasil dihapus'
        ]);
    }

    public function update(AdminUpdateRequest $request, int $adminId)
    {
        $admin = Admin::find($adminId);
        if(!$admin){
            return response()->json([
                "message"=>"Admin TIdak di temukan"
            ],404);
        }

        $data = $request->validated();


        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        // 2. Handle Update Foto Profile
        if ($request->hasFile('profile')) {
            // Hapus foto lama jika ada di storage
            if ($admin->profile && Storage::disk('public')->exists($admin->profile)) {
                Storage::disk('public')->delete($admin->profile);
            }

            $path = $request->file('profile')->store('admin_profiles', 'public');
            $data['profile'] = $path;
        }

        $admin->update($data);

        return new AdminResource($admin);
    }

}
