<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title')</title>

    <script src="{{asset('/js/vue.js')}}"></script>
    <script src="{{asset('/elementUI/index.js')}}"></script>
    <script src="{{asset('/js/axios.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/elementUI/index.css')}}">
</head>

<body>
<div id="app">
    <el-container>
        <el-header class="header">
            <el-row>
                <el-col :sm="4" :xs="4" :md="4" :offset="4">
                    <a href="/home"><span>CRAFTS</span></a>
                </el-col>

                <el-col :sm="2" :xs="2" :md="2" :offset="12">
                    <a href="/entry/login">登 录</a>
                </el-col>

                <el-col :sm="2" :xs="2" :md="2">
                    <a href="/entry/register">注 册</a>
                </el-col>
            </el-row>
        </el-header>

        <el-main>
            @yield('content')
        </el-main>
    </el-container>
</div>



<style>
    body{
        padding: 0;
        margin: 0;
        background-image: url("{{asset('/images/LoginBg.jpg')}}");
        background-size: auto;
    }
    .header{
        padding: 10px;
        height: 70px;
        background: #e4dbdb18;

        line-height: 40px;

    }
    .header a{
        cursor: pointer;
        color: white;
        text-decoration:none

    }
    .header a{
        font-size: 1.1em;
    }
    .header a span{
        font-size: 2em;
    }


</style>

@yield('js_css')
</body>

</html>