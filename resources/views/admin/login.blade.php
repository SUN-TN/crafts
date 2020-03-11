<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <script src="{{asset('/js/vue.js')}}"></script>
    <script src="{{asset('/elementUI/index.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/elementUI/index.css')}}">

    <title>后台登录</title>
</head>

<body>
<div id="app">
    <form method="post" action="">
        {{ csrf_field() }}
        <div class="loginPanel">
            <el-row class="row">
                <el-col :span="14" :offset=5>
                    <el-input name="username" v-model="admin.username" placeholder="请输入用户名"></el-input>
                </el-col>
            </el-row>


            <el-row class="row">
                <el-col :span="14" :offset=5>
                    <el-input name="password" v-model="admin.password" placeholder="请输入密码" show-password></el-input>
                </el-col>
            </el-row>

            <el-row class="row">
                <el-col :span="6" :offset=9>
                    <el-button type="primary" native-type="submit" class="btn">登录</el-button>
                </el-col>
            </el-row>
        </div>
    </form>
</div>

<!-- {{--<script src="{{ asset('js/app.js') }}"></script>--}} -->
<script>
    var app = new Vue({
        el: '#app',
        mounted() {
            @if(session('error'))
                this.$message.error('{{session('error')}}');
            @endif
            @if(session('note'))
                this.$message.info('{{session('note')}}');
            @endif
        },
        data() {
            return {
                admin: {
                    username: '',
                    password: ''
                },
            }
        },
    })
</script>
</body>
<style>
    body {
        background-image: url('https://www.crafts.com/images/loginbg.png');
        background-size: 100%;
    }
    .loginPanel {
        min-width: 450px;
        min-height: 450px;
        position: fixed;
        border-radius: 25px;
        background-color: rgb(22, 16, 16);
        background-color: rgba(10, 6, 0, 0.849);
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
    .row {
        padding-top: 50px;
    }
    .row:first-child {
        padding-top: 30%;
    }
    .inp {
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .btn {
        width: 100%;
    }
</style>
</html>