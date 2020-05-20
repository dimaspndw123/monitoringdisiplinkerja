<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MDK | Monitoring Disiplin Kerja</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/asset/style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body class="body">
    <div class="transparent-black-background">
        <div class="input-body">
            <div class="title">
                Monitoring Disiplin Kerja
            </div>
            <form>
                <labe>Tanggal</labe>
                <input name="tanggal" type="date" class="input">
                <labe>Jam Masuk</labe>
                <input name="jammasuk" type="time" class="input" id="jammasuk">
                <labe>Jam Pulang</labe>
                <input name="jampulang" type="time" class="input" id="jampulang">
                <labe>Tugas</labe>
                <input name="tugas" type="text" class="input">
                <labe>Kendala</labe>
                <input name="kendala" type="text" class="input">
                <labe>Lama kerja</labe>
                <input name="lama" type="text" class="input" id="lama">
                <button type="submit" class="btn btn-submit">Post</button>
            </form>
        </div>
        <div class="table-monitor">
            <table class="table" border="1">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam Masuk</th>
                        <th scope="col">Jam Pulang</th>
                        <th scope="col">Tugas</th>
                        <th scope="col">Kendala</th>
                        <th scope="col">Lama kerja</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dt)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$dt -> tanggal}}</td>
                        <td>{{$dt -> jammasuk}}</td>
                        <td>{{$dt -> jampulang}}</td>
                        <td>{{$dt -> tugas}}</td>
                        <td>{{$dt -> kendala}}</td>
                        <td>{{$dt -> lama}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".btn-submit").click(function(e) {
        e.preventDefault();
        var tanggal = $("input[name=tanggal]").val();
        var jammasuk = $("input[name=jammasuk]").val();
        var jampulang = $("input[name=jampulang]").val();
        var tugas = $("input[name=tugas]").val();
        var kendala = $("input[name=kendala]").val();
        var lama = $("input[name=lama]").val();
        // document.getElementById("demo").innerHTML = name;
        $.ajax({
            type: 'POST',
            url: "{{url('/index')}}",
            data: {
                tanggal: tanggal,
                jammasuk: jammasuk,
                jampulang: jampulang,
                tugas: tugas,
                kendala: kendala,
                lama: lama
            },
            success: function(data) {
                alert(data.success + lama);
                window.location.reload();
            }
        });

    });
    $(document).ready(function() {
        $("input").keyup(function() {
            var jammasuk = $('#jammasuk').val();
            var jampulang = $('#jampulang').val();
            var hours = jampulang.split(':')[0] - jammasuk.split(':')[0];
            var minutes = jampulang.split(':')[1] - jammasuk.split(':')[1];

            if (jammasuk <= "12:00" && jampulang >= "13:00") {
                a = 1
                if (jammasuk <= "16:00" && jampulang >= "17:00") {
                    a = 1 + a;
                    if (jammasuk <= "18:00" && jampulang >= "19:00") {
                        a = 1 + a;
                    }
                }
            } else if (jammasuk <= "16:00" && jampulang >= "17:00") {
                a = 1;
                if (jammasuk <= "18:00" && jampulang >= "19:00") {
                    a = 1 + a;
                }
            } else if (jammasuk <= "18:00" && jampulang >= "19:00") {
                a = 1;
            } else {
                a = 0;
            }
            minutes = minutes.toString().length < 2 ? '0' + minutes : minutes;
            if (minutes < 0) {
                hours--;
                minutes = 60 + minutes;
            }
            hours = hours.toString().length < 2 ? '0' + hours : hours;

            $('#lama').val(hours - a + ':' + minutes);
        });
    });
</script>

</html>