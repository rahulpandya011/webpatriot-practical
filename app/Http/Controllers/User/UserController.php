<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class UserController extends Controller
{
    public function dashboard(Request $request, Builder $builder)
    {
        $html = $builder->columns([
            ['data' => 'created_at', 'name' => 'created_at', 'title' => "Created at"],
            ['data' => 'full_name', 'name' => 'full_name', 'title' => "Full Name"],
            ['data' => 'email', 'name' => 'email', 'title' => "Email"],
            ['data' => 'username', 'name' => 'username', 'title' => "Username"],
            ['data' => 'profile_pic', 'name' => 'status', 'title' => "Profile Pic"],
            ['data' => 'phone_number', 'name' => 'phone_number', 'title' => "Phone no"],
            ['data' => 'hobbies', 'name' => 'hobbies', 'title' => "Hobbies"],
        ])->ajax([
            'url' => route('user.list'),
            'type' => 'POST',
            'headers' => ['X-CSRF-TOKEN' => csrf_token()],
        ])->parameters([
            'paging' => true,
            'bLengthChange' => false,
            'searching' => false,
            'info' => false,
            'aaSorting' => [],
            'order' => [0, 'desc'],
        ]);
        return view('users.list', compact('html'));
    }

    public function list(Request $request)
    {
        $user_data = User::where(
            'user_id',
            '!=',
            Auth::user()->user_id
        );

        if ($request['order'][0]['column'] == 0) {
            $user_data = $user_data->orderBy('created_at', $request['order'][0]['dir']);
        } elseif ($request['order'][0]['column'] == 1) {
            $user_data = $user_data->orderBy('first_name', $request['order'][0]['dir']);
        } elseif ($request['order'][0]['column'] == 2) {
            $user_data = $user_data->orderBy('email', $request['order'][0]['dir']);
        } elseif ($request['order'][0]['column'] == 3) {
            $user_data = $user_data->orderBy('mobile_number', $request['order'][0]['dir']);
        } elseif ($request['order'][0]['column'] == 4) {
            $user_data = $user_data->orderBy('status', $request['order'][0]['dir']);
        } else {
            $user_data = $user_data->orderBy('created_at', 'DESC');
        }
        return DataTables::of($user_data)
            ->addColumn('created_at', function ($user_data) {
                return Carbon::parse($user_data->created_at)->format('d-m-Y H:i');
            })
            ->addColumn('full_name', function ($user_data) {
                return $user_data->first_name . ' ' . $user_data->last_name;
            })
            ->addColumn('profile_pic', function ($user_data) {
                return "<img src='" . url('uploads/user_profile/' . $user_data->profile_pic) . "' width='100px'/>";
            })
            ->addColumn('hobbies', function ($user_data) {
                $str = [];
                $hb = $user_data->user_hobbies->pluck('hobby_id')->toArray();
                foreach ($hb as $key => $val) {
                    if ($val == 1) {
                        array_push($str, 'Singing');
                    } else if ($val == 2) {
                        array_push($str, 'Sports');
                    } else if ($val == 3) {
                        array_push($str, 'Gaming');
                    } else if ($val == 4) {
                        array_push($str, 'Surfing');
                    } else if ($val == 5) {
                        array_push($str, 'Music');
                    }
                }
                return implode(', ', $str);
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'full_name', 'hobbies', 'profile_pic'])
            ->escapeColumns()
            ->toJSON();
    }
}
