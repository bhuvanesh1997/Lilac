<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhereHas('department', function($q) use ($search) {
                      $q->where('name', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('designation', function($q) use ($search) {
                      $q->where('name', 'LIKE', "%{$search}%");
                  });
        }

        if ($request->has('sortBy') && $request->has('sortOrder')) {
            $sortBy = $request->input('sortBy');
            $sortOrder = $request->input('sortOrder');
            if (in_array($sortBy, ['name', 'designation', 'department']) && in_array($sortOrder, ['asc', 'desc'])) {
                if ($sortBy === 'designation') {
                    $query->join('designations', 'users.fk_designation', '=', 'designations.id')
                          ->orderBy('designations.name', $sortOrder);
                } elseif ($sortBy === 'department') {
                    $query->join('departments', 'users.fk_department', '=', 'departments.id')
                          ->orderBy('departments.name', $sortOrder);
                } else {
                    $query->orderBy('users.name', $sortOrder);
                }
            }
        }

        $users = $query->with(['department', 'designation'])->get();

        return response()->json(['users' => $users]);
    }
}
