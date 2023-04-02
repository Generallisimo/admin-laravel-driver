<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\DriverFile;



class AdminPanelController extends Controller
{
    public function AdminPanel(){
        // получение имени текущего аутентифицированного пользователя
        $name = Auth::user()->name;
        $count = User::count();
        return view('admin/admin_panel', ['name' => $name], ['count'=>$count] );
    }
    public function AdminDrivers(){
        // получение имени текущего аутентифицированного пользователя
        $name = Auth::user()->name;
        // выводим из бд 
        $users = DB::table('users')->get();
        // выводим все var
        return view('admin/admin_drivers', ['name' => $name,'users' => $users]);
    }
    
    public function addNewUser(){
        $name = Auth::user()->name;
        return view('admin/admin_add', ['name' => $name]);
    }

    public function addUser(Request $request)
    {
        $data = date('d.m.Y');
        // DB::table('users')->insert([
        //     'name' => $request->name,
        //     'phone' => $request->phone,
        //     'password' =>$request->password_no,
        //     'password_no'=>$request->password,
        //     'data' => $data,
        // ]);
        // return redirect()->back();
        // Создаем нового пользователя
        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->phone = $request->phone;
        $newUser->data = $data;
        $password = Str::random(8);
        $newUser->password_no = $password;
        $newUser->password = Hash::make($password);
        $newUser->save();

        // Добавляем роль пользователю
        $userRole = Role::where('name', 'user')->first();
        $newUser->roles()->attach($userRole);
        // Редирект на страницу со списком пользователей
        return redirect('/drivers');
    }

    public function deleteUser($id)
    {
        // ищем 
        $user = User::findOrFail($id);
        // удаляем роль
        $user->roles()->detach();
        // удаляем пользователя
        $user->delete();
    
        return redirect()->back();
    }
    
    // делаем синхранизацию по кнопке
    public function sync(Request $request)
    {
        $response = Http::withHeaders([
            'Api-Key' => 'wTspil9TDdEx6wxouJU9dm1bmbQgF5WAEV4AQt2GrXVjNZu7xUAtmBCoP10vMQQm1PR8wZpvtONqlXijvx70q4PII6KipdVto6XAyTaOMcEzxVrUFX0dAssrRYUk2zeB',
            'Accept'=>'application/json',
        ])->get('http://taxi-admin.mercool.ru/api/drivers');
        
        $drivers = $response->json();

        foreach ($drivers['result']['data'] as $driver) {
            // Проверяем, есть ли такой водитель в базе
            $existingDriver = User::where('id', $driver['id'])->first();

            // Если водитель не существует, создаем новую запись в базе
            if (!$existingDriver) {
                $newDriver = new User();
                $newDriver->id = $driver['id'];
                $newDriver->name = $driver['first_name'] . ' ' . $driver['last_name'];
                $newDriver->phone = $driver['phones'][0];
                $newDriver->data = date('d.m.Y');
                // $newDriver->email = Str::random(10) . '@example.com';
                $password = Str::random(8);
                $newDriver->password_no = $password;
                $newDriver->password = Hash::make($password);
                // $newDriver->password = bcrypt($password);
                $newDriver->save();
                // Добавление роли user
                $userRole = Role::where('name', 'user')->first();
                $newDriver->roles()->attach($userRole);
            }
        }

        return redirect()->back();
    }
    public function show($id)
    {

        $driver = User::find($id);
    $files = $driver->driverFiles()->orderBy('created_at', 'desc')->get();
        return view('admin/admindriver', compact('driver', 'files'));
        // $driver = User::find($id);
        // return view('admin/admindriver', compact('driver'));
    }
    public function showFiles(Request $request, $driverId)
    {
        // получаем пользователя по id
        $driver = User::findOrFail($driverId);
        // проверяем, есть ли загруженный файл
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $uploadedFile) {
                // создаем новый объект файла
                $file = new DriverFile();
                $file->driver_id = $driver->id;
                // получаем имя и расширение файла
                $file->filename = $uploadedFile->getClientOriginalName();
                $file->extension = $uploadedFile->getClientOriginalExtension();
                // перемещаем файл в папку storage/app/public/files
                $path = $uploadedFile->store('public/files');
                $file->path = $path;
                // сохраняем объект файла в базе данных
                $file->save();
            }
        }
        // перенаправляем пользователя на страницу профиля
        return redirect()->route('showDriver', ['id' => $driver->id]);
    }
    

}


