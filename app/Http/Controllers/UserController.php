<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $users = User::paginate(5);

      return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:225',
            'email' => 'required|string|email|max:225|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,kasir,waiters,kitchen',
        ]);

        try {


        DB::beginTransaction();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);


        DB::commit();

        return redirect()->route('userindex')
           ->with('success', 'User berhasil disimpan.');

    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->back()
            ->with('error', 'Terjadi kesalahan dalam input user' . $e->getMessage())
            ->withInput();
        }
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
        $user = User::findOrfail($id);
        return view('user.edit', ['users' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        

         $user = User::findOrFail($id); 
 
          if ($request->filled('password')) {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:users,name,'.$user->id,
                'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
                'password' => 'required|string|min:8',
                'role' => 'required'
            ]);
          }else{
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:users,name,'.$user->id,
                'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
                'role' => 'required'
            ]);
          }


           try {
 
            DB::beginTransaction();  
       
            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
            ];
 
           if ($request->filled('password')) {
                $userData['password'] = Hash::make($validated['password']);
            }
            $user->update($userData);
            
            
            
            DB::commit();
            
          return redirect()->route('userindex')
            ->with('success', 'Data user berhasil diupdate.');
        } catch (Exception $e) {
           DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Data user gagal diupdate, karena: ' . $e->getMessage())
                ->withInput();
        }
         
              
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            
            $user = User::findOrFail($id);
            
            if (Auth::id() == $user->id) {
                return redirect()->back()
                    ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            }else{
                $user->delete();
                
                DB::commit();
                
              return redirect()->route('userindex')
                    ->with('success', 'User berhasil dihapus.');
            }
           
 
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'User gagal dihapus' . $e->getMessage());
        }
    }
}