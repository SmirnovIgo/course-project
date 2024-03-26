
<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function index()
    {
        $trainers = Trainer::all();
        return view('trainers.index', compact('trainers'));
    }

    public function create()
    {
        return view('trainers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:trainers',
            'password' => 'required|min:6',
        ]);

        Trainer::create($request->all());

        return redirect()->route('trainers.index')
            ->with('success', 'Trainer created successfully.');
    }

    public function show(Trainer $trainer)
    {
        return view('trainers.show', compact('trainer'));
    }

    public function edit(Trainer $trainer)
    {
        return view('trainers.edit', compact('trainer'));
    }

    public function update(Request $request, Trainer $trainer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:trainers,email,' . $trainer->id,
            'password' => 'nullable|min:6',
        ]);
    }

    public function destroy(Trainer $trainer)
    {
        $trainer->delete();

        return redirect()->route('trainers.index')
            ->with('success', 'Trainer deleted successfully.');
    }

    // Добавьте здесь другие методы для управления тренерами, такие как show, edit, update, delete, и т.д.
}





use App\Models\PageGroup;
use App\Models\PageGroupPermission;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Trainer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class TrainerController extends Controller
{
    public static string $PAGE = 'trainers';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 0)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        $trainer_role = Role::where('id', '3')->first();
//        dd($trainer_role->pagesPermisions[1]->pageGroup->name);
//        $client_role = Role::create([
//            'name' => 'client',
//        ]);
//        Permission::create([
//            'role_id' => $client_role->id
//        ]);
//       $groups =  PageGroup::all();
//       foreach ($groups as $group) {
//           PageGroupPermission::create([
//               'role_id' => $client_role->id,
//               'page_group_id' => $group->id,
//           ]);
//       }
//        ->pagesPermisions[0]->pageGroup
//        $page_group = PageGroup::where('id', '2')->first();
//        dd($page_group->pageGroupPermission);
        $trainers = User::where('role_id', $trainer_role->id)->get();
        return view('trainers.index', ['trainers' => $trainers]);
    }

    public function create() {
        if(!Auth::user()->checkPermission(self::$PAGE, 1)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        return view('trainers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 1)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        // Валідація даних
        $validator = $this->validateData($request->all());

        // Перевірка результату валідації
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $trainer_role = Role::where('name', 'trainer')->first();
        $trainer = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $trainer_role->id,
        ]);

        return redirect()->route('trainers.index')->with('success', 'Trainer successfully created.');
    }

    private function validateData(array $data, $user_id = false)
    {

        // Визначте правила валідації для полів
        $email_rules = 'required|email|unique:users';
        $password_rules = 'required|string|min:5';
        if($user_id) {
            $user_with_email_exists = User::where('email',$data['email'])->where('id',$user_id)->exists();
            if($user_with_email_exists) {
                $email_rules = 'required|email';
            }
            $password_rules = '';
        }

        $rules = [
            'name' => 'required|string|max:255|min:3',
            'email' => $email_rules,
            'password' => $password_rules,
        ];

        // Визначте повідомлення про помилку для кожного правила (необов'язково)
        $messages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
        ];

        // Створення об'єкта валідації
        return Validator::make($data, $rules, $messages);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 2)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        $trainers = User::find($id);
        return view('trainers.edit', ['trainers' => $trainers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 2)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        // Валідація даних
        $validator = $this->validateData($request->all(), $id);

        // Перевірка результату валідації
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $trainer = User::find($id);
        $trainer->name = $request->name;
        $trainer->email = $request->email;
        if(isset($request->password)) {
            $trainer->password = Hash::make($request->password);
        }
        $trainer->save();


        return redirect()->route('trainers.index')->with('success', 'Trainer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!Auth::user()->checkPermission(self::$PAGE, 3)) {
            return back()->withErrors(["message" => Lang::get('translation.not_allowed')]);
        }
        $trainers = Trainer::find($id);
        $trainers->delete();
        return redirect()->route('trainers.index')->with('success', 'Trainer deleted successfully.');
    }

    public function lide()
    {
        $trainers = Trainer::all();
        return view('trainers.lide', ['trainers' => $trainers]);
    }
}
