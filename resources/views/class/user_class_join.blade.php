<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Member List</title>
</head>
<style>
    table{
        width: 800px;
    }

</style>
<body>
    <h2>학생 list</h2>
    <table>
        <tr>
            <th>아이디</th>
            <th>사용자 코드</th>
            <th>이름</th>
            <th>학교</th>
            <th>등록일</th>
            <th>수업이름</th>
            <th>관리</th>
        </tr>
        {{-- @foreach ($user_not as $user)
        <tr>
            <th>{{$user->id}}</th>
            <th>{{$user->user_code}}</th>
            <th><a href="/get_class/{{$user->user_code}}">{{$user->name}}</a></th>
            <th>{{$user->school}}</th>
            <th>{{$user->join_date}}</th>
            <th></th>
            <th><a href="/insert_class_view/{{$user->user_code}}">[수업등록]</a><br/></th>
        </tr>
        @endforeach --}}
        @foreach ($users as $user)
        <tr>
            <th>{{$user->id}}</th>
            <th>{{$user->user_code}}</th>
            <th><a href="/get_class/{{$user->user_code}}">{{$user->name}}</a></th>
            <th>{{$user->school}}</th>
            <th>{{$user->join_date}}</th>
            {{-- <th>{{$user->class_name}}</th> --}}
            <th><a href="/insert_class_view/{{$user->user_code}}">[수업등록]</a><br/></th>
        </tr>
        @endforeach
    </table>

    <h2>수업 list</h2>
    <table>
        <tr>
            <th>수업코드</th>
            <th>수업이름</th>
            <th>강사</th>
            <th>수강료</th>
            <th>시작일</th>
            <th>종료일</th>
            <th>시간</th>
            <th>수강생 수</th>           
        </tr>
        @foreach ($classs as $class)
        <tr>
            <th>{{$class->class_code}}</th>
            <th>{{$class->class_name}}</th>
            <th>{{$class->teacher}}</th>
            <th>{{$class->tuition}}</th>
            <th>{{$class->begin_date}}</th>
            <th>{{$class->end_date}}</th>
            <th>{{$class->class_time}}</th>
            {{-- <th><a href="/get_user/{{$class->class_code}}">{{$class->user_count}}</a></th> --}}
        </tr>
        @endforeach
    </table>
   
    <script>

    </script>
</body>
</html>