<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
</head>
<body>
    <h1>Profiles</h1>
    <hr>



    {{-- <?php 
        foreach ($users_list as $users) {     ?>
            <h1> <?= $users ['name'] ?></h1>
            <h1> <?= $users ['age'] ?></h1>
    <?php }?> --}}

        {{-- using Laravel Blade --}}
    @foreach ($users_list as $users)
        <h1> {{$users['name']}}</h1>
        <h1> {{$users['age']}}</h1>

        @if ($users['age']<18)
            <p> User Can't Log</p>
            
        @endif
        <hr>
    @endforeach

</body>
</html>