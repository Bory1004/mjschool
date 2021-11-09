<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class MainController extends Controller{

    //사용자<->수업등록<->수업
    public function user_class_join(){
        //회원 리스트
        $users = DB::table('users')
        ->leftjoin('register', 'users.user_code', '=', 'register.user_code')
        ->select('name', 'school', 'users.user_code', 'id', 'join_date')
        ->leftjoin('class', 'class.class_code', '=', 'register.class_code')
        // ->select(DB::raw("group_concat(class.class_name) as class_name"), 'name', 'school', 'users.user_code', 'id', 'join_date')
        // ->groupBy('name, school, users.user_code, id, join_date')
        ->get();

        //select c.class_code, count(r.user_code) as cnt, class_name, teacher, tuition, begin_date, end_date, class_time from class as c left join register as r on c.class_code = r.class_code group by c.class_code;
        //수업 리스트
        $classs = DB::table('class')
        ->leftjoin('register', 'class.class_code', '=', 'register.class_code')
        //->select(DB::raw('count(register.user_code) as user_count'),'class.class_code', 'class_name', 'teacher', 'tuition', 'begin_date', 'end_date', 'class_time')
        //->groupBy('class.class_code, class_name, teacher, tuition, begin_date, end_date, class_time')
        ->get();

        return view('class.user_class_join', ['users' => $users, 'classs' => $classs]);
    }

    //회원이름을 클릭하면 회원이 등록한 수업 리스트 출력
    public function get_class($user){
        //dd($user);
        //echo $user;
        $users = DB::table('users')
        ->select('name')
        ->where('user_code', '=', $user)
        ->get();

        $classs = DB::table('class')
        ->whereIn('class_code', function ($query) use ($user){
            $query->select('class_code')
            ->from('register')
            ->where('user_code', '=', $user);
        })->get();

        return view('class.class_list', ['classs' => $classs,'user_code' => $user, 'users' => $users]);
    }

    public function get_user($code){
        $users = DB::table('users')
        ->whereIn('user_code', function ($query) use ($code){
            $query->select('user_code')
            ->from('register')
            ->where('class_code', '=', $code);
        })->get();

        return view('class.user_list', ['users' => $users]);
    }

    //수업 등록 -> 등록할 수 있는 수업 리스트 보여주기
    public function insert_class_view($user){
        $users = DB::table('users')
        ->where('user_code', '=', $user)
        ->get();

        //echo $user;
        $classs = DB::table('class')
        ->whereNotIn('class_code', function ($query) use ($user){
            $query->select('class_code')
            ->from('register')
            ->where('user_code', '=', $user);
        })->get();

        return view('class.insert_class_view', ['classs' => $classs, 'user_code' => $user, 'users' => $users]);
    }

    //수업 등록
    public function insert_class(Request $request){
        $user_code = $request->input('user_code');
        $class_code = $request->input('class_code');
        $regi_date = Carbon::now();

        $register = DB::table('register')
        ->insert(['user_code'=>$user_code, 'class_code'=>$class_code, 'regi_date'=>$regi_date]);

        return redirect('/user_class_join');
    }

    //수업 삭제
    public function delete_class($class, $user){
        //echo $class;
        //echo $user;

        $classs = DB::table('register')
        ->where('class_code', '=', $class)
        ->where('user_code', '=', $user)
        ->delete();

        //return view('class.class_result');
        return redirect('/user_class_join');
    }
}
