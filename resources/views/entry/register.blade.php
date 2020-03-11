@extends('entry.master')

@section('title')
    注册
@endsection

@section('content')

    <el-form class="login" action="#">
        <h1>注 册</h1>
        <el-input v-model="email" placeholder="邮箱/E-mail"></el-input>
        <el-input v-model="username" placeholder="用户名/Username"></el-input>
        <el-input v-model="password" placeholder="密码/Password" show-password></el-input>
        <el-input v-model="password_confirmation" placeholder="确认密码/Confirm Password" show-password></el-input>
        <el-input id="inp_security_code" v-model="security_code" placeholder="验证码/security code">
            <template slot="append">
                <el-button class="btn_get_code" :disabled="btn_get_code_disabled" @click="getSecurityCode" round>
                    @{{btn_get_code_text}}
                </el-button>
            </template>
        </el-input>
        <el-button class="btn_register"  @click="register" round>注册</el-button>


    </el-form>

@endsection

@section('js_css')
    <script>
        var app = new Vue({
            el: '#app',
            mounted: function () {
                if (navigator.cookieEnabled == false) {
                    this.$notify.error({
                        title: '提示',
                        message: '请将浏览器Cookie设置为启用再进行注册'
                    });
                }
            },
            data() {
                return {
                    username: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    security_code: '',
                    btn_get_code_disabled: false,
                    btn_get_code_text: '获取验证码'
                }
            }
            ,
            methods: {

                getSecurityCode() {
                    if (this.checkCookies() == false) {
                        return '';
                    }
                    let data = new FormData();
                    data.append('email', this.email);
                    data.append('option','registered');
                    axios.post('/sendSecurityCode', data)
                        .then(function (res) {
                            if (res.data.status_code == 200) {
                                // app.$message.success(res.data.message);
                                app.$notify.success({
                                    title: '提示',
                                    message: res.data.message
                                });
                                app.btn_get_code_disabled = true;
                                let time = 60;
                                let timer = setInterval(function () {
                                    app.btn_get_code_text = time-- + 's后重试';
                                    if (time < 0) {
                                        app.btn_get_code_text = '获取验证码';
                                        app.btn_get_code_disabled = false;
                                        clearInterval(timer);
                                    }
                                }, 1000);
                            } else {
                                app.$notify.error({
                                    title: '提示',
                                    message: res.data.error[0]
                                });
                            }
                        })
                        .catch(function (err) {
                            app.$notify.error({
                                title: '提示',
                                message: '服务器错误，请刷新重试'
                            });
                            console.log(err);
                        });

                },
                register() {
                    if (this.checkCookies() == false) {
                        return '';
                    }
                    let data = new FormData();
                    data.append('email', this.email);
                    data.append('username', this.username);
                    data.append('password', this.password);
                    data.append('password_confirmation', this.password_confirmation);
                    data.append('security_code', this.security_code);
                    axios.post('/entry/register', data)
                        .then(function (res) {
                            if (res.data.status_code == 200) {
                                app.$notify.success(res.data.message);
                            } else {
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
                            app.$notify.error({
                                title: '提示',
                                message: '服务器错误，请刷新重试'
                            });
                            console.log(err);
                        })
                },

                checkCookies() {
                    if (navigator.cookieEnabled == false) {
                        this.$notify.error({
                            title: '提示',
                            message: '请将浏览器Cookie设置为启用再进行注册,否则将无法进行注册'
                        });
                        return false;
                    }
                    return true;
                }
            }
        })


    </script>

    <style>
        .login {
            width: 455px;
            padding: 20px;
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

        #inp_security_code {
            width: 260px;
            padding-right: 5px;
            margin-right: 5px;
        }

        .login input[type="text"]:focus,
        .login input[type="password"]:focus {
            width: 300px;
            border-color: #2ecc71;
        }

        .el-input-group__append {
            background-color: transparent;
            border: none;
            padding: 0;
            margin: 0;
        }

        .el-input-group__append button.el-button {
            width: 92px;
            background: none;
            display: block;
            padding: 10px;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #2ecc71;
            border-radius: 25px;
            outline: none;
            color: white;
            height: 50px;
            transition: 0.25s;
            cursor: pointer;

        }

        .login .btn_register {
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #2ecc71;
            outline: none;
            color: white;
            height: 50px;
            width: 80px;
            border-radius: 25px;
            transition: 0.25s;
            cursor: pointer;
        }
        .login .btn_register:hover{
            width: 100px;
        }

        .login button:hover {
            background: #2ecc71;
            color: white;
        }
    </style>
@endsection