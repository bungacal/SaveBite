<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display the admin dashboard with user statistics.
     */
    public function index(Request $request)
    {
        // Get search and pagination parameters
        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);

        // Build user query with search functionality - simplified since we don't have role column yet
        $usersQuery = User::query()
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%")
                      ->orWhere('address', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'asc');

        // Get paginated users
        $users = $usersQuery->paginate($perPage)->appends($request->query());

        // Calculate statistics - simplified since we don't have role/donations tables yet
        $donorsCount = User::where('register_as', 'organization')->count() + 
                      User::where('register_as', 'company')->count();
        $receiversCount = User::where('register_as', 'personal')->count();
        
        // Mock data for now since we don't have donations table
        $foodDistributedCount = 2420;

        return view('admin.dashboard', compact(
            'users',
            'donorsCount',
            'receiversCount',
            'foodDistributedCount'
        ));
    }

    /**
     * Display user details.
     */
    public function showUser(User $user)
    {
        return view('admin.dashboard2', compact('user'));
    }

    /**
     * Delete a user.
     */
    public function deleteUser(User $user)
    {
        // Store user info for success message
        $userName = $user->name;

        // Delete user
        $user->delete();

        // Redirect with success message
        return redirect()
            ->route('admin.dashboard')
            ->with('success', "User {$userName} has been successfully deleted from the system.");
    }

    /**
     * Get user statistics for AJAX requests.
     */
    public function getStatistics()
    {
        $statistics = [
            'donors_count' => User::where('register_as', 'organization')->count() + 
                             User::where('register_as', 'company')->count(),
            'receivers_count' => User::where('register_as', 'personal')->count(),
            'food_distributed_count' => 2420, 
            'total_users' => User::count(),
        ];

        return response()->json($statistics);
    }

    /**
     * Search users via AJAX.
     */
    public function searchUsers(Request $request)
    {
        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);

        $users = User::when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%")
                      ->orWhere('address', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'asc')
            ->paginate($perPage);

        return response()->json([
            'users' => $users->items(),
            'pagination' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'per_page' => $users->perPage(),
                'total' => $users->total(),
            ]
        ]);
    }
}