<?php

namespace App\Http\Controllers\Panel;

use App\Helpers\EnConverter;
use App\Helpers\Reply;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ImageService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public $imageService;
    public $userService;

    public function __construct(ImageService $imageService, UserService $userService)
    {
        $this->imageService = $imageService;
        $this->userService = $userService;
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = User::orderBy('id', 'DESC')->Where('role', 'caller')
            ->when($request->get('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . EnConverter::ar2fa($request->name) . '%');
            })
            ->when($request->get('mobile'), function ($query) use ($request) {

                $query->where('mobile', 'like', '%' . $request->mobile . '%');
            })
            ->when($request->get('national_code'), function ($query) use ($request) {
                $query->where('national_code', 'like', '%' . $request->national_code . '%');
            })
            ->when($request->get('gender'), function ($query) use ($request) {
                $query->where('gender', $request->gender);
            })
            ->when($request->get('role'), function ($query) use ($request) {
                $query->role($request->role);
            })
            ->paginate(30);
        $roles = Role::all();

        return view('panel.user.index', ['users' => $users, 'roles' => $roles]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $row = [];
        $roles = Role::all();


        return view('panel.user.create', [
            'row' => $row,
            'roles' => $roles,

        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'family' => 'required',
            'national_code' => 'required|unique:users',
            'gender' => 'required',
        ]);
        $role = $request->role;
        $password = Hash::make($request->national_code);
        $user = $this->userService->userCreate($request, $role, $password);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            foreach ($image as $index => $file) {
                $file_name = $index . time() . '.' . $file->extension();
                $this->imageService->store($file_name, $file, 400, 300, 'user_photos');
                $user->images()->create(['file' => $file_name]);
            }
        }
        $role = Role::where('name', $request->role)->first();
        $user->syncRoles($role);
        return redirect('/panel/users');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('panel.role.show', [
            'role' => $role,
            'rolePermissions' => $rolePermissions
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->with('images')->first();
        return view('panel.user.edit', [
            'row' => $user
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $password = Hash::make($request->national_code);
        $this->userService->userUpdate($user, $request, $password);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            foreach ($image as $index => $file) {
                $file_name = $index . time() . '.' . $file->extension();
                $this->imageService->store($file_name, $file, 400, 300, 'user_photos');
                $user->images()->create(['file' => $file_name]);
            }
        }
        return redirect('/panel/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $item = User::find($id);
        if ($item) {
            $item->delete();
            return 'ok';
        }
    }
}
