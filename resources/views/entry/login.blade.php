@extends('entry.master')

@section('title')
    登录
@endsection

@section('content')
    <el-form class="login" action="#">
        <h1>登 录</h1>
        <el-input v-model="email" placeholder="邮箱/E-mail"></el-input>
        <el-input v-model="password" placeholder="密码/Password" show-password></el-input>
        <el-button  @click="login">登录</el-button>
        <a href="/entry/forgotPassword" class="forgot_password">忘记密码></a>
    </el-form>
@endsection


@section('js_css')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                email: '',
                password: ''
            },
            methods: {
                login() {
                    let data = new FormData();
                    data.append('email', this.email);
                    data.append('password', this.password);
                    axios.post('/entry/login',data)
                        .then(function (res) {
                            if(res.data.status_code == 200){
                                app.$message.success(res.data.message);
                                setTimeout(function () {
                                    window.location.href="/home";
                                },1000)
                            }else{
                                res.data.error.forEach(item => {
                                    setTimeout(function () {
                                        app.$notify.error({
                                            title: '提示',
                                            message: item
                                        });
                                    }, 1)
                                });
                            }

                        })
                        .catch(function (err) {
                        });
                }
            }

        })
    </script>

    <style>
        .login {
            width: 360px;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #252525;
            /* background: #eceaea; */
            text-align: center;
            border-radius: 24px;
            opacity: 0.9;
        }

        .login h1 {
            color: white;
            text-transform: uppercase;
            font-weight: 500;
        }

        .login input[type="text"],
        .login input[type="password"] {
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #3498db;
            padding: 14px 10px;
            width: 260px;

            height: 50px;
            outline: none;
            color: white;
            border-radius: 24px;
            transition: 0.25s;
        }

        .login input[type="text"]:focus,
        .login input[type="password"]:focus {
            width: 300px;
            border-color: #2ecc71;
        }

        .login button {
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #2ecc71;
            width: 80px;
            outline: none;
            color: white;
            height: 50px;
            border-radius: 24px;
            transition: 0.25s;
            cursor: pointer;
        }

        .login button:hover {
            background: #2ecc71;
            color: white;
            border: none;
            width: 100px;
        }

        .forgot_password {
            float: right;
            margin-right: 0px;
            color: white;
            font-size: 0.8em;
            text-decoration: none;

        }

        .forgot_password:hover {
            cursor: pointer;
            color: #2ecc71;
        }

    </style>
@endsection
