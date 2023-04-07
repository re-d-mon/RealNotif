<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Group;
use App\Notifications\PostLikeNotification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //запрос к БД
        //получения списка групп и участников каждой группы

        $groups = DB::table('user__groups')
        ->join('users', 'user__groups.ID_USER', '=', 'users.id')
        ->join('groups', 'user__groups.ID_GROUP', '=', 'groups.id')
        ->select(DB::raw(' groups.id, GROUP_CONCAT(users.id SEPARATOR \', \') as id_user'))
        ->groupBy('groups.id')
        ->get();
    
        return view('home',['groups'=>$groups]);
    }
    public function To_Do_List()
    {
        //получение текушего пользователя
        $this_User = auth()->user();
        //получения списка задач от групп, в которых состоит пользователь
        $groups_to_do_list = DB::table('to__do__list__group')
        ->join('groups', 'groups.id', '=', 'to__do__list__group.ID_Group')
        ->join('user__groups', 'user__groups.ID_GROUP', '=', 'groups.id')
        ->select(DB::raw('to__do__list__group.id,End_Date,user__groups.ID_GROUP, Name,descriptions'))
        ->where('ID_USER',$this_User->id)
        ->get();

        echo($groups_to_do_list);
        //получения списка задач опользователя
        $user_to_do_list = DB::table('to__do__list__user')
        ->select(DB::raw('id,End_Date,descriptions'))
        ->where('ID_USER',$this_User->id)
        ->get();
        
    
        return view('todolist',['groups_to_do_list'=>$groups_to_do_list, "user_to_do_list"=>$user_to_do_list]);
    }
    public function postLike(Request $request){
        /* получения списка пользователей группы*/
        $User_In_Groups = DB::table('user__groups')
        ->where('ID_GROUP', $request->post_id)
        ->get();

       

        /*Пользователь который отправил уведомления */
        $user_Output = auth()->user();
        
        /*Проход по всем пользователям группы*/
        foreach($User_In_Groups as $row) {
            echo($row->ID_USER);

            /*Получение  пользователя*/
            $User_Input = User::find($row->ID_USER);

            /*Пользоваель которому отправляем*/
            $author = $User_Input;
        
            if($author){
            /*Создаем новое уведомление, передавая пользоваеля который отправил уведомления*/
            $author->notify(new PostLikeNotification($user_Output));//файл http/notifications/PostLikeNotification
            }
        }
       
        return response()->json([]);
        
    }
    //добавление задач
    public function add_to_do(Request $request){
        DB::table('to__do__list__user')->insert([
            ['descriptions' => $request->desk, 'ID_Group' => $request->id_Group,'End_Date'=> $request->date]
        ]);
        return response()->json([]);
        
    }

    public function add_to_do_group(Request $request){
       
        return view('home',['groups'=>$request]);
        DB::table('to__do__list__group')->insert([
            ['descriptions' => $request->desk, 'ID_User' => $request->id,'End_Date'=> $request->date]
        ]);
        return response()->json([]);
        
    }
}
